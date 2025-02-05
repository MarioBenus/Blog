<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleLike(Post $post)
    {
        $user = auth()->user();
        $liked = false;

        if ($post->isLikedBy($user)) {
            $post->likes()->where('user_id', $user->id)->delete();
        } else {
            $post->likes()->create(['user_id' => $user->id]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'likes' => $post->likes()->count(),
        ]);
    }
}
