<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes\TheMovieDBClass;


class UserMoviesController extends Controller
{

    private $movie_class;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->movie_class = new TheMovieDBClass();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $movieList['favorites'] = $this->getMovieList($user->movies()->where('favorite', 1)->get());
        $movieList['watchLater'] = $this->getMovieList($user->movies()->where('watch_later', 1)->get());
        $movieList['viewed'] = $this->getMovieList($user->movies()->where('viewed', 1)->get());
        //return $movieList;
        return view('user-profile', [
            'movies' => $movieList
        ]);
    }

    private function getMovieList($movieList)
    {
        if (count($movieList) !== 0) {
            $movieArray = [];
            foreach ($movieList as $movie) {
                array_push($movieArray, $this->movie_class->getMovie($movie['movie_id']));
            }
            return $movieArray;
        } else {
            return 0;
        }
    }
}
