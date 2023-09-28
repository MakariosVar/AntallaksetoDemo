<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
    ];

    public function isReadByUser($userId) {
        // Use the 'message_user' pivot table to check if the message is associated with the user.
        return $this->belongsToMany(User::class, 'message_user')
            ->where('user_id', $userId)
            ->where('message_id', $this->id)
            ->exists();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'message_user');
    }
}
