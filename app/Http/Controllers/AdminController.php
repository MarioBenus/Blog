<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('manage-users');
    }

    public function updateRole(Request $request, User $user)
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate(['role_id' => 'in:commenter,blogger,admin']);

        $user->update(['role' => $request->role_id]);

        return response()->json(['message' => 'User role updated successfully']);
    }

    public function searchUsers(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('name', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        return response()->view('partials.manage-users-table', compact('users'));
    }


}
