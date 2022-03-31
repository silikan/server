<?php

namespace App\Http\Controllers;

use App\Models\GigImages;
use Illuminate\Http\Request;

class GigImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $input=$request->all();
        $images=array();
        if($files=$request->file('gigimages')){
            foreach($files as $file){



                  // processing the uploaded image

          $image_name =    time() . '.' . $file->getClientOriginalExtension();
          $image = $file;
          $img = Image::make($image->path());


          $img->resize(250, 250, function ($constraint) {
            $constraint->aspectRatio();
          });


          $img->save('storage/gig-image/' . $image_name);





            }





          // Update user's avatar column on 'users' table
    /*       $profile =  Auth::user();
          $profile->avatar = $avatar_path; */



        }

        return response()->json([
          'status'    => 'failure',
          'message'   => 'No image file uploaded!',

        ]);
      }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GigImages  $gigImages
     * @return \Illuminate\Http\Response
     */
    public function show(GigImages $gigImages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GigImages  $gigImages
     * @return \Illuminate\Http\Response
     */
    public function edit(GigImages $gigImages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GigImages  $gigImages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GigImages $gigImages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GigImages  $gigImages
     * @return \Illuminate\Http\Response
     */
    public function destroy(GigImages $gigImages)
    {
        //
    }
}
