@extends('layouts.app')

@section('title', 'User Profile')

@section('content')

<div id="profile">
  <p id="profile_pic">{{ $profile->profile_pic_path }}</p>
  <h2><b>
    {{ $profile->user->name }}
    @if ($profile->user == Auth::user())
      <button type="button" class="btn btn-primary" name="button">
        Edit Profile
      </button>
    @endif
  </b></h2>
  <p>Member since {{ $profile->created_at }}</p>
  <div id="info">
    <h3><b>Bio</b></h3>
    <p id="bio">{{ $profile->bio }}</p>
    <h3><b>Posts<b></h3>
    <ul>
      @foreach ($profile->user->posts as $post)
        <li>
          <a href="{{ route('posts.show', ['id' => $post->id]) }}">
            {{ $post->title }}
          </a>
        </li>
      @endforeach
    </ul>
  </div>
</div>

@endsection
