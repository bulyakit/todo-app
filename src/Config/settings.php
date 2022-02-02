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
    ],
];
