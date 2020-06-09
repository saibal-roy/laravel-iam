<?php

namespace LaravelIam\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LaravelIamMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!app('laraveliam')->iam()) {
            Auth::logout();
            return redirect()->route('laravel-iam.no_access');
        }

        return $next($request);
    }
}
