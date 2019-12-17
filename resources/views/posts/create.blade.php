@extends('layouts.app')

@section('title', 'Create Post')

@section('content')

  <multiselect v-model="value" tag-placeholder="Add this as new tag" placeholder="Search or add a tag" label="name" track-by="code" :options="options" :multiple="true" :taggable="true" @tag="addTag"></multiselect>

  <div id="createPost">
    <form action="{{ route('posts.store') }}" method="post">
      @csrf

      <p>Title*: <input type="text" name="title" value="{{ old('title') }}" /></p>
      <p>Featured Picture: <input type="text" name="featured_pic_path" value="{{ old('featured_pic_path') }}" /></p>
      <p>Tags (comma separated): <input type="text" name="tags" value="{{ old('tags') }}" /></p>
      <p>Content*: <input type="text" name="content" value="{{ old('content') }}" /></p>
      <input class="btn btn-success" type="submit" value="Submit" />
      <a class="btn btn-danger" href="{{ route('posts') }}">Cancel</a>
    </form>
  </div>

@endsection
