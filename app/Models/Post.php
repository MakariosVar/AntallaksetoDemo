<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
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
