@extends('layouts.app')

@section('content')

    <div class="row">

        @include('layouts.messages')
        <h3>Products List</h3>

        <hr />

        <div class="row">
            <div class="mb-3">
                <table class="table table-striped table-hover">
                <thead>
                  <th>Bil</th>
                  <th>Product Name</th>
                  <th>Price</th>
                  <th>Options</th>         
                </thead>
                @foreach($products as $product)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ strtoupper($product->name) }}</td>
                    <td>{{ number_format($product->price, 2) }}</td>
                    <td>[ <a href="">Edit</a> ] [ <a href="">Delete</a> ]</td>
                  </tr>
                @endforeach
              </table>
              <div class="container">
                <div class="d-flex justify-content-center">
                  {{ $products->render() }}
                </div>        
              </div>
                
            </div>
        </div>

    </div>

@endsection
