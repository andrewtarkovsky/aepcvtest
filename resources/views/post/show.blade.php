@extends('layouts.main')

@section('title', 'Ieraksts')

@section('content')

<h1>Dienasgrāmatas ieraksts {{ $post->id }}</h1>

<h2>{{ $post->title }}</h2>
<p>{{ $post->text }}</p>

<p>
    <editpost post_id="{{$post->id}}"></editpost>
    <a class="btn btn-danger" href="{{ action('PostController@destroy', $post) }}">Dzēst šo ierakstu</a>
</p>

<h1>Komentāri</h1>
<ul class="comments">
    @foreach($post->comments as $comment)
        <li class="comments__item">
            <span class="comments__item__label">Autors: </span><span class="comments__item__value">{{ $comment->email }}</span>
            <a class="btn btn-danger comments__item__button-block" href="{{ action('CommentController@block', ['email' => $comment->email, 'post_id' => $post->id]) }}">Bloķēt šo personu</a><br>
            <span class="comments__item__label">Datums: </span><span class="comments__item__value">{{ $comment->created_at }}</span><br>
            <span class="comments__item__description">{{ $comment->comment }}</span>
        </li>
    @endforeach
</ul>
<form action="{{ action('CommentController@store', $post) }}" method="post" class="comment-form">
    <h2>Komentēt</h2>
    {{ csrf_field() }}
    <div class="comment-form__row">
        <label for="comment-form__email">Tavs epasts </label>
        <input
                type="text"
                name="email"
                value="{{ old('email') }}"
                class="form-control col-md-6 col-lg-4"
                id="comment-form__email">
    </div>
    <div class="comment-form__row">
        <label for="comment-form__comment">Tavs komentārs</label>
        <textarea
                name="comment"
                class="form-control col-md-6 col-lg-4"
                id="comment-form__comment">{{ old('comment') }}</textarea>
    </div>
    <div class="comment-form__row">
        <input
                type="submit"
                value="Komentēt"
                class="btn btn-primary comment-form__button-save">
    </div>
</form>

@endsection