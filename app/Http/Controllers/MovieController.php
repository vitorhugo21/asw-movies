<?php

namespace App\Http\Controllers;

use App\Classes\TheMovieDBClass;
use App\User;
use App\UserMovies;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $infoMovie = $this->movie_class->getMovie($movie);
        if (array_key_exists('status_code', $infoMovie)) {
            abort(404, 'MOVIE NOT FOUND');
        }

        if (Auth::check()) {
            // The user is logged in...
            $user = Auth::user();
            if (UserMovies::where([['movie_id', $movie], ['user_id', $user->id],])->doesntExist()) {

                $newRecord = new UserMovies();
                $newRecord->movie_id = $movie;
                $newRecord->user_id = $user->id;
                $newRecord->created_at = Carbon::now();
                $newRecord->save();
            }
            $infoUserMovie[$user->username] = UserMovies::where([
                ['movie_id', $movie],
                ['user_id', $user->id],
            ])->get(['watch_later', 'favorite', 'viewed']);

            return view('movie', [
                'movie' => $infoMovie,
                'infoUserMovie' => $infoUserMovie
            ]);
        }

        return view('movie', [
            'movie' => $infoMovie
        ]);
        // return $this->movie_class->getMovie($movie);
    }

    public function getAllCategories()
    {
        return $this->movie_class->getAllCategories();
    }

    public function changeState($movie, $state)
    {
        $user = Auth::user();
        $isFavorite = UserMovies::where([
            ['movie_id', $movie],
            ['user_id', $user->id],
        ])->value($state);

        if ($isFavorite) {
            UserMovies::where([
                ['movie_id', $movie],
                ['user_id', $user->id],
            ])->update([$state => 0]);
        } else {
            UserMovies::where([
                ['movie_id', $movie],
                ['user_id', $user->id],
            ])->update([$state => 1]);
        }

        return json_encode(UserMovies::where([
            ['movie_id', $movie],
            ['user_id', $user->id],
        ])->value($state));
    }
}
