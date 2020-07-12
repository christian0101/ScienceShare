@extends('layouts.app')

@section('title', 'User Profile')

@section('content')

<div id="profile">
    <h2><b>{{ $profile->user->name }}</b></h2>
    <p>Member since {{ $profile->created_at->format('d M Y') }}</p>
    <div id="info">
        <h3><b>Bio</b>
          @if ($profile->user == Auth::user())
            <button v-if="!editingBio" @click="createEditor" type="button" class="btn btn-primary" name="button" v-cloak>
              Edit Bio
            </button>
          @endif
        </h3>
        <div class="mb-3" v-cloak>
          <div id="bio">{!! $profile->bio ?? 'No bio' !!}</div>
          <div class="btn-group mt-2">
            <button v-if="editingBio" @click="updateBio({{ $profile->id }})" class="btn btn-success">Save</button>
            <button v-if="editingBio" @click="cancelEdit" class="btn btn-danger">Cancel</button>
          </div>
        </div>
        <h3><b>Statistics</b></h3>
        <div class="row">
            <div class="col-md-3">
                <p>{{ $profile->user->posts->count() }} Published articles.</p>
            </div>
            <div class="col-md-3">
                <p>{{ $profile->user->comments->count() }} Posted comments.</p>
            </div>
            <div class="col-md-3">
                <p>{{ $profile->user->posts->sum(function ($post) {
                    return $post->views->count();
                }) }} Views recieved on published articles.</p>
            </div>
            <div class="col-md-3">
                <p>{{ $profile->user->posts->sum(function ($post) {
                    return $post->votes->count();
                }) }} Votes recieved on published articles.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p>{{ $profile->user->votes->count() }} Votes casted on articles.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h3><b>Posts</b></h3>
                <ul class="pl-4">
                  @foreach ($profile->user->posts as $post)
                    <li>
                      <a href="{{ route('posts.show', ['post' => $post]) }}">
                        {!! $post->title !!}
                      </a>
                    </li>
                  @endforeach
                </ul>
            </div>
            <div class="col-md-6">
                <h3><b>Comments</b></h3>
                <ul class="pl-4">
                  @foreach ($profile->user->comments as $comment)
                    <li>
                      <a href="{{ route('posts.show', ['post' => $comment->post]) }}#{{$comment->id}}">
                        {!! Str::limit($comment->text) !!}
                      </a>
                    </li>
                  @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
