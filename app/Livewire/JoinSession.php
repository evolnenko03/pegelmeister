<?php

namespace App\Livewire;

use App\Models\GameSession;
use App\Models\Player;
use App\Events\PlayerJoined;
use Livewire\Component;

class JoinSession extends Component
{
    public $sessionCode;
    public $playerName;
    public $joined = false;
    public $error;

    public function joinSession()
    {
        $this->validate([
            'sessionCode' => 'required',
            'playerName' => 'required|min:2|max:50'
        ]);

        $gameSession = GameSession::where('code', strtoupper($this->sessionCode))->first();

        if (!$gameSession) {
            $this->error = 'Session not found!';
            return;
        }

        $player = Player::create(['player_name' => $this->playerName]);
        $gameSession->players()->attach($player->id, ['score' => 0]);

        $this->joined = true;
        session(['player_id' => $player->id, 'session_code' => $gameSession->code]);

        // Broadcast player joined
        broadcast(new PlayerJoined($gameSession->code, $player));

        return redirect('/game/' . $gameSession->code);
    }

    public function render(): object
    {
        return view('livewire.join-session');
    }
}
