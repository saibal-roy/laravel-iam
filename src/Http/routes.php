<?php
Route::get('/', 'HomeController@index')->name('laravel-iam.dashboard');
Route::get('dashboard', 'HomeController@index')->name('laravel-iam.dashboard');
Route::resource('users', 'UserController');
Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');