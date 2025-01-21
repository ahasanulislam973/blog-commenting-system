<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $post = Post::findOrFail($postId);

        // Create a new comment
        Comment::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return redirect()->route('feed')->with('success', 'Comment added successfully!');
    }

    public function destroy($commentId)
    {
        $comment = Comment::findOrFail($commentId);
    
        // Use the policy to authorize deletion
        $this->authorize('delete', $comment);
    
        $comment->delete();
        return redirect()->route('feed')->with('success', 'Comment deleted successfully!');
    }


    public function edit($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if ($comment->user_id != Auth::id()) {
            return redirect()->route('feed')->with('error', 'You can only edit your own comments.');
        }

        return view('comments.edit', compact('comment'));
    }


    public function update(Request $request, $commentId)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);
    
        $comment = Comment::findOrFail($commentId);
    
        // Use the policy to authorize update
        $this->authorize('update', $comment);
    
        // Update the comment
        $comment->update([
            'comment' => $request->comment,
        ]);
    
        return redirect()->route('feed')->with('success', 'Comment updated successfully!');
    }

}