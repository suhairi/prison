<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Products;

class OrderController extends Controller
{
    public function index() {

        $products = Products::all();

        return view('users.orders')
            ->with('products', $products);
    }
}
