<?php

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__.'/../templates/',
        ],

        'auth' => [
            'token' => 'wolsnut4'
        ],

        'swagger_path' => __DIR__.'/../public/swagger.json',

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__.'/../logs',
            'level' => Psr\Log\LogLevel::DEBUG,
        ],
    ],
];
