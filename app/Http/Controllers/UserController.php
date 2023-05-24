<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $Users = User::get();
        return view(
            'admin.users.users', [
                'users' => $Users,
                'teams' => Team::all()
            ]);
    }

    public function edit($id)
    {
        $User = User::where('id', $id)->FirstOrFail();
        return view('admin.users.editUser', [
            'user' => $User,
            'teams' => Team::all(),
        ]);
    }

    public function DeleteUser($id)
    {
        $UserModel = User::where('id', $id)->first();
        $UserModel->delete();
        return redirect()->route('users');
    }
    public function EditUserRequest(int $id)
    {
        $name = \request()->get('name');
        $email = \request()->get('email');
        $role = \request()->get('role');
        $team = \request()->get('team');
        $team = Team::find($team);

        $userModel = User::where('id', $id)->first();
        $userModel->name = $name;
        $userModel->email = $email;
        $userModel->role = $role;
        $userModel->save();

        if ($team === null) {
            $userModel->teams()->detach();// Remove the linked team if it's null
        } else {
            $userModel->teams()->sync($team); // Save the selected team in the linked table
        }

        return redirect()->route('users');
    }


}
