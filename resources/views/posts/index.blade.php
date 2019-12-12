@extends('layouts.app')

@section('title', 'Posts')

@section('content')

  <div class="row">
      @foreach ($posts as $post)
        <div align="center" class="col-1">
          <button class="btn btn-success">up</button>
          <h6>{{ $post->votes->sum('type') }}</h6>
          <button class="btn btn-danger">down</button>
        </div>
        <div class="col-11">
          <h3>
            <a href="{{ route('posts.show', ['id' => $post->id]) }}">
              {{ $post->title }}
            </a>
          </h3>

          <p>Published by {{ $post->user->name }} {{ $post->created_at }}
            <span class="badge badge-secondary">
              {{ $post->views->count() }} View(s)
            </span>
          </p>
          <p> {{ $post->content }} </p>
        </div>
      @endforeach

    <div class="col-12">
      {{ $posts->links() }}
    </div>
  </div>

@endsection
