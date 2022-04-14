@extends('layouts.app')

@section('content')

<div class="row">

  @include('layouts.messages')
  <div class="row">
      <div class="mb-3">
        <h4><a href="{{ url()->previous() }}"> <i class="bx bx-arrow-back bx-fade-left-hover"> </i></a> {{ $product->name }} ordered by Users</h4>
      </div>
  </div>
  <hr />  

  <div class="row">
    <div class="mb-3">
      <table class="table table-bordered table-striped table-hover">
        <thead>
          <th>Bil</th>
          <th>Name</th>
          <th>No KP</th>
          <th>Section</th>
          <th>Quantity</th>         
        </thead>
        <?php $grandTotal = 0; ?>
        @foreach($product->orders as $order)
          <tr>
            <td valign="middle">{{ $loop->iteration }}</td>
            <td valign="middle">{{ strtoupper($order->users->name) }}</td>
            <td valign="middle">{{ $order->users->username }}</td>
            <td valign="middle">{{ $order->users->section }}</td>
            <td valign="middle" align="center">{{ $order->pivot->quantity }}</td>
          </tr>
          <?php $grandTotal += $order->pivot->quantity; ?>
        @endforeach
        <tr>
          <td colspan="4" align="right"><strong>Total</strong></td>
          <td align="center"><strong>{{ $grandTotal }}</strong></td>
        </tr>
      </table>
      

    </div>    
  </div>
</div>


@endsection