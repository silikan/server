<?php

namespace App\Http\Controllers;

use App\Models\TaskItem;
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
               $taskItem->cart()->associate($task);
                $taskItem->save();
                $gig->taskItem()->associate($taskItem);
                $gig->save();

                return response()->json([
                    'status'    =>  'success',
                    'message'   =>  'Gig added to Task!',
                    'taskItem'  =>  $taskItem
                ]);
        }else if($type == "request"){


            $taskItem = new TaskItem();
               $clientRequest =  ClientRequest::find($request->request_id);
               $task =  Task::find($request->task_id);
               $taskItem->cart()->associate($task);
                $taskItem->save();
               $clientRequest->taskItem()->associate($taskItem);
               $clientRequest->save();
               return response()->json([
                'status'    =>  'success',
                'message'   =>  'Request added to Task!',
                'taskItem'  =>  $taskItem
            ]);
        }
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
