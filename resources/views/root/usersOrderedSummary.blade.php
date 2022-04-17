@extends('layouts.app')

@section('content')

<div class="row">

  @include('layouts.messages')
  <div class="row">
    <div class="mb-3">
      <h4> User Ordered List</h4>
    </div>
  </div>
  <hr />

  <div class="row">
    <div class="mb-3">

      
      
      <div class="d-flex justify-content-end mb-4">
            <a class="btn btn-primary btn-sm" href="{{ route('admin.orderedReportPdf') }}"><i class="fa fa-solid fa-file-pdf"> </i> Export All to PDF</a>
      </div>

      <table class="table table-bordered table-striped table-hover">
        <tr>
          <td width="150px" valign="middle"><strong>Total Users</strong></td>
          <td valign="middle"><a href="{{ route('admin.userList') }}">{{ $totalUsers }}</a></td>
        </tr>
        <tr>
          <td width="100px"><strong>Total Ordered</strong></td>
          <td><a href="{{ route('admin.orderedList') }}">{{ $totalOrdered }}</a></td>
        </tr>
        <tr>
          <td width="100px"><strong>Total Not Ordered</strong></td>
          <td><a href="{{ route('admin.usernotorderlist') }}">{{ $totalUsers - $totalOrdered }}</a></td>
        </tr>
      </table>
      
      <table class="table table-bordered table-striped table-hover">
        <thead>
          <th>Bil</th>
          <th>Name</th>
          <th>Username</th>
          <th>Section</th>         
          <th>Sum Amount Ordered</th>         
        </thead>
        <?php $grandTotal = 0; ?>
        @foreach($orders as $order) <!-- ($users = $order) -->
          <tr>
            <td valign="middle">{{ $loop->iteration }}</td>
            <td valign="middle"><a href="{{ route('admin.showOrdered', ['id' => $order->users->id]) }}" >{{ strtoupper($order->users->name) }}</a></td>
            <td valign="middle">{{ $order->users->username }}</td>
            <td valign="middle">{{ strtoupper($order->users->section) }}</td>
            <td valign="middle" align="right">
              <?php $subtotal = 0; ?>
              @foreach($order->products as $product)
                <?php 
                  $subtotal += $product->price * $product->pivot->quantity;
                ?>
              @endforeach
              <?php $grandTotal += $subtotal; ?>
              {{ number_format($subtotal, 2) }}              
            </td>
          </tr>
        @endforeach
        <tr>
            <td colspan="4" align="right"><strong>GrandTotal</strong></td>
            <td align="right"><strong>{{ number_format($grandTotal, 2) }}</strong></td>
      </table>
      

    </div>    
  </div>
</div>


@endsection