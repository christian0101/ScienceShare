@extends('layouts.app')

@section('title', 'Posts')

@section('content')

  <h2>{{ $post->title }}</h2>

  @foreach ($post->tags as $tag)
    <a  href="{{ route('posts.index', ['id' => $tag->id]) }}" class="badge badge-primary">
      {{ $tag->name }}
    </a>
  @endforeach

  <p>{{ $post->content }}</p>
  <span>Published by {{ $post->user->name }}</span>
  <span class="badge badge-secondary">
    {{ $post->views->count() }} View(s)
  </span>

@endsection
