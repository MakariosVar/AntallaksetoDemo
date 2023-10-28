<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(User $user)
    {
        $users = User::all();
        return view('users', compact('users',));
    }

    public function destroy($token)
    {
        $user = User::authenticateByToken($token);

        if ($user) {
            $user->delete();

            return response()->json([
                'status' => 'success'
            ]);
        }
        if (empty($user)) {
            return response()->json([
                'status' => 'error',
                'expired' => true,
                'message' => 'Session Expired',
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'post_not_found' => true,
            'message' => 'Post not found',
        ], 404);
    }
}
