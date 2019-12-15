@extends('layouts.layout')

@section('title', config('app.name') . ' - '.$movie['original_title'])

@section('more_styles')
<link rel="stylesheet" href="{{ asset('css/modal.css') }}">
@endsection

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
        @foreach ($movie['credits']['cast'] as $people)
        <span> {{$people['name']}} </span>
        @endforeach

        <p>
          <h4>{{$movie['overview']}}</h4>
        </p>
        <br>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}" data-target="#myModal">
          VER TRAILER
        </button>
        <br><br>
        @auth
        <div>
          <button type="button" class="btn btn-outline-warning">Mark as Favorite</button>
          <button type="button" class="btn btn-outline-info">See Later</button>
          <button type="button" class="btn btn-outline-primary">Watched</button>
        </div>
        @endauth
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">


        <div class="modal-body">

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <!-- 16:9 aspect ratio -->
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay" allowfullscreen></iframe>
          </div>


        </div>

      </div>
    </div>
  </div>
  @endsection

  @section('more_scripts')
  <script src="{{ asset('js/modal.js') }}"></script>
  @endsection