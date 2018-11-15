<?php

namespace LaravelIam\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelIam extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laraveliam';
    }
}
