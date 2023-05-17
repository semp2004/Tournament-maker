<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    private function duplicateCheck(Team $team) {
        if ($team->created_at)
            return true;
        return false;
    }
    public function index()
    {
        $teams = Team::get();
        return view(view: 'admin.teams.teams', data: ['teams' => $teams]);
    }

    public function add()
    {
        return view(view: 'admin.teams.addTeam');
    }

    public function edit(Team $team)
    {
        return view(view: 'admin.teams.editTeam', data: ['team' => $team]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|max:255',
            'id' => 'int',
        ]);

        $team = Team::find($data['id']);

        $cTeam = Team::firstOrNew(
            ['name' => $data['name']],
        );

        if ($this->duplicateCheck($cTeam))
            return redirect()->back()->withErrors(['duplicate' => 'This name already exists.']);

        $team->name = $data['name'];

        $team->save();

        return redirect()->back()->with('success', 'Your edit has been successfully updated');
    }

    public function addPost(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|max:255',
        ]);

        $team = Team::firstOrNew(
            ['name' => $data['name']],
        );

        if ($this->duplicateCheck($team))
            return redirect()->back()->withErrors(['duplicate' => 'This name already exists.']);

        $team->save();

        return redirect(route('teams'));
    }

    public function destroy(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|int',
        ]);

        Team::find($data['id'])->delete();

        return redirect()->back();
    }
}
