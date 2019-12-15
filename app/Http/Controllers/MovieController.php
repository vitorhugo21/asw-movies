<?php

namespace App\Http\Controllers;

use App\Classes\TheMovieDBClass;
use App\User;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{

    private $movie_class;

    public function __construct()
    {
        $this->movie_class = new TheMovieDBClass();
    }

    public function index()
    {
        $top5_popular_movies = array_slice($this->movie_class->getPopularMovies(), 0, 5);
        return view('index', [
            'movies' => $top5_popular_movies
        ]);
    }

    public function showInfoMovie($movie)
    {
        // if (Auth::check()) {
        //     $userId = Auth::id();
        //     return User::find($userId)->movies;
        //     // The user is logged in...
        // }


        return view('movie', [
            'movie' => $this->movie_class->getMovie($movie)
        ]);
        return $this->movie_class->getMovie($movie);
    }

    public function getAllCategories()
    {
        return $this->movie_class->getAllCategories();
    }
}
