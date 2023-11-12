<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
  


    public function index(User $user)
    {
        $posts = Post::where("user_id", "=", $user->id)->get();

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
      
        $postCount = Cache::remember('count.posts.'.$user->id, now()->addSeconds(5), function() use ($user) {
            return $user->posts->count();
        }) ;
 
        $followersCount =Cache::remember('count.followers.'.$user->id, now()->addSeconds(5), function() use ($user) {
         return  $user->profile->followers->count();
     }) ;
        $followingCount =Cache::remember('count.following.'.$user->id, now()->addSeconds(5), function() use ($user) {
         return  $user->following->count(); 
     }) ;
 
 
 
         return view('profiles.index', compact('user', 'follows','postCount','followersCount','followingCount', 'posts'));
    }

    public function edit(User $user)
    {
      $this->authorize('update', $user->profile);
      return view('profiles.edit', compact('user'));
    }

    public function update($token)
    {
        try {
            $validator = \Validator::make(request()->all(), [
                'description' => ['max:600', 'nullable'],
                'image' => ['nullable', 'image', 'max:2048'],
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $data = request()->validate([
                'description' => ['max:600', 'nullable'],
                'image' => ['nullable', 'image', 'max:2048'],
            ]);
            
            
            $user = User::authenticateByToken($token);
            if (!empty($user)) {
                if (!(request('image') == '')){
                    $imagePath = request('image')->store('profile', 'public');
                    
                    $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
                    $image->save();
                    
                    $imageArray =   ['image'=> $imagePath];
                    
                }
                
            
                $user->profile->update(array_merge(
                    $data,
                    $imageArray ?? []
                ));

                return response()->json([
                    'status' => 'success',
                    'image_url' => $imagePath ?? ''
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'expired' => true,
                    'message' => 'Session Expired',
                ], 200);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }
}
