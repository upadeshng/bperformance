<?php

if (count( $argv ) > 3) {

    $branch = end( $argv );

    switch ($branch) {
        case 'origin/local':
            $environment = 'local';
            break;
        case 'origin/develop':
            $environment = 'dev';
            break;
        case 'origin/master' :
            $environment = 'live';
            break;
    }

    if (empty( $environment )) {
        die( "Branch specified is no correct \n" );
    }

    if (file_exists( dirname( __FILE__ ) . '/config/console.' . $environment . '.php' )) {

        $yiic   = dirname( __FILE__ ) . '/../yii/framework/yiic.php';
        $config = require_once( dirname( __FILE__ ) . '/config/console.' . $environment . '.php' );

        require_once( $yiic );

    } else {
        die( "Please, enter valid environment.\n" );
    }
} else if (count( $argv ) == 2 && $argv[1] == 'migrate') { //Local environment

    $yiic   = dirname( __FILE__ ) . '/../../yii/framework/yiic.php';
    $config = require_once( dirname( __FILE__ ) . '/config/console.local.php' );

    require_once( $yiic );

} else {
    die( "Please, specify environment.\nExample: 'php yiic  migrate up {branch}' \n" );
}
