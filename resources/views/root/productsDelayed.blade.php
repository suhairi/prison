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
                <th align="center">Delayed</th>
              </thead>
              @foreach($productsDelayed as $productDelayed)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $productDelayed['name'] }}</td>
                  <td>{{ number_format($productDelayed['price'], 2) }}</td>
                  <td align="center">{{ strtoupper($productDelayed['pivot']['delayed']) }}</td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>   
       

    </div>

@endsection
