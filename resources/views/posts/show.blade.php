@extends('layouts.app')

@section('title', 'Posts')

@section('content')

  <h2>{{ $post->title }}</h2>

  <p>{{ $post->content }}</p>
  <span>Published by {{ $post->user->name }}</span>

@endsection
