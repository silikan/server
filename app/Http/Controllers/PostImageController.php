<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use Image;

class PostImage extends Controller
{
    public function upload_post_image (Request $request) {
        if ($request->file('post_image')) {
            // check if user has an existing avatar

            // processing the uploaded image

            $avatar_name =    time() . '.' . $request->file('post_image')->getClientOriginalExtension();
            $image = $request->file('post_image');
            $img = Image::make($image->path());


            $img->resize(250, 250, function ($constraint) {
              $constraint->aspectRatio();
            });

            $img->save('storage/post-images/' . $avatar_name);
            $avatar_path =  $path = $img->basePath();
            error_log($avatar_path);

            // Update user's avatar column on 'users' table
            $post =  Post::find($request->post_id);
            $post->image = $avatar_path;

            if ($post->save()) {
              return response()->json([
                'status'    =>  'success',
                'message'   =>  'post Photo Updated!',
                'avatar_url' =>  url('storage/post-images/' . $avatar_path)
              ]);
            } else {
              return response()->json([
                'status'    => 'failure',
                'message'   => 'failed to update profile photo!',
                'avatar_url' => NULL
              ]);
            }
          }

          return response()->json([
            'status'    => 'failure',
            'message'   => 'No image file uploaded!',
            'avatar_url' => NULL
          ]);
        }
    }
}
