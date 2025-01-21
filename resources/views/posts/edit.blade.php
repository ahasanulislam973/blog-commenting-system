@extends('layout')

@section('content')
<div class="container mt-5">
    <!-- Back Arrow to Feed Page -->
    <a href="{{ route('feed') }}" class="text-decoration-none text-dark">
        <i class="bi bi-arrow-left fs-4"></i> Back
    </a>

    <h2 class="mb-4 text-center">Edit Post</h2>

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="5" required>{{ old('description', $post->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control" value="{{ old('category', $post->category) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
            @if($post->image)
            <div class="mt-2">
                <img src="{{ asset($post->image) }}" alt="Post Image" class="img-thumbnail" width="150">
            </div>
            @endif
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary px-5">Update Post</button>
        </div>
    </form>
</div>
@endsection
