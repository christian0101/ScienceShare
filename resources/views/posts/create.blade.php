@extends('layouts.app')

@section('title', 'Create Post')

@section('content')

  <div id="createPost">

    <form action="{{ route('posts.store') }}" method="post">
      @csrf

      <h3><label>Title*</label>
      <input class="form-control" type="text" name="title" value="{{ old('title') }}" /></h3>
      <p>Featured Picture: <input class="form-control" type="text" name="featured_pic_path" value="{{ old('featured_pic_path') }}" /></p>
      <p>Tags (space separated):
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
          :value={{ old('tags') ?? "[]" }}>
        </tags-input>
      </p>
      <p>Content*: <textarea class="form-control" type="text" name="content" value="{{ old('content') }}"></textarea></p>
      <input class="btn btn-success" type="submit" value="Submit" />
      <a class="btn btn-danger" href="{{ route('posts') }}">Cancel</a>

    </form>
  </div>

@endsection
