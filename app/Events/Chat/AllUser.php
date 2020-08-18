<?php

namespace App\Events\Chat;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AllUser implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $eventName,$respeondData;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($eventName,$respeondData)
    {
        $this->eventName=$eventName;
        $this->respeondData=$respeondData;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('commona_user');
    }

    public function broadcastAs()
    {
        return $this->eventName;
    }

    public function broadcastWith()
    {
        return  $this->respeondData;
    }
}
