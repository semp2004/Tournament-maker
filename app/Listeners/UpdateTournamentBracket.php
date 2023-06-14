<?php

namespace App\Listeners;

use App\Events\WinnerWinnerChickenDinner;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateTournamentBracket
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WinnerWinnerChickenDinner $event): void
    {
        $matches = $event->match->tournament->matches->count();
    }
}
