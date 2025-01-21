@extends('layout')

@section('content')
    <h1>All Posts</h1>
    @foreach($posts as $post)
        <h2><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h2>
    @endforeach
@endsection
