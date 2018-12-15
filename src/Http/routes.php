<?php
Route::get('/', 'HomeController@index')->name('laravel-iam.dashboard');
Route::get('dashboard', 'HomeController@index')->name('laravel-iam.dashboard');
Route::resource('users', 'UserController', [
    'as' => 'laravel-iam'
]);
Route::resource('roles', 'RoleController', [
    'as' => 'laravel-iam'
]);
Route::resource('permissions', 'PermissionController', [
    'as' => 'laravel-iam'
]);
Route::get('impersonate/{user}', 'ImpersonationController')->name('impersonate');