@extends('layouts.main')

@section('title', 'Welcome')

@section('content')

<h1>Statistics dashboard</h1>
<div class="statistics col-xs-12 col-md-12 col-lg-6">
    <div class="statistics__short">
        <h2>Short statistics</h2>
        <div class="statistics__short__row">
            <div class="col-xs-6 col-md-6 col-lg-6 statistics__short__row__label">Post count: </div>
            {{ $post_count }}
        </div>
        <div class="statistics__short__row">
            <div class="col-xs-6 col-md-6 col-lg-6 statistics__short__row__label">Comment count:</div>
            {{ $comment_count }}
        </div>
        <div class="statistics__short__row">
            <div class="col-xs-6 col-md-6 col-lg-6 statistics__short__row__label">Blocked user count:</div>
            {{ $blocked_user_count }}
        </div>
        <div class="statistics__short__row">
            <div class="col-xs-6 col-md-6 col-lg-6 statistics__short__row__label">Latest comment added on:</div>
            <a href="/post/{{$latest_comment['post_id']}}" target="new">{{ $latest_comment['created_at'] }} ({{ $latest_comment['comment'] }})</a>
        </div>
        <div class="statistics__short__row">
            <div class="col-xs-6 col-md-6 col-lg-6 statistics__short__row__label">Most commented post:</div>
            <a href="/post/{{$most_commented_post['id']}}" target="new">[{{ $most_commented_post['id'] }}] {{ $most_commented_post['title'] }}</a>
        </div>
    </div>

    <div class="row col-xs-12 col-md-12 col-lg-12 list-group">
        <h2>Latest Comments</h2>
        @foreach($comments as $comment)
            <div class="list-group-item list-group-item-action">
                <a href="/post/{{$comment->post_id}}" target="new">[{{$comment->id }}] {{$comment->comment}}</a>
            </div>
        @endforeach
    </div>

    <div class="row col-xs-12 col-md-12 col-lg-12 list-group">
        <h2>Latest Posts</h2>
        @foreach($posts as $post)
            <div class="list-group-item list-group-item-action">
                <div>[{{$post->id }}] {{$post->title}}</div>
                <commentdetails post_id="{{$post->id}}"></commentdetails>
            </div>
        @endforeach
    </div>
</div>

@endsection