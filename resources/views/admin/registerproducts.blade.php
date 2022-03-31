@extends('layouts.app')

@section('content')

    <div class="row">

        @include('layouts.messages')

        <div class="row">
            <h3>Register a Grocery Product</h3>
        </div>
        <hr />

        <div class="row">
            <form method="POST" action="{{ route('admin.registerproducts') }}">
                @csrf

                <div class="mb-3">
                    <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus placeholder="Product Name" />
                </div>
                <div class="mb-3">
                    <input id="price" class="form-control" type="number" step=0.01 name="price" :value="old('price')" required placeholder="Price" />
                </div>             
                <button class="btn btn-primary" type=submit>Register Product</button>

            </form>
        </div>
    </div>
        



    
                    
@endsection
