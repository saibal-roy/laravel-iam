# LaravelIAM

An elegant way to manage the identity access management for the Laravel framework.
An approach with the following points in mind:
1. If you want to have a seperate Identity access management dashboard.
2. Your existing application user table will not be affected.
3. Customizable configurations via the config file.
4. Roles and permissions setup with spatie permissions package. Thanks to their wonderful work.


## Installation

Via Composer

``` bash
    composer require sunnyroy21/laravel-iam

```
Artisan 
``` bash
    php artisan migrate
    php artisan laravel-iam:create-admin # to create the sudo and administrator setup
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
 php artisan vendor:publish --tag=laravel-iam-assets --force # for each new package update
 php artisan vendor:publish --tag=laravel-iam-config --force # for each new package update 
 php artisan laravel-iam:reset-sudo # for reset password via artisan to default password "secret"

```
## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Security

If you discover any security related issues, please email sunnyroy21@gmail.com instead of using the issue tracker.

## License

MIT license. Please see the [license file](license.md) for more information.

