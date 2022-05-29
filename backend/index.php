<?php
function env()
{
    $env = getenv('APP_ENV');
    if (empty( $env )) {
        //define('YII_ENV', 'local'); ToDo: Uncomment this if you going to use constants instead of function env()
        return 'local';
    } else {
        //define('YII_ENV', $env); ToDo: Uncomment this if you going to use constants instead of function env()
        return $env;
    }
}



$env = env();

// include global function
$global_function = dirname( __FILE__ ) . '/protected/config/index_global_function.php';
require_once($global_function);


// change the following paths if necessary
$yii    = dirname( __FILE__ ) . '/yii/framework/yii.php';

// environment config file
$config = dirname( __FILE__ ) . '/protected/config/main.' . $env . '.php';

// disable debug in production mode
if ($env != 'live'){
    defined( 'YII_DEBUG' ) or define( 'YII_DEBUG', true );
}

// specify how many levels of call stack should be shown in each log message
defined( 'YII_TRACE_LEVEL' ) or define( 'YII_TRACE_LEVEL', 3 );

// show all errors
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );


require_once( $yii );
Yii::createWebApplication( $config )->run();
