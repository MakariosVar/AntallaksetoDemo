<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    
        public function index()
        {
            $messages = Message::all();
            foreach($messages as $message){
                $message->date = date( "d-m-Y H:i:s", strtotime($message->created_at) );
                $message->update_at = date( "d-m-Y H:i:s", strtotime($message->updated_at) );
                }
            return $messages->sortByDesc("id")->values();
        }

        public function store()
        {
            
            $data = request()->validate([
                'name' => ['required'] ,
                'email' => ['required'] ,
                'subject' => ['required'] ,  
                'message' => ['required'] , 
            ]);
            Message::create([
                'name' => $data['name'],
                'email' => $data['email'] ,
                'subject' => $data['subject'] ,  
                'message' => $data['message'] , 
            ]);
            
    
            return response()->json([
                'status'   => 'success'
              ]); 
      
    
       
        }
   
        
   
        public function destroy($id)
        {
            $message = Message::find($id);
            
            $message->delete();
            
            return response()->json([
                'status'   => 'success'
              ]); 
        }
        
    
}
