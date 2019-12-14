<?php

namespace App\Classes;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class TheMovieDBClass
{
    private $key;
    private $client;

    public function __construct()
    {
        $this->key = config('movie_key.moviedb_key');
        $this->client = new Client();
    }

    public function getPopularMovies()
    {
        $url = 'https://api.themoviedb.org/3/movie/popular?api_key=' . $this->key . '&language=en-US&page=1';
        $request = $this->client->get($url);
        $response = json_decode($request->getBody(), true);
        return $response['results'];
    }

    public function getMovie($movie)
    {
        $url = 'https://api.themoviedb.org/3/movie/' . $movie . '?api_key=' . $this->key . '&language=en-US';
        $request = $this->client->get($url);
        $response = json_decode($request->getBody(), true);
        return $response;
    }

    public function getAllCategories()
    {
        $url = 'https://api.themoviedb.org/3/genre/movie/list?api_key=' . $this->key . '&language=pt-pt';
        $request = $this->client->get($url);
        $response = json_decode($request->getBody(), true);
        return $response;
    }

    public function getMovieCast($movie)
    {
        $url = 'https://api.themoviedb.org/3/movie/' . $movie . '/credits?api_key=' . $this->key;
        $request = $this->client->get($url);
        $response = json_decode($request->getBody(), true);
        return $response;
    }
}
