<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function show(Post $post)
    {
        return view('post', compact('post'));
    }

    public function index()
    {

        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('index', ['posts' => $posts]);
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to create a post.');
        }
        return view('/create-post');
    }

    public function save(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to create a post.');
        }


        $validated = $request->validate([
            'title' => 'required|max:60',
            'body' => 'required',
        ]);


        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);


        return redirect('/')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            // If the user is not the owner, redirect or abort
            return redirect('/')->with('error', 'You are not authorized to delete this post.');
        }

        return view('edit', compact('post'));
    }


    public function update(Request $request, Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            // If the user is not the owner, redirect
            return redirect('/')->with('error', 'You are not authorized to delete this post.');
        }

        // Validate input
        $request->validate([
            'title' => 'required|max:60',
            'body' => 'required',
        ]);


        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        // Redirect back to the post with a success message
        return redirect()->route('posts.show', $post)->with('success', 'Post updated successfully!');
    }


    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            // If the user is not the owner, redirect or abort
            return redirect('/')->with('error', 'You are not authorized to delete this post.');
        }

        $post->delete();

        // Redirect to homepage with a success message
        return redirect('/')->with('success', 'Post deleted successfully!');
    }
}
