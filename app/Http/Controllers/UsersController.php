<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

use App\Models\User;

class UsersController extends Controller
{
    public function create(Request $request) {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        return 'here';

        $user = User::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'role'      => $request->role,
            'password'  => Hash::make($request->password),
        ]);

        return view('dashboard');
    }

    public function userList() {

        $users = User::all();

        return view('admin.userlist');


    }
}
