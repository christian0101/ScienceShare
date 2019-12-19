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

    <p id="post_text">{{ $post->content }}</p>
    <p class="text-secondary">Published by
        <a href="{{ route('profiles.show', ['user' => $post->user]) }}">{{  $post->user->name }}</a>
        <span class="badge badge-secondary">
          {{ $post->views->count() }} View(s)
        </span>
    </p>

    <div class="btn-group">
      @can('update', $post)
        <form method="put" action="{{ route('posts.destroy', ['post' => $post]) }}">
          @csrf
          @method('DELETE')
          <button typy="submit" class="btn btn-primary">Edit Post</button>
        </form>
      @endcan

      @can('delete', $post)
        <form class="ml-1" method="post" action="{{ route('posts.destroy', ['post' => $post]) }}">
          @csrf
          @method('DELETE')
          <button typy="submit" class="btn btn-danger">Delete Post</button>
        </form>
      @endcan
    </div>
  </div>

  <comments :post-id="{{ $post->id }}"
    @if( Auth::check())
      :current-user="{{ Auth::user() }}"
    @endif
  >
  </comments>

@endsection
