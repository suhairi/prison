<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;


use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

use Session;

use App\Models\User;
use App\Models\Orders;

use Carbon\Carbon;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

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
            'status'    => 'active',
        ]);

        Session::flash('success', 'Success');

        return redirect()->back();
    }

    public function userList() {

        $totalUsers = User::where('role', 'user')
                        ->count();

        $totalActive = User::where('username', '!=', 'suhairi')
                    ->where('role', 'user')
                    ->where('status', 'active')
                    ->count();

        $totalInActive = User::where('username', '!=', 'suhairi')
                    ->where('role', 'user')
                    ->where('status', '!=', 'active')
                    ->orderBy('name', 'asc')
                    ->count();

        $users = User::where('role', 'user')
                    ->where('status', 'active')
                    ->orderBy('name', 'asc')
                    ->paginate(15);

        return view('admin.userlist')
            ->with('totalUsers', $totalUsers)
            ->with('totalActive', $totalActive)
            ->with('totalInActive', $totalInActive)
            ->with('users', $users);
    }

    public function userNotOrderList() {

        $bulanTahun = date('mY');
        $totalOrdered = Orders::where('bulanTahun', $bulanTahun)->distinct('user_id')->count();
        $totalUsers = User::where('role', 'user')->where('status', 'active')->count();

        $orders = Orders::where('bulanTahun', $bulanTahun)->distinct('user_id')->pluck('user_id');
        $users = User::where('role', 'user')->where('status', 'active')->pluck('id');

        $diffs = $users->diff($orders);

        $usersNotOrder = collect([]);
        foreach($diffs as $diff) {
            $user = User::find($diff);
            $usersNotOrder->push($user);
        }

        $users = $usersNotOrder;

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
                        ->paginate(10);

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

    public function editUser($id) {

        $user = User::find($id);

        return view('admin.editUser')->with('user', $user);
    }

    public function updateUser(Request $request) {

        if($request->password != $request->password_confirmation) {

            Session::flash('fail', 'Password and confirmation does not match');
            return redirect()->back();
        }


        $user = User::find($request->id);
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->save();

        Session::flash('success', 'User Updated');

        return redirect()->back();

    }

    

    
}
