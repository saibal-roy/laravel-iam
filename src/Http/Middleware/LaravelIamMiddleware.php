<?php

namespace LaravelIam\Http\Middleware;

use Closure;
use LaravelIam\Storage\User;

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
        
        if(!auth()->user())
        {             
            if(config('laraveliam.forbidden_page_for_without_login'))
            {
                abort('401'); 
            }                   
            return redirect()->route(config('laraveliam.login_route'));
        }
        $user = User::find(auth()->user()->id);
        if ($user->hasRole(config('iamconstants.sudo_user_name'))) {            
            return $next($request);
        }                       
        abort('401'); 
    }

    
}