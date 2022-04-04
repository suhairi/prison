@extends('layouts.app')

@section('content')

<div class="row">

    @include('layouts.messages')
    <div class="row">

        <h4><a href="{{ url()->previous() }}"> <i class="bx bx-arrow-back bx-fade-left"> </i></a> Register a Product</h4>
    </div>
    <hr />

    <div class="row">
        <form method="POST" action="{{ route('admin.registerproducts') }}">
            @csrf

            <div class="mb-3">
                <input id="name" class="form-control form-control-sm" type="text" name="name" :value="old('name')" required autofocus placeholder="Product Name" />
            </div>
            <div class="mb-3">
                <input id="price" class="form-control form-control-sm" type="number" step=0.01 name="price" value="old('price')" required placeholder="Price" />
            </div>             
            <button class="btn btn-primary btn-sm" type=submit>
                <span data-feather="file-plus"></span> 
                Register Product
            </button>

        </form>
    </div>
</div>
  
                    
@endsection
