@extends('layouts.main')

@section('title', 'Ieraksti')

@section('content')

<div class="content-posts">
    <ul class="posts list-group">
        @foreach ($posts as $post)
            <li class="list-group-item list-group-item-action">
                <a href="{{ action('PostController@show', $post) }}">{{ $post->id }}: {{ $post->title }}</a>
                <span>Created: {{$post->created_at}}</span>
                <span>Updated: {{$post->updated_at}}</span>
            </li>
        @endforeach
    </ul>
    <p><editpost></editpost></p>
</div>
@endsection