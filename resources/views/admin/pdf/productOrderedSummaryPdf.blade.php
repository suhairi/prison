@extends('layouts.appPdf')

@section('content')

    <div class="container mt-6 ">
        <h2 class="text-left mb-3">Products Ordered List Summary</h2>
        <h2 class="text-left mb-3">{{ date('m-Y') }}</h2>
        <table class="table table-bordered table-striped" style="table-layout: fixed;">
            <thead>
                <tr class="table-danger">
                    <th scope="col" width="2px">#</th>
                    <th scope="col" width="10px">Product Name</th>
                    <th scope="col" width="5px">Price</th>
                    <th scope="col" width="5px">Quantity</th>
                    <th scope="col" width="8px">Subtotal</th>
                    <th scope="col" width="100px">Catatan</th>
                </tr>
            </thead>
            <?php $grandTotal = 0; ?>
            @foreach($quantityProducts as $product)
                <?php
                  $subtotal = $product['price'] * $product['quantity'];
                  $grandTotal += $subtotal;
                ?>
                <tbody>
                  <tr>
                    <td valign="middle" align="center">{{ $loop->iteration }}</td>
                    <td valign="middle">
                        {{ $product['name'] }}
                        @if($productsDelayed->contains('id', $product['id']))
                          <font color=red><strong>(Delayed)</strong></font>
                        @endif
                    </td>
                    <td  valign="middle" align="right">{{ number_format($product['price'], 2) }}</td>
                    <td  valign="middle" align="center">{{ $product['quantity'] }}</td>
                    <td  valign="middle" align="right">{{ number_format($subtotal, 2) }}</td>
                    <td  valign="middle" align="right"></td>
                  </tr>
                </tbody>
            @endforeach
            <tr>
              <td colspan="4" align="right"><strong>Grand Total </strong></td>
              <td align="right"><strong>{{ number_format($grandTotal, 2) }}</strong></td>
              <td align="right"><strong></strong></td>
            </tr>
        </table>
    </div>

@endsection
