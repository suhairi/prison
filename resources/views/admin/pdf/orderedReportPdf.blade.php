@extends('layouts.appPdf')

@section('content')
<?php use Carbon\Carbon; ?>
    

    @foreach($orders as $order)
        <div class="container mt-6">
        <div>
            <strong>
                SENARAI ODER BARANG KANTIN ODS <br />
                PUSAT REINTEGRASI PENGHUNI INDUSTRI (PRPI) <br />
                SUNGAI PETANI, KEDAH. <br /><br />
            </strong>
        </div>
        <table class="table table-bordered">
          <tr>
            <td width="100px"><strong>Name </strong></td>
            <td>{{ $order->users->name }}</td>
          </tr>
          <tr>
            <td><strong>No KP </strong> </td>
            <td>{{ $order->users->username }}</td>
          </tr>
          <tr>
            <td><strong>No SMPP </strong> </td>
            <td>{{ $order->users->nosmpp }}</td>
          </tr>
          <tr>
            <td><strong>Status </strong></td>
            <td>{{ strtoupper($order->users->status) }}</td>
          </tr>
          <tr>
            <td><strong>Date </strong></td>
            <td>{{ $order->created_at }}</td>
          </tr>
        </table>

        <table class="table table-bordered table-striped table-hover" id="tblProducts">
            <thead>
              <th>Bil</th>
              <th>Products</th>
              <th align="center">Price (RM)</th>
              <th>Quantity</th>
              <th>Subtotal</th>
            </thead>
            <?php $grandTotal = 0; ?>
            @foreach($order->products as $product)
              <tbody>
                <tr>
                  <td width="10px" valign="middle" align="center">{{ $loop->iteration }}</td>
                  <td width="200px" valign="middle">{{ $product->name }}</td>
                  <td width="80px" align="right" valign="middle">{{ number_format($product->price, 2) }}</td>
                  <td width="80px" align="center">{{ $product->pivot->quantity }}</td>
                  <td align="right" valign="middle" width="10%">{{ number_format($product->price * $product->pivot->quantity, 2) }}</td>
                </tr>
              </tbody>
              <?php $grandTotal += $product->price * $product->pivot->quantity; ?> 
            @endforeach
            <tfoot>
              <tr>
                <td colspan="4" align="right"><strong>JUMLAH BESAR (RM)</strong></td>
                <td align="right"><strong>{{ number_format($grandTotal, 2) }}</strong></td>
              </tr>
              <tr>
                <td colspan="4" align="right"><strong>Baki Lebihan Belanja</strong></td>
                <td align="right"><strong>{{ number_format(100 - $grandTotal, 2) }}</strong></td>
              </tr>
            </tfoot>
          </table>
        </div>
        @if(!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach



    <script src="{{ asset('js/app.js') }}" type="text/js"></script>

@endsection