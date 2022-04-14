@extends('layouts.appPdf')

@section('content')

    <div class="container mt-6">
        <h2 class="text-left mb-3">Products List</h2>

        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-danger">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products ?? '' as $product)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $product->name }}</td>
                    <td width="100px" align="right">{{ number_format($product->price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div align="center">
            <hr />
            <strong>END</strong> <br />
            <hr />
        </div>
    </div>

@endsection
