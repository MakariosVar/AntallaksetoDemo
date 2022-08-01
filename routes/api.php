<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VueApi;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfilesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/vuelogin', [LoginController::class, 'vuelogin']);
Route::post('/vuelogout', [LogoutController::class, 'logout']);
Route::post('/vueregister', [RegisterController::class, 'vuecreate']);


                        /* FUNCTIONAL ROUTES */
                                /*     */

                       
                        /* route for ADD post */  
Route::post('/p/store', [PostsController::class, 'store']);

                        /* route for UPDATE post */  
Route::patch('/p/{post}', [PostsController::class, 'update']);
                       
                        /* route for UPDATE IMAGES OF post */  
Route::post('/p/{post}', [PostsController::class, 'updateImage']);

                        /* route for VERIFICATION*/  
Route::post('/verificatepost/{id}', [PostsController::class, 'verificate']);
                        
                        /* route for RE-EDIT FOR VERIFICATION*/  
Route::post('/toreedit/{id}', [PostsController::class, 'reeditpost']);

                        /* route for FAILED VERIFICATION*/  
Route::post('/deletepost/{id}', [PostsController::class, 'destroy']);


                        /* route for DELETE POST */  
Route::delete('/p/{id}', [PostsController::class, 'destroy']);
                        
                        /* route for FOLLOW USER  */
Route::post('follow/{user}', [FollowsController::class, 'store']);

                        /* route for SET COMMENT */
Route::post('/c/store', [CommentsController::class, 'commentStore']); 

                        /* route for SET COMMENT */
Route::post('/deletecomment/{comment}', [CommentsController::class, 'destroy']); 


                        /* route for UPDATE PROFILE  */
Route::post('/profile/{user}', [ProfilesController::class, 'update']);
                        
                        /* route for SEND MESSAGES  */
Route::post('/sendMessage', [MessageController::class, 'store']);


                        /* route for DELETE MESSAGES  */
Route::post('/deleteMessage/{id}', [MessageController::class, 'destroy']);



                        /* route for SHOW MESSAGES  */
Route::get('/getmessages', [MessageController::class, 'index']);


                                /*    */
                        



                                //     
                        // THIS ENDPOINTS RETURNS:


                                                                        
Route::get('/vue/users', [VueApi::class, 'users']);                     // ALL USERS DATA
                                                                        // '/api/users' 
                                                                        

Route::get('/vue/getuser/{id}', [VueApi::class, 'getuser']);            // ONE user's data with ID request 
                                                                        // '/api/vue/getuser/ID' 
                                                                        

Route::get('/vue/username/{id}', [VueApi::class, 'username']);          // ONLY USERNAME with ID request
                                                                        // '/api/vue/username/ID' 
                                                                        

Route::get('/vue/profile/{id}', [VueApi::class, 'profile']);           // Profile data with ID request
                                                                        // '/api/vue/profile/ID' 
                                                                        

Route::get('/vue/getcomments/{id}', [VueApi::class, 'getcomments']);    // comments from profile
                                                                        // '/api/vue/getcomments/ID' 


Route::get('/vue/posts', [VueApi::class, 'posts']);                     // ALL VERIFICATED POSTS DATA
                                                                        // '/api/vue/posts' 

Route::get('/vue/toverificate', [VueApi::class, 'toVerificate']);       // ALL POSTS TO VERIFICATE
                                                                        // '/api/vue/posts'                                                                        


Route::get('/vue/post/{id}', [VueApi::class, 'getPost']);               // ONE post DATA with ID request
                                                                        // '/api/vue/post/ID' 
                                                                        

Route::get('/vue/myposts/{id}', [VueApi::class, 'getMyPost']);           // USERS POSTS with ID request
                                                                        // '/api/vue/myposts/ID' 


Route::get('/vue/premiumPosts', [VueApi::class, 'premiumPosts']);       // ALL PREMIUM POSTS
                                                                        // '/api/vue/premiumPosts' 


Route::get('/vue/categories', [VueApi::class, 'categories']);           // ALL CATEGORIES
                                                                        // '/api/vue/categories' 

