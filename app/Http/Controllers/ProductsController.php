<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Products;
use Session;

class ProductsController extends Controller
{
    public function index() {

        $products = Products::all();

        return view('admin.products');
    }

    public function register() {

        return view('admin.registerproducts');

    }

    public function create(Request $request) {

        Products::create([
            'name'  => ucfirst($request->name),
            'price' => $request->price,
        ]);

        Session::flash('success', 'Product Registration Success');

        return redirect()->route('admin.registerproducts');
    }
}
