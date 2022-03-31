<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UsersController extends Controller
{
    public function create(Request $request) {

        // return $request->all();

        $validator = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'username'  => ['required', 'string', 'max:255', 'unique:users'],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
            'role'      => ['required']
        ]);

        $user = User::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'role'      => $request->role,
            'password'  => Hash::make($request->password),
        ]);

        Session::flash('success', 'Success');

        return view('admin.register');
    }

    public function userList() {

        $users = User::where('username', '!=', 'suhairi')->paginate(15);

        return view('admin.userlist')
            ->with('users', $users);


    }
}
