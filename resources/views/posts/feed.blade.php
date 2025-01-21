@extends('layout')

@section('content')
    <h2 class="mb-4 text-center" style="font-size: 35px; color: #333;">Blog Feed</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('post.create') }}" class="btn btn-success btn-lg"
            style="border-radius: 30px; padding: 10px 20px; font-size: 16px;">Create New Post</a>
    </div>

    <div class="d-flex justify-content-center mb-3">
        <form method="GET" action="{{ route('feed') }}" class="d-flex align-items-center w-75">
            <input type="text" name="category" class="form-control" placeholder="Search by category"
                value="{{ request('category') }}"
                style="flex: 1; height: 40px; font-size: 16px; padding: 0 20px; border-radius: 30px; border: 1px solid #ccc;">

            <div class="d-flex justify-content-center" style="margin-left:10px">
                <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center"
                    style="height: 40px; font-size: 16px; border-radius: 30px; padding: 0 20px;">
                    Search
                </button>

                @if (request('category'))
                    <a href="{{ route('feed') }}"
                        class="btn btn-secondary d-flex align-items-center justify-content-center ml-4"
                        style="height: 40px; font-size: 16px; border-radius: 30px; margin-left:10px; padding: 0 20px;">
                        Reset
                    </a>
                @endif
            </div>

        </form>
    </div>

    <div class="row" @if ($posts->isEmpty()) style="height: 100vh" @endif>
        @forelse($posts as $post)
            <div class="col-md-4 mb-3">
                <div class="card" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    @if ($post->image)
                        <img src="{{ $post->image }}" class="card-img-top" alt="Post Image"
                            style="border-top-left-radius: 15px; border-top-right-radius: 15px; object-fit: contain; height: 200px; width: 100%;">
                    @else
                        <img src="images/default_img.png" class="card-img-top" alt="Default Image"
                            style="border-top-left-radius: 15px; border-top-right-radius: 15px; object-fit: contain; height: 200px; width: 100%;">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 20px; font-weight: bold; color: #333;">{{ $post->title }}
                        </h5>
                        <p class="card-text" style="font-size: 14px; color: #555;">
                            {{ \Illuminate\Support\Str::limit($post->description, 100) }}</p>
                        <p class="text-muted" style="font-size: 13px;">By: {{ $post->user->name }} |
                            {{ $post->created_at->diffForHumans() }}</p>

                        @if (Auth::check() && Auth::id() == $post->user_id)
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning"
                                    style="border-radius: 30px; font-size: 14px; padding: 8px 16px;">Edit</a>
                                <form action="{{ route('post.destroy', $post->id) }}" method="POST"
                                    onsubmit="confirmSweetAlert(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        style="border-radius: 30px; font-size: 14px; padding: 8px 16px;">Delete</button>
                                </form>

                            </div>
                        @endif

                        <div>
                            <h6 style="font-size: 16px; font-weight: bold; color: #333;">Comments:</h6>
                            @foreach ($post->comments as $comment)
                                <div class="border p-2 mb-2" style="border-radius: 8px; background-color: #f9f9f9;">
                                    <strong>{{ $comment->user->name }}:</strong>
                                    <p style="font-size: 14px; color: #555;">{{ $comment->comment }}</p>

                                    @if (Auth::id() == $comment->user_id)
                                        <button class="btn btn-warning btn-sm"
                                            style="border-radius: 30px; font-size: 14px; margin-right: 5px; padding: 8px 16px;"
                                            onclick="toggleEditForm('{{ $comment->id }}')">Edit</button>
                                    @endif

                                    @if (Auth::id() == $post->user_id)
                                        <form action="{{ route('comment.destroy', $comment->id) }}" method="POST"
                                            onsubmit="confirmSweetAlert(event)" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                style="border-radius: 30px; font-size: 14px; margin-left: 5px; padding: 8px 16px;">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('comment.update', $comment->id) }}" method="POST"
                                        id="editForm{{ $comment->id }}" class="mt-2" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <textarea class="form-control" name="comment" rows="3" required>{{ $comment->comment }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary"
                                            style="border-radius: 30px; font-size: 14px; padding: 8px 16px;">Save
                                            Changes</button>
                                    </form>
                                </div>
                            @endforeach

                            <form action="{{ route('comment.store', $post->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <textarea class="form-control" name="comment" rows="3" required placeholder="Add your comment"
                                        style="border-radius: 8px;"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary"
                                    style="border-radius: 30px; font-size: 14px; padding: 8px 16px;">Add Comment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted text-center" style="font-size: 16px;">No posts available!</p>
        @endforelse
    </div>


    <script>
        function confirmSweetAlert(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this item!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
        }

        function toggleEditForm(commentId) {
            var form = document.getElementById('editForm' + commentId);
            var button = event.target;

            if (form.style.display === "none") {
                form.style.display = "block";
                button.innerText = "Cancel Edit";
            } else {
                form.style.display = "none";
                button.innerText = "Edit";
            }
        }
    </script>



@endsection
