<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Location;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\ValidationException;
use Auth;

class PostsController extends Controller
{

    public function index()
    {
        $posts = Post::all()->sortByDesc("id")->values();

        return view('posts.index', compact('posts'));
    }
    public function store(Request $request, $token)
    {
        $user = User::authenticateByToken($token);

        if (empty($user)) {
            return response()->json([
                'status' => 'error',
                'expired' => true,
                'message' => 'Session Expired',
            ], 200);
        } else {
            $prem = false;

            try {
                $data = $request->validate([
                    'title' => ['required', 'max:60'],
                    'description' => ['required', 'max:300'],
                    'location_id' => ['required', 'exists:locations,id'],
                    'category' => 'required',
                    'condition' => 'required',
                    'phone' => ['nullable'],
                    'transferPref' => ['required', 'max:300'],
                    'premium' => 'nullable',
                    'image0' => ['required', 'image', 'max:2048'],
                    'image1' => 'nullable|image|max:2048',
                    'image2' => 'nullable|image|max:2048',
                    'image3' => 'nullable|image|max:2048',
                    'image4' => 'nullable|image|max:2048',
                ]);



                // IMAGE 0 - REQUIRED //
                if ($request->has('image0')) {
                    $imagePath0 = $this->uploadImage($request->file('image0'));
                } else {
                    $imagePath0 = "";
                }

                // IMAGE 1 //
                $imagePath1 = $this->uploadOptionalImage($request, 'image1', null);

                // IMAGE 2 //
                $imagePath2 = $this->uploadOptionalImage($request, 'image2', null);

                // IMAGE 3 //
                $imagePath3 = $this->uploadOptionalImage($request, 'image3', null);

                // IMAGE 4 //
                $imagePath4 = $this->uploadOptionalImage($request, 'image4', null);

                $post = $user->posts()->create([
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'image0' => $imagePath0,
                    'image1' => $imagePath1,
                    'image2' => $imagePath2,
                    'image3' => $imagePath3,
                    'image4' => $imagePath4,
                    'location_id' => $data['location_id'],
                    'category' => $data['category'],
                    'condition' => $data['condition'],
                    'phone' => $data['phone'],
                    'transferPref' => $data['transferPref'],
                    'verified' => false,
                    'reEdit' => false,
                    'premium' => $prem,
                ]);
                if (!empty($post)) {
                    return response()->json([
                        'status' => 'success',
                    ]);
                }
                return response()->json([
                    'status' => 'error',
                ]);

            } catch (ValidationException $e) {
                // Validation failed
                return response()->json([
                    'status' => 'error',
                    'errors' => $e->errors(),
                ]);
            }
        }
    }

