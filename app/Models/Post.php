<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends \TCG\Voyager\Models\Post
{
   protected $guarded = [];

    public function user()
    {   
       return $this->belongsTo(User::class,'user_id','id');
    }    

    public function location()
    {
        return $this->hasOne(Location::class);
    }
}
