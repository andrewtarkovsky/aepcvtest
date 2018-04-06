@extends('layouts.main')

@section('title', "Ieraksta labošana")

@section('content')

<h1>Ieraksta {{ $post->id }} labošana</h1>
 @if (count($errors) > 0)
    <h2>Jūsu ievadītajos datos bija nepilnības</h2>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif


<form action="{{ action('PostController@update', $post) }}" method="post" class="post-form">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="post-form__row">
        <label for="post-form__title">Ieraksta virsraksts</label>
        <input
                type="text"
                name="title"
                value="{{ old('title', $post->title) }}"
                class="form-control col-md-6 col-lg-4"
                id="post-form__title">
    </div>
    <div class="post-form__row">
        <label for="post-form__text">Ieraksta teksts</label>
        <textarea
                name="text"
                class="form-control col-md-6 col-lg-4"
                id="post-form__text">{{ old('text', $post->text) }}</textarea>
        </label>
    </div>
    <div class="post-form__row">
        <input
                type="submit"
                value="Izveidot"
                class="btn btn-primary comment-form__button-save">
    </div>
</form>

@endsection