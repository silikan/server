<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\User;

class TaskController extends Controller
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
        $task = Task::where('user_id',  $user_id)->first();
        if($task){
            return $task;
        }else{
            $task = new Task();
            $user =  User::find($user_id);
            $task->user()->associate($user);
            $task->save();
            return $task;
        }
    }


    public function getUserTaskItems($id){
        $user =  User::find($id);
        $task = $user->task;
        $task_items = $task->taskItems;

        $clientRequestData = array();
        foreach ($task_items as $item) {
           $clientRequest = $item->clientRequests;
           $handyman_id = $item->handyman_id;
              $client_id = $item->client_id;
             $task_id = $item->task_id;
             $handyman = User::find($handyman_id);
             $client = User::find($client_id);
             $task = Task::find($task_id);
              array_push($clientRequestData,array(
                'item' => array(
                    'task' => $task,
                   'clientRequest' => $clientRequest,
                    'handyman' => $handyman,
                    'client' => $client,
                    'task_item' => $item

                ), )
              );

        }

        return $clientRequestData;
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
