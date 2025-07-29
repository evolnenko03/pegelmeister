<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlayerJoined implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sessionCode;
    public $player;

    public function __construct($sessionCode, $player)
    {
        $this->sessionCode = $sessionCode;
        $this->player = $player;
    }

    public function broadcastOn()
    {
        return new Channel('game-session.' . $this->sessionCode);
    }

    public function broadcastWith()
    {
        return [
            'player' => $this->player,
            'sessionCode' => $this->sessionCode
        ];
    }
}
