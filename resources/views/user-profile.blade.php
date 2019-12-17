@extends('layouts.layout')

@section('title', 'ASW-MOVIES - '.$user['username'])


@section('content')

<div class="row">


    <div class="col d-flex justify-content-center">
        <img src="{{ asset('img/default-avatar.png') }}" alt="" srcset="">
    </div>

    <div class="col">

        <div class="card">

            <div class="card-body">
                <h4>Name: {{$user['name']}}</h4>
                <h4>Username: {{$user['username']}}</h4>
                <h4>Email: {{$user['email']}}</h4>
                <p><a href="">Change my email</a></p>
                <h4>Password: *****</h4>
                <p><a href="">Change my password</a></p>
            </div>

        </div>

    </div>

</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4>Favorite</h4>
                <div class="container-fluid py-2">
                    <div class="d-flex flex-row flex-nowrap overflow-auto">
                        @foreach ($favorites as $favorite)
                        <div class="pmcard card card-body">
                            <span> {{$favorite['movie_id']}} </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4>Watch later</h4>
                <div class="container-fluid py-2">
                    <div class="d-flex flex-row flex-nowrap overflow-auto">
                        @foreach ($watchLater as $watch)
                        <div class="pmcard card card-body">
                            <span> {{$watch['movie_id']}} </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4>Viewed</h4>
                <div class="container-fluid py-2">
                    <div class="d-flex flex-row flex-nowrap overflow-auto">
                        @foreach ($viewed as $watched)
                        <div class="pmcard card card-body">
                            <span> {{$watched['movie_id']}} </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection