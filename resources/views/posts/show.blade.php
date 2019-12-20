@extends('layouts.app')

@section('title', 'Post')

@section('content')

  <div id="post">
    <h2 id="title" v-if="!editingPost">{{ $post->title }}</h2>
    <input v-model="title" v-if="editingPost" class="h2 form-control form-control-lg" type="text" name="title" />
    <h5 v-if="!editingPost"><span>Tag(s):</span>
      @foreach ($post->tags as $tag)
          <a href="{{ route('tag.posts', ['tag' => $tag]) }}" class="badge badge-primary">
              {{ $tag->name }}
          </a>
      @endforeach
    </h5>
    <h5 v-if="editingPost">Tag(s):
      <tags-input element-id="tags"
        :existing-tags="[
            { key: 1, value: 'Web Development' },
            { key: 2, value: 'PHP' },
            { key: 3, value: 'JavaScript' },
        ]"
        :typeahead="true"
        :add-tags-on-space="true"
        :add-tags-on-comma="true"
        :typeahead-max-results="10"
        :typeahead-hide-discard="true"
        :value="tags">
      </tags-input>
    </h5>

    @if($post->featured_pic_path)
      <img src="{{ $post->featured_pic_path }}"></img>
    @endif

    <div id="post_text">{!! $post->content !!}</div>
    <p class="text-secondary">Published by
        <a href="{{ route('profiles.show', ['user' => $post->user]) }}">{{  $post->user->name }}</a>
        <span class="badge badge-secondary">
          {{ $post->views->count() }} View(s)
        </span>
    </p>

    <div class="btn-group">
      @can('update', $post)
        <button v-if="!editingPost" @click="createEditor({{ $post->id }})" class="btn btn-primary">Edit Post</button>
        <button v-if="editingPost" @click="updatePost({{ $post->id }})" class="btn btn-success">Save</button>
        <button v-if="editingPost" @click="cancelEdit" class="btn btn-danger">Cancel</button>
      @endcan

      @can('delete', $post)
        <form v-if="!editingPost" class="btn-group" method="post" action="{{ route('posts.destroy', ['post' => $post]) }}">
          @csrf
          @method('DELETE')
          <button typy="submit" class="btn btn-danger">Delete Post</button>
        </form>
      @endcan
    </div>
  </div>

  <div id="comments">
    <comments :post-id="{{ $post->id }}"
      @if( Auth::check())
        :current-user="{{ Auth::user() }}"
      @endif
    >
    </comments>
  </div>

@endsection
