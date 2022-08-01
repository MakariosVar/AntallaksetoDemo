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
        $posts = Post::all()->sortByDesc("id")->values();
       
        return view('posts.index', compact('posts'));
    }

  
   
  

    public function store(Request $request)
    {
        if (request('premium') != null ) {$prem=true;}
        else {$prem=false;}
     
        $data = request()->validate([
            'title' => ['required', 'max:60'] ,
            'description' =>['required ','max:300'],
            'image0' => ['image', 'required','max:2048'],
            'image1' => ['image', 'nullable','max:2048'],
            'image2' => ['image', 'nullable','max:2048'],
            'image3' => ['image', 'nullable','max:2048'],
            'image4' => ['image', 'nullable','max:2048'],
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

       
        
     
        Auth()->user()->posts()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'image0' => $imagePath0,
            'image1' => $imagePath1,
            'image2' => $imagePath2 ,
            'image3' => $imagePath3,
            'image4' => $imagePath4,
            'adlocation' => $data['adlocation'],
            'category' => $data['category'],
            'condition' => $data['condition'],
            'phone' => $data['phone'],
            'transferPref' => $data['transferPref'],
            'verified' => false,
            'reEdit' => false,
            'premium' => $prem
             
         
        ]);

        return response()->json([
            'status'   => 'success'
          ]); 
    }
   
    
    public function update(Post $post)
        {
     
        
        if(Auth::id() == $post->user_id){
        
        
         
         $data = request()->validate([
          'title' => ['required','max:60'] ,
          'description' =>['required','max:300'],
          'adlocation' => ['required','max:60'] ,
          'category' => ['required','max:60'] ,
          'condition' => ['required','max:60'] ,
          'phone' => ['required','digits:10'],
          'transferPref'=> ['required','max:300'] 
          
         
        ]);
        $post->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'adlocation' => $data['adlocation'],
            'category' => $data['category'],
            'condition' => $data['condition'],
            'phone' => $data['phone'],
            'transferPref' => $data['transferPref'],
            'verified' => 0,
            'reEdit' => 0
        ]);        
      
         
        return response()->json([
            'status'   => 'success'
          ]); 
    }
    else
        {
        return Redirect('/');
        }
    }
    
    public function updateImage(Post $post)
        {
     
        
        if(Auth::id() == $post->user_id){
        
        
        $data = request()->validate([
          'image0' => ['image', 'nullable','max:2048'] ,
          'image1' => ['image', 'nullable','max:2048'] ,
          'image2' => ['image', 'nullable','max:2048'] ,
          'image3' => ['image', 'nullable','max:2048'] ,
          'image4' => ['image', 'nullable','max:2048'] 
        ]);
       
        // IMAGE 0 - //
        if (request('image0')){
            
            $imagePath0 = request('image0')->store('uploads', 'public');
            
            $image0 = Image::make(public_path("storage/{$imagePath0}"))->fit(1200, 1200);
            $image0->save();
        }
        else{ $imagePath0 = $post->image0; }
        
            
    
            // IMAGE 1 //
    
            if(request('image1')){
            $imagePath1 = request('image1')->store('uploads', 'public');
    
            $image1 = Image::make(public_path("storage/{$imagePath1}"))->fit(1200, 1200);
            $image1->save();
            }
            else{ $imagePath1 = $post->image1;}
     
            // IMAGE 2 //
    
            if(request('image2')){
            $imagePath2 = request('image2')->store('uploads', 'public');
    
            $image2 = Image::make(public_path("storage/{$imagePath2}"))->fit(1200, 1200);
            $image2->save();
            }
            else{ $imagePath2 = $post->image2;}
    
    
            // IMAGE 3 //
    
            if(request('image3')){
            $imagePath3 = request('image3')->store('uploads', 'public');
    
            $image3 = Image::make(public_path("storage/{$imagePath3}"))->fit(1200, 1200);
            $image3->save();   
            }
            else{ $imagePath3 = $post->image3;}
     
            // IMAGE 4 //
    
    
            if(request('image4')){
            $imagePath4 = request('image4')->store('uploads', 'public');
    
            $image4 = Image::make(public_path("storage/{$imagePath4}"))->fit(1200, 1200);
            $image4->save();
            }
            else{ $imagePath4 =$post->image4;}

    
        $post->update(['image0' => $imagePath0,
                        'image1' => $imagePath1,
                        'image2' => $imagePath2 ,
                        'image3' => $imagePath3,
                        'image4' => $imagePath4,
                        'verified' => 0,
                        'reEdit' => 0]);
       
        
                        return response()->json([
                            'status'   => 'success'
                          ]);
    }
    else
        {
        return 'failed';
        }
    }


    public function destroy($id)
    {
        $post = Post::find($id);
        
        $post->delete();
        
        return response()->json([
            'status'   => 'success'
          ]);
    }
    
    public function verificate($id)
    {
        if(auth()->user()->role_id != 2){
        
        $post = Post::find($id);
         

           $post->update( ['verified' => true] );        
         
            
           return response()->json([
            'status'   => 'success'
          ]); 
       }
       else
           {
           return "failed";
           }
       
    }
    public function reeditpost($id)
    {
        if(auth()->user()->role_id != 2){
        
            $post = Post::find($id);
         

           $post->update( ['reEdit' => true] );        
         
            
           return response()->json([
            'status'   => 'success'
          ]); 
       }
       else
           {
           return "failed";
           }
       
    }
}