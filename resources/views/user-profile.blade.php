@extends('layouts.layout')

@section('title', 'ASW-MOVIES - '.$user['name'])

@section('content')
<h1>{{$user['name']}}</h1>
@endsection
