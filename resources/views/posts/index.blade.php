@extends('layouts.app')

@section('title', 'Posts')

@section('content')
  @auth
    <div>
      <p align="center"><a class="btn btn-success" href="{{ route('posts.create') }}">New Post</a></p>
    </div>
  @endauth

  <div id="posts" class="row">
      @foreach ($posts as $post)
        <vote :post-id="{{ $post->id }}"
          @if( Auth::check())
            :current-user="{{ Auth::user() }}"
          @endif
        >
        </vote>
        <div class="col-11">
            <h3>
                <a href="{{ route('posts.show', ['post' => $post]) }}">
                    {{ $post->title }}
                </a>
            </h3>
            <p class="text-secondary">
                <a href="{{ route('profiles.show', ['user' => $post->user]) }}">{{ $post->user->name }}</a>
                on {{ $post->created_at->format('d M Y') }} / {{ $post->views->count() }} View(s) /
            </p>
            <p> {!! Str::limit($post->content, 900) !!} </p>
        </div>
      @endforeach
  </div>
  <div class="col-12">
      {{ $posts->links('vendor.pagination.bootstrap-4') }}
  </div>

@endsection
