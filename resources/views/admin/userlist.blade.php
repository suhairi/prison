@extends('layouts.app')

@section('content')

<div class="row">
  <h1>Users List</h1>

  <hr />

  <div class="row">
    <div class="mb-3">
      <table class="table table-striped table-hover">
        <thead>
          <th>Bil</th>
          <th>Nama</th>
          <th>Username</th>
          <th>Role</th>         
          <th>Options</th>         
        </thead>
        @foreach($users as $user)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ strtoupper($user->name) }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ strtoupper($user->role) }}</td>
            <td>[ <a href="">Edit</a> ] [ <a href="">Delete</a> ]</td>
          </tr>
        @endforeach
      </table>
      <div class="container">
        <div class="d-flex justify-content-center">
          {{ $users->render() }}
        </div>        
      </div>
      

    </div>    
  </div>
</div>


@endsection