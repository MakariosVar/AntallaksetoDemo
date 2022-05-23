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
}
