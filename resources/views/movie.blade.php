@extends('layouts.layout')

@section('title', config('app.name') . ' - '.$movie['original_title'])

@section('more_styles')
<link href="{{ asset('css/modal.css') }}" rel="stylesheet">
<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col d-flex justify-content-center poster_path">
      @if ($movie['poster_path'])
      <img class="d-block" src="https://image.tmdb.org/t/p/original{{$movie['poster_path']}}" alt="{{$movie['original_title']}}" srcset="">
      @else
      <img src="{{ asset('img/no-image.jpeg') }}" class="card-img" alt="{{ $movie['original_title'] }}">
      @endif
      <div class="col paddingRight">
        <div class="card">
          <div class="card-body">
            <div class="d-flex">
              <span class="font-weight-bold h2 align-self-end">{{ $movie['original_title'] }}</span>&nbsp;
              <span class="align-self-center">({{ date('d-m-Y', strtotime($movie['release_date'])) }})</span>
            </div>
            <span class="text-uppercase">{{ $movie['runtime'] }} min | </span>
            @if ($movie['genres'])
            @foreach ($movie['genres'] as $key => $genre)
            @if (($key+1) === (count($movie['genres'])))
            <span class="text-uppercase">{{ $genre['name'] }}</span>
            @else
            <span class="text-uppercase">{{ $genre['name'] }},</span>
            @endif
            @endforeach
            @endif
            <br><br>
            <h5>DIRECTOR</h5>
            @foreach ($movie['credits']['crew'] as $member)
            @if ($member['job'] === 'Director')
            <a href="{{ route('actor', $member['id']) }}" class="text-decoration-none text-reset btn btn-light"><span>{{ $member['name'] }}</span></a>
            @endif
            @endforeach
            <br><br>
            <h5>OVERVIEW</h5>
            <p>
              <span>{{$movie['overview']}}</span>
            </p>
            <br>
            @if ($movie['videos']['results'])
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger fab fa-youtube video-btn moviesBtns" data-toggle="modal" data-src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}" data-target="#myModal">
              TRAILER
            </button>
            <button type="button" class="btn btn-warning fas fa-arrow-circle-right moviesBtns" id="imdb" data-src="https://www.imdb.com/title/{{ $movie['imdb_id'] }}">
              IMDB
            </button>
            @endif
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
              <button type="button" class="btn btn-outline-primary text-dark active fas fa-eye moviesBtns" id="watch"> WATCHED</button>
              <button type="button" class="btn btn-outline-info text-dark far fa-check-circle moviesBtns" id="seeLater" style="display: none"> SEE LATER ?</button>
              @elseif ($watchLater === 1)
              <button type="button" class="btn btn-outline-primary text-dark fas fa-eye moviesBtns" id="watch"> WATCHED ?</button>
              <button type="button" class="btn btn-outline-info text-dark far fa-check-circle active moviesBtns" id="seeLater"> SEE LATER</button>
              @else
              <button type="button" class="btn btn-outline-primary text-dark fas fa-eye moviesBtns" id="watch"> WATCHED ?</button>
              <button type="button" class="btn btn-outline-info text-dark far fa-check-circle moviesBtns" id="seeLater"> SEE LATER ?</button>
              @endif
              <button type="button" class="btn btn-outline-warning text-dark far fa-star moviesBtns {{ $favorite === 1 ? 'active' : '' }}" id="favorite">
                {{ $favorite === 1 ? ' FAVORITE' : ' FAVORITE ?' }}</button>
            </div>
            @endauth
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <!-- Collapse -->
  @if ($movie['credits']['cast'])
  <p>
    <button class="btn btn-primary w-100 p-2 font-weight-bold" type="button" data-toggle="collapse" data-target="#cast" aria-expanded="false" aria-controls="collapseExample">
      CAST
    </button>
  </p>
  <div class="collapse" id="cast">
    <div id="multi-item-example-cast" class="carousel slide carousel-multi-item" data-ride="carousel">
      <!--Controls-->
      <div class="controls-top d-flex justify-content-center">
        <a class="btn-floating h2 px-2" href="#multi-item-example-cast" data-slide="prev"><i class="fas fa-chevron-circle-left"></i></a>
        <a class="btn-floating h2 px-2" href="#multi-item-example-cast" data-slide="next"><i class="fa fa-chevron-circle-right"></i></a>
      </div>
      <!--/.Controls-->
      @php
      $totalCast = count($movie['credits']['cast']);
      $divideCastPerFive = ceil($totalCast / 5);
      @endphp
      <!--Indicators-->
      <ol class="carousel-indicators">
        @for ($index = 0; $index < $divideCastPerFive; $index++) <li data-target="#multi-item-example-cast" data-slide-to="{{ $index }}" class="@if($index == 0) active @endif">
          </li>
          @endfor
      </ol>
      <!--/.Indicators-->
      <div class="carousel-inner">
        @for ($index = 0; $index < round(($totalCast/10))*10; $index+=5) <div class="carousel-item @if($index === 0) active @endif">
          <div class="row">
            @foreach (array_slice($movie['credits']['cast'], $index, 5) as $people)
            <div class="col">
              <div class="container">
                <div class="d-flex flex-column align-items-center">
                  <a href="{{ route('actor', $people['id']) }}" class="text-decoration-none text-reset">
                    @if ($people['profile_path'])
                    <img src="https://image.tmdb.org/t/p/original{{$people['profile_path']}}" class="card-img-top actorImg" alt="{{$people['name']}}">
                    @else
                    <img src="{{ asset('img/no-image.jpeg') }}" class="card-img-top actorImg" alt="{{$people['name']}}">
                    @endif
                  </a>
                  <br>
                  <div class="">
                    <a href="{{ route('actor', $people['id']) }}" class="text-decoration-none text-reset">
                      <h5 class="movieCast">{{$people['name']}}</h5>
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
  </div>
