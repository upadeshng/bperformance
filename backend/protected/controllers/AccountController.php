<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Cache-Control: no-cache');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Accept, Authorization, X-Requested-With');

class AccountController extends Controller
{
    public function actionLogin()
    {
        $body = Yii::app()->request->getRawBody();
        $json = CJSON::decode($body);

        $username = isset($json['username']) ? $json['username'] : '';
        $password = isset($json['password']) ? $json['password'] : '';

        $model = new LoginForm;
        $model->username = $username;
        $model->password = $password;

        $model->validate();
        $get_errors = $model->getErrors();
        if($get_errors){
            $values = array_map('array_pop', $get_errors);
            $message = implode('<br>', $values);
        }

        if (!$get_errors && $token = $model->authenticate()) {

            /* format token and user info */
            $token_data = Common::getLoginToken($token);
            $status = 200;

            /* token response info */
            $data = [];
            $data['result']='SUCCESS';
            $data['token']=$token;
            $data['data']=$token_data;
            $token_data = CJSON::encode($data);

            /* response */
            Common::sendResponse(200,$token_data);
            Yii::app()->end();
        }

        $return_data = [
            'status'=>isset($status) ? $status : '',
            'result'=>isset($result) ? $result : 'ERROR',
            'message'=>isset($message) ? $message : 'ERROR',
        ];

        /* response */
        Common::sendResponse(200,CJSON::encode($return_data));
        Yii::app()->end();
    }

}