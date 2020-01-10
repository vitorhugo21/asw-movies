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

                //return $infoMovie;
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
        $movies = 1;
        $actors = 0;

        $resultsSearchMovie = $this->movie_class->searchMovie($searchSentence);
        $resultsSearchActor = $this->movie_class->searchActor($searchSentence);


        if ($this->confirmEmptyResult($resultsSearchMovie['results'])) {
            $searchArray['moviesResults'] = $resultsSearchMovie;
            if ($searchArray['moviesResults']['total_pages'] > 1) {
                $searchArray['moviesResults']['results'] =
                    $this->getAllPages($resultsSearchMovie, $sentence, $movies);
                $searchArray['moviesResults']['results'] =
                    $this->sortByPopularity($searchArray['moviesResults']['results']);
            } else {
                $searchArray['moviesResults']['results'] =
                    $this->sortByPopularity($searchArray['moviesResults']['results']);
            }
        } else {
            $searchArray['moviesResults'] = 0;
        }



        if ($this->confirmEmptyResult($resultsSearchActor['results'])) {
            $searchArray['actorsResults'] = $resultsSearchActor;
            if ($searchArray['actorsResults']['total_pages'] > 1) {
                $searchArray['actorsResults']['results'] =
                    $this->getAllPages($resultsSearchActor, $sentence, $actors);
                $searchArray['actorsResults']['results'] =
                    $this->sortByPopularity($searchArray['actorsResults']['results']);
            } else {
                $searchArray['actorsResults']['results'] =
                    $this->sortByPopularity($searchArray['actorsResults']['results']);
            }
            $searchArray['actorsResults']['results'] = $this->removeFakeActors($searchArray['actorsResults']['results']);
        } else {
            $searchArray['actorsResults'] = 0;
        }


        //return $searchArray;

        return view('new-search', [
            'result' => $searchArray
        ]);





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

    private function getAllPages($arrayMovieOrActor, $sentence, $moviesOrActors)
    {
        $numberOfPages = $arrayMovieOrActor['total_pages'];
        $currentPage = $arrayMovieOrActor['page'];
        $resultsPerPage = count($arrayMovieOrActor['results']);
        $page = [];
        $count = 0;

        if ($numberOfPages > 1) {

            if ($moviesOrActors === 1) {
                for ($index = ($currentPage + 1); $index <= $numberOfPages; $index++) {
                    $page[$count] = $this->movie_class->searchMovie($sentence, $index)['results'];
                    $count++;
                }
            } else {
                for ($index = ($currentPage + 1); $index <= $numberOfPages; $index++) {
                    $page[$count] = $this->movie_class->searchActor($sentence, $index)['results'];
                    $count++;
                }
            }

            for ($index = 0; $index < count($page); $index++) {
                for ($kindex = 0; $kindex < count($page[$index]); $kindex++) {
                    $arrayMovieOrActor['results'][$resultsPerPage] = $page[$index][$kindex];
                    $resultsPerPage++;
                }
            }
        }
        return $arrayMovieOrActor['results'];
    }

    private function sortByPopularity($results)
    {
        usort($results, function ($a, $b) {
            return $b['popularity'] <=> $a['popularity'];
        });

        return $results;
        //return array_slice($results, 0, 20);
    }

    private function removeFakeActors($actorsArray)
    {

        for ($index = 0; $index < count($actorsArray); $index++) {
            if (!$this->confirmEmptyResult($actorsArray[$index]['known_for'])) {
                unset($actorsArray[$index]);
            }
        }
        return $actorsArray;
    }
}
