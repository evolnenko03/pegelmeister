<?php

namespace App\Http\Controllers;

use App\Models\GameSession;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GameSessionController extends Controller
{
    public function create(Request $request)
    {
        $gameSession = GameSession::create([
            'code' => strtoupper(Str::random(6))
        ]);

        return response()->json([
            'code' => $gameSession->code,
            'session_id' => $gameSession->id
        ]);
    }

    public function join(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'player_name' => 'required|string|max:255'
        ]);

        $gameSession = GameSession::where('code', $request->code)->first();

        if (!$gameSession) {
            return response()->json(['error' => 'Session not found'], 404);
        }

        $player = Player::create(['name' => $request->player_name]);

        $gameSession->players()->attach($player->id, ['score' => 0]);

        return response()->json([
            'message' => 'Joined successfully',
            'player_id' => $player->id,
            'session_id' => $gameSession->id
        ]);
    }

    public function getPlayers($code)
    {
        $gameSession = GameSession::where('code', $code)->with('players')->first();

        if (!$gameSession) {
            return response()->json(['error' => 'Session not found'], 404);
        }

        return response()->json(['players' => $gameSession->players]);
    }
}
