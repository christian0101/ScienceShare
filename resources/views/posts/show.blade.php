@extends('layouts.app')

@section('title', 'Post')

@section('content')

  <div id="post">
    <h2>{{ $post->title }}</h2>
    <h5><span>Tags:</span>
        @foreach ($post->tags as $tag)
            <a href="{{ route('tag.posts', ['id' => $tag->id]) }}" class="badge badge-primary">
                {{ $tag->name }}
            </a>
        @endforeach
    </h5>

    <p>{{ $post->content }}</p>
    <p class="text-secondary">Published by
        <a href="{{ route('profiles.show', ['id' => $post->user->id]) }}">{{  $post->user->name }}</a>
        <span class="badge badge-secondary">
          {{ $post->views->count() }} View(s)
        </span>
    </p>
  </div>

  <div class="py-4" id="comments">
    <h3><b>Comments</b></h3>
    @foreach ($post->comments as $comment)
      <div id="comment{{$comment->id}}">
        <a href="{{ route('profiles.show', ['id' => $comment->user->id]) }}">{{ $comment->user->name }}</a>
        on {{ $comment->created_at->format('d M Y') }}
        <p>{{ $comment->text }}</p>
      </div>
    @endforeach
  </div>

@endsection
