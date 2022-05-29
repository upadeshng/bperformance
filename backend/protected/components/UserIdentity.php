<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $crt = new CDbCriteria;
        $crt->condition = '(username=:username) 
        and (password=:password) ';
        $crt->params[ ':username' ]           = $this->username;
        $crt->params[ ':password' ]        = md5( $this->password );

        $user = User::model()->find($crt);


        if ($user === null) {
            return false;

        } else {

            $this->errorCode = self::ERROR_NONE;
            $data = array(
                "name" => $user->name,
                "username" => $user->username,
                "email" => $user->email,
                "mobile" => $user->mobile,
                "date" => date( 'Y-m-d H:i' ),
                "id" => $user->id,
            );

            /* encode jwt token */
            $token = Yii::app()->JWT->encode($data);

            return $token;

        }

    }
}