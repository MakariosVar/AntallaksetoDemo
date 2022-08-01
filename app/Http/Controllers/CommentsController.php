<?php

namespace App\Http\Controllers;
use URL;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store() // <= for Blade view
    {
        $profileID = substr(URL::previous(), -1);
        $data = request()->validate([
            'comment' => ['required ','max:255']
        ]);
    
       
        Auth()->user()->comments()->create([
            'comment' => $data['comment'],
            'profile_id' => $profileID
        ]);

        return Redirect(URL::previous());
    }

    
    public function commentStore() // <= for Vue Api
    {
        $profileID = substr(URL::previous(), -1);
        $data = request()->validate([
            'comment' => ['required ','max:255']
        ]);
    
       
        Auth()->user()->comments()->create([
            'comment' => $data['comment'],
            'profile_id' => $profileID
        ]);

        return response()->json([
            'status'   => 'success'
          ]); 
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        
        $comment->delete();
        
        return response()->json([
            'status'   => 'success'
          ]); 
    }
}
