<?php

/**
 * Common class.
 * Common is the data structure for keeping
 */
class Common extends CFormModel
{
    static function validateLoginToken(){
        if (!$token_data = Common::getLoginToken()) {
            Common::sendResponse(401, 'Unauthorized');
            Yii::app()->end();
        }
    }

    static function getLoginToken($token = null){
        $token = isset($token) && $token ? $token : Common::getBearerToken();
        try {
            $decode = Yii::app()->JWT->decode($token);
            return $decode;
        } catch (Exception $e) {
            return false;
        }
    }


    static function getBearerToken(){
        $headers = getallheaders();

        if(isset($headers['authorization']) || isset($headers['Authorization'])) {

            /* Bearer eyJ0eXAiOiJKV1QiLCJhbGc.. */
            if (isset($headers[ 'authorization' ])) // Android sends as "authorization"
            {
                $explode = explode('Bearer ', $headers[ 'authorization' ]);
            } else // IOS sends as "Authorization"
            {
                $explode = explode('Bearer ', $headers[ 'Authorization' ]);
            }

            /* HEADER: Get the access token from the header */
            if (isset($explode[ 1 ])) {
                return $explode[ 1 ];
            }
        }
        return null;
    }

    public static function sendResponse($status = 200, $body = '', $contentType = 'application/json')
    {
        // Set the status
        $statusHeader = 'HTTP/1.1 ' . $status . ' ' . self::getStatusCodeMessage($status);
        header($statusHeader);
        // Set the content type
        header('Content-type: ' . $contentType);

        echo $body;
        Yii::app()->end();
    }

    public static function getStatusCodeMessage($status)
    {
        $codes = array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

}
