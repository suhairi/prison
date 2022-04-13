<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;

use Illuminate\Http\Request;

use Session;

use App\Models\Delay;
use App\Models\Orders;
use App\Models\Products;
use App\Models\Setting;
use App\Models\User;

class RootController extends Controller
{

    public function resetOrder() {
        // 1. set setting->lock = null
        // 2. delete all order for current monthYear
        // 3. set orders_products->delayed = null for the current monthYear

        $settings = Setting::where('lock', 'no')->first();

        $orders = Orders::where('bulanTahun', $settings->bulanTahun)->delete();

        Session::flash('success', 'All Orders for current month has been wiped.');

        return redirect()->back();

    }

    public function productOrderedReport() {
        // list of products name, price, quantity, subtotal and grandtotal of all orders
        $bulanTahun = date('mY');
        $orders = Orders::where('bulanTahun', date('mY'))->get();
        $products = Products::where('status', 'active')
                        ->withCount('orders')
                        ->get();

        $orders = Orders::where('bulanTahun', $bulanTahun)->get();

        $productsDelayed = collect([]);
        foreach($orders as $order) {
            foreach($order->products as $product) {
                if($product->pivot->delayed == 'on') {
                    $productsD = $product->toArray();
                    $productsDelayed->push($productsD);
                }
            }
        }

        $productsDelayed = $productsDelayed->unique('id');

        // dd($productsDelayed);

        return view('root.productOrdered')
                ->with('productsDelayed', $productsDelayed)
                ->with('products', $products);
    }

    public function productsDelayed() {

        $bulanTahun = date('mY');
        $setting = Setting::where('bulanTahun', $bulanTahun)->first();

        if($setting->lock == 'no') {
            
            Session::flash('fail', 'Oder bulan ' . date('m') . ' dan tahun ' . date('Y') . ' belum ditutup diperingkat PRPI.');
            return redirect()->back();
        }

        $products = Products::where('status', 'active')->get();

        $orders = Orders::where('bulanTahun', $setting->bulanTahun)->get();

        $productsDelayed = collect([]);
        foreach($orders as $order) {
            foreach($order->products as $product) {
                if($product->pivot->delayed == 'on') {
                    $productsD = $product->toArray();
                    $productsDelayed->push($productsD);
                }
            }
        }

        $productsDelayed = $productsDelayed->unique('id');

        // foreach($productsDelayed as $productDelayed) {
        //     dd($productDelayed['pivot']['delayed']);
        // }

        // return;

        return view('root.productsDelayed')
                ->with('productsDelayed', $productsDelayed)
                ->with('products', $products);
    }

    public function lessAmountOrdered() {
        // list of users that order less than RM 100
        // *bwZfbBg6b6y1v)T6I0Py98x
        // root:YFRWj0G0w5N6e8r8y6
        // root:YFRWjOGow5N6e8r8y6
        // root:YFRWj0Gow5N6e8r8y6
        // root:YFRWjOG0w5N6e8r8y6
        // 7838+VCytn4jp3R
        

        $settings = Setting::where('lock', 'no')->first();
        $orders = Orders::where('bulanTahun', $settings->bulanTahun)->get();

        $orderFiltered = collect([]);
        foreach($orders as $order) {
            // check order sum less than RM 100
            // dd($order);
            $subtotal = 0;
            foreach($order->products as $product) {
                $subtotal += $product->price * $product->pivot->quantity;                
            }

            if($subtotal < 100.00)
                $orderFiltered->push($order);
        }

        $orderFiltered = $orderFiltered->sortBy(function($order) {
                            return $order->users->name;
                        });

        return view('root.lessAmountOrdered')->with('orderFiltered', $orderFiltered);
    }

    public function overAmountOrdered() {
        // list of users  that order more than RM 100
        $settings = Setting::where('lock', 'no')->first();
        $orders = Orders::where('bulanTahun', $settings->bulanTahun)->get();

        $orderFiltered = collect([]);
        foreach($orders as $order) {
            // check order sum less than RM 100
            // dd($order);
            $subtotal = 0;
            foreach($order->products as $product) {
                $subtotal += $product->price * $product->pivot->quantity;                
            }

            if($subtotal > 100.00)
                $orderFiltered->push($order);
        }

        $orderFiltered = $orderFiltered->sortBy(function($order) {
                            return $order->users->name;
                        });

        return view('root.lessAmountOrdered')->with('orderFiltered', $orderFiltered);

    }

    public function perfectAmountOrdered() {
        // list of users  that order more than RM 100
        $settings = Setting::where('lock', 'no')->first();
        $orders = Orders::where('bulanTahun', $settings->bulanTahun)->get();

        $orderFiltered = collect();
        foreach($orders as $order) {
            // check order sum less than RM 100
            // dd($order);
            $subtotal = 0;
            foreach($order->products as $product) {
                $subtotal += $product->price * $product->pivot->quantity;                
            }

            if($subtotal == 100.00)
                $orderFiltered->push($order);
        }

        $orderFiltered = $orderFiltered->sortBy(function($order) {
                            return $order->users->name;
                        });

        return view('root.perfectAmountOrdered')->with('orderFiltered', $orderFiltered);

    }

}
