<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Auth;

class PostsController extends Controller
{

    public function index()
    {
        $posts = Post::all()->sortByDesc("id");
       
        return view('posts.index', compact('posts'));
    }
    public function myposts(User $user)
    {
      
        $posts = Post::where("user_id", "=", $user->id)->get();
        return view('posts.myposts', compact('posts'));
    }
   
    public function create()
    {
        return view('posts.create');
    }
   
    public function show(\App\Models\Post $post)
    {
        
        return view('posts.show', compact('post'));
        
    }

    public function store()
    {
       
        if (request('premium') != null ) {$prem=true;}
        else {$prem=false;}
   
        $data = request()->validate([
            'title' => ['required', 'max:60'] ,
            'description' =>['required ','max:300'],
            'image0' => ['image' , 'required'],
            'image1' => ['image' , 'nullable'],
            'image2' => ['image' , 'nullable'],
            'image3' => ['image' , 'nullable'],
            'image4' => ['image' , 'nullable'],
            'image5' => ['image' , 'nullable'],
            'image6' => ['image' , 'nullable'],
            'image7' => ['image' , 'nullable'],
            'image8' => ['image' , 'nullable'],
            'image9' => ['image' , 'nullable'],
            'adlocation' =>['required','max:60'] ,
            'category' => 'required',
            'condition' => 'required', 
            'phone' => ['required','digits:10'],
            'transferPref'=> ['required','max:300'] ,
            'premium'=>'nullable'
           
        ]);
    
    

        // IMAGE 0 - REQUIRED //
        if (request('image0')){

        $imagePath0 = request('image0')->store('uploads', 'public');

        $image0 = Image::make(public_path("storage/{$imagePath0}"))->fit(1200, 1200);
        $image0->save();
        }

        

        // IMAGE 1 //

        if(request('image1')){
        $imagePath1 = request('image1')->store('uploads', 'public');

        $image1 = Image::make(public_path("storage/{$imagePath1}"))->fit(1200, 1200);
        $image1->save();
        }
        else{ $imagePath1 = "";}
 
        // IMAGE 2 //

        if(request('image2')){
        $imagePath2 = request('image2')->store('uploads', 'public');

        $image2 = Image::make(public_path("storage/{$imagePath2}"))->fit(1200, 1200);
        $image2->save();
        }
        else{ $imagePath2 = "";}


        // IMAGE 3 //

        if(request('image3')){
        $imagePath3 = request('image3')->store('uploads', 'public');

        $image3 = Image::make(public_path("storage/{$imagePath3}"))->fit(1200, 1200);
        $image3->save();   
        }
        else{ $imagePath3 = "";}
 
        // IMAGE 4 //


        if(request('image4')){
        $imagePath4 = request('image4')->store('uploads', 'public');

        $image4 = Image::make(public_path("storage/{$imagePath4}"))->fit(1200, 1200);
        $image4->save();
        }
        else{ $imagePath4 = "";}

        // IMAGE 5 //

        if(request('image5')){
        $imagePath5 = request('image5')->store('uploads', 'public');

        $image5 = Image::make(public_path("storage/{$imagePath5}"))->fit(1200, 1200);
        $image5->save();
        }
        else{ $imagePath5 = "";}

        // IMAGE 6 //

        if(request('image6')){
        $imagePath6 = request('image6')->store('uploads', 'public');

        $image6 = Image::make(public_path("storage/{$imagePath6}"))->fit(1200, 1200);
        $image6->save();
        }
        else{ $imagePath6 = "";}

        // IMAGE 7 //

        if(request('image7')){
        $imagePath7 = request('image7')->store('uploads', 'public');

        $image7 = Image::make(public_path("storage/{$imagePath7}"))->fit(1200, 1200);
        $image7->save();
        }
        else{ $imagePath7 = "";}
        // IMAGE 8 //

        if(request('image8')){
        $imagePath8= request('image8')->store('uploads', 'public');

        $image8= Image::make(public_path("storage/{$imagePath8}"))->fit(1200, 1200);
        $image8 ->save();
        }
        else{ $imagePath8 = "";}

        // IMAGE 9 //

        if(request('image9')){
        $imagePath9= request('image9')->store('uploads', 'public');

        $image9= Image::make(public_path("storage/{$imagePath9}"))->fit(1200, 1200);
        $image9->save();
        }
        else{ $imagePath9 = "";}
        
     
        Auth()->user()->posts()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'image0' => $imagePath0,
            'image1' => $imagePath1,
            'image2' => $imagePath2 ,
            'image3' => $imagePath3,
            'image4' => $imagePath4,
            'image5' => $imagePath5,
            'image6' => $imagePath6,
            'image7' => $imagePath7,
            'image8' => $imagePath8,
            'image9' => $imagePath9,
            'adlocation' => $data['adlocation'],
            'category' => $data['category'],
            'condition' => $data['condition'],
            'phone' => $data['phone'],
            'transferPref' => $data['transferPref'],
         
            'premium' => $prem
             
         
        ]);

        return Redirect('/p');
    }
    public function edit (Post $post)
    {
    
       
        if(Auth::id() == $post->user_id){
            return view('posts.edit', compact('post'));
        }
        else{
            return redirect('/');
        }
    }
    
    public function update(Post $post)
    {
   
     if(Auth::id() == $post->user_id){
        
         
         
         $data = request()->validate([
          'title' => ['required','max:60'] ,
          'description' =>['required ','max:300'],
          'adlocation' => ['required','max:60'] ,
          'category' => ['required','max:60'] ,
          'condition' => ['required','max:60'] ,
          'phone' => ['required','digits:10'],
          'transferPref'=> ['required','max:300'] 
         
         
        ]);
        
        Auth()->user()->posts()->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'adlocation' => $data['adlocation'],
            'category' => $data['category'],
            'condition' => $data['category'],
            'phone' => $data['phone'],
            'transferPref' => $data['transferPref'],
            
           
            
       
        ]);        
        
        return redirect("/p/{$post->id}");
        }
        else
        {
        return redirect('/');
        }
    }
    
    public function destroy($id)
    {
        $post = Post::find($id);
        
        $post->delete();
        
        return redirect()->route('myposts',['user' => User::find($post->user_id)]);
    }
    
    public function search(Request $request){
        // Get the search value from the request
        $search = request()->validate([
            'title' => 'nullable',
            'category' => 'required'
            
        ]);
       //dd(!($search['category'] == "Διάφορα"));
       if(!($search['category'] == "Διάφορα"))
       {
        // Search in the title and category columns from the posts table
        $posts = Post::query()
        ->where('title', 'LIKE', "{$search['title']}")
        ->orWhere('category', 'LIKE', "{$search['category']}")
        ->get();
       }
       else
       {
           $posts = Post::all();
       }
      
        
       
        // Return the search view with the resluts compacted
        return view('posts.search', compact('posts'));
    }
}