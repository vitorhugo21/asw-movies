<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Classes\TheMovieDBClass;
use App\User;
use App\UserMovies;
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
        } else {
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

                // return $infoMovie;
                return view('movie', [
                    'movie' => $infoMovie,
                    'infoUserMovie' => $infoUserMovie
                ]);
            } else {
                return view('movie', [
                    'movie' => $infoMovie
                ]);
            }
        }
        // return $this->movie_class->getMovie($movie);
    }

    public function getAllCategories()
    {
        return $this->movie_class->getAllCategoriesPT();
    }

    public function changeState($movie, $state)
    {
        $user = Auth::user();
        $movieState = UserMovies::where([
            ['movie_id', $movie],
            ['user_id', $user->id],
        ])->value($state);

        if ($movieState) {
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

    public function discover(Request $request)
    {

        $sentence = strip_tags($request['discover']);
        $searchSentence = str_replace(' ', '+', $sentence);
        $searchArray['sentence'] = $sentence;

        $resultsSearchMovie = $this->movie_class->searchMovie($searchSentence);
        $resultsSearchActor = $this->movie_class->searchActor($searchSentence);

        if ($this->confirmEmptyResult($resultsSearchMovie['results'])) {
            $searchArray['moviesResults'] = $this->movie_class->searchMovie($searchSentence);
        } else {
            $searchArray['moviesResults'] = 0;
        }

        if ($this->confirmEmptyResult($resultsSearchActor['results'])) {
            $searchArray['actorsResults'] = $this->movie_class->searchActor($searchSentence);
        } else {
            $searchArray['actorsResults'] = 0;
        }


        return view('search-page', [
            'result' => $searchArray
        ]);

        // return $searchArray;



        //$movieOrPerson = str_replace(' ', '+', strip_tags($request['discoverMovie']));


        // $results = $this->movie_class->searchMovie($movie);

        // if (empty($results['results'])) {
        //     abort(404, 'MOVIE NOT FOUND');
        // }
        // return $results;
    }

    private function confirmEmptyResult($results)
    {
        if (!empty($results)) {
            return true;
        } else {
            return false;
        }
    }
}
