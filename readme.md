# LaravelIAM

An elegant way to manage the identity access management for the Laravel framework.
An approach being taken with the following points in mind:
1. If you want to have a seperate Identity access management dashboard.
2. Your existing application user table will not be affected.
3. Customizable configurations via the config file.
4. Roles and permissions setup with spatie permissions package. Thanks to their wonderful work.

## Features
1. Laravel version support from 5.6 onwards.
2. Seperate Identity Access Management dashboard
3. Manage users
4. Manage roles
5. Manage permissions
6. Impersonate users login

## Installation

Via Composer

``` bash
    composer require saibal-roy/laravel-iam

```
Create Authentication scaffolding:
For Laravel version < 5.8
``` bash
    php artisan make:auth
```
For Laravel version 6.x
``` bash
    composer require laravel/ui "^1.0" --dev
    php artisan ui bootstrap --auth
```
For Laravel version 7.x
``` bash
    composer require laravel/ui
    php artisan ui bootstrap --auth
```
#### Please make sure laravel authentication scaffolding is being completed before you proceed further.
Artisan
``` bash
    php artisan migrate
    php artisan laravel-iam:setup-root # to setup the root user
    php artisan laravel-iam:publish --force # for each new package update for all publishable contents

```
Default Credentials and Dashboard
``` bash
    Username : sudo@email.com
    Password : secret
    User : {domain}/iam or localhost:8000/iam (locally)

```

## Usage

Artisan commands

``` bash
# for each new package update for all publishable contents
php artisan laravel-iam:publish --force

# can also use it to reset the root user credentials
php artisan laravel-iam:setup-root

```

## Advanced Usage

Config constants that can be modified via .env

``` bash
#   /*
#    |--------------------------------------------------------------------------
#    | LaravelIAM Identity configurations
#    |--------------------------------------------------------------------------
#    |
#    | This configuration options determines the identity table that will
#    | be used to store Laravel IAM's data. In addition,
#    | you may set any custom options as needed.
#    |
#    */

    'identity_table' => env('LARAVELIAM_TABLE', 'users'),
    'identity_pk' => env('LARAVELIAM_TBL_PK_COLUMN', 'email'),
    'identity_name' => env('LARAVELIAM_TBL_NAME_COLUMN', 'name'),
    'identity_password' => env('LARAVELIAM_TBL_PWD_COLUMN', 'password'),

#   /*
#    |--------------------------------------------------------------------------
#    | LaravelIAM Root User values
#    |--------------------------------------------------------------------------
#    |
#    | This configuration options determines the root user credentials. In addition,
#    | you may set any custom options as needed.
#    |
#    */

    'sudo_user_name' => 'sudo',
    'sudo_user_pk' => 'sudo@email.com',
    'sudo_password' => 'secret'

```

Get the LarvelIam User wrapper to access all the roles and permissions of spatie package.

```
    app('laraveliam')->identity()
```

Check the current user is a allowed user for viewing LaravelIam Dashboard.
```
    app('laraveliam')->iam()
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Security

If you discover any security related issues, please email connectsaibalroy@gmail.com instead of using the issue tracker.

## License

MIT license. Please see the [license file](license.md) for more information.

