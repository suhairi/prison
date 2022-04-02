<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

use Session;

use App\Models\User;
use App\Models\Orders;

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

        $totalActive = User::where('username', '!=', 'suhairi')
                    ->where('role', 'user')
                    ->where('status', 'active')
                    ->orderBy('name', 'asc')
                    ->count();

        $totalInActive = User::where('username', '!=', 'suhairi')
                    ->where('role', 'user')
                    ->where('status', '!=', 'active')
                    ->orderBy('name', 'asc')
                    ->count();

        // $users = User::where('username', '!=', 'suhairi')->paginate(15);
        $users = User::where('username', '!=', 'suhairi')
                    ->where('role', 'user')
                    ->where('status', 'active')
                    ->orderBy('name', 'asc')->get();

        return view('admin.userlist')
            ->with('totalActive', $totalActive)
            ->with('totalInActive', $totalInActive)
            ->with('users', $users);
    }

    public function userNotOrderList() {

        $bulanTahun = date('mY');
        $totalOrdered = Orders::where('bulanTahun', $bulanTahun)->distinct('user_id')->count();

        $totalUsers = User::where('role', 'user')->count();

        // dd($totalUsers);

        $bulanTahun = date('mY');
        $users = DB::table('users')
                    ->where('role', 'user')
                    ->orderBy('name', 'asc')
                    ->whereNotExists(function($query) {
                        $query->select(DB::raw(1))
                            ->from('orders')
                            ->whereColumn('users.id', 'orders.user_id');
                    })->get();

        // $users = DB::table('users')
        //             ->join('orders', 'users.id', 'orders.user_id')
        //             ->get();

        return view('admin.usernotorderlist')
                ->with('totalUsers', $totalUsers)
                ->with('totalOrdered', $totalOrdered)
                ->with('users', $users);
    }

    public function inactivelist() {

        $totalActive = User::where('username', '!=', 'suhairi')
                    ->where('role', 'user')
                    ->where('status', 'active')
                    ->orderBy('name', 'asc')
                    ->count();

        $totalInActive = User::where('username', '!=', 'suhairi')
                    ->where('role', 'user')
                    ->where('status', '!=', 'active')
                    ->orderBy('name', 'asc')
                    ->count();

        $users = User::where('role', 'user')
                        ->where('status', 'inactive')
                        ->get();

        return view('admin.inactivelist')
                ->with('totalActive', $totalActive)
                ->with('totalInActive', $totalInActive)
                ->with('users', $users);
    }

    public function setInactive($id) {

        $user = User::find($id);
        $user->status = 'inactive';
        $user->save();

        Session::flash('success', ' Success');

        return redirect()->route('admin.userList');

    }

    public function setActive($id) {

        $user = User::find($id);
        $user->status = 'active';
        $user->save();

        Session::flash('success', ' Success');

        return redirect()->route('admin.inactivelist');

    }

    
}
