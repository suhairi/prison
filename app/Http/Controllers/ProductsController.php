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

    public function productsPdf() {

        $products = Products::all();


        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Arial');
        $dompdf->setOptions($options);
        $dompdf->setPaper('A4', 'landscape');
        
        view()->share('products',$products);

        $pdf = PDF::loadview('admin.pdf.productsPdf', ['products' => $products]);

        return $pdf->download('products - ' . Carbon::now() . '.pdf');
    }
}
