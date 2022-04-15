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
            <div class="d-flex justify-content-end mb-4">
              <a class="btn btn-primary btn-sm" href="{{ route('admin.registerproducts') }}"><i class='bx bx-qr-scan'> </i> Add Product</a>
            </div>
          </div>
        </div> 
        <hr />
        

        <div class="row">
            <div class="mb-3">
                <div class="d-flex justify-content-end mb-4">
                  <a class="btn btn-primary btn-sm" href="{{ route('admin.productsPdf') }}"><i class="fa fa-solid fa-file-pdf"> </i> Export All to PDF</a>
                </div>
                <div class="alert alert-warning">Edit/Deactivate sebelum order baru dibuat.</div>
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
                    <td valign="middle">
                      <a href="{{ route('admin.editProduct', ['id' => $product->id]) }}"> <button type="button" class="btn btn-warning btn-sm"> <i class='bx bx-edit-alt bx-spin-hover'> </i> Edit</button></a>
                      @if($product->status == 'active')
                        <a href="{{ route('admin.deactivateProduct', ['id' => $product->id]) }}"> <button type="button" class="btn btn-danger btn-sm"> <i class="bx bx-trash bx-spin-hover"> </i> Deactivate </button>
                      @else
                        <a href="{{ route('admin.activateProduct', ['id' => $product->id]) }}"> <button type="button" class="btn btn-success btn-sm"> <i class="bx bx-trash bx-spin-hover"> </i> Activate </button>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </table>                
            </div>
            
        </div>
        <div class="row">
          <div class="mb-3">
            {!! $products->links() !!}
          </div>
        </div>

    </div>

@endsection
