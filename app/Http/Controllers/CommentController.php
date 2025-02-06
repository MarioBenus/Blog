<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to create a comment.');
        }

        $request->validate([
            'body' => 'required|max:500',
        ]);

        $post->comments()->create([
            'body' => $request->input('body'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.show', $post->id)->with('success', 'Comment added successfully!');
    }

    public function destroy(Comment $comment)
    {
        if (auth()->id() !== $comment->user_id && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
