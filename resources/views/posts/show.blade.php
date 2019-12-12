@extends('layouts.app')

@section('title', 'Posts')

@section('content')

  <div id="post">
    <h2>{{ $post->title }}</h2>

    @foreach ($post->tags as $tag)
      <a href="{{ route('posts.index', ['id' => $tag->id]) }}" class="badge badge-primary">
        {{ $tag->name }}
      </a>
    @endforeach

    <p>{{ $post->content }}</p>
    <span>Published by {{ $post->user->name }}</span>
    <span class="badge badge-secondary">
      {{ $post->views->count() }} View(s)
    </span>
  </div>

  <div class="py-4" id="comments">
    <h3><b>Comments</b></h3>
    @foreach ($post->comments as $comment)
      <div id="comment{{$comment->id}}">
        <a href="{{ route('profiles.show', ['id' => $comment->user->id]) }}">{{ $comment->user->name }}</a>
        on {{ $comment->created_at }}
        <p>{{ $comment->text }}</p>
      </div>
    @endforeach
  </div>

@endsection
