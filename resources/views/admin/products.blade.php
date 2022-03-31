@extends('layouts.app')

@section('content')

    <div class="row">

        @include('layouts.messages')

        <div class="row">
          <h4>Products List</h4>
        </div>       

        <hr />

        <div class="row">
            <div class="mb-3">
                <table class="table table-striped table-hover">
                <thead>
                  <th>Bil</th>
                  <th>Product Name</th>
                  <th>Price</th>
                  <th align="center">Options</th>         
                </thead>
                @foreach($products as $product)
                  <tr>
                    <td valign="middle">{{ $loop->iteration }}</td>
                    <td valign="middle">{{ strtoupper($product->name) }}</td>
                    <td valign="middle">{{ number_format($product->price, 2) }}</td>
                    <td valign="middle" align="center">
                      <button type="button" class="btn btn-warning btn-sm" href="#">Edit</button>
                      <button type="button" class="btn btn-danger btn-sm" href="#">Delete</button>
                    </td>
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
