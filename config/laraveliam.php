<?php

use LaravelIam\Http\Middleware\LaravelIamMiddleware;

return [



    /*
    |--------------------------------------------------------------------------
    | LaravelIAM Identity configurations
    |--------------------------------------------------------------------------
    |
    | This configuration options determines the identity table that will
    | be used to store Laravel IAM's data. In addition,
    | you may set any custom options as needed.
    |
    */

    'identity_table' => env('LARAVELIAM_TABLE', 'users'),
    'identity_pk' => env('LARAVELIAM_TBL_PK_COLUMN', 'email'),
    'identity_name' => env('LARAVELIAM_TBL_NAME_COLUMN', 'name'),
    'identity_password' => env('LARAVELIAM_TBL_PWD_COLUMN', 'password'),

    /*
    |--------------------------------------------------------------------------
    | LaravelIAM Root User values
    |--------------------------------------------------------------------------
    |
    | This configuration options determines the root user credentials. In addition,
    | you may set any custom options as needed.
    |
    */

    'sudo_user_name' => 'sudo',
    'sudo_user_pk' => 'sudo@email.com',
    'sudo_password' => 'secret',

    /*
    |--------------------------------------------------------------------------
    | LaravelIAM Route Middleware
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
