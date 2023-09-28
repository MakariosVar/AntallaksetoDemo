<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthToken extends Model
{
    protected $table = 'auth_tokens'; // Specify the table name

    protected $fillable = [
        'user_id',
        'token',
        'expires_at',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}