</div>
@endif

@if ($movie['recommendations']['results'])
<p>
  <button class="btn btn-primary w-100 p-2 font-weight-bold" type="button" data-toggle="collapse" data-target="#movieRecommendations" aria-expanded="false" aria-controls="collapseExample">
    SIMILAR MOVIES
  </button>
</p>
<div class="collapse" id="movieRecommendations">
  <div id="multi-item-example-similar-movies" class="carousel slide carousel-multi-item" data-ride="carousel">
    <!--Controls-->
    <div class="controls-top d-flex justify-content-center">
      <a class="btn-floating h2 px-2" href="#multi-item-example-similar-movies" data-slide="prev"><i class="fas fa-chevron-circle-left"></i></a>
      <a class="btn-floating h2 px-2" href="#multi-item-example-similar-movies" data-slide="next"><i class="fa fa-chevron-circle-right"></i></a>
    </div>
    <!--/.Controls-->
    @php
    $totalMovies = count($movie['recommendations']['results']);
    $divideMoviesPerFive = ceil($totalMovies / 5);
    @endphp
    <!--Indicators-->
    <ol class="carousel-indicators">
      @for ($index = 0; $index < $divideMoviesPerFive; $index++) <li data-target="#multi-item-example-similar-movies" data-slide-to="{{ $index }}" class="@if($index == 0) active @endif">
        </li>
        @endfor
    </ol>
    <!--/.Indicators-->
    <div class="carousel-inner">
      @for ($index = 0; $index < round(($totalMovies/10))*10; $index+=5) <div class="carousel-item @if($index === 0) active @endif">
        <div class="row">
          @foreach (array_slice($movie['recommendations']['results'], $index, 5) as $recommendation)
          <div class="col">
            <div class="container">
              <div class="d-flex flex-column align-items-center">
                <a href="{{ route('movie', $recommendation['id']) }}" class="text-decoration-none text-reset">
                  @if ($recommendation['poster_path'])
                  <img src="https://image.tmdb.org/t/p/original{{$recommendation['poster_path']}}" class="card-img-top actorImg" alt="{{$recommendation['original_title']}}">
                  @else
                  <img src="{{ asset('img/no-image.jpeg') }}" class="card-img-top actorImg" alt="{{$recommendation['original_title']}}">
                  @endif
                </a>
                <br>
                <a href="{{ route('movie', $recommendation['id']) }}" class="text-decoration-none text-reset">
                  <h5 class="movieCast">{{$recommendation['original_title']}}</h5>
                </a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <br>
    </div>
    @endfor
  </div>
</div>
</div>
@endif

@if ($movie['videos']['results'])
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
@endif

</div>

@endsection

@section('more_scripts')
<script src="{{ asset('js/changeMovieState.js') }}"></script>
<script src="{{ asset('js/moviePage.js') }}"></script>
@endsection