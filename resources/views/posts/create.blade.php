@extends('layouts.app')

@section('title', 'Create Post')

@section('content')

  <div id="createPost">

    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
      @csrf

      <h4><label>Title*</label>
      <input class="form-control" type="text" name="title" value="{{ old('title') }}" /></h4>
      <p><label>Tags (space separated):</label>
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
      <p><img id="preview" src="" /></p>
      <p><label>Featured Pictures:</label> <input onchange="previewFile(this)" type="file" class="form-control" name="featured_pic" value="" accept="image/x-png,image/gif,image/jpeg,image/svg" /></p>
      <p><label>Content*:</label> <textarea id="post_text" class="form-control" type="text" name="content">{{ old('content') }}</textarea></p>
      <input class="btn btn-success" type="submit" value="Submit" />
      <a class="btn btn-danger" href="{{ route('posts') }}">Cancel</a>

    </form>
  </div>

@endsection
