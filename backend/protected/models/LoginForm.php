<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
    public $username;
    public $password;
    public $rememberMe;
    public $loginType;

    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return [
            // username and password are required
            [ 'username, password', 'required' ],
            [ 'loginType', 'required', 'on'=>'qna_login' ],
            // rememberMe needs to be a boolean
            [ 'rememberMe', 'boolean' ],
            // password needs to be authenticated
            [ 'password', 'authenticate' ],
        ];
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return [
            'username'   => 'Username',
            'rememberMe' => 'Remember me next time',
        ];
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate()
    {
        $this->_identity = new UserIdentity( $this->username, $this->password );
        $token = $this->_identity->authenticate();

        return $token;

    }
}
