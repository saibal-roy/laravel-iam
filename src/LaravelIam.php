<?php

namespace LaravelIam;

use LaravelIam\Storage\LaravelIamUser;

class LaravelIam
{
    // Build wonderful things
    public static function hello()
    {
        return 'Hello from LaravelIam';
    }

    public static function identity()
    {
        if (!auth()->user()) {
            return null;
        }
        return LaravelIamUser::find(auth()->user()->id);
    }

    public static function iam()
    {
        if (app('laraveliam')->identity() && app('laraveliam')->identity()->isIam()) {
            return app('laraveliam')->identity();
        }

        return null;
    }
}
