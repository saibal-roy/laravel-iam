<?php

namespace LaravelIam\Http\Controllers;

use LaravelIam\Storage\LaravelIamUser;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = LaravelIamUser::where('id', '!=', auth()->user()->id)
            ->excludeSudo()
            ->latest()
            ->limit(10)
            ->get();
        return view('laraveliam::dashboard')
            ->with('users', $users);
    }

    /**
     * Show the unauthorized page.
     *
     * @return \Illuminate\Http\Response
     */
    public function unauthorized()
    {
        return view('laraveliam::errors.401');
    }
}
