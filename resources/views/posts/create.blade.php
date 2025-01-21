@extends('layout')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Create New Post</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Title:</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    @error('title') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description:</label>
                    <textarea name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
                    @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Category:</label>
                    <select name="category" class="form-select" required>
                        <option value="" selected>Select a category</option>
                        <option value="Technology">Technology</option>
                        <option value="Lifestyle">Lifestyle</option>
                        <option value="Education">Education</option>
                        <option value="Health">Health</option>
                    </select>
                    @error('category') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Image:</label>
                    <input type="file" name="image" class="form-control">
                    @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Create Post</button>
            </form>

            <div class="mt-3 text-center">
                <a href="{{ route('feed') }}" class="btn btn-secondary">Back to Feed</a>
            </div>
        </div>
    </div>
</div>
@endsection