<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();;
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
          
        $data = request()->validate([
            'title' => ['required'] ,
          
           
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
          ] 
        );
        
        Auth()->user()->posts()->update([
            'title' => $data['title'],
         
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
        $category = Category::find($id);
        
        $category->delete();
        
        return redirect('/');
    }
    
}
