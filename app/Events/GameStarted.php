<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GameStarted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sessionCode;

    public function __construct($sessionCode)
    {
        $this->sessionCode = $sessionCode;
    }

    public function broadcastOn()
    {
        return new Channel('game-session.' . $this->sessionCode);
    }
}
