<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\User;

class MessageSent implements ShouldBroadcast
{
    use SerializesModels;

    public $messageId;
    public $message;
    public $userId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($messageId, $message, $userId)
    {
        $this->messageId = $messageId;
        $this->message = $message;
        $this->userId = $userId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('simple-chat');
    }

    public function broadcastWith()
    {
        $username = User::find($this->userId)->username;

        return [
            'message' => [$this->messageId, $this->message, $this->userId, $username]
        ];
    }
}
