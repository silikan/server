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

public function setTaskItemStatusToAccepted (Request $request)
{
    $taskItem = TaskItem::find($request->task_item_id);
    $cartItemFromTask = $taskItem->cartItems;
    $cartItemFromTaskId = $cartItemFromTask[0]->id;
    $cartItem = CartItem::find($cartItemFromTaskId);
      $taskItem->is_pending = false;
      $cartItem->is_pending = false;
    $taskItem->is_accepted = true;
      $cartItem->is_accepted = true;

    $taskItem->save();
    $cartItem->save();

    return $taskItem;
}

public function setTaskItemStatusToDeclined (Request $request)
{
    $taskItem = TaskItem::find($request->task_item_id);
    $cartItemFromTask = $taskItem->cartItems;
    $cartItemFromTaskId = $cartItemFromTask[0]->id;
    $cartItem = CartItem::find($cartItemFromTaskId);
      $taskItem->is_pending = false;
      $cartItem->is_pending = false;
    $taskItem->is_declined = true;
        $cartItem->is_declined = true;
    $taskItem->save();
    $cartItem->save();
    return $taskItem;
}


public function setTaskItemStatusToPaid (Request $request)
{
    $taskItem = TaskItem::find($request->task_item_id);
    $cartItemFromTask = $taskItem->cartItems;
    $cartItemFromTaskId = $cartItemFromTask[0]->id;
    $cartItem = CartItem::find($cartItemFromTaskId);
      $taskItem->is_pending = false;
      $cartItem->is_pending = false;
    $taskItem->is_paid = true;
        $cartItem->is_paid = true;
    $taskItem->save();
    $cartItem->save();
    return $taskItem;
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
