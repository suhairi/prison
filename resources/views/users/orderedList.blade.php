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
        <td>{{ Auth::user()->name }} </td>
      </tr>
      <tr>
        <td><strong>No KP </strong> </td>
        <td>{{ Auth::user()->username }}</td>
      </tr>
      <tr>
        <td><strong>No SMPP </strong> </td>
        <td>{{ Auth::user()->nosmpp }}</td>
      </tr>
      <tr>
        <td><strong>Status </strong></td>
        <td>{{ strtoupper(Auth::user()->status) }}</td>
      </tr>

    </table>

    <table class="table table-bordered table-striped table-hover" id="tblProducts">
      <thead>
        <th>Bil</th>
        <th>Bulan</th>
      </thead>
      <?php $grandTotal = 0; ?>
      @foreach($orders as $order)
        <tbody>
          <tr>
            <td width="10px" valign="middle" align="center">{{ $loop->iteration }}</td>
            <td width="200px" valign="middle"><a href="{{ route('user.userShowOrdered', ['id' => $order->id]) }}">{{ $order->bulanTahun }}</a></td>
          </tr>
        </tbody>
      @endforeach        
    </table>

  </div>

</div>


@endsection