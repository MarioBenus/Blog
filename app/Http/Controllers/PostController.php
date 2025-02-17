<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function show(Post $post)
    {
        $post->load('comments.user');
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
        if (auth()->user()->role === 'commenter') {
            return redirect()->route('login')->with('error', 'You don\'t have permissions to create a post.');
        }
        return view('/create-post');
    }

    public function save(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to create a post.');
        }
        if (auth()->user()->role === 'commenter') {
            return redirect()->route('login')->with('error', 'You don\'t have permissions to create a post.');
        }

        $validated = $request->validate([
            'title' => 'required|max:60',
            'body' => 'required',
        ]);

        $strippedTitle = strip_tags($request->input('title'));
        if (strlen($strippedTitle) === 0) {
            return back()->with('error', 'The title must have at least 1 character after removing HTML tags.');
        }

        $strippedBody = strip_tags($request->input('body'));
        if (strlen($strippedBody) === 0) {
            return back()->with('error', 'The body must have at least 1 character after removing HTML tags.');
        }


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
            return redirect('/')->with('error', 'You are not authorized to delete this post.');
        }

        return view('edit', compact('post'));
    }


    public function update(Request $request, Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            return redirect('/')->with('error', 'You are not authorized to delete this post.');
        }

        $request->validate([
            'title' => 'required|max:60',
            'body' => 'required',
        ]);

        $strippedTitle = strip_tags($request->input('title'));
        if (strlen($strippedTitle) === 0) {
            return back()->with('error', 'The title must have at least 1 character after removing HTML tags.');
        }

        $strippedBody = strip_tags($request->input('body'));
        if (strlen($strippedBody) === 0) {
            return back()->with('error', 'The body must have at least 1 character after removing HTML tags.');
        }

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Post updated successfully!');
    }


    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->user_id && auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', 'You are not authorized to delete this post.');
        }

        $post->delete();

        return redirect('/')->with('success', 'Post deleted successfully!');
    }
}
