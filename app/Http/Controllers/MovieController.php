<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class MovieController extends Controller
{

    private $key;

    public function __construct()
    {
        $this->key = config('movie_key.moviedb_key');
    }

    public function index()
    {
        $url = 'https://api.themoviedb.org/3/movie/popular?api_key=' . $this->key . '&language=en-US&page=1';
        $client = new Client();
        $request = $client->get($url);
        $response = json_decode($request->getBody(), true);
        return view('index', ['movies' => array_slice($response['results'], 0, 5)]);
    }
}
