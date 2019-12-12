@extends('layouts.app')

@section('title', 'User Profile')

@section('content')

<div>
  {{ $profile->user->name }}
</div>

@endsection
