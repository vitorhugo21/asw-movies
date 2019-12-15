<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserMoviesController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $favMovies = \Auth::user()->movies()->where('favorite',1)->get();
        $watchLaterMovies = \Auth::user()->movies()->where('watch_later',1)->get();
        $viewedMovies = \Auth::user()->movies()->where('viewed',1)->get();

        return view('user-profile', ['user' => \Auth::user(), 'favorites' => $favMovies, 'watchLater' => $watchLaterMovies, 'viewed' => $viewedMovies]);
    }
}
