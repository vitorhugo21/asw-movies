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
    <div class="row">
        <div class="col-8">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                    @foreach ($result['moviesResults']['results'] as $movie)
                    <a href="{{ route('movie', $movie['id']) }}" class="text-decoration-none text-reset">
                        <div class="card mb-3" style="width: 15rem;">
                            <div class="card-header text-center font-weight-bold">
                                {{ $movie['original_title'] }}
                            </div>
                            @if ($movie['poster_path'])
                            <img src="https://image.tmdb.org/t/p/original{{$movie['poster_path']}}" class="card-img-top" alt="{{ $movie['original_title'] }}">
                            @else
                            <img src="{{ asset('img/no-image.jpeg') }}" class="card-img-top" alt="{{ $movie['original_title'] }}">
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>
                <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                    @foreach ($result['actorsResults']['results'] as $person)
                    <a href="{{ route('actor', $person['id']) }}" class="text-decoration-none text-reset">
                        <div class="card border-0 mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    @if ($person['profile_path'])
                                    <img src="https://image.tmdb.org/t/p/original{{$person['profile_path']}}" class="card-img" alt="{{ $person['name'] }}">
                                    @else
                                    <img src="{{ asset('img/no-image.jpeg') }}" class="card-img" alt="{{ $movie['original_title'] }}">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $person['name'] }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @elseif($result['moviesResults'] and !$result['actorsResults'])
    @foreach ($result['moviesResults']['results'] as $movie)
    <div class="card mb-3" style="width: 15rem;">
        <div class="card-header text-center font-weight-bold">
            {{ $movie['original_title'] }}
        </div>
        @if ($movie['poster_path'])
        <img src="https://image.tmdb.org/t/p/original{{$movie['poster_path']}}" class="card-img-top" alt="{{ $movie['original_title'] }}">
        @else
        <img src="{{ asset('img/no-image.jpeg') }}" class="card-img-top" alt="{{ $movie['original_title'] }}">
        @endif
    </div>
    @endforeach
    @elseif(!$result['moviesResults'] and $result['actorsResults'])
    @foreach ($result['actorsResults']['results'] as $person)
    <div class="card mb-3" style="width: 15rem;">
        <div class="card-header text-center font-weight-bold">
            {{ $person['name'] }}
        </div>
        @if ($person['profile_path'])
        <img src="https://image.tmdb.org/t/p/original{{$person['profile_path']}}" class="card-img-top" alt="{{ $person['name'] }}">
        @else
        <img src="{{ asset('img/no-image.jpeg') }}" class="card-img-top" alt="{{ $person['name'] }}">
        @endif
    </div>
    @endforeach
    @else
    <h1 class="text-center">No Results!</h1>
    @endif
</div>



@endsection