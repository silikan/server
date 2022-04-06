<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\Gig;

class CartItemController extends Controller
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
        $type = $request->type;
        if($type == "gig"){

                $cartItem = new CartItem();
               $gig =  Gig::find($request->gig_id);
               $cart =  Cart::find($request->cart_id);

                $cartItem->save();
                $cartItem->cart()->associate($cart);
                $gig->user()->cartItem($cartItem);

        }else if($type == "request"){


                $cartItem = new CartItem();
               $clientRequest =  ClientRequest::find($request->request_id);
               $cart =  Cart::find($request->cart_id);

                $cartItem->save();
                $cartItem->cart()->associate($cart);
                $clientRequest->user()->cartItem($cartItem);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function show(CartItem $cartItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function edit(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CartItem $cartItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(CartItem $cartItem)
    {
        //
    }
}
