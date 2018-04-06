@extends('layouts.main')

@section('title', 'Welcome')

@section('content')
    <h4><a href="{{ action('PostController@index') }}">Ieraksti</a></h4>
@endsection
