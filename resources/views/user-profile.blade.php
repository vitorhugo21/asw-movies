@extends('layouts.layout')

@section('title', 'ASW-MOVIES - '. Auth::user()->name)
@section('more_styles')
<link rel="stylesheet" href="{{ asset('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row mb-3">


        <div class="col d-flex justify-content-center">
            <img src="{{ asset(Auth::user()->avatar_path) }}" class="rounded-circle"
                style="width: 300px; height: 300px; object-fit: contains" alt="" srcset="">
        </div>

        <div class="col">

            <div class="card">

                <div class="card-body">
                    <form action="{{ route('user.update') }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Name</span>
                            </div>
                            <input type="text" class="form-control" name="userName" value=" {{Auth::user()->name}}"
                                disabled>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Username</span>
                            </div>
                            <input type="text" class="form-control" name="userUsername"
                                value=" {{Auth::user()->username}}" disabled>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Email</span>
                            </div>
                            <input type="text" class="form-control" name="userEmail" value="{{Auth::user()->email}}">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Password</span>
                            </div>
                            <input type="password" placeholder="*****" class="form-control" name="userPassword">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Image</span>
                            </div>
                            <input id="profile_image" type="file" class="form-control" name="profile_image">
                        </div>



                        <div class="form-group row mb-0 mt-5">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>

    <!-- End row profile -->

    <!-- Start user movies -->

    <!-- Start favorite section-->
    @if ($movies['favorites'])
    <div class="mb-3">
        <button class="btn btn-primary w-100 p-2 font-weight-bold" type="button" data-toggle="collapse"
            data-target="#favoritesMovies" aria-expanded="false" aria-controls="collapseExample">
            FAVORITES
        </button>
    </div>

    <div class="collapse" id="favoritesMovies">
        @if(count($movies['favorites']) > 5)
        <div id="multi-item-example-favorite-movies" class="carousel slide carousel-multi-item" data-ride="carousel">
            <!--Controls-->
            <div class="controls-top d-flex justify-content-center">
                <a class="btn-floating h2 px-2" href="#multi-item-example-favorite-movies" data-slide="prev"><i
                        class="fas fa-chevron-circle-left"></i></a>
                <a class="btn-floating h2 px-2" href="#multi-item-example-favorite-movies" data-slide="next"><i
                        class="fa fa-chevron-circle-right"></i></a>
            </div>
            <!--/.Controls-->
            @php
            $totalMovies = count($movies['favorites']);
            $divideMoviesPerFive = ceil($totalMovies / 5);
            @endphp
            <ol class="carousel-indicators">
                @for ($index = 0; $index < $divideMoviesPerFive; $index++) <li
                    data-target="#multi-item-example-similar-movies" data-slide-to="{{ $index }}"
                    class="@if($index == 0) active @endif">
                    </li>
                    @endfor
            </ol>
            <!--/.Indicators-->
            <div class="carousel-inner">
                @for ($index = 0; $index < round(($totalMovies/10))*10; $index+=5) <div
                    class="carousel-item @if($index === 0) active @endif">
                    <div class="row">
                        @foreach (array_slice($movies['favorites'], $index, 5) as $movie)
                        <div class="col">
                            <div class="container">
                                <div class="d-flex flex-column align-items-center">
                                    <a href="{{ route('movie', $movie['id']) }}"
                                        class="text-decoration-none text-reset">
                                        @if ($movie['poster_path'])
                                        <img src="https://image.tmdb.org/t/p/original{{$movie['poster_path']}}"
                                            class="card-img-top actorImg" alt="{{$movie['original_title']}}">
                                        @else
                                        <img src="{{ asset('img/no-image.jpeg') }}" class="card-img-top actorImg"
                                            alt="{{$movie['original_title']}}">
                                        @endif
                                    </a>
                                    <br>
                                    <a href="{{ route('movie', $movie['id']) }}"
                                        class="text-decoration-none text-reset">
                                        <h5 class="movieCast">{{$movie['original_title']}}</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
            </div>
            @endfor
        </div>
    </div>
    @else
    <div class="row">
        @foreach ($movies['favorites'] as $movie)
        <div class="col">
            <div class="container">
                <div class="d-flex flex-column align-items-center">
                    <a href="{{ route('movie', $movie['id']) }}" class="text-decoration-none text-reset">
                        @if ($movie['poster_path'])
                        <img src="https://image.tmdb.org/t/p/original{{$movie['poster_path']}}"
                            class="card-img-top actorImg" alt="{{$movie['original_title']}}">
                        @else
                        <img src="{{ asset('img/no-image.jpeg') }}" class="card-img-top actorImg"
                            alt="{{$movie['original_title']}}">
                        @endif
                    </a>
                    <br>
                    <a href="{{ route('movie', $movie['id']) }}" class="text-decoration-none text-reset">
                        <h5 class="movieCast">{{$movie['original_title']}}</h5>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endif

