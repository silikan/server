<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AvatarController extends Controller
{
    public function upload_user_photo(Request $request){
        // check if image has been received from form
        if($request->file('avatar')){
          // check if user has an existing avatar
          $user =  Auth::user();

          if($user->avatar != NULL){
            // delete existing image file
            Storage::disk('user_avatars')->delete($user->user()->avatar);
          }
          // processing the uploaded image
          $random = Str::random(20);
          $avatar_name =    $random.'.'.$request->file('avatar')->getClientOriginalExtension();
          $avatar_path = $request->file('avatar')->storeAs('',$avatar_name, 'user_avatars');


          // Update user's avatar column on 'users' table
          $profile =  Auth::user();
          $profile->avatar = $avatar_path;

          if($profile->save()){
            return response()->json([
              'status'    =>  'success',
              'message'   =>  'Profile Photo Updated!',
              'avatar_url'=>  url('storage/user-avatar/'.$avatar_path)
            ]);
          }else{
            return response()->json([
              'status'    => 'failure',
              'message'   => 'failed to update profile photo!',
              'avatar_url'=> NULL
            ]);
          }

        }

        return response()->json([
          'status'    => 'failure',
          'message'   => 'No image file uploaded!',
          'avatar_url'=> NULL
        ]);
      }
}
