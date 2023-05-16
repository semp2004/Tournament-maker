<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $Users = User::get();
        return view('admin.users.users', data: ['users' => $Users]);
    }

    public function edit($id)
    {
        $User = User::where('id', $id)->FirstOrFail();
        return view(view: 'admin.users.editUser', data: ['user' => $User]);
    }

    public function DeleteUser($id)
    {
        $UserModel = User::where('id', $id)->first();
        $UserModel->delete();
        return redirect()->route('users');
    }

    public function EditUserRequest(int $id)
    {
        $Name = \request()->get('name');
        $Email = \request()->get('email');
        $role = \request()->get('role');

        $UserModel = User::where('id', $id)->first();
        $UserModel->name = $Name;
        $UserModel->email = $Email;
        $UserModel->role = $role;
        $UserModel->save();


        return $this->index();
    }
}
