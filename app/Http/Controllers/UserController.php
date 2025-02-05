<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::with(['posts', 'comments'])->findOrFail($id);

        $postCount = $user->posts->count();
        $commentCount = $user->comments->count();
        $likeCount = $user->posts()->withCount('likes')->get()->sum('likes_count');


        return view('profile', compact('user', 'postCount', 'commentCount', 'likeCount'));
    }
}

