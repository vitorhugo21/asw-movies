<?php

namespace App\Classes;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;


class TheMovieDBClass
{
    private $key;
    private $client;

    public function __construct()
    {
        $this->key = config('movie_key.moviedb_key');
        $this->client = new Client(['http_errors' => false]);
    }

    public function getPopularMovies()
    {
        $url = 'https://api.themoviedb.org/3/discover/movie?api_key=' . $this->key . '&sort_by=popularity.desc';
        $request = $this->client->get($url);
        $response = json_decode($request->getBody(), true);
        return $response['results'];
    }

    public function getMovie($movie)
    {
        $url = 'https://api.themoviedb.org/3/movie/' . $movie . '?api_key=' . $this->key . '&language=en-US
        &append_to_response=videos,credits,recommendations';
        $request = $this->client->get($url);
        $response = json_decode($request->getBody(), true);
        return $response;
    }

    public function getAllCategoriesPT()
    {
        $url = 'https://api.themoviedb.org/3/genre/movie/list?api_key=' . $this->key . '&language=pt-pt';
        $request = $this->client->get($url);
        $response = json_decode($request->getBody(), true);
        return $response;
    }

    public function getAllCategoriesEN()
    {
        $url = 'https://api.themoviedb.org/3/genre/movie/list?api_key=' . $this->key . '&language=en-US';
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

    public function getInfoActor($actor)
    {
        $url = 'https://api.themoviedb.org/3/person/' . $actor . '?api_key=' . $this->key . '&language=en-US
        &append_to_response=movie_credits';
        $request = $this->client->get($url);
        $response = json_decode($request->getBody(), true);
        return $response;
    }

    public function getSimilarMovies($movie)
    {
        $url = 'https://api.themoviedb.org/3/movie/' . $movie . '/recommendations?api_key=' . $this->key;
        $request = $this->client->get($url);
        $response = json_decode($request->getBody(), true);
        return $response;
    }

    public function searchMovie($movie, $page = 1)
    {
        $url = 'https://api.themoviedb.org/3/search/movie?api_key=' . $this->key . '&query=' . $movie . '&page=' . $page;
        $request = $this->client->get($url);
        $response = json_decode($request->getBody(), true);
        return $response;
    }

    public function searchActor($actor, $page = 1)
    {
        $url = 'http://api.themoviedb.org/3/search/person?api_key=' . $this->key . '&query=' . $actor . '&page=' . $page;
        $request = $this->client->get($url);
        $response = json_decode($request->getBody(), true);
        return $response;
    }
}
