<?php

namespace App\Http\Controllers;
use URL;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store()
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

    public function destroy($id)
    {
        $comment = Comment::find($id);
        
        $comment->delete();
        
        return redirect()->route('profile.show',['user' => User::find($comment->profile_id)]);
    }
}
