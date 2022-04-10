@extends('layouts.app')

@section('content')

<div class="row">

  @include('layouts.messages')
  <div class="row">
    <div class="mb-3">
      <h4> User Ordered Amount Over RM 100</h4>
    </div>
  </div>
  <hr />

  <div class="row">
    <div class="mb-3">

      <table class="table table-bordered table-striped table-hover">
        <thead>
          <th>Bil</th>
          <th>Name</th>
          <th>Username</th>
          <th>Role</th>         
          <th>Options</th>         
        </thead>
        @foreach($orderFiltered as $order)
          <tr>
            <td valign="middle">{{ $loop->iteration }}</td>
            <td valign="middle"><a href="{{ route('admin.showOrdered', ['id' => $order->users->id]) }}" >{{ strtoupper($order->users->name) }}</a></td>
            <td valign="middle">{{ $order->users->username }}</td>
            <td valign="middle">{{ strtoupper($order->users->role) }}</td>
            <td valign="middle">
              <a class="btn btn-primary btn-sm" href="{{ route('admin.orderPdf', ['id' => $order->users->id]) }}"><i class="fa fa-solid fa-file-pdf"> </i> Export to PDF</a>
            </td>
          </tr>
        @endforeach
      </table>

      <div class="row">
        <div class="mb-3">
          <!-- {!! $orderFiltered->links() !!} -->
        </div>
      </div>
      

    </div>    
  </div>
</div>


@endsection