@extends('layouts.layout')

@section('title', 'ASW-MOVIES - '. Auth::user()->name)
@section('more_styles')
<link rel="stylesheet" href="{{ asset('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">


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
    @if (count($movies['favorites']) !== 0)
    <p>
        <button class="btn btn-primary w-100 p-2 font-weight-bold" type="button" data-toggle="collapse"
            data-target="#favorites_movies" aria-expanded="false" aria-controls="collapseExample">
            FAVORITES
        </button>
    </p>
    <div class="collapse" id="favorites_movies">
        <div id="multi-item-example-favorite" class="carousel slide carousel-multi-item" data-ride="carousel">
            <!--Controls-->
            <div class="controls-top d-flex justify-content-center">
                <a class="btn-floating h2 px-2" href="#multi-item-example-favorite" data-slide="prev"><i
                        class="fas fa-chevron-circle-left"></i></a>
                <a class="btn-floating h2 px-2" href="#multi-item-example-favorite" data-slide="next"><i
                        class="fa fa-chevron-circle-right"></i></a>
            </div>
            <!--/.Controls-->
            @php
            $totalFavorites = count($movies['favorites']);
            $divideFavoritesPerFive = ceil($totalFavorites / 5);
            @endphp
            <!--Indicators-->
            <ol class="carousel-indicators">
                @for ($index = 0; $index < $divideFavoritesPerFive; $index++) <li
                    data-target="#multi-item-example-favorite" data-slide-to="{{ $index }}"
                    class="@if($index == 0) active @endif">
                    </li>
                    @endfor
            </ol>
            <!--/.Indicators-->
            <div class="carousel-inner">
                @for ($index = 0; $index < round(($totalFavorites/10))*10; $index+=5) <div
                    class="carousel-item @if($index === 0) active @endif">
                    <div class="row">
                        @foreach (array_slice($movies['favorites'], $index, 5) as $favorite)
                        <pre>{{$favorite}}</pre>
                        <div class="col">

                            <div class="container">
                                <div class="d-flex flex-column align-items-center">
                                    <a href='{{ route('movie', $favorite['id']) }}'>
                                        <div class="pmcard card card-body">
                                            <span> {{$favorite['original_title']}} </span>
                                            <img class="d-block w-100"
                                                src="https://image.tmdb.org/t/p/original{{$favorite['backdrop_path']}}"
                                                alt="" srcset="">
                                        </div>
                                    </a>
                                    <br>
                                    <div class="">
                                        <a href='{{ route('movie', $favorite['id']) }}'
                                            class="text-decoration-none text-reset">
                                            <h5 class="movieFavorite">{{$favorite['name']}}</h5>
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



@if ($movies['favorites'] !== 0)
<div class="row">
    <div class="col">

        <div class="card">
            <div class="card-body">
                <h4>Favorite</h4>
                <div class="container-fluid py-2">
                    <div class="d-flex flex-row flex-nowrap overflow-auto">
                        @foreach ($movies['favorites'] as $favorite)
                        <a href='{{ route('movie', $favorite['id']) }}'>
                            <div class="pmcard card card-body">
                                <span> {{$favorite['original_title']}} </span>
                                <img class="d-block w-100"
                                    src="https://image.tmdb.org/t/p/original{{$favorite['backdrop_path']}}" alt=""
                                    srcset="">
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if ($movies['watchLater'] !== 0)
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4>Watch later</h4>
                <div class="container-fluid py-2">
                    <div class="d-flex flex-row flex-nowrap overflow-auto">
                        @foreach ($movies['watchLater'] as $watch)
                        <a href='{{ route('movie', $watch['id']) }}'>
                            <div class="pmcard card card-body">
                                <span> {{$watch['original_title']}} </span>
                                <img class="d-block w-100"
                                    src="https://image.tmdb.org/t/p/original{{$watch['backdrop_path']}}" alt=""
                                    srcset="">
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if ($movies['viewed'] !== 0)
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4>Viewed</h4>
                <div class="container-fluid py-2">
                    <div class="d-flex flex-row flex-nowrap overflow-auto">
                        @foreach ($movies['viewed'] as $watched)
                        <a href='{{ route('movie', $watched['id']) }}'>
                            <div class="pmcard card card-body">
                                <span> {{$watched['original_title']}} </span>
                                <img class="d-block w-100"
                                    src="https://image.tmdb.org/t/p/original{{$watched['backdrop_path']}}" alt=""
                                    srcset="">
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
</div>

@endsection