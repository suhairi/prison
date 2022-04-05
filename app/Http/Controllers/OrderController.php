<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Products;
use App\Models\Orders;

use Session;

class OrderController extends Controller
{
    public function index() {

        $ordered = false;

        $products = Products::all();

        // check if user has made the order
        // if yes, disable order form
        $bulanTahun = date('mY');
        $order = Orders::where('user_id', Auth::user()->id)->where('bulanTahun', $bulanTahun)->first();

        if(!empty($order)) 
            $ordered = true;

        $user = User::find(Auth::user()->id);

        return view('users.orders')
            ->with('order', $order)
            ->with('user', $user)
            ->with('products', $products)
            ->with('ordered', $ordered);     
        
    }

    public function create(Request $request) {

        $bulanTahun = date("mY");
        $user_id    = Auth::user()->id;

        $order = Orders::create([
                    'user_id'       => $user_id,
                    'bulanTahun'    => $bulanTahun,
                ]);

        // Filter through chosen products only
        $qtyCollection = collect($request->qty);
        $quantity = $qtyCollection->filter(function($value, $key) {
            return $value >  0;
        });

        // assigning products_id array
        foreach($quantity->all() as $product_id => $qty) {
            $order->products()->attach($product_id, ['quantity' => $qty]);
        }

        Session::flash('success', 'Success');
        return redirect()->route('user.order');

    }

    public function orderedList() {

        $users = DB::table('users')
                    ->join('orders', 'users.id', 'orders.user_id')
                    ->get();

        // dd($users);

        return view('admin.orderedList')->with('users', $users);
    }

    public function showOrdered($id) {

        $bulanTahun = date("mY");

        $user = User::find($id);
        $order = Orders::where('user_id', $id)
                    ->where('bulanTahun', $bulanTahun)
                    ->with('products')
                    ->first();

        // dd($order->products);

        return view('admin.showOrdered')
                ->with('user', $user)
                ->with('order', $order);
    }

    public function userShowOrdered($id) {

        $order = Orders::find($id);

        return view('users.showOrdered')->with('order', $order);
    }

}
