<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;



class MessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    private $message;
    private $user_identity;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $message,$user_identity)
    {
        $this->message = $message;
        $this->user_identity = $user_identity;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('message.'.$this->user_identity);
    }

    /**
     * JSON data to broadcast with this message
     */
    public function broadcastWith()
    {
        return $this->message->toArray();
    }
}
