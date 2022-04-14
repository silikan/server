<?php

namespace App\Http\Controllers;

use App\Models\TaskItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\Gig;
use App\Models\ClientRequest;
use App\Models\Task;

class TaskItemController extends Controller
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

                $taskItem = new TaskItem();
                $gig =  Gig::find($request->gig_id);
                $task =  Task::find($request->task_id);
                $taskItem->type =  $request->type;
                $taskItem->client_id = $request->client_id;
                $taskItem->handyman_id = $request->handyman_id;
                $taskItem->task()->associate($task);
                $taskItem->save();
                $taskItem->gigs()->attach($gig);
                $cartItems = CartItem::find($request->cart_item_id);
                $taskItem->cartItems()->attach($cartItems);

                //return the id of the task item
                return  $cartItems;

        }else if($type == "request"){

                $taskItem = new TaskItem();
                $clientRequest =  ClientRequest::find($request->request_id);
                $task =  Task::find($request->task_id);
                $taskItem->type =  $request->type;
                $taskItem->client_id = $request->client_id;
                $taskItem->handyman_id = $request->handyman_id;
                $taskItem->task()->associate($task);

                $taskItem->save();

                $taskItem->clientRequests()->attach($clientRequest);

                $cartItems = CartItem::find($request->cart_item_id);
                $taskItem->cartItems()->attach($cartItems);



                //return the id of the task item
                return  $taskItem;
        }
    }



    /* 'is_completed' => 'boolean',
    'is_pending' => 'boolean',
    'is_accepted' => 'boolean',
    'is_cancelled' => 'boolean',
    'is_in_progress' => 'boolean',
    'is_declined' => 'boolean',
    'is_paid' => 'boolean',
    'is_on_checkout' => 'boolean', */

    public function setTaskItemsStatusToInProgress (Request $request)
    {
        $taskItem = TaskItem::find($request->task_item_id);
        $cartItemFromCart = $taskItem->cartItems;
        $cartItemFromCartId = $cartItemFromCart[0]->id;
        $cartItem = CartItem::find($cartItemFromCartId);

        $cartItem->is_in_progress = true;
        $taskItem->is_in_progress = true;


        $cartItem->save();
        $taskItem->save();
        return $cartItem;
    }

    public function setTaskItemsStatusToCancelled (Request $request)
    {
        $taskItem = TaskItem::find($request->task_item_id);
        $cartItemFromCart = $taskItem->cartItems;
        $cartItemFromCartId = $cartItemFromCart[0]->id;
        $cartItem = CartItem::find($cartItemFromCartId);

        $cartItem->is_cancelled = true;
        $taskItem->is_cancelled = true;
        $cartItem->is_in_progress = false;
        $taskItem->is_in_progress = false;


        $cartItem->save();
        $taskItem->save();
        return $cartItem;
    }

    public function setTaskItemsStatusToCompleted (Request $request)
    {
        $taskItem = TaskItem::find($request->task_item_id);
        $cartItemFromCart = $taskItem->cartItems;
        $cartItemFromCartId = $cartItemFromCart[0]->id;
        $cartItem = CartItem::find($cartItemFromCartId);

        $cartItem->is_completed = true;
        $taskItem->is_completed = true;

        $cartItem->is_on_checkout = true;
        $taskItem->is_on_checkout = true;
        $cartItem->save();
        $taskItem->save();
        return $cartItem;
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskItem  $taskItem
     * @return \Illuminate\Http\Response
     */
    public function show(TaskItem $taskItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskItem  $taskItem
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskItem $taskItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TaskItem  $taskItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskItem $taskItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskItem  $taskItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskItem $taskItem)
    {
        //
    }
}
