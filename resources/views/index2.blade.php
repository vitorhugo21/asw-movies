@extends('layouts.app')
@section('more_styles')
<link href="{{ asset('css/myCss.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="content">
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            @for ($index = 0; $index < count($movies); $index++) <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="@if($index == 0) active @endif">
                </li>
                @endfor
        </ol>
        <div class="carousel-inner">
            @foreach ($movies as $movie)
            <div class="carousel-item @if($loop->first) active @endif">
                <img class="d-block w-100" src="https://image.tmdb.org/t/p/original{{$movie['backdrop_path']}}" alt="" srcset="">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{$movie['original_title']}}</h5>
                    <p>{{$movie['overview']}}</p>
                </div>
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
@endsection