<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


     /**
     * BOOT
     *
     * 
     */

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->profile()->create([
                'title' => $user->username,
            ]);
        });
    }



        /**
     * Post connection
     *
     * 
     */

    public function posts()
    {
        return $this->hasMany(Post::class);
    }



     /**
     * Following
     *
     * 
     */

    public function following()
    {
        return $this->belongsToMany(Profile::class);
    }


     /**
     * Profile connection
     *
     * 
     */

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

        /**
     * comments connection
     *
     * 
     */

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
