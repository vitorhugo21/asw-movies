@extends('layouts.layout')

@section('title', 'ASW-MOVIES - '.$movie['original_title'])

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
