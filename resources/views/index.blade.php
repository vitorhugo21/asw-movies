@extends('layouts.layout')

@section('title', config('app.name'))

@section('content')
<div class="container-fluid px-0">
    <div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel">

        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                @for ($index = 0; $index < count($movies); $index++) <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="@if($index == 0) active @endif">
                    </li>
                    @endfor
            </ol>
            <div class="carousel-inner">
                @foreach ($movies as $movie)
                <div class="carousel-item @if($loop->first) active @endif">
                    <img src="https://image.tmdb.org/t/p/original{{$movie['backdrop_path']}}" class="vw-100 vh-100" alt="{{$movie['original_title']}}" srcset="">
                    <div class="carousel-caption">
                        <h3 class="font-weight-bold text-uppercase">{{$movie['original_title']}}</h3>
                        <p>{{$movie['overview']}}</p>
                        <button type="submit" class="btn btn-primary" onclick="location.href='{{ route('movie', $movie['id']) }}';"> <a style="color:white">See details</a> </button>
                    </div>
                </div>
                @endforeach
            </div>

            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>



        </div>
    </div>
    @endsection