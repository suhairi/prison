@extends('layouts.app')

@section('content')

    <div class="row">

        @include('layouts.messages')

        <div class="row">
          <div class="mb-3">
            <h4>Product List</h4>
          </div>
        </div>       
        <hr />

        <div class="row">
          <div class="mb-3">
            <h5>Delayed Products</h5>
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <th>Bil</th>
                <th>Product Name</th>
                <th>Price</th>
                <th align="center">Quantity (Unit)</th>
                <th>Subtotal (RM)</th>
              </thead>
              <?php $grandTotal = 0; ?>
              @foreach($productsDelayed as $productDelayed)
                
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $productDelayed['name'] }}</td>
                  <td>{{ number_format($productDelayed['price'], 2) }}</td>
                  <td align="center">{{ $productDelayed['quantity'] }}</td>
                  <?php 
                    $subtotal = $productDelayed['price'] * $productDelayed['quantity'];
                    $grandTotal += $subtotal;
                  ?>
                  <td align="right">{{ number_format($subtotal, 2) }}</td>
                </tr>
              @endforeach
              <tr>
                <td colspan="4" align="right"><strong>GrandTotal</strong></td>
                <td align="right"><strong>{{ number_format($grandTotal, 2) }}</strong></td>
              </tr>
            </table>
          </div>
        </div>   
       

    </div>

@endsection
