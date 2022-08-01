<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Profile;
use App\Models\Category;
use Illuminate\Http\Request;

class VueApi extends Controller
{

    

  
     //       //        //
    // APIs FOR POSTS  //

    public function posts() //  <== this return ALL VERIFICATED POSTS
    {
        $posts = Post::where("verified", "=","1")->orderByDesc('id')->get();
        return $posts;
    }

    public function toVerificate() //  <== this return ALL VERIFICATED POSTS
    {
        $posts = Post::where("verified", "=","0")->get();
        foreach($posts as $post){
        $post->date = date( "d-m-Y H:i:s", strtotime($post->created_at) );
        $post->update_at = date( "d-m-Y H:i:s", strtotime($post->updated_at) );
        $post->username =  User::find($post->user_id)->name;
        $post->email =  User::find($post->user_id)->email;
        }
        return $posts;
    }

    public function premiumPosts()//  <== this return PREMIUM POSTS 
    {
       
        $prem = Post::where("premium", "=", "1")->where("verified","=", "1")->orderBy('id', 'DESC')->get();
    
        return $prem;
        
    }
    public function getPost($id)//  <== this return SPECIFIC POST
    {
        $post = Post::where("id", "=", $id)->get();
        $post[0]->username =  User::find($post[0]->user_id)->name;
        $post[0]->email =  User::find($post[0]->user_id)->email;
        $post[0]->date = date( "d-m-Y H:i:s", strtotime($post[0]->created_at) );
        $post[0]->update_at = date( "d-m-Y H:i:s", strtotime($post[0]->updated_at) );
        if(!(empty(Profile::find($post[0]->user_id)->image))){
                $post[0]->userimage =  Profile::find($post[0]->user_id)->image;
        }
        
        return response()->json([
            'status'   => 'success',
            'post' => $post,
          ]); 
  
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
    // APIs FOR USERS  //
    public function getuser($id)
    {
        $user = User::where("id", "=", $id)->get();
        return response()->json([
            'status'   => 'success',
            'user' => $user,
          ]); 
     
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

            $category->count = Post::where('category','=',$category->title)->where("verified","=","1")->count();

        }
            $ret = $categories->sortByDesc('count');

        return $ret->values();
    }

       //       //        //
    // APIs FOR profile  //

    public function profile($id)
    {
    
        $profile = Profile::where("user_id", "=", $id)->get();
        $follows = (auth()->user()) ? auth()->user()->following->contains($profile[0]) : false;

        
        $user = User::find($id);
      
        $postCount = $user->posts->count();
 

        $followersCount = $user->profile->followers->count();

        $followingCount = $user->following->count(); 
  
        $profile[0]->follows = $follows;
        $profile[0]->postCount = $postCount;
        $profile[0]->followersCount = $followersCount;
        $profile[0]->followingCount = $followingCount;
        
        return response()->json([
            'status'   => 'success',
            'profile' => $profile,
          ]); 
        
        
    }
    public function countPostsFollowersFollowing(User $user)
    {
        

      
      
        $postCount = Cache::remember('count.posts.'.$user->id, now()->addSeconds(5), function() use ($user) {
                return $user->posts->count();
            }) ;
 
        $followersCount =Cache::remember('count.followers.'.$user->id, now()->addSeconds(5), function() use ($user) {
                return  $user->profile->followers->count();
             }) ;
        $followingCount =Cache::remember('count.following.'.$user->id, now()->addSeconds(5), function() use ($user) {
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
