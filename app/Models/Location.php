<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['locality', 'country', 'latitude', 'longitude'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
