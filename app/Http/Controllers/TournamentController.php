<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function index()
    {
        return view('tournament.tournaments',
            [
                'tournaments' => Tournament::all(),
            ]);
    }

    public function singleview($id)
    {
        return view('tournament.tournament',
            [
                'tournament' => Tournament::find($id)
            ]);
    }

    public function add()
    {
        return view('tournament.newTournaments',
            [
                'teams' => Team::all(),
                'referees' => User::all(),
            ]);
    }

    public function edit($id)
    {
        return view('tournament.editTournaments', [
            'tournament' => Tournament::find($id),
            'teams' => Team::all(),
            'referees' => User::all(),
        ]);
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $referee = User::find($request->input('referee'));
        $teams = Team::find($request->input('teams'));

        $tournament = Tournament::query()
            ->create([
                'name' => $name,
                'description' => $description,
                'referee_id' => $referee->id,
            ]);

        $tournament->teams()->sync($teams);

        dispatch(new \App\Jobs\GenerateTournamentBracket($tournament));

        return redirect()->route('tournaments')->with('success', 'Store created successfully.');
    }

    public function delete($id)
    {
        $tournament = Tournament::find($id);
        $tournament->delete();

        return redirect()->route('tournaments')->with('success', 'Store deleted successfully.');
    }
}
