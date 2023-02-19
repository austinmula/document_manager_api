<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExpiringSoon
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public  $senderEmail;
    public $receiverEmail;
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($senderEmail, $receiverEmail, $message)
    {
        //
        $this->senderEmail = $senderEmail;
        $this->receiverEmail=$receiverEmail;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
