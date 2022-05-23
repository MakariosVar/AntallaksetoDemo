<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
   public function index()
   {
    $posts = Post::all()->sortByDesc("id");
        
    return view('index', compact('posts'));
   }
}
