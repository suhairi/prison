<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Products;
use App\Models\Orders;
use App\Models\Setting;

use Session;

class OrderController extends Controller
{
    public function index() {

        $ordered = false;

        $products = Products::where('status', 'active')->get();

        // check if user has made the order
        // if yes, disable order form
        $bulanTahun = date('mY');
        $order = Orders::where('user_id', Auth::user()->id)->where('bulanTahun', $bulanTahun)->first();

        if(!empty($order)) 
            $ordered = true;

        $locker = Setting::where('bulanTahun', $bulanTahun)->first();

        if($locker == null) {
            Setting::query()->update(['lock' => 'yes']);
            $locker = Setting::create(['bulanTahun' => $bulanTahun, 'lock' => 'no']);
        }        

        $user = User::find(Auth::user()->id);

        return view('users.orders')
            ->with('order', $order)
            ->with('user', $user)
            ->with('products', $products)
            ->with('locker', $locker)
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

        $bulanTahun = date('mY');
        $locker = Setting::where('bulanTahun', $bulanTahun)->first();

        $totalOrdered = Orders::where('bulanTahun', $bulanTahun)->distinct('user_id')->count();

        $totalUsers = User::where('role', 'user')->where('status', 'active')->count();

        $users = DB::table('users')
                    ->join('orders', 'users.id', 'orders.user_id')
                    ->get();

        return view('admin.orderedList')
                ->with('totalOrdered', $totalOrdered)
                ->with('totalUsers', $totalUsers)
                ->with('locker', $locker)
                ->with('users', $users);
    }

    public function showOrdered($id) {

        $user = User::find($id);

        $locker = Setting::where('lock', 'no')->first();

        $order = Orders::where('user_id', $user->id)
                    ->where('bulanTahun', $locker->bulanTahun)
                    ->first();

        $locker = Setting::where('bulanTahun', date('mY'))->first();

        return view('users.showOrdered')
                ->with('locker', $locker)
                ->with('user', $user)
                ->with('order', $order);
    }

    public function userShowOrdered($id) {

        $order = Orders::find($id);

        $locker = Setting::where('bulanTahun', date('mY'))->first();

        return view('users.showOrdered')
                ->with('locker', $locker)
                ->with('order', $order);
    }

    public function editOrdered($id) {

        $ordered = false;

        $products = Products::all();

        // check if user has made the order
        // if yes, disable order form
        $bulanTahun = date('mY');
        $order = Orders::where('user_id', Auth::user()->id)->where('bulanTahun', $bulanTahun)->first();

        if(!empty($order)) 
            $ordered = true;

        $order = Orders::find($id);

        return view('users.editOrdered')
                ->with('products', $products)
                ->with('ordered', $ordered)
                ->with('order', $order);
    }

    public function modifyOrder(Request $request) {

        $order = Orders::find($request->id);
        $order->products()->detach();

        // Filter through chosen products only
        $qtyCollection = collect($request->qty);
        $quantity = $qtyCollection->filter(function($value, $key) {
            return $value >  0;
        });

        // assigning products_id array
        foreach($quantity->all() as $product_id => $qty) {
            $order->products()->attach($product_id, ['quantity' => $qty]);
        }

        Session::flash('success', 'Order has been modified.');

        return redirect()->back();
    }

    public function ordersList() {

        $user = Auth::user();

        $orders = Orders::where('user_id', $user->id)->get();

        dd($orders);
    }

    public function hqList() {

        // check if the current 'mY' has been closed
        // if yes, then display the order list

        $bulanTahun = date('mY');
        $setting = Setting::where('bulanTahun', $bulanTahun)->first();

        if($setting->lock == 'no') {
            
            Session::flash('fail', 'Oder bulan ' . date('m') . ' dan tahun ' . date('Y') . ' belum ditutup diperingkat PRPI.');
            return redirect()->back();
        }

        $orders = Orders::where('bulanTahun', $bulanTahun)->distinct('user_id')->get();

        // dd($orders);
        $totalOrdered = Orders::where('bulanTahun', $bulanTahun)->distinct('user_id')->count();

        $totalUsers = User::where('role', 'user')->where('status', 'active')->count();

        $users = DB::table('users')
                    ->join('orders', 'users.id', 'orders.user_id')
                    ->get();

        return view('hq.hqList')
                ->with('totalUsers', $totalUsers)
                ->with('users', $users)
                ->with('totalOrdered', $totalOrdered)
                ->with('orders', $orders);
    }

    public function delayProducts() {

        $bulanTahun = date('mY');
        $setting = Setting::where('bulanTahun', $bulanTahun)->first();

        if($setting->lock == 'no') {
            
            Session::flash('fail', 'Oder bulan ' . date('m') . ' dan tahun ' . date('Y') . ' belum ditutup diperingkat PRPI.');
            return redirect()->back();
        }


        $products = Products::where('status', 'active')->orderBy('name', 'asc')->get();

        // dd($products->toArray());

        return view('hq.delayProducts')->with('products', $products);
    }

    public function updateDelayProducts(Request $request) {

        $bulanTahun = date('mY');
        $setting = Setting::where('bulanTahun', $bulanTahun)->first();

        if($setting->lock == 'no') {
            
            Session::flash('fail', 'Oder bulan ' . date('m') . ' dan tahun ' . date('Y') . ' belum ditutup diperingkat PRPI.');
            return redirect()->back();
        }

        // Check if user has make delay before
        // if yes, nullify the order first

        foreach($request->delay as $key => $value) {
            
            $product = Products::find($key);

            foreach($product->orders as $order) {

                if($order->bulanTahun == $bulanTahun) {
                    $order->pivot->delayed = 'on';
                    $order->pivot->save();
                }
            }            
        }

        Session::flash('success', 'Delay Products has been updated.');

        return redirect()->back();
        dd($request->all());
    }

}
