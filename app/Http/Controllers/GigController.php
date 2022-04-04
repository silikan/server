<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class GigController extends Controller
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

        //create a gig
        $gig = new Gig();
        $gig->title = $request->title;
        $gig->description = $request->description;
        $basic = json_encode($request->basic);
        $standard = json_encode($request->standard);
        $premium = json_encode($request->premium);
        $paymentMethod = json_encode($request->paymentMethod);
        $gig->basic = $basic;
        $gig->standard = $standard;
        $gig->premium = $premium;
        $gig->paymentMethod = $paymentMethod;
        $gig->save();

        $user =  Auth::user();
        $gig->user()->associate($user);
/*         $gig->categories()->attach($request->category);
 */

return $gig;
      }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gig  $gig
     * @return \Illuminate\Http\Response
     */
    public function show(Gig $gig)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gig  $gig
     * @return \Illuminate\Http\Response
     */
    public function edit(Gig $gig)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gig  $gig
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gig $gig)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gig  $gig
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gig $gig)
    {
        //
    }
}
