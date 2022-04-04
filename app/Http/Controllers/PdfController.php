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


        // foreach($orders as $order) {
        //     echo 'Name : ' . $order->users->name . '<br />';
        //     echo 'No KP : ' . $order->users->nokp . '<br />';
        //     echo 'No SMPP : ' . $order->users->nosmpp . '<br />';
        //     echo 'Status : ' . $order->users->status . '<br />';
        //     echo 'Order Date : ' . $order->created_at . '<br />';
        //     foreach($order->products as $product) {
        //         echo 'Products Name : ' . $product->name . '<br />';
        //         echo 'Products Price : ' . $product->price . '<br />';
        //     }
            
        //     echo '<br />';
        // }

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


}
