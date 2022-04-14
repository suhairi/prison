@extends('layouts.appPdf')

@section('content')

  <div class="container mt-5">
    <h2 class="text-left mb-3">{{ $product->name }}</h2>
    <table class="table table-bordered table-striped w-50">
      <thead>
          <tr class="table-primary">
              <th scope="col" width="2px">Bil</th>
              <th scope="col" width="8px">Name</th>
              <th scope="col" width="5px">No KP</th>
              <th scope="col" width="2px">Section</th>
              <th scope="col" width="10px">Quantity</th>
          </tr>
      </thead>
      <?php $grandTotal = 0; ?>
      <tbody>
      @foreach($product->orders as $order)
        <tr>
          <td valign="middle" align="center">{{ $loop->iteration }}</td>
          <td valign="middle">{{ strtoupper($order->users->name) }}</td>
          <td valign="middle">{{ $order->users->username }}</td>
          <td valign="middle">{{ $order->users->section }}</td>
          <td valign="middle" align="center">{{ $order->pivot->quantity }}</td>
        </tr>
        <?php $grandTotal += $order->pivot->quantity; ?>
      @endforeach
      </tbody>
      <tr>
        <td colspan="4" align="right"><strong>Total</strong></td>
        <td align="center"><strong>{{ $grandTotal }}</strong></td>
      </tr>
    </table>

  </div>    



@endsection