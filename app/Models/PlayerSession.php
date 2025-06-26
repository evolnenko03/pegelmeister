<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerSession extends Model
{
    use HasFactory;

    protected $table = 'player_session';

    protected $fillable = [
        'player_id',
        'game_session_id',
        'score',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function gameSession()
    {
        return $this->belongsTo(GameSession::class);
    }
}
