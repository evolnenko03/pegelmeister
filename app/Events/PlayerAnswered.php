<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlayerAnswered implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sessionCode;
    public $playerId;
    public $correct;

    public function __construct($sessionCode, $playerId, $correct)
    {
        $this->sessionCode = $sessionCode;
        $this->playerId = $playerId;
        $this->correct = $correct;
    }

    public function broadcastOn()
    {
        return new Channel('game-session.' . $this->sessionCode);
    }
}