<!-- End favorite section-->


<!-- Start watchLater section-->
@if ($movies['watchLater'])
<div class="mb-3">
    <button class="btn btn-primary w-100 p-2 font-weight-bold" type="button" data-toggle="collapse"
        data-target="#watchLaterMovies" aria-expanded="false" aria-controls="collapseExample">
        SEE LATER
    </button>
</div>

<div class="collapse" id="watchLaterMovies">
    @if(count($movies['watchLater']) > 5)
    <div id="multi-item-example-favorite-movies" class="carousel slide carousel-multi-item" data-ride="carousel">
        <!--Controls-->
        <div class="controls-top d-flex justify-content-center">
            <a class="btn-floating h2 px-2" href="#multi-item-example-favorite-movies" data-slide="prev"><i
                    class="fas fa-chevron-circle-left"></i></a>
            <a class="btn-floating h2 px-2" href="#multi-item-example-favorite-movies" data-slide="next"><i
                    class="fa fa-chevron-circle-right"></i></a>
        </div>
        <!--/.Controls-->
        @php
        $totalMovies = count($movies['watchLater']);
        $divideMoviesPerFive = ceil($totalMovies / 5);
        @endphp
        <ol class="carousel-indicators">
            @for ($index = 0; $index < $divideMoviesPerFive; $index++) <li
                data-target="#multi-item-example-similar-movies" data-slide-to="{{ $index }}"
                class="@if($index == 0) active @endif">
                </li>
                @endfor
        </ol>
        <!--/.Indicators-->
        <div class="carousel-inner">
            @for ($index = 0; $index < round(($totalMovies/10))*10; $index+=5) <div
                class="carousel-item @if($index === 0) active @endif">
                <div class="row">
                    @foreach (array_slice($movies['watchLater'], $index, 5) as $movie)
                    <div class="col">
                        <div class="container">
                            <div class="d-flex flex-column align-items-center">
                                <a href="{{ route('movie', $movie['id']) }}" class="text-decoration-none text-reset">
                                    @if ($movie['poster_path'])
                                    <img src="https://image.tmdb.org/t/p/original{{$movie['poster_path']}}"
                                        class="card-img-top actorImg" alt="{{$movie['original_title']}}">
                                    @else
                                    <img src="{{ asset('img/no-image.jpeg') }}" class="card-img-top actorImg"
                                        alt="{{$movie['original_title']}}">
                                    @endif
                                </a>
                                <br>
                                <a href="{{ route('movie', $movie['id']) }}" class="text-decoration-none text-reset">
                                    <h5 class="movieCast">{{$movie['original_title']}}</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
        </div>
        @endfor
    </div>
