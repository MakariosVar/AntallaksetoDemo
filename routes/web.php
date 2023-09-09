<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/create-admin', function () {
    $adminExists = User::where('email', 'admin@admin')->exists();

    if (!$adminExists) {
        $admin = new User();
        $admin->name = 'Administrator';
        $admin->email = 'admin@admin';
        $admin->role_id = 1;
        $admin->password = bcrypt('123123');
        $admin->save();


        dd('Admin Created');
    } else {
        dd('Admin Already Exists');
    }
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/', function (){
    return redirect('/home');
});

Route::get('/home', function (){
    return view('app');
});
Route::get('{any}', function () {
    return view('app');
})->where('any','.*');




        

