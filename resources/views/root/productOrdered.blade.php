@extends('layouts.app')

@section('content')

<?php use Carbon\Carbon; ?>

<div class="row">
  @include('layouts.messages')
  <div class="row">
    <h4> <a href="{{ url()->previous() }}"> <i class="bx bx-arrow-back bx-fade-left-hover"> </i></a> Products Ordered Summary</h4>
  </div>
  <hr />

  <div class="row">

    <div class="d-flex justify-content-end mb-4">
      <a class="btn btn-primary btn-sm" href="{{ route('admin.productOrderedSummaryPdf') }}"><i class="fa fa-solid fa-file-pdf"> </i> Export All to PDF</a>
    </div>

    <table class="table table-bordered table-striped table-hover" id="tblProducts" width="50%">
      <thead>
        <th>Bil</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
      </thead>
      <?php $grandTotal = 0; ?>
      @foreach($quantityProducts as $product)
        <?php
          $subtotal = $product['price'] * $product['quantity'];
          $grandTotal += $subtotal;
        ?>
        <tbody>
          <tr>
            <td width="10px" valign="middle" align="center">{{ $loop->iteration }}</td>
            <td width="200px" valign="middle">
                <a href="{{ route('root.productBelongs', ['id' => $product['id']]) }}">{{ $product['name'] }}</a>
                @if($productsDelayed->contains('id', $product['id']))
                  <font color=red><strong>(Delayed)</strong></font>
                @endif
            </td>
            <td width="200px" valign="middle" align="right">{{ number_format($product['price'], 2) }}</td>
            <td width="200px" valign="middle" align="center">{{ $product['quantity'] }}</td>
            <td width="200px" valign="middle" align="right">{{ number_format($subtotal, 2) }}</td>
          </tr>
        </tbody>
      @endforeach
        <tr>
          <td colspan="4" align="right"><strong>Grand Total </strong></td>
          <td align="right"><strong>{{ number_format($grandTotal, 2) }}</strong></td>
        </tr>
    </table>

  </div>

</div>


@endsection