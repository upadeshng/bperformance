<?php

return [
    'urlFormat'      => 'path',
//    'showScriptName' => false,
    'caseSensitive'  => false,
    'rules'          => [

        '/' => '/',
        ''  => 'site/index',

//        '<action:(login|logout|loginlocalserver|signup|about|forgotpassword|signupactivate|accessaccount|maintenance)>' => 'site/<action>',


        // pagination
//        '<controller:\w+>/<action:\w+>/page/<Clinicmember_page:\d+>' => '<controller>/<action>',

        '<controller:\w+>/<id:\d+>'              => '<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
        '<controller:\w+>/<action:\w+>'          => '<controller>/<action>',

       '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
    ],
];