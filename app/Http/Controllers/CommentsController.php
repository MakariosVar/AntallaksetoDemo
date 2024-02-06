<?php

namespace App\Http\Controllers;
use URL;
use App\Models\User;
use App\Models\Comment;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $request = request();
        // Validate the request data
        try {
            $data = $request->validate([
                'auth_token' => 'required',
                'comment' => ['required', 'max:255'],
                'profile_id' => [
                    'required',
                    Rule::exists('users', 'id'),
                ],
            ]);
        } catch (ValidationException $e) {
            // Return validation errors in the JSON response
            return response()->json(['errors' => $e->errors()], 200);
        }
            
        // Check if the authenticated user has permission to comment on the specified profile
        $user = User::authenticateByToken(request('auth_token'));
        if (!empty($user)) {

            $profile = Profile::where("user_id", "=", request('profile_id'))->first();

            if (!empty($profile)) {
                if (empty(Comment::where(['user_id' => $user->id, 'profile_id' => $profile->id])->first())) {
                    Comment::create([
                        'user_id' => $user->id,
                        'comment' => $data['comment'],
                        'profile_id' => $profile->id,
                    ]);
                    
                    return response()->json([
                        'status' => 'success',
                    ]);
                }
                return response()->json([
                    'status' => 'error',
                    'commentExist' => true,
                    'message' => 'User has commented profile already',
                ], 200);
            }
            return response()->json([
                'status' => 'error',
                'message' => 'Profile Not Found',
            ], 404);
        } else {
            return response()->json([
                'status' => 'error',
                'expired' => true,
                'message' => 'Session Expired',
            ], 200);
        }
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
