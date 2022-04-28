<?php

namespace App\Http\Controllers;

use App\Models\NotificationRoom;
use Illuminate\Http\Request;

class NotificationRoomController extends Controller
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

        //if room exist return room
        //else create room and return room
        $user = Auth::user();
        $notificationRoom = NotificationRoom::where('user_id', $user->id)->first();
        if ($notificationRoom) {
            return $notificationRoom;
        } else {
            $notificationRoom = new NotificationRoom();
            $notificationRoom->user()->associate($user);
            $notificationRoom->save();
            return $notificationRoom;
        }

    }


    public function getRoomNotifications ($id) {
        $notificationRoom = NotificationRoom::find($id);
        return $notificationRoom->Notification;
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
     * @param  \App\Models\NotificationRoom  $notificationRoom
     * @return \Illuminate\Http\Response
     */
    public function show(NotificationRoom $notificationRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NotificationRoom  $notificationRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(NotificationRoom $notificationRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NotificationRoom  $notificationRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotificationRoom $notificationRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NotificationRoom  $notificationRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotificationRoom $notificationRoom)
    {
        //
    }
}