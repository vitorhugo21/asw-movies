@extends('layouts.layout')

@section('title', 'asw-movies - '.$movie['original_title'])

@section('content')

  
<div class="row">
  <div class="col d-flex justify-content-center">
    <img class="d-block w-100" src="https://image.tmdb.org/t/p/original{{$movie['poster_path']}}" alt="" srcset="">
  </div>
  
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h3>{{ $movie['original_title'] }}</h3>
        <h4>{{ $movie['release_date'] }}</h4>
        <span class="badge badge-secondary">{{ $movie['runtime'] }} min</span>

        @foreach ($movie['genres'] as $genre)
          <h4>{{$genre['name']}}</h4>
        @endforeach

        <span>Cast:</span>
        @foreach ($cast['cast'] as $people)
          <span>  {{$people['name']}} </span>        
        @endforeach

        <p>
        <h4>{{$movie['overview']}}</h4>


      </div>
    </div>
  </div>
</div>


@endsection


<?php /**
 "adult" => false
  "backdrop_path" => "/zTxHf9iIOCqRbxvl8W5QYKrsMLq.jpg"
  "belongs_to_collection" => array:4 [▶]
  "budget" => 90000000
  "genres" => array:4 [▶]
  "homepage" => "http://jumanjimovie.com"
  "id" => 512200
  "imdb_id" => "tt7975244"
  "original_language" => "en"
  "original_title" => "Jumanji: The Next Level"
  "overview" => "In Jumanji: The Next Level, the gang is back but the game has changed. As they return to rescue one of their own, the players will have to brave parts unknown f ▶"
  "popularity" => 432.363
  "poster_path" => "/l4iknLOenijaB85Zyb5SxH1gGz8.jpg"
  "production_companies" => array:6 [▶]
  "production_countries" => array:1 [▶]
  "release_date" => "2019-12-04"
  "revenue" => 0
  "runtime" => 123
  "spoken_languages" => array:1 [▶]
  "status" => "Released"
  "tagline" => ""
  "title" => "Jumanji: The Next Level"
  "video" => false
  "vote_average" => 6.9
  "vote_count" => 201

 */?>