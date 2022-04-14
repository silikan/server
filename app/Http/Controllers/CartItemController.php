<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\TaskItem;
use App\Models\Cart;

use Illuminate\Http\Request;
use App\Models\Gig;
use App\Models\Task;
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
               $cartItem->client_id = $request->client_id;
               $cartItem->handyman_id = $request->handyman_id;
               $cartItem->cart()->associate($cart);
                $cartItem->save();
                $cartItem->gigs()->attach($gig);
                $taskItems = TaskItem::find($request->task_item_id);
                $cartItem->taskItems()->attach($taskItems);
                //return the id of the task item
                return  $cartItem;
        }else if($type == "request"){


                $cartItem = new CartItem();
                $clientRequest =  ClientRequest::find($request->request_id);
                $cart =  Cart::find($request->cart_id);
                $cartItem->type =  $request->type;
                $cartItem->client_id = $request->client_id;
                $cartItem->handyman_id = $request->handyman_id;
                $cartItem->cart()->associate($cart);
                $cartItem->save();
                $cartItem->clientRequests()->attach($clientRequest);
                $taskItems = TaskItem::find($request->task_item_id);
                $cartItem->taskItems()->attach($taskItems);

                return  $cartItem;

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



    /* 'is_completed' => 'boolean',
    'is_pending' => 'boolean',
    'is_accepted' => 'boolean',
    'is_cancelled' => 'boolean',
    'is_in_progress' => 'boolean',
    'is_declined' => 'boolean',
    'is_paid' => 'boolean',
    'is_on_checkout' => 'boolean', */

    public function setCartItemsStatusToInProgress (Request $request)
    {
        $cartItem = CartItem::find($request->cart_item_id);
        $taskItemFromCart = $cartItem->taskItems;
        $taskItemFromCartId = $taskItemFromCart[0]->id;
        $taskItem = TaskItem::find($taskItemFromCartId);

        $cartItem->is_in_progress = true;
        $taskItem->is_in_progress = true;


        $cartItem->save();
        $taskItem->save();
        return $cartItem;
    }

    public function setCartItemsStatusToCancelled (Request $request)
    {
        $cartItem = CartItem::find($request->cart_item_id);
        $taskItemFromCart = $cartItem->taskItems;
        $taskItemFromCartId = $taskItemFromCart[0]->id;
        $taskItem = TaskItem::find($taskItemFromCartId);

        $cartItem->is_cancelled = true;
        $taskItem->is_cancelled = true;


        $cartItem->save();
        $taskItem->save();
        return $cartItem;
    }

    public function setCartItemsStatusToCompleted (Request $request)
    {
        $cartItem = CartItem::find($request->cart_item_id);
        $taskItemFromCart = $cartItem->taskItems;
        $taskItemFromCartId = $taskItemFromCart[0]->id;
        $taskItem = TaskItem::find($taskItemFromCartId);

        $cartItem->is_completed = true;
        $taskItem->is_completed = true;

        $cartItem->is_on_checkout = true;
        $taskItem->is_on_checkout = true;
        $cartItem->save();
        $taskItem->save();
        return $cartItem;
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
