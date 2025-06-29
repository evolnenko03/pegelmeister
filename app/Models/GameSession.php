<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'host_player_id',
    ];

    public function players()
    {
        return $this->belongsToMany(Player::class, 'player_session')
            ->withPivot('score')
            ->withTimestamps();
    }
}
