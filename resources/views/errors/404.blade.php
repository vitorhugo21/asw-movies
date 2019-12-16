@extends('errors::minimal')


@section('code', '404')

@if ($exception->getMessage())
@section('message', $exception->getMessage())
@section('title', $exception->getMessage())
@else
@section('message', __('Not Found'))
@section('title', __('Not Found'))
@endif