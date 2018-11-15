<?php
use LaravelIam\Http\Middleware\LaravelIamMiddleware;

return [

    'path' => 'iam',

    /*
    |--------------------------------------------------------------------------
    | Laravel IAM Storage Driver
    |--------------------------------------------------------------------------
    |
    | This configuration options determines the storage driver that will
    | be used to store Laravel IAM's data. In addition,
    | you may set any custom options as needed by the particular driver you choose.
    |
    */

    'driver' => env('LARAVEL_IAM_DRIVER', 'database'),

    'storage' => [
        'database' => [
            'connection' => env('DB_CONNECTION', 'mysql'),
        ],
    ],

    'show_forbidden_page_for_without_login' => env('LARAVEL_IAM_WITHOUT_LOGIN_CHECK', false),
    'login_route' => env('LARAVEL_IAM_LOGIN_ROUTE', 'login'),    
    'identity_table' => env('LARAVEL_IAM_IDENTITY_TABLE', 'users'),
    'identity_pk' => env('LARAVEL_IAM_IDENTITY_PK', 'email'),
    'identity_name' => env('LARAVEL_IAM_IDENTITY_NAME', 'name'),
    'identity_password' => env('LARAVEL_IAM_IDENTITY_PWD', 'password'),
    /*
    |--------------------------------------------------------------------------
    | Laravel IAM Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to every Laravel IAM route, 
    | giving you the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'middleware' => [
        'web',
        LaravelIamMiddleware::class,
    ],
    
];