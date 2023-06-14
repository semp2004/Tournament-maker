<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TournamentMatch extends Model
{
    protected $table = 'tournament_matches';

    protected $fillable = [
        'round',
        'team_1_score',
        'team_2_score',
        'team_1_id',
        'team_2_id',
    ];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function teams()
    {
        return [
            $this->hasOne(Team::class, 'id', 'team_1_id'),
            $this->hasOne(Team::class, 'id', 'team_2_id'),
        ];
    }
}
