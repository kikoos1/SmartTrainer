<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class FriendRequest implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $name;

    public $type;
    public $id;
    public $text;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($name,$id)
    {
        //
        $this->name = $name;
        $this->type = "friends";
        $this->text  = "{$name} ви изпрати покана";
        $this->id = $id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel("user-".$this->id);
    }
}
