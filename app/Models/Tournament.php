<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $table = 'tournaments';

    protected $fillable = [
        'name',
        'description',
        'match_id',
        'referee_id',
    ];

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'tournament_teams');
    }

    public function matches()
    {
        return $this->belongsTo(TournamentMatch::class);
    }

    public function referee()
    {
        return $this->hasOne(User::class, 'id', 'referee_id');
    }

    public function matchesByRound()
    {
        return $this->matches()->orderBy('round')->get()->groupBy('round');
    }

}
