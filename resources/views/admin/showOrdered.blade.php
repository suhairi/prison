@extends('layouts.app')

@section('content')

<?php use Carbon\Carbon; ?>

<div class="row">
  @include('layouts.messages')
  <div class="row">
    <h4> <a href="{{ url()->previous() }}"> <i class="bx bx-arrow-back bx-fade-left-hover"> </i></a> Order Details</h4>
  </div>
  <hr />

  <div class="row">

    <table class="table table-bordered">
      <tr>
        <td width="100px"><strong>Name </strong></td>
        <td>{{ $user->name }}</td>
      </tr>
      <tr>
        <td><strong>No KP </strong> </td>
        <td>{{ $user->username }}</td>
      </tr>
      <tr>
        <td><strong>No SMPP </strong> </td>
        <td>{{ $user->nosmpp }}</td>
      </tr>
      <tr>
        <td><strong>Status </strong></td>
        <td>{{ strtoupper($user->status) }}</td>
      </tr>
      <tr>
        <td><strong>Date </strong></td>
        <td>
          @foreach($user->orders as $order)
            {{ $order->created_at }}
          @endforeach
        </td>
      </tr>
    </table>

    <form method="POST" action="{{ route('user.order') }}"> 
      @csrf
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

      <div align="right">
        <a href="#" class="btn btn-primary btn-sm" id="btnSubmit">
          <i class="fa-solid fa-print"> </i> 
          Print
        </a>
      </div>

    </form>
  </div>

</div>


@endsection