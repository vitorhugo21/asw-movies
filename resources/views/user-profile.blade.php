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
                        <div class="form-group row">
                            <label for="profile_image" class="col-md-4 col-form-label text-md-right">Profile
                                Image</label>
                            <div class="col-md-6">
                                <input id="profile_image" type="file" class="form-control" name="profile_image">
                                @if (auth()->user()->image)
                                <code>{{ auth()->user()->image }}</code>
                                @endif
                            </div>
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
                                <img class="d-block w-100"
                                    src="https://image.tmdb.org/t/p/original{{$favorite['backdrop_path']}}" alt=""
                                    srcset="">
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
                                <img class="d-block w-100"
                                    src="https://image.tmdb.org/t/p/original{{$watch['backdrop_path']}}" alt=""
                                    srcset="">
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
                                <img class="d-block w-100"
                                    src="https://image.tmdb.org/t/p/original{{$watched['backdrop_path']}}" alt=""
                                    srcset="">
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