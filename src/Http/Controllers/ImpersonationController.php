<?php

namespace LaravelIam\Http\Controllers;

use LaravelIam\Storage\LaravelIamUser;

class ImpersonationController extends Controller
{
    /**
     * Impersonate the given user.
     *
     * @param  LaravelIamUser $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(LaravelIamUser $user)
    {
        auth()->login($user);

        return redirect('/');
    }
}
