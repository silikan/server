<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Cart;

use Illuminate\Http\Request;
use App\Models\Gig;
use App\Models\ClientRequest;


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
               $cartItem->type =  $request->type;
               $cartItem->cart()->associate($cart);
                $cartItem->save();
                $gig->cartItem()->associate($cartItem);
                $gig->save();

                return response()->json([
                    'status'    =>  'success',
                    'message'   =>  'Gig added to cart!',
                    'cartItem'  =>  $cartItem
                ]);
        }else if($type == "request"){


                $cartItem = new CartItem();
               $clientRequest =  ClientRequest::find($request->request_id);
               $cart =  Cart::find($request->cart_id);
               $cartItem->type =  $request->type;
               $cartItem->cart()->associate($cart);
               $cartItem->save();
               $clientRequest->cartItem()->associate($cartItem);
                $clientRequest->save();

                return response()->json([
                    'status'    =>  'success',
                    'message'   =>  'Request added to cart!',
                    'cartItem'  =>  $cartItem
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //get cart item gig
        $CartItem = CartItem::find(3);

        return $CartItem->gigs;
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
