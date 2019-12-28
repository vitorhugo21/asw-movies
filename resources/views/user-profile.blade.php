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
            <img src="{{ asset(Auth::user()->avatar_path) }}" alt="" srcset="">
        </div>

        <div class="col">

            <div class="card">

                <div class="card-body">
                    <h4>Name: {{Auth::user()->name}}</h4>
                    <h4>Username: {{Auth::user()->username}}</h4>
                    <h4>Email: {{Auth::user()->email}}</h4>
                    <p><a href="">Change my email</a></p>
                    <h4>Password: *****</h4>
                    <p><a href="">Change my password</a></p>
                </div>

            </div>

        </div>

    </div>
    @if ($movies['favorites'] !== 0)
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4>Favorite</h4>
                    <div class="container-fluid py-2">
                        <div class="d-flex flex-row flex-nowrap overflow-auto">
                            @foreach ($movies['favorites'] as $favorite)
                            <div class="pmcard card card-body">
                                <span> {{$favorite['original_title']}} </span>
                                <img class="d-block w-100" src="https://image.tmdb.org/t/p/original{{$favorite['backdrop_path']}}" alt="" srcset="">
                            </div>
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
                            <div class="pmcard card card-body">
                                <span> {{$watch['original_title']}} </span>
                                <img class="d-block w-100" src="https://image.tmdb.org/t/p/original{{$watch['backdrop_path']}}" alt="" srcset="">
                            </div>
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
                            <div class="pmcard card card-body">
                                <span> {{$watched['original_title']}} </span>
                                <img class="d-block w-100" src="https://image.tmdb.org/t/p/original{{$watched['backdrop_path']}}" alt="" srcset="">
                            </div>
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