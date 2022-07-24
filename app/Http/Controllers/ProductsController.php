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

        $products = Products::paginate(10);

        return view('admin.products')
            ->with('products', $products);
    }

    public function register() {

        return view('admin.registerproducts');

    }

    public function create(Request $request) {

        Products::create([
            'name'      => ucfirst($request->name),
            'price'     => $request->price,
            'status'    => 'active',
        ]);

        Session::flash('success', 'Product Registration Success');

        return redirect()->route('admin.registerproducts');
    }

    public function editProduct($id) {

        $product = Products::find($id);

        return view('admin.editProduct')->with('product', $product);
    }

    public function updateProduct(Request $request) {

        $product = Products::find($request->id);
        $product->price = $request->price;
        $product->save();

        Session::flash('success', 'Success');

        return redirect()->back();
    }

    public function deactivateProduct($id) {

        $product = Products::find($id);
        $product->status = 'inactive';

        $product->save();

        Session::flash('success', 'Product has been deactivated.');

        return redirect()->back();

    }

    public function activateProduct($id) {

        $product = Products::find($id);
        $product->status = 'active';

        $product->save();

        Session::flash('success', 'Product has been activated.');

        return redirect()->back();

    }

    
}
