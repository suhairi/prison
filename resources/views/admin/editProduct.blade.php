@extends('layouts.app')

@section('content')

<div class="row">

    @include('layouts.messages')
    <div class="row">

        <h4><a href="{{ url()->previous() }}"> <i class="bx bx-arrow-back bx-fade-left"> </i></a> Register a Product</h4>
    </div>
    <hr />

    <div class="row">
        <form method="POST" action="{{ route('admin.updateProduct') }}">
            @csrf

            <input type="hidden" name="id" value="{{ $product->id }}">
            <div class="mb-3">
                <label><strong>Product Name</strong></label>
                <input id="name" class="form-control form-control-sm" type="text" name="name" value="{{ $product->name }}" required />
            </div>
            <div class="mb-3">
                <label><strong>Price</strong></label>
                <input id="price" class="form-control form-control-sm" type="number" step=0.01 name="price" value="{{ number_format($product->price, 2) }}" required autofocus />
            </div>             
            <button class="btn btn-primary btn-sm" type=submit>
                <span data-feather="file-plus"></span> 
                Update Price
            </button>

        </form>
    </div>
</div>
  
                    
@endsection