    private function uploadImage($file)
    {
        $imagePath = $file->store('uploads', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"));
        $image->save();
        return $imagePath;
    }

    private function uploadOptionalImage($request, $fieldName, $savedPath)
    {
        if ($request->has($fieldName)) {
            $imagePath = $this->uploadImage($request->file($fieldName));
        } else if (!empty($savedPath)) {
            $imagePath = $savedPath;
        } else {
            $imagePath = "";
        }
        return $imagePath;
    }



    public function update(Request $request, Post $post, $token)
    {
        $user = User::authenticateByToken($token);

        if (empty($user)) {
            return response()->json([
                'status' => 'error',
                'expired' => true,
                'message' => 'Session Expired',
            ], 200);
        }

        if ($user->id != $post->user_id) {
            return response()->json([
                'status' => 'error',
                'unauthorized' => true,
                'message' => 'Unauthorized user',
            ]);
        }

        try {
            $validator = Validator::make($request->all(), [
                'title' => ['required', 'max:60'],
                'description' => ['required', 'max:300'],
                'category' => ['required', 'max:60'],
                'condition' => ['required', 'max:60'],
                'phone' => ['nullable'],
                'transferPref' => ['required', 'max:300'],
                'image0' => 'nullable|image|max:2048',
                'image1' => 'nullable|image|max:2048',
                'image2' => 'nullable|image|max:2048',
                'image3' => 'nullable|image|max:2048',
                'image4' => 'nullable|image|max:2048',
                'location_id' => ['required', 'exists:locations,id'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors(),
                ]);
            }

            // IMAGE 0 //
            $imagePath0 = $this->uploadOptionalImage($request, 'image0', $post->image0);
            // IMAGE 1 //
            $imagePath1 = $this->uploadOptionalImage($request, 'image1', $post->image1);
            // IMAGE 2 //
            $imagePath2 = $this->uploadOptionalImage($request, 'image2', $post->image2);
            // IMAGE 3 //
            $imagePath3 = $this->uploadOptionalImage($request, 'image3', $post->image3);
            // IMAGE 4 //
            $imagePath4 = $this->uploadOptionalImage($request, 'image4', $post->image4);

            $post->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'category' => $request->input('category'),
                'location_id' => $request->input('location_id'),
                'image0' => $imagePath0,
                'image1' => $imagePath1,
                'image2' => $imagePath2,
                'image3' => $imagePath3,
                'image4' => $imagePath4,
                'condition' => $request->input('condition'),
                'phone' => $request->input('phone'),
                'transferPref' => $request->input('transferPref'),
                'verified' => 0,
                'reEdit' => 0
            ]);

            return response()->json([
                'status' => 'success'
            ]);
        } catch (ValidationException $th) {
            return response()->json([
                'status' => 'error',
                'errors' => $th->validator->errors(),
            ]);
        }
    }

    public function updateImage(Post $post)
    {


        if (Auth::id() == $post->user_id) {


            $data = request()->validate([
                'image0' => ['image', 'nullable', 'max:2048'],
                'image1' => ['image', 'nullable', 'max:2048'],
                'image2' => ['image', 'nullable', 'max:2048'],
                'image3' => ['image', 'nullable', 'max:2048'],
                'image4' => ['image', 'nullable', 'max:2048']
            ]);

            // IMAGE 0 - //
            if (request('image0')) {

                $imagePath0 = request('image0')->store('uploads', 'public');

                $image0 = Image::make(public_path("storage/{$imagePath0}"))->fit(1200, 1200);
                $image0->save();
            } else {
                $imagePath0 = $post->image0;
            }



            // IMAGE 1 //

            if (request('image1')) {
                $imagePath1 = request('image1')->store('uploads', 'public');

                $image1 = Image::make(public_path("storage/{$imagePath1}"))->fit(1200, 1200);
                $image1->save();
            } else {
                $imagePath1 = $post->image1;
            }

            // IMAGE 2 //

            if (request('image2')) {
                $imagePath2 = request('image2')->store('uploads', 'public');

                $image2 = Image::make(public_path("storage/{$imagePath2}"))->fit(1200, 1200);
                $image2->save();
            } else {
                $imagePath2 = $post->image2;
            }


            // IMAGE 3 //

            if (request('image3')) {
                $imagePath3 = request('image3')->store('uploads', 'public');

                $image3 = Image::make(public_path("storage/{$imagePath3}"))->fit(1200, 1200);
                $image3->save();
            } else {
                $imagePath3 = $post->image3;
            }

            // IMAGE 4 //


            if (request('image4')) {
                $imagePath4 = request('image4')->store('uploads', 'public');

                $image4 = Image::make(public_path("storage/{$imagePath4}"))->fit(1200, 1200);
                $image4->save();
            } else {
                $imagePath4 = $post->image4;
            }


            $post->update([
                'image0' => $imagePath0,
                'image1' => $imagePath1,
                'image2' => $imagePath2,
                'image3' => $imagePath3,
                'image4' => $imagePath4,
                'verified' => 0,
                'reEdit' => 0
            ]);


            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return 'failed';
        }
    }

    public function markAsDone($id, $token) {
        $user = User::authenticateByToken($token);
        $post = Post::find($id);

        if ($user && $post) {
            if ($user->id == $post->user_id) {
                $post->done = true;
                if ($post->save()) {
                    return response()->json([
                        'status' => 'success'
                    ]);
                }
                return response()->json([
                    'status' => 'error',
                    'message' => 'Post not Updated.'
                ]);
            }
            return response()->json([
                'status' => 'error',
                'unauthorized' => true,
                'message' => 'Unauthorized user',
            ]);
        }
        if (empty($user)) {
            return response()->json([
                'status' => 'error',
                'expired' => true,
                'message' => 'Session Expired',
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'post_not_found' => true,
            'message' => 'Post not found',
        ], 404);
    }

    public function destroy($id, $token)
    {
        $user = User::authenticateByToken($token);
        $post = Post::find($id);

        if ($user && $post) {
            if (($user->id == $post->user_id) || $user->canDeletePosts()) {
                $post->delete();

                return response()->json([
                    'status' => 'success'
                ]);
            }
            return response()->json([
                'status' => 'error',
                'unauthorized' => true,
                'message' => 'Unauthorized user',
            ]);
        }
        if (empty($user)) {
            return response()->json([
                'status' => 'error',
                'expired' => true,
                'message' => 'Session Expired',
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'post_not_found' => true,
            'message' => 'Post not found',
        ], 404);
    }

    public function verificate($id)
    {
        $token = request('auth_token');
        $user = User::authenticateByToken($token);

        if ($user) {
            if ($user->role_id != 2) {
                $post = Post::find($id);
                $post->update([
                    'verified' => true,
                    'reEdit' => false
                ]);

                return response()->json([
                    'status' => 'success'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'unauthorized' => true,
                    'message' => 'Unauthorized user',
                ]);
            }
        }
        return response()->json([
            'status' => 'error',
            'expired' => true,
            'message' => 'Session Expired',
        ], 200);

    }
    public function reeditpost($id)
    {
        $token = request('auth_token');
        $user = User::authenticateByToken($token);

        if ($user) {
            if ($user->role_id != 2) {

                $post = Post::find($id);


                $post->update([
                    'reEdit' => true,
                    'verified' => false
                ]);


                return response()->json([
                    'status' => 'success'
                ]);
            }
            return response()->json([
                'status' => 'error',
                'unauthorized' => true,
                'message' => 'Unauthorized user',
            ]);
        } return response()->json([
            'status' => 'error',
            'expired' => true,
            'message' => 'Session Expired',
        ], 200);

    }
}