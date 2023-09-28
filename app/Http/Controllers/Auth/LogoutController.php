<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;

class LogoutController extends Controller
{
    public function logout(Request $request) {
        Auth::logout();
            
        return response()->json([
            'status' => "success",
            'message' => 'Successfully logged out'
        ]);
    }
}