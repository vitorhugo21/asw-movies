@extends('layouts.layout')

@section('title', config('app.name') . ' - '.$actor['name'])

@section('more_styles')
<link href="{{ asset('css/modal.css') }}" rel="stylesheet">
<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">

@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col d-flex justify-content-center poster_path">
      @if ($actor['profile_path'])
      <img class="d-block" src="https://image.tmdb.org/t/p/original{{$actor['profile_path']}}" alt="{{$actor['name']}}" srcset="">
      @else
      <img src="{{ asset('img/no-image.jpeg') }}" class="" alt="{{ $actor['name'] }}">
      @endif
      <div class="col paddingRight">
        <div class="card">
          <div class="card-body">
            <div class="d-flex">
              <span class="font-weight-bold h2 align-self-end">{{ $actor['name'] }}</span>&nbsp;
              <span class="align-self-center">({{ date('d-m-Y', strtotime($actor['birthday'])) }})</span>
            </div>
            <span>{{$actor['place_of_birth']}}</span><br><br>
            <h5>DEPARTMENT</h5>
            <p>
              <span>{{$actor['known_for_department']}}</span>
            </p>
            <br>
            <h5>BIOGRAPHY</h5>
            <p>
              <span>{{$actor['biography']}}</span>
            </p>
            <br>
            <button type="button" class="btn btn-warning fas fa-arrow-circle-right moviesBtns" id="imdb" data-src="https://www.imdb.com/name/{{ $actor['imdb_id'] }}">
              IMDB
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@if ($actor['movie_credits']['cast'])
<div class="container">
  <p>
    <button class="btn btn-primary w-100 p-2 font-weight-bold" type="button" data-toggle="collapse" data-target="#cast" aria-expanded="false" aria-controls="collapseExample">
      MOVIES
    </button>
  </p>
  <div class="collapse" id="cast">
    @if (count($actor['movie_credits']['cast']) > 5)
    <div id="multi-item-example-cast" class="carousel slide carousel-multi-item" data-ride="carousel">

      <!--Controls-->
      <div class="controls-top d-flex justify-content-center">
        <a class="btn-floating h2 px-2" href="#multi-item-example-cast" data-slide="prev"><i class="fas fa-chevron-circle-left"></i></a>
        <a class="btn-floating h2 px-2" href="#multi-item-example-cast" data-slide="next"><i class="fa fa-chevron-circle-right"></i></a>
      </div>

      <!--/.Controls-->
      @php
      $totalMovies = count($actor['movie_credits']['cast']);
      $divideMoviesPerFive = ceil($totalMovies / 5);
      @endphp
      <!--Indicators-->
      <ol class="carousel-indicators">
        @for ($index = 0; $index < $divideMoviesPerFive; $index++) <li data-target="#multi-item-example-cast" data-slide-to="{{ $index }}" class="@if($index == 0) active @endif">
          </li>
          @endfor
      </ol>

      <div class="carousel-inner">
        @for ($index = 0; $index < round(($totalMovies/10))*10; $index+=5) <div class="carousel-item @if($index === 0) active @endif">
          <div class="row">
            @foreach (array_slice($actor['movie_credits']['cast'], $index, 5) as $movie)
            <div class="col">
              <div class="container">
                <div class="d-flex flex-column align-items-center">
                  <a href="{{ route('movie', $movie['id']) }}" class="text-decoration-none text-reset">
                    @if ($movie['poster_path'])
                    <img src="https://image.tmdb.org/t/p/original{{$movie['poster_path']}}" class="card-img-top actorImg" alt="{{$movie['original_title']}}">
                    @else
                    <img src="{{ asset('img/no-image.jpeg') }}" class="card-img-top actorImg" alt="{{$movie['original_title']}}">
                    @endif
                  </a>
                  <br>
                  <div class="">
                    <a href="{{ route('movie', $movie['id']) }}" class="text-decoration-none text-reset">
                      <h5 class="movieCast">{{$movie['original_title']}}</h5>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <br>
      </div>
      @endfor
    </div>
    @else
    <div class="row">
      @foreach ($actor['movie_credits']['cast'] as $movie)
      <div class="col">
        <div class="container">
          <div class="d-flex flex-column align-items-center">
            <a href="{{ route('movie', $movie['id']) }}" class="text-decoration-none text-reset">
              @if ($movie['poster_path'])
              <img src="https://image.tmdb.org/t/p/original{{$movie['poster_path']}}" class="card-img-top actorImg" alt="{{$movie['original_title']}}">
              @else
              <img src="{{ asset('img/no-image.jpeg') }}" class="card-img-top actorImg" alt="{{$movie['original_title']}}">
              @endif
            </a>
            <br>
            <div class="">
              <a href="{{ route('movie', $movie['id']) }}" class="text-decoration-none text-reset">
                <h5 class="movieCast">{{$movie['original_title']}}</h5>
              </a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</div>
@endif
@endsection
@section('more_scripts')
<script>
  const btnImdb = document.getElementById("imdb");

  btnImdb.onclick = () => {
    const page = btnImdb.getAttribute("data-src");
    window.open(page);
  };
</script>
@endsection