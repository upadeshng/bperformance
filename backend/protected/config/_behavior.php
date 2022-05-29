<?php

return [
    [
        'class'       => 'application.extensions.CorsBehavior',
        //'route'       => ['controller/actionA', 'controller/actionB', 'controllerC/*'],
        'route'       => '*',
        'allowOrigin' => '*'
    ],
];