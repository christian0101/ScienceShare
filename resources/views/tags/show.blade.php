@extends('layouts.app')

@section('title', 'Posts')

@section('content')

  <div class="row">
    <div class="col-xl-12 py-md-3 pl-md-5 bd-content">
      <h2>{{ $tag->name }}</h2>
      @foreach ($tag->posts as $post)
        <div>
          <h3>
            <a href="{{ route('posts.show', ['id' => $post->id]) }}">
              {{ $post->title }}
            </a>
          </h3>

          <span>Published by {{ $post->user->name }}</span>
          <span>{{ $post->created_at }}</span>
          <p> {{ $post->content }} </p>
        </div>
      @endforeach
    <div>
  </div>

@endsection
