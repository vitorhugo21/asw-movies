@extends('layouts.layout')

@section('title', config('app.name') . ' - [' . $result['sentence'] . ']')

@section('content')
<div class="row">
    <div class="col-4">
        <div class="list-group" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action active d-flex justify-content-between" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">
                <span>Movies</span>
                @if ($result['moviesResults'])
                <span class="badge badge-dark badge-pill align-self-center">{{ count($result['moviesResults']['results']) }}</span>
                @else
                <span class="badge badge-dark badge-pill align-self-center">0</span>
                @endif
            </a>
            <a class="list-group-item list-group-item-action d-flex justify-content-between" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">
                <span>People</span>
                @if ($result['actorsResults'])
                <span class="badge badge-dark badge-pill align-self-center">{{ count($result['actorsResults']['results']) }}</span>
                @else
                <span class="badge badge-dark badge-pill align-self-center">0</span>
                @endif
            </a>
        </div>
    </div>
    <div class="col-8">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                @if ($result['moviesResults'])
                @foreach ($result['moviesResults']['results'] as $movie)
                <a href="{{ route('movie', $movie['id']) }}" class="text-decoration-none text-reset">
                    <div class="card border-0 mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="https://image.tmdb.org/t/p/original{{$movie['poster_path']}}" class="card-img" alt="{{ $movie['original_title'] }}">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $movie['original_title'] }}</h5>
                                    <p class="card-text">{{ $movie['overview'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
                @else
                <span>NO RESULTS!</span>
                @endif
            </div>
            <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                @if ($result['actorsResults'])
                @foreach ($result['actorsResults']['results'] as $person)
                <a href="{{ route('actor', $person['id']) }}" class="text-decoration-none text-reset">
                    <div class="card border-0 mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="https://image.tmdb.org/t/p/original{{$person['profile_path']}}" class="card-img" alt="{{ $person['name'] }}">
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
                @else
                <span>NO RESULTS!</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection