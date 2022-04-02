@extends('layouts.appPdf')

@section('content')

    <div class="container mt-6">
        <h2 class="text-left mb-3">Active Users List</h2>

        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-danger">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">No KP</th>
                    <th scope="col">No SMPP</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users ?? '' as $data)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $data->name }}</td>
                    <td width="100px">{{ $data->username }}</td>
                    <td width="100px">{{ $data->nosmpp }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>

@endsection
