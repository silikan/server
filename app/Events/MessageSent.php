<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $room_id;
    public $from;
    public $to;
    public $message;

    public function __construct(    $room_id, $from, $to, $message)
    {
        $this->room_id = $room_id;
        $this->from = $from;
        $this->to = $to;
        $this->message = $message;
    }


    public function broadcastOn()
    {
        return new Channel($this->room_id);
    }


}
