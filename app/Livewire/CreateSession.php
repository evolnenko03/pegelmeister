<?php

namespace App\Livewire;

use App\Models\GameSession;
use App\Models\Player;
use App\Events\PlayerJoined;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

class CreateSession extends Component
{
    public $sessionCode;
    public $playerName;
    public $playerId;
    public $sessionCreated = false;

    public function createSession()
    {
        $this->validate(['playerName' => 'required|min:2|max:50']);

        $player = Player::create(['player_name' => $this->playerName]);

        $gameSession = GameSession::create([
            'code' => strtoupper(Str::random(6)),
            'host_player_id' => $player->id
        ]);

        $gameSession->players()->attach($player->id, ['score' => 0]);

        $this->sessionCode = $gameSession->code;
        $this->playerId = $player->id;
        $this->sessionCreated = true;

        session(['player_id' => $player->id, 'session_code' => $gameSession->code]);

        // Broadcast player joined
        broadcast(new PlayerJoined($gameSession->code, $player));
    }

    public function render(): Factory|View
    {
        return view('livewire.create-session');
    }
}
