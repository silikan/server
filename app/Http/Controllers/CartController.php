<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CartController extends Controller
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
    public function create(Request $request)
    {

        $user_id =  $request->user_id;
        //create a cart and if cart exist return cart
        $cart = Cart::where('user_id',  $user_id)->first();
        if($cart){
            return $cart;
        }else{
            $cart = new Cart();
            $user =  User::find($user_id);
            $cart->user()->associate($user);
            $cart->save();
            return $cart;
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

public function getUserCartItems($id){
    $user =  User::find($id);
    $cart = $user->cart;
    $cart_items = $cart->cartItems;

    $gigsData = array();
    foreach ($cart_items as $item) {
       $gig = $item->gigs;
       $handyman_id = $item->handyman_id;
         $cart_id = $item->cart_id;
         $client_id = $item->client_id;
         $handyman = User::find($handyman_id);
         $client = User::find($client_id);
         $cart = Cart::find($cart_id);
          array_push($gigsData,array(
            'item' => array(
                'cart' => $cart,
               'gig' => $gig,
                'handyman' => $handyman,
                'client' => $client,
                'cart_item' => $item

            ), )
          );

    }

    return $gigsData;
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
