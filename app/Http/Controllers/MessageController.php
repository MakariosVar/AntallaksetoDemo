<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    
        public function index($token)
        {
            $user = User::authenticateByToken($token);
            if ($user){
                if($user->isAdmin()) {
                    $messages = Message::all()->sortByDesc("id");
                    $readMessages = [];
                    $unreadMessages = [];
                    foreach($messages as $message){
                        $message->date = date( "d-m-Y H:i:s", strtotime($message->created_at) );
                        $message->update_at = date( "d-m-Y H:i:s", strtotime($message->updated_at) );
                        if (!$message->isReadByUser($user->id)) {
                            $message->isNotRead = true;
                            $unreadMessages[] = $message;
                        } else {
                            $readMessages[] = $message;
                        }
                    }

                    return response()->json([
                        'status' => 'success',
                        'readMessages' => $readMessages,
                        'unreadMessages' => $unreadMessages,
                    ]);
                }
                return response()->json([
                    'status' => 'error',
                    'unauthorized' => true,
                    'message' => 'Unauthorized user',
                ]);
            }
            return response()->json([
                'status' => 'error',
                'expired' => true,
                'message' => 'Session Expired',
            ], 200);
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
   
        public function readMessage($id, $token)
        {
            $user = User::authenticateByToken($token);
            if ($user){
                $message = Message::find($id);

                if ($message) {
                    // Attach the user to the message in the pivot table if not already attached.
                    $message->users()->syncWithoutDetaching($user->id);
                    return response()->json([
                        'status' => 'success',
                    ]);
                }
                return response()->json([
                    'status' => 'error',
                    'message' => 'Message not Found',
                ], 200);
                    
            }
            return response()->json([
                'status' => 'error',
                'expired' => true,
                'message' => 'Session Expired',
            ], 200);
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
