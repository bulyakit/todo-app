<?php

/**
 * @link http://www.slimframework.com/docs/objects/application.html#slim-default-settings
 */

return [
    'settings' => [
        // Allow the web server to send the content-length header
        'addContentLengthHeader' => false,

        // Determine route before App Middleware to true for middleware
        'determineRouteBeforeAppMiddleware' => true,

        // Database connections.
        'database' => [
            'default' => [
                'hostname' => 'db',
                'database' => 'test',
                'username' => 'root',
                'password' => 'test',
            ],
        ],

        'displayErrorDetails' => true,
        // Logger settings.
//        'logger' => [
//            'name'     => 'to_do_logger',
//            'ident'    => 'php_to_do',
//            'facility' => 184, // LOG_LOCAL7
//            'level'    => \Monolog\Logger::DEBUG,
//            'bubble'   => true,
//            'logopts'  => 4, // LOG_ODELAY
//        ],

        // Cross origin resource sharing.
//        'cors' => [
//            'origin'  => '*',
//            'headers' => [
//                'X-Auth-Token',
//                'Content-Type',
//            ],
//            'methods' => [
//                'GET',
//                'POST',
//                'PUT',
//                'DELETE',
//                'OPTIONS',
//            ],
//        ],
    ],
];
