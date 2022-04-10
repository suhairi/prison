<?php

namespace App\Http\Controllers;

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
        $orders = Orders::where('bulanTahun', date('mY'))->get();

        foreach($orders as $order) {
            dd($order->products);
        }

    }

    public function lessAmountOrdered() {
        // list of users that order less than RM 100
        // *bwZfbBg6b6y1v)T6I0Py98xs
        // root:YFRWj0G0w5N6e8r8y6
        // root:YFRWjOGow5N6e8r8y6
        // root:YFRWj0Gow5N6e8r8y6
        // root:YFRWjOG0w5N6e8r8y6
        // 7838+VCytn4jp3R
        
        


    }

    public function overAmountOrdered() {
        // list of users  that order more than RM 100

    }
}
