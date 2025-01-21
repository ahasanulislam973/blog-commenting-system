@extends('layout')

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->description }}</p>

    <h2>Comments</h2>
    @foreach($post->comments as $comment)
        <p>{{ $comment->comment }} - by {{ $comment->user->name }}</p>
        @can('delete', $comment)
            <form method="POST" action="{{ route('comments.destroy', $comment->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        @endcan
    @endforeach

    <form method="POST" action="{{ route('comments.store', $post->id) }}">
        @csrf
        <textarea name="comment" required></textarea>
        <button type="submit">Add Comment</button>
    </form>
@endsection
