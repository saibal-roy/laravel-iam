<?php

namespace LaravelIam;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class LaravelIamServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Route::middlewareGroup('laraveliam', config('laraveliam.middleware', []));
        $this->registerRoutes();
        $this->registerMigrations();
        $this->registerPublishing();
        $this->loadViewsFrom(
            __DIR__ . '/../resources/views',
            'laraveliam'
        );
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        });
    }

    /**
     * Get the LaravelIam route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            'namespace' => 'LaravelIam\Http\Controllers',
            'prefix' => config('iamconstants.path'),
        ];
    }

    /**
     * Register the package's migrations.
     *
     * @return void
     */
    private function registerMigrations()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/Storage/migrations');
        }
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    private function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../public' => public_path('vendor/laravel-iam'),
            ], 'laravel-iam-assets');

            $this->publishes([
                __DIR__ . '/../config/laraveliam.php' => config_path('laraveliam.php'),
            ], 'laravel-iam-config');
        }
    }





    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laraveliam.php', 'laraveliam');
        $this->mergeConfigFrom(__DIR__ . '/../config/iamconstants.php', 'iamconstants');
        // Register the service the package provides.
        $this->app->singleton('laraveliam', function ($app) {
            return new LaravelIam;
        });

        $this->commands([
            Console\SetupRootIamUserCommand::class,
            Console\PublishCommand::class,
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laraveliam'];
    }
}
