<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;
use App\Mail\ResetPasswordMail;
use Swift_TransportException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:40'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function vuecreate(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (!empty($user)) {
                return response()->json([
                    'status'   => 'error',
                    'message' => 'User Exist',
                ]); 
            }


            // Email was sent successfully
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
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
            $user->auth_token = $token;

            // Send the email
            $sent = Mail::to($user->email)->send(new VerificationEmail($user));
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return response()->json([
                    'status'   => 'success',
                    'user' => $user,
                ]); 
            }
        // Email sending failed
        } catch (Swift_TransportException $e) {
            // Email sending failed, handle the exception
            // You can log the error or perform other actions
            var_dump($e);die();
        }   
    }

    public function verificateUser(Request $request, $token)
    {
        // Get the authenticated user
        $user = User::where('verification_token', $token)->first();

        if (!empty($user)) {

            if ($user->hasVerifiedEmail()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Email is already verified.',
                ]);    
            }
            if ($user->verifyEmail()) {
                return response()->json([
                    'status' => 'success',
                    'user' => $user,
                    'message' => 'User Verified.',
                ]);
            }
            return response()->json([
                'status' => 'Not Found',
                'error' => 'User Can\'t be verified.'
            ]);
        } else {
            return response()->json([
                'status' => 'Not Found',
                'error' => 'User Not Found.'
            ]);
        }
    }

    public function setPassword ($token) 
    {
        $data = request()->all();
        $password = $data['password'];

        $user = User::where('reset_password_token', $token)->first();


        if (!empty($user)) {
            $user->password = Hash::make($password);
            $user->reset_password_token = null;
            if ($user->save()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Password updated',
                ]);     
            }
            return response()->json([
                'status' => 'error',
                'message' => 'User not saved',
            ]);  
        } else {
            return response()->json([
                'status' => 'Not Found',
                'error' => 'User Not Found.'
            ]);
        }
    }

    public function resetPassword () {
        $data = request()->all();
        $email = $data['email'];

        $user = User::where('email', $email)->first();

        if (!empty($user)) {
            $user->reset_password_token = \Str::random(40);
            if ($user->save()) {
                // Send the email
                $sent = Mail::to($user->email)->send(new ResetPasswordMail($user));                
                return response()->json([
                    'status' => 'success',
                    'message' => 'Email send',
                ]);     
            }
            return response()->json([
                'status' => 'error',
                'message' => 'Email not send',
            ]);     
        } else {
            return response()->json([
                'status' => 'Not Found',
                'error' => 'User Not Found.'
            ]);
        }
    }
}
