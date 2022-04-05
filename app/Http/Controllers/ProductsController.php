<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Products;
use Session;

use Carbon\Carbon;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class ProductsController extends Controller
{
    public function index() {

        $products = Products::all();

        return view('admin.products')
            ->with('products', $products);
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

    public function editProduct($id) {

        $product = Products::find($id);

        // dd($product);

        return view('admin.editProduct')->with('product', $product);
    }

    public function updateProduct(Request $request) {

        $product = Products::find($request->id);
        $product->price = $request->price;
        $product->save();

        Session::flash('success', 'Success');

        return redirect()->back();
    }

    
}
