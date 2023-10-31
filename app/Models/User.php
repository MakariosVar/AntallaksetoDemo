<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
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
        'verification_token' => 'string',
    ];


     /**
     * BOOT
     *
     * 
     */

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->verification_token = \Str::random(40); // Generate a random token
        });

        static::created(function ($user) {
            $user->auth_token = \Str::random(40); // Generate a random token
            $user->profile()->create([
                'title' => $user->username,
            ]);
        });

        static::deleting(function ($user) {
            // Delete all posts related to the user
            $user->posts->each(function ($post) {
                $post->delete();
            });
        });
    }

    public static function authenticateByToken($token)
    {
        $authTokenRecord = DB::table('auth_tokens')->where('token', $token)->first();

        if ($authTokenRecord && $authTokenRecord->expires_at > now()) {
            // The record exists, and the token is not expired
            // Now, retrieve the associated user
            $user = User::find($authTokenRecord->user_id);
    
            if ($user) {
                return $user;
            }
        }
    
        return null;
    }

    public function isAdmin()
    {
        return $this->role_id === 1;
    }

    public function isModerator()
    {
        return $this->role_id === 3;
    }

    public function canDeletePosts() {
        return ($this->isAdmin() || $this->isModerator());
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

    public function authToken()
    {
        return $this->hasOne(AuthToken::class);
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

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function getProfileImage()
    {
        // Check if the user has a profile
        if ($this->profile) {
            // Return the 'image' attribute from the related profile
            return $this->profile->image;
        }

        // Default value if no profile image is available
        return null;
    }

    public function hasVerifiedEmail()
    {
        return empty($this->verification_token) && !empty($this->email_verified_at);
    }

    public function verifyEmail() {
        $this->verification_token = null;
        $this->email_verified_at = now();
        if ($this->save()) {
            return true;
        }
        return false;
    }
}
