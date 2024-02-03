<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Profile;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VueApi extends Controller
{

        
     //       //        //
    // API ENDPOINT FOR SESSION CHECK  //
    public function checkSession ($token)
    {
        $user = User::authenticateByToken($token);
        if ($user) {
            return response()->json([
                'status' => 'success',
                'session' => true
            ]);
        }

        return response()->json([
            'status' => 'error',
            'expired' => true,
            'message' => 'Session Expired',
        ], 200);
    }

         //       //        //
    // API ENDPOINT FOR SESSION CHECK  //
    public function checkResetPasswordToken ($token)
    {
        $user = User::where('reset_password_token', $token)->first();
        if ($user) {
            return response()->json([
                'status' => 'success',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'expired' => true,
            'message' => 'Session Expired',
        ], 200);
    }

  
     //       //        //
    // APIs FOR POSTS  //

    public function posts(Request $request)
    {
        // Get the search query from the request, if available
        $search = $request->input('q');

        // Get the search query from the request, if available
        $searchCategory = $request->input('category');

        // Get the search query from the request, if available
        $searchPlace = $request->input('place');

        // Query the posts and filter based on verification and search criteria
        $query = Post::where('verified', 1)
            ->where(function ($subquery) {
                $subquery->where('done', false)
                    ->orWhereNull('done');
            })
            ->orderByDesc('id');
    
        // Apply search filtering if a search query is provided
        if ($search && $search != 'undefined') {
            $query->where(function ($subquery) use ($search) {
                $subquery->where('title', 'like', '%' . $search . '%');
            });
        }

        // Apply search filtering if a place  search query is provided
        if (!empty($searchPlace)) {
            if (!is_numeric($searchPlace)) {
                // Decode the URL-encoded string
                $decodedString = urldecode($searchPlace);
                // Remove leading/trailing single quotes if present
                $decodedString = trim($decodedString, "'");
                // Convert the JSON-like string to a PHP associative array
                $parsedPlaceObject = json_decode($decodedString, true);
    
                if ($parsedPlaceObject !== null) {
                    // Eager load location relationship with constraint
                    $query->whereHas('location', function($q) use ($parsedPlaceObject){
                        $q->where('locality', $parsedPlaceObject['locality']);
                    });
                }
            } else {
                $query->where(function ($subquery) use ($searchPlace) {
                    $subquery->where('location_id', $searchPlace);
                });
            }
        }

        // Apply category filtering if a category is provided
        if ($searchCategory && $searchCategory != 'undefined' && !($searchCategory === 'all')) {
            $query->where(function ($subquery) use ($searchCategory) {
                $subquery->where('category', 'like', '%' . $searchCategory . '%');
            });
        }
    
        // Paginate the results (e.g., 10 posts per page)
        $posts = $query->paginate(10);
        foreach ($posts as $key => $post) {
            $location = $post->location; // Access the location related model
    
            $post->fullAddress = $location;
        }
        return $posts;
    }

    public function relatedPosts($id)
    {
        $post = Post::find($id);
    
        if (empty($post)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post not found',
            ], 200);
        }
    
        // Get posts with the same category
        $relatedByCategory = Post::where('category', $post->category)
            ->where('verified', true)
            ->where('id', '<>', $post->id) // Exclude the current post
            ->get();
    
        // Get posts with similar names
        $relatedBySimilarName = Post::where('title', 'like', '%' . $post->title . '%')
            ->where('verified', true)
            ->where('id', '<>', $post->id) // Exclude the current post
            ->get();
    
        // Combine the two sets of related posts
        $relatedPosts = $relatedByCategory->concat($relatedBySimilarName);
    
        // Use the unique method to ensure uniqueness based on the 'id' attribute
        $uniqueRelatedPosts = $relatedPosts->unique('id');
    
        // Limit the results to the first 4 posts
        $limitedRelatedPosts = $uniqueRelatedPosts->take(4);
    
        foreach ($limitedRelatedPosts as $key => $relatedPost) {
            $location = $relatedPost->location; // Access the location related model
    
            // Assuming "location" has a property named "fullAddress"
            $relatedPost->fullAddress = $location;
        }
    
        return response()->json([
            'status' => 'success',
            'posts' => $limitedRelatedPosts,
        ]);
    }
    
    

    public function toVerificate($token) //  <== this return ALL VERIFICATED POSTS
    {
        $user = User::authenticateByToken($token);
        if (!$user){
            return response()->json([
                'status' => 'error',
                'expired' => true,
                'message' => 'Session Expired',
            ], 200);
        }
        if(!$user->isAdmin() && !$user->isModerator()) {
            return response()->json([
                'status' => 'error',
                'unauthorized' => true,
                'message' => 'Unauthorized user',
            ]);
        }
        $posts = Post::where("verified", "=","0")->get();
        foreach($posts as $post){
            $location = $post->location; // Access the location related model

            // Assuming "location" has a property named "fullAddress"
            $post->fullAddress = $location;
            $post->date = date( "d-m-Y H:i:s", strtotime($post->created_at) );
            $post->update_at = date( "d-m-Y H:i:s", strtotime($post->updated_at) );
            $post->username =  User::find($post->user_id)->name;
            $post->email =  User::find($post->user_id)->email;
        }
        return $posts;
    }

    public function unreadMessages($token) //  <== this return ALL VERIFICATED POSTS
    {
        $user = User::authenticateByToken($token);
        if (!$user){
            return response()->json([
                'status' => 'error',
                'expired' => true,
                'message' => 'Session Expired',
            ], 200);
        }
        if(!$user->isAdmin() && !$user->isModerator()) {
            return response()->json([
                'status' => 'error',
                'unauthorized' => true,
                'message' => 'Unauthorized user',
            ]);
        }
        
        $messages = Message::all();
        $totalUnreadMessages = 0;
        foreach($messages as $message){
            $message->date = date( "d-m-Y H:i:s", strtotime($message->created_at) );
            $message->update_at = date( "d-m-Y H:i:s", strtotime($message->updated_at) );
            if (!$message->isReadByUser($user->id)) {
                $message->isNotRead = true;
                $totalUnreadMessages += 1;
            }
        }
        return response()->json([
            'status' => 'success',
            'messages' => $messages,
            'totalUnreadMessages' => $totalUnreadMessages
        ]);
    }

    public function premiumPosts()//  <== this return PREMIUM POSTS 
    {
       
        $prem = Post::where("premium", "=", "1")->where("verified","=", "1")->orderBy('id', 'DESC')->get();
    
        return $prem;
        
    }
    public function getPost($id)//  <== this return SPECIFIC POST
    {
        $post = Post::where("id", "=", $id)->first();
        if (!empty($post)) {
            $location = $post->location; // Access the location related model

            // Assuming "location" has a property named "fullAddress"
            $post->fullAddress = $location;
            $post->username =  User::find($post->user_id)->name;
            $post->email =  User::find($post->user_id)->email;
            $post->date = date( "d-m-Y H:i:s", strtotime($post->created_at) );
            $post->update_at = date( "d-m-Y H:i:s", strtotime($post->updated_at) );
            if(!(empty(Profile::find($post->user_id)->image))){
                    $post->userimage =  Profile::find($post->user_id)->image;
            }
            
            return response()->json([
                'status'   => 'success',
                'post' => $post,
            ]); 
        }
        return response()->json([
            'status'   => 'error',
            'message' => 'Post not found',
        ], 404);
  
    }
    public function getMyPost($id)//  <== this return User's POSTS
    {
        $posts = Post::where("user_id", "=", $id)->orderBy('id', 'DESC')->get();
        return response()->json([
            'status'   => 'success',
            'posts' => $posts,
          ]); 
  
    }

    //       //        //
    // API FOR USER  //
    public function getuser($token)
    {
        $user = User::authenticateByToken($token);
    
        if ($user) {
            $user->profile_image = $user->getProfileImage();
            $user->auth_token = $token;
            // $user->unreadMessages = $user->messages()->wherePivot('read', false)->get();
    
            return response()->json([
                'status' => 'success',
                'user' => $user,
            ]);
        }
    
        return response()->json([
            'status' => 'error',
            'expired' => true,
            'message' => 'Session Expired',
        ], 200);
    }
    
    public function username($id) 
    {
        $user = User::where("id","=",$id);
        return User::find($id)->name;
    }


    public function users() // <====== this returns all users!!
    {
        return User::all()->sortByDesc("id");
    }

    //       //        //
    // APIs FOR CATEGORIES  //

    public function categories()
    {
        $categories = Category::all();
        
        foreach($categories as $category){

            $category->count = Post::where('category','=',$category->title)->where("done", "=", "0")->where("verified","=","1")->count();

        }
            $ret = $categories->sortByDesc('count');

        return $ret->values();
    }


    //       //        //
    // APIs FOR PLACES  //

    public function places()
    {
        $locations = Location::all();
        
        $locationNames = [];
        foreach($locations as $location){
            $locationNames[$location->id] = $location->name_el;
        }


        return $locationNames;
    }

       //       //        //
    // APIs FOR profile  //

    public function profile($id, $token = '')
    {
        $user = User::authenticateByToken($token);
    
        $profile = Profile::where("user_id", "=", $id)->get();
        if (!empty($user)) {
            $follows = ($user) ? $user->following->contains($profile[0]) : false;
            $profile[0]->follows = $follows;
        }

        
        $user = User::find($id);
        if (!empty($user)) {
            $postCount = $user->posts->count();
            $profile[0]->postCount = $postCount;
        }
 

        $followersCount = $user->profile->followers->count();

        $followingCount = $user->following->count(); 
  
        $profile[0]->followersCount = $followersCount;
        $profile[0]->followingCount = $followingCount;
        
        return response()->json([
            'status'   => 'success',
            'profile' => $profile,
            'profileUser' => $user
          ]); 
    }

    public function followToggle($id, $token)
    {
        $user = User::authenticateByToken($token);
        $profileUser = User::find($id);
        if ($user && $user->following()->toggle($profileUser->profile)) {
    
            return response()->json([
                'status' => 'success',
            ]);
        }
    
        return response()->json([
            'status' => 'error',
            'expired' => true,
            'message' => 'Session Expired',
        ], 200);

    }

    public function countPostsFollowersFollowing(User $user)
    {
        $postCount = \Illuminate\Support\Facades\Cache::remember('count.posts.'.$user->id, now()->addSeconds(5), function() use ($user) {
            return $user->posts->count();
        }) ;

        $followersCount = \Illuminate\Support\Facades\Cache::remember('count.followers.'.$user->id, now()->addSeconds(5), function() use ($user) {
            return  $user->profile->followers->count();
        }) ;
        $followingCount = \Illuminate\Support\Facades\Cache::remember('count.following.'.$user->id, now()->addSeconds(5), function() use ($user) {
            return  $user->following->count(); 
        }) ;
    }

    public function getcomments($id)
    {
        $comments = Comment::where("profile_id","=",$id)->orderBy('id', 'DESC')->get();
        foreach($comments as $comment){
            $comment->commentersname =  User::find($comment->user_id)->name;
            $comment->date = date( "d-m-Y H:i:s", strtotime($comment->created_at) );
            $comment->update_at = date( "d-m-Y H:i:s", strtotime($comment->updated_at) );
        }
        return response()->json([
            'status'   => 'success',
            'comments' => $comments,
        ]); 
    }
}
