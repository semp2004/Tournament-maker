<?php

namespace App\Jobs;

use App\Models\Tournament;
use App\Models\TournamentMatch;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateTournamentBracket implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Tournament $tournament)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $rounds = 0;

        global $firstRun;
        $firstRun = true;

        $currentTeams = $this->tournament->teams()->count();

        while ($currentTeams > 1)
        {
            $rounds++;

            $teams = $this->tournament->teams->shuffle();

            for ($i = 0; $i < $currentTeams; $i+=2) {
                $this->tournament->matches()->create([
                    'round' => $rounds,
                    'team_1_id' => $firstRun ? $teams[$i]->id : null,
                    'team_2_id' => $firstRun ? $teams[$i + 1]->id : null,
                ]);
            }

            $currentTeams /= 2;
            $firstRun = false;
        }
    }
}
