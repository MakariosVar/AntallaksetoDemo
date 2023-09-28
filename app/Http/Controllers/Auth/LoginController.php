<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function vuelogin(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
          $user= Auth::user();

          // Generate a unique token and store it in the database
          $token = Str::random(60);
          $expiresAt = Carbon::now()->addHours(2); // Token expiration time, e.g., 2 hours from now
          // Store the token and expiration timestamp in the database
          DB::table('auth_tokens')->updateOrInsert(
            ['user_id' => $user->id],
            [
                'token' => $token,
                'expires_at' => $expiresAt,
            ]
          );
          $user->profile_image = $user->getProfileImage();
          $user->auth_token = $token;
          return response()->json([
            'status'   => 'success',
            'user' => $user,
          ]); 
        } else { 
          return response()->json([
            'status' => 'error',
            'user'   => 'Unauthorized Access'
          ]); 
        } 
    }
   
}
