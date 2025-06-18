<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_name',
    ];

    public function gameSessions()
    {
        return $this->belongsToMany(GameSession::class, 'player_session')
            ->withPivot('score')
            ->withTimestamps();
    }
}
