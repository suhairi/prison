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
            <a class="btn btn-primary btn-sm" href="{{ route('admin.orderPdf', ['id' => Auth::user()->id]) }}"><i class="fa fa-solid fa-file-pdf"> </i> Export All to PDF</a>
            &nbsp;&nbsp;
            @if($locker->lock == 'no')
              <a class="btn btn-warning btn-sm" href="{{ route('admin.lockOrder') }}"><i class="bx bx-lock-open-alt"> </i> Lock Order</a>
            @else
              &nbsp;&nbsp;
              <a class="btn btn-danger btn-sm disabled" href="#"><i class="bx bx-lock-alt"> </i> Order Locked!!</a>
            @endif

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
          <th>No KP</th>
          <th>Tarikh Oder</th>         
          <th>Options</th>         
        </thead>
        @foreach($orders as $order) <!-- ($users = $order) -->
          <tr>
            <td valign="middle">{{ $loop->iteration }}</td>
            <td valign="middle"><a href="{{ route('admin.showOrdered', ['id' => $order->users->id]) }}" >{{ strtoupper($order->users->name) }}</a></td>
            <td valign="middle">{{ $order->users->username }}</td>
            <td valign="middle">{{ $order->updated_at->format('d-m-Y') }}</td>
            <td valign="middle">
              <a class="btn btn-primary btn-sm" href="{{ route('admin.orderPdf', ['id' => $order->users->id]) }}"><i class="fa fa-solid fa-file-pdf"> </i> Export to PDF</a>
            </td>
          </tr>
        @endforeach
      </table>

      <div class="row">
        <div class="mb-3">
          {!! $orders->links() !!}
        </div>
      </div>
      

    </div>    
  </div>
</div>


@endsection