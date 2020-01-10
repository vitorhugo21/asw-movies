@extends('layouts.layout')

@section('title', config('app.name') . ' - [' . $result['sentence'] . ']')
@section('more_styles')
<link rel="stylesheet" href="{{ asset('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
@endsection

@section('content')

<div class="container">
    @if ($result['moviesResults'] and $result['actorsResults'])

    <div class="row justify-content-md-center">
        <div class="col-4">
            <div class="list-group flex-sm-row" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active d-flex justify-content-between" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">
                    <span>Movies</span>
                    <span class="badge badge-dark badge-pill align-self-center">{{ count($result['moviesResults']['results']) }}</span>
                </a>
                <a class="list-group-item list-group-item-action d-flex justify-content-between" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">
                    <span>People</span>
                    <span class="badge badge-dark badge-pill align-self-center">{{ count($result['actorsResults']['results']) }}</span>
                </a>
            </div>
        </div>
    </div>
    <br>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
            <div class="d-flex justify-content-center flex-wrap">
                @foreach ($result['moviesResults']['results'] as $movie)

                <div class="mx-2 my-2 border-0" style="width: 10rem;">
                    <a href="{{ route('movie', $movie['id']) }}" class="text-decoration-none text-reset">
                        @if ($movie['poster_path'])
                        <img src="https://image.tmdb.org/t/p/original{{$movie['poster_path']}}" class="card-img-top img-fluid h-75" alt="{{ $movie['original_title'] }}">
                        @else
                        <img src="{{ asset('img/no-image.jpeg') }}" class="card-img-top img-fluid" alt="{{ $movie['original_title'] }}">
                        @endif
                    </a>
                    <div class="p-0 mt-2">
                        <a href="{{ route('movie', $movie['id']) }}" class="text-decoration-none text-reset">
                            <h5 class="h6 text-center font-weight-bold">{{ $movie['original_title'] }}</h5>
                        </a>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
            <div class="d-flex justify-content-center flex-wrap">
                @foreach ($result['actorsResults']['results'] as $person)

                <div class="mx-2 my-2 border-0" style="width: 10rem;">
                    <a href="{{ route('actor', $person['id']) }}" class="text-decoration-none text-reset">
                        @if ($person['profile_path'])
                        <img src="https://image.tmdb.org/t/p/original{{$person['profile_path']}}" class="card-img-top img-fluid h-75" alt="{{$person['profile_path']}}">
                        @else
                        <img src="{{ asset('img/no-image.jpeg') }}" class="card-img-top img-fluid" alt="{{$person['profile_path']}}">
                        @endif
                    </a>
                    <div class="p-0 mt-2">
                        <a href="{{ route('actor', $person['id']) }}" class="text-decoration-none text-reset">
                            <h5 class="h6 text-center font-weight-bold">{{ $person['name'] }}</h5>
                        </a>
                    </div>
                </div>

                @endforeach
            </div>
        </div>

        @elseif($result['moviesResults'] and !$result['actorsResults'])

        <div class="d-flex justify-content-center flex-wrap">
            @foreach ($result['moviesResults']['results'] as $movie)

            <div class="mx-2 my-2 border-0" style="width: 10rem;">
                <a href="{{ route('movie', $movie['id']) }}" class="text-decoration-none text-reset">
                    @if ($movie['poster_path'])
                    <img src="https://image.tmdb.org/t/p/original{{$movie['poster_path']}}" class="card-img-top img-fluid h-75" alt="{{ $movie['original_title'] }}">
                    @else
                    <img src="{{ asset('img/no-image.jpeg') }}" class="card-img-top img-fluid" alt="{{ $movie['original_title'] }}">
                    @endif
                </a>
                <div class="p-0 mt-2">
                    <a href="{{ route('movie', $movie['id']) }}" class="text-decoration-none text-reset">
                        <h5 class="h6 text-center font-weight-bold">{{ $movie['original_title'] }}</h5>
                    </a>
                </div>
            </div>

            @endforeach
        </div>

        @elseif(!$result['moviesResults'] and $result['actorsResults'])


        <div class="d-flex justify-content-center flex-wrap">
            @foreach ($result['actorsResults']['results'] as $person)

            <div class="mx-2 my-2 border-0" style="width: 10rem;">
                <a href="{{ route('actor', $person['id']) }}" class="text-decoration-none text-reset">
                    @if ($person['profile_path'])
                    <img src="https://image.tmdb.org/t/p/original{{$person['profile_path']}}" class="card-img-top img-fluid h-75" alt="{{$person['profile_path']}}">
                    @else
                    <img src="{{ asset('img/no-image.jpeg') }}" class="card-img-top img-fluid" alt="{{$person['profile_path']}}">
                    @endif
                </a>
                <div class="p-0 mt-2">
                    <a href="{{ route('actor', $person['id']) }}" class="text-decoration-none text-reset">
                        <h5 class="h6 text-center font-weight-bold">{{ $person['name'] }}</h5>
                    </a>
                </div>
            </div>

            @endforeach

            @else
            <h1 class="text-center">No Results!</h1>
            @endif
        </div>



        @endsection