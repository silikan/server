<?php

namespace App\Http\Controllers;

use App\Models\GigImages;
use App\Models\Gig;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

/*         $gigId = $request->gigId;
 */
        if($files=$request->file('GigImages')){
            foreach($files as $file){



                  // processing the uploaded image

          $image_name =    time() . $file->getClientOriginalName() ;
          $image = $file;
          $img = Image::make($image->path());


          $img->resize(250, 250, function ($constraint) {
            $constraint->aspectRatio();
          });
          $path = 'storage/gig-image/' . $image_name;


          $img->save($path);



          //find a gid with the gidid
         /*  $gig = Gig::find($gigId);
          $gig->images()->associate( $img); */



            }





          // Update user's avatar column on 'users' table
    /*       $profile =  Auth::user();
          $profile->avatar = $avatar_path; */



        }


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