</div>
@else
<div class="row">
    @foreach ($movies['watchLater'] as $movie)
    <div class="col">
        <div class="container">
            <div class="d-flex flex-column align-items-center">
                <a href="{{ route('movie', $movie['id']) }}" class="text-decoration-none text-reset">
                    @if ($movie['poster_path'])
                    <img src="https://image.tmdb.org/t/p/original{{$movie['poster_path']}}"
                        class="card-img-top actorImg" alt="{{$movie['original_title']}}">
                    @else
                    <img src="{{ asset('img/no-image.jpeg') }}" class="card-img-top actorImg"
                        alt="{{$movie['original_title']}}">
                    @endif
                </a>
                <br>
                <a href="{{ route('movie', $movie['id']) }}" class="text-decoration-none text-reset">
                    <h5 class="movieCast">{{$movie['original_title']}}</h5>
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
</div>
@endif

<!-- End watchLater section-->

<!-- Start viewed section-->
@if ($movies['viewed'])
<div class="mb-3">
    <button class="btn btn-primary w-100 p-2 font-weight-bold" type="button" data-toggle="collapse"
        data-target="#viewedMovies" aria-expanded="false" aria-controls="collapseExample">
        WATCHED
    </button>
</div>

<div class="collapse" id="viewedMovies">
    @if(count($movies['viewed']) > 5)
    <div id="multi-item-example-favorite-movies" class="carousel slide carousel-multi-item" data-ride="carousel">
        <!--Controls-->
        <div class="controls-top d-flex justify-content-center">
            <a class="btn-floating h2 px-2" href="#multi-item-example-favorite-movies" data-slide="prev"><i
                    class="fas fa-chevron-circle-left"></i></a>
            <a class="btn-floating h2 px-2" href="#multi-item-example-favorite-movies" data-slide="next"><i
                    class="fa fa-chevron-circle-right"></i></a>
        </div>
        <!--/.Controls-->
        @php
        $totalMovies = count($movies['viewed']);
        $divideMoviesPerFive = ceil($totalMovies / 5);
        @endphp
        <ol class="carousel-indicators">
            @for ($index = 0; $index < $divideMoviesPerFive; $index++) <li
                data-target="#multi-item-example-similar-movies" data-slide-to="{{ $index }}"
                class="@if($index == 0) active @endif">
                </li>
                @endfor
        </ol>
        <!--/.Indicators-->
        <div class="carousel-inner">
            @for ($index = 0; $index < round(($totalMovies/10))*10; $index+=5) <div
                class="carousel-item @if($index === 0) active @endif">
                <div class="row">
                    @foreach (array_slice($movies['viewed'], $index, 5) as $movie)
                    <div class="col">
                        <div class="container">
                            <div class="d-flex flex-column align-items-center">
                                <a href="{{ route('movie', $movie['id']) }}" class="text-decoration-none text-reset">
                                    @if ($movie['poster_path'])
                                    <img src="https://image.tmdb.org/t/p/original{{$movie['poster_path']}}"
                                        class="card-img-top actorImg" alt="{{$movie['original_title']}}">
                                    @else
                                    <img src="{{ asset('img/no-image.jpeg') }}" class="card-img-top actorImg"
                                        alt="{{$movie['original_title']}}">
                                    @endif
                                </a>
                                <br>
                                <a href="{{ route('movie', $movie['id']) }}" class="text-decoration-none text-reset">
                                    <h5 class="movieCast">{{$movie['original_title']}}</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
        </div>
        @endfor
    </div>
</div>
@else
<div class="row">
    @foreach ($movies['viewed'] as $movie)
    <div class="col">
        <div class="container">
            <div class="d-flex flex-column align-items-center">
                <a href="{{ route('movie', $movie['id']) }}" class="text-decoration-none text-reset">
                    @if ($movie['poster_path'])
                    <img src="https://image.tmdb.org/t/p/original{{$movie['poster_path']}}"
                        class="card-img-top actorImg" alt="{{$movie['original_title']}}">
                    @else
                    <img src="{{ asset('img/no-image.jpeg') }}" class="card-img-top actorImg"
                        alt="{{$movie['original_title']}}">
                    @endif
                </a>
                <br>
                <a href="{{ route('movie', $movie['id']) }}" class="text-decoration-none text-reset">
                    <h5 class="movieCast">{{$movie['original_title']}}</h5>
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
</div>
@endif

<!-- End viewed section-->




</div>

@endsection