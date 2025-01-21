@extends('layout')

@section('content')
    <h2>Edit Comment</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('comment.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <textarea class="form-control" name="comment" rows="4" required>{{ $comment->comment }}</textarea> <!-- Use 'comment' here -->
        </div>
        
        <button type="submit" class="btn btn-primary">Update Comment</button>
    </form>

    <a href="{{ route('feed') }}" class="btn btn-secondary mt-3">Back to Feed</a>
@endsection
