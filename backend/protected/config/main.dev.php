<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return [
    'basePath'   => dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '..',
    'name'       => 'My Web Application',

    // preloading 'log' component
    'preload'    => [ 'log' ],

    // autoloading model and component classes
    'import'     => [
        'application.models.*',
        'application.components.*',
        'application.helpers.*',
        'application.extensions.*',
    ],
    //'timeZone'   => 'Australia/Sydney',
    'timeZone'   => 'Asia/Kathmandu',
    'modules'    => [

        'profile'  => [ 'defaultController' => 'profile' ],
        'basic'    => [ 'defaultController' => 'profile' ],
        'practice' => [ 'defaultController' => 'profile' ],
        'pharmacy' => [ 'defaultController' => 'profile' ],
        'super'    => [ 'defaultController' => 'clinic' ],
        'patient',

        // uncomment the following to enable the Gii tool
        'gii'      => [
            'class'     => 'system.gii.GiiModule',
            'password'  => 'afd',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => [ '127.0.0.1', '::1' ],
        ],

    ],

    // application components
    'components' => [
        // cors origin allow to specific domain that has book button widget integrated
        'behaviors' => require( dirname( __FILE__ ) . '/_behavior.php' ),
        'JWT' => array(
            'class' => 'ext.JWT.JWT',
            'key' => 'medikoma-token-autentication-key',
        ),
        'mail' => [
            'class'      => 'Mail',
            'host'       => 'smtp.postmarkapp.com',
            'from_email' => 'contact@medikoma.com', //According to Postmark rules, from email can not be changed
            'from_name'  => 'Medikoma email service',
            'port'       => '587',
            'username'   => 'ab1b4156-6b15-4e10-9624-eaf2bde4d03f',
            'password'   => 'ab1b4156-6b15-4e10-9624-eaf2bde4d03f'

        ],

        'currency_formator' => [
            'class' => 'ext.yii-extension-INRCurrencyFormator-master.INRCurrencyFormator',
            'params' => [
                'postfix' => 'only',
                'currency' => ''
            ]
        ],

        'cache' => [
            'class' => 'CFileCache'
        ],

        'user' => [
            // enable cookie-based authentication
            'allowAutoLogin'            => true,
            'loginRequiredAjaxResponse' => 'YII_LOGIN_REQUIRED',
        ],

        'session' => [
            'class'   => 'CDbHttpSession', //Set class to CDbHttpSession
            'timeout' => 8 * 60 * 60, // 8 hours
        ],


        'urlManager' => require( dirname( __FILE__ ) . '/_urlmanager.php' ),

        // database settings are configured in database.php
        'db'         => [
            //'connectionString' => 'mysql:host=localhost;dbname=medikoma;unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock',

            'connectionString' => 'mysql:host=db1.csrew4qrtkkz.ap-south-1.rds.amazonaws.com;dbname=medikoma_dev',
            'emulatePrepare'   => true,
            'username'         => 'dbroot',
            'password'         => 'dkiy738yrh87dhj27',
            'charset'          => 'utf8',
        ],

        'errorHandler' => [
            // use 'site/error' action to display errors
            'errorAction' => YII_DEBUG ? null : 'site/error',
        ],

        'log' => [
            'class'  => 'CLogRouter',
            'routes' => [
                [
                    'class'  => 'CFileLogRoute',
                    'levels' => 'error, warning',

                ],
                // uncomment the following to show log messages on web pages

                /*[
                    'class' => 'CWebLogRoute',
                ],*/

            ],
        ],

    ],

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'     => [
        'server_ip'        => 'http://13.127.38.165',
        'server_socket_notification_port'        => '3003',
        'emailFrom'        => 'contact@medikoma.com',
        'inboundEmailFrom' => '',
        'portmarkToken'    => 'ab1b4156-6b15-4e10-9624-eaf2bde4d03f',
        'smsApi' => [
            'url'   => 'http://api.sparrowsms.com/v2/sms/',
            'token' => 'raMO1hwnItvOzz4Md2fw',
            'from'  => 'Medikoma', //InfoSMS
        ],
        'debug' => [
            'email' => [
                'to' => 'upadesh.ng@gmail.com'
            ],
            'sms'   => [
                'to' => ''
            ]
        ],
        // true for maintenance mode
        'maintenance' => false
    ],
];
