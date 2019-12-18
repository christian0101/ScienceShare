@extends('layouts.app')

@section('title', 'Post')

@section('content')

  <div id="post">
    <h2>{{ $post->title }}</h2>
    <h5><span>Tag(s):</span>
        @foreach ($post->tags as $tag)
            <a href="{{ route('tag.posts', ['tag' => $tag]) }}" class="badge badge-primary">
                {{ $tag->name }}
            </a>
        @endforeach
    </h5>

    @if($post->featured_pic_path)
      <img src="{{ $post->featured_pic_path }}"></img>
    @endif

    <p>{{ $post->content }}</p>
    <p class="text-secondary">Published by
        <a href="{{ route('profiles.show', ['user' => $post->user]) }}">{{  $post->user->name }}</a>
        <span class="badge badge-secondary">
          {{ $post->views->count() }} View(s)
        </span>
    </p>
  </div>

  <comments :post-id="{{ $post->id }}">
  </comments>

@endsection
