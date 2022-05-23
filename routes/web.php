<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfilesController;
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

Auth::routes();



        // HOMEPAGE //

Route::get('/', [HomeController::class, 'index']);

    // // PROFILE ROUTES // // 

Route::get('/profile/{user}', [ProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [ProfilesController::class, 'update'])->name('profile.update');

// // POST ROUTES // //

Route::get('/p', [PostsController::class, 'index'])->name('posts.index');
Route::get('/p/myposts/{user}', [PostsController::class, 'myposts'])->name('myposts');
Route::get('/p/create', [PostsController::class, 'create'])->middleware('auth');
Route::post('/p/store', [PostsController::class, 'store'])->name('post.store');
Route::get('/p/search', [PostsController::class, 'search'])->name('post.search');
Route::get('/p/{post}', [PostsController::class, 'show'])->name('post.show');
Route::get('/p/{post}/edit', [PostsController::class, 'edit'])->name('post.edit');
Route::patch('/p/{post}', [PostsController::class, 'update'])->name('post.update');
Route::delete('/p/{post}', [PostsController::class, 'destroy'])->name('post.destroy');

// // SEARCH ROUTE // // 
    Route::get('/find', function (){
        return view('find');
    });

// // USERS ROUTES // //

Route::get('/users', [UsersController::class, 'index']);

// // COMMENTS ROUTES // // 

Route::post('/c/store', [App\Http\Controllers\CommentsController::class, 'store'])->middleware('auth');
Route::delete('/c/{comment}', [App\Http\Controllers\CommentsController::class, 'destroy'])->name('comment.destroy');

// // FOLLOW ROUTES // //

Route::post('follow/{user}', [App\Http\Controllers\FollowsController::class, 'store']);


    // // INFO ROUTE // // 
Route::get('/info', function (){
    return view('info');
});

    // // CONTACT ROUTE // // 
Route::get('/contact', function (){
    return view('contact');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
