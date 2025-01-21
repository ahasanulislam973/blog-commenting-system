<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $categoryName = $request->get('category');
        $posts = Post::when($categoryName, function ($query) use ($categoryName) {
            return $query->where('category', 'like', '%' . $categoryName . '%');
        })
        ->latest()
        ->get();

        return view('posts.feed', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
    
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'user_id' => $request->user()->id,
        ]);
    
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $post->image = 'images/' . $imageName;
            $post->save();
        }
    
        return redirect()->route('feed')->with('success', 'Post created successfully.');
    }

    public function edit($postId)
    {
        $post = Post::findOrFail($postId);
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $postId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'image' => 'nullable|image|max:2048',
        ]);

        $post = Post::findOrFail($postId);
        $this->authorize('update', $post);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $post->image = 'images/' . $imageName;
        }

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('feed')->with('success', 'Post updated successfully!');
    }

    public function destroy($postId)
    {
        $post = Post::findOrFail($postId);
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()->route('feed')->with('success', 'Post deleted successfully!');
    }
}
