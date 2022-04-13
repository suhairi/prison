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
      
        <div class="row">
            <div class="mb-3">
              <form method="POST" action="{{ route('hq.updateDelayProducts') }}">
              @csrf
              <table class="table table-striped table-hover">
                <thead>
                  <th>Bil</th>
                  <th>Product Name</th>
                  <th>Price</th>
                  <th align="center">Delay</th>         
                </thead>
                @foreach($products as $product)
                  <tr>
                    <td valign="middle">{{ $loop->iteration }}</td>
                    <td valign="middle">{{ strtoupper($product->name) }} {{ $product->id }}</td>
                    <td valign="middle">{{ number_format($product->price, 2) }}</td>
                    <td valign="middle">
                      <?php $checked = 'checked = false'; ?>
                      @foreach($productsDelayed as $productDelayed)
                        @if($product->id == $productDelayed['id'])
                          <?php $checked = 'checked = true'; break;?>
                        @else
                          <?php $checked = 'checked = false'; ?>
                        @endif
                      @endforeach
                      <input type="checkbox" name="delay[{{ $product->id }}]" {{ $checked }}> {{ $productDelayed['id'] }}
                    </td>
                  </tr>
                @endforeach                
              </table>
              <div class="d-flex justify-content-end mb-4">
                <button type="submit" class="btn btn-primary btn-sm">
                  <i class="bx bx-edit-alt"></i> 
                  Update Delay Products
                </button>
              </div>
              </form>  
            </div>
        </div>

    </div>

@endsection
