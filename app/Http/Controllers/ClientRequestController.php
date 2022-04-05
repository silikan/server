<?php

namespace App\Http\Controllers;

use App\Models\ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class ClientRequestController extends Controller
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
               //create a request
               $request = new ClientRequest();
               $request->title = $request->title;
               $request->description = $request->description;
               $request->price = $request->price;
               $request->currency = $request->currency;
               $request->paymentMethod = $request->payment_method;
               $request->save();
               $user =  Auth::user();
               $request->user()->assosiate($user);
               //associate to a category
       /*         $request->categories()->attach($request->category);
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientRequest  $clientRequest
     * @return \Illuminate\Http\Response
     */
    public function show(ClientRequest $clientRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientRequest  $clientRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientRequest $clientRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientRequest  $clientRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientRequest $clientRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientRequest  $clientRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientRequest $clientRequest)
    {
        //
    }
}
