<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Products;
use App\Models\Orders;

use Session;

class OrderController extends Controller
{
    public function index() {

        $products = Products::all();

        // check if user has made the order
        // if yes, disable order form

        return view('users.orders')
            ->with('products', $products);
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
}
