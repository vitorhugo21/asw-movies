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

        <p>
          <h4>{{$movie['overview']}}</h4>
        </p>
        <br>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger fab fa-youtube video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}" data-target="#myModal">
          TRAILER
        </button>
        <!-- <div class="rating">
          <span>☆</span>
        </div> -->
        <br><br>
        @auth
        @php
        $user = Auth::user();
        $username = $user->username;
        $watchLater = $infoUserMovie[$username][0]['watch_later'];
        $viewed = $infoUserMovie[$username][0]['viewed'];
        $favorite = $infoUserMovie[$username][0]['favorite'];
        @endphp
        <input type="hidden" value="{{$movie['id']}}" id="movieID">
        <div>
          @if ($viewed === 1)
          <button type="button" class="btn btn-outline-primary active fas fa-eye" id="watch"> WATCHED</button>
          <button type="button" class="btn btn-outline-info far fa-check-circle" id="seeLater" style="display: none"> SEE LATER ?</button>
          @elseif ($watchLater === 1)
          <button type="button" class="btn btn-outline-primary fas fa-eye" id="watch"> WATCHED ?</button>
          <button type="button" class="btn btn-outline-info far fa-check-circle active" id="seeLater"> SEE LATER ?</button>
          @else
          <button type="button" class="btn btn-outline-primary fas fa-eye" id="watch"> WATCHED ?</button>
          <button type="button" class="btn btn-outline-info far fa-check-circle" id="seeLater"> SEE LATER ?</button>
          @endif
          <button type="button" class="btn btn-outline-warning far fa-star {{ $favorite === 1 ? 'active' : '' }}" id="favorite">
            {{ $favorite === 1 ? 'FAVORITE' : 'MARK AS FAVORITE' }}</button>

        </div>
        @endauth

      </div>
    </div>
  </div>
</div>
<!-- Collapse -->

<p>
  <button class="btn btn-primary w-100 p-2" type="button" data-toggle="collapse" data-target="#cast" aria-expanded="false" aria-controls="collapseExample">
    CAST
  </button>
</p>
<div class="collapse" id="cast">
  <div class="row row-cols-1 row-cols-md-5">
    @foreach (array_slice($movie['credits']['cast'], 0, 5) as $people)
    <a href="{{ route('actor', $people['id']) }}">
      <div class="card" style="width: 18rem;">
        <img src="https://image.tmdb.org/t/p/original{{$people['profile_path']}}" class="card-img-top actorImg" alt="{{$people['name']}}">
        <div class="card-body">
          <h5 class="card-title">{{$people['name']}}</h5>
        </div>
      </div>
    </a>
    @endforeach
  </div>
</div>

<p>
  <button class="btn btn-primary w-100 p-2" type="button" data-toggle="collapse" data-target="#movieRecommendations" aria-expanded="false" aria-controls="collapseExample">
    SIMILAR MOVIES
  </button>
</p>
<div class="collapse" id="movieRecommendations">
  <div class="row row-cols-1 row-cols-md-5">
    @foreach (array_slice($movie['recommendations']['results'], 0, 5) as $recommendation)
    <a href="{{ route('movie', $recommendation['id']) }}">
      <div class="card" style="width: 18rem;">
        <img src="https://image.tmdb.org/t/p/original{{$recommendation['poster_path']}}" class="card-img-top actorImg" alt="{{$people['name']}}">
        <div class="card-body">
          <h5 class="card-title">{{$recommendation['original_title']}}</h5>
        </div>
      </div>
    </a>
    @endforeach
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
<script src="{{ asset('js/changeMovieState.js') }}"></script>
@endsection