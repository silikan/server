<?php
namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;


class NotificationController extends Controller
{
    public function store(Request $request)
    {
        $notification = new Notification();
        $notification->type = $request->type;
        $notification->data = $request->data;
        $notification->from = $request->from;
        $notification->to = $request->to;

        $notification->NotificationRoom()->associate($request->notification_room_id);
        $notification->user()->associate($request->to);


        $notification->save();
        return $notification;
    }
}
