<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Session;

use App\Models\User;
use App\Models\Orders;
use App\Models\Products;

use Carbon\Carbon;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfController extends Controller
{
    public function userPdf() {

        $totalActive = User::where('username', '!=', 'suhairi')
                    ->where('role', 'user')
                    ->where('status', 'active')
                    ->orderBy('name', 'asc')
                    ->count();

        $totalInActive = User::where('username', '!=', 'suhairi')
                    ->where('role', 'user')
                    ->where('status', '!=', 'active')
                    ->orderBy('name', 'asc')
                    ->count();

        $users = User::where('role', 'user')
                        ->where('status', 'inactive')
                        ->get();

        $users = User::where('role', 'user')
                    ->where('status', 'active')
                    ->take(30) // remove this line after testing 
                    ->get();

        // dd($users);
        // return view('admin.pdf.usersPdf')
        //         ->with('users', $users)
        //         ->with('totalActive', $totalActive)
        //         ->with('totalInActive', $totalInActive);           

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Arial');
        $dompdf->setOptions($options);
        $dompdf->setPaper('A4', 'landscape');
        
        view()->share('users',$users);

        $pdf = PDF::loadview('admin.pdf.usersPdf', ['users' => $users, 'totalActive' => $totalActive, 'totalInActive' => $totalInActive]);

        return $pdf->download('users - ' . Carbon::now() . '.pdf');
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

    public function orderedReportPdf() {

        $orders = Orders::where('bulanTahun', date('mY'))->get();

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Arial');
        $dompdf->setOptions($options);
        $dompdf->setPaper('A4', 'landscape');
        
        view()->share('orders', $orders);

        $pdf = PDF::loadview('admin.pdf.orderedReportPdf', ['OrderedReport' => $orders]);

        return $pdf->download('Ordered Report - ' . Carbon::now() . '.pdf');

        return view('admin.pdf.orderedReportPdf')->with('orders', $orders);

    }

    public function orderPdf($id) {

        $order = Orders::find($id);

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Arial');
        $dompdf->setOptions($options);
        $dompdf->setPaper('A4', 'landscape');
        
        view()->share('order', $order);

        $pdf = PDF::loadview('admin.pdf.orderPdf', ['OrderedReport' => $order]);

        return $pdf->download('Ordered Report - ' . Carbon::now() . '.pdf');

        return view('admin.pdf.orderPdf')->with('order', $order);

    }

    public function productOrderedSummaryPdf() {
        $bulanTahun = date('mY');
        $orders = Orders::where('bulanTahun', $bulanTahun)->get();
        $products = Products::where('status', 'active')->orderBy('name', 'asc')->get();

        $quantityProducts = collect([]);
        foreach($orders as $order) {

            foreach($order->products as $product) {

                if(!$quantityProducts->contains('id', $product->id)) {

                    $quantity = 0;
                    foreach($product->orders as $ord) {
                        $quantity += $ord->pivot->quantity;
                    }

                    $prod = $product->toArray();
                    $prod['quantity'] = $quantity;

                    $quantityProducts->push($prod);
                } 
            }
        }

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

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Arial');
        $dompdf->setOptions($options);
        $dompdf->setPaper('A4', 'landscape');
        
        // view()->share('order', $order);

        $pdf = PDF::loadview('admin.pdf.productOrderedSummaryPdf', ['quantityProducts' => $quantityProducts, 'productsDelayed' => $productsDelayed, 'products' => $products]);

        return $pdf->download('Product Ordered Summary - ' . Carbon::now() . '.pdf');

    }

    public function productOrderedPdf($id) {
        $users = collect([]);
        $product = Products::find($id);

        foreach ($product->orders as $order) {
            $users->push($order->users);
        }

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Arial');
        $dompdf->setOptions($options);
        $dompdf->setPaper('A4', 'landscape');
        
        $pdf = PDF::loadview('admin.pdf.productOrderedPdf', ['product' => $product, 'users' => $users]);

        return $pdf->download('List Users by Product Ordered  - ' . Carbon::now() . '.pdf');

    }



}
