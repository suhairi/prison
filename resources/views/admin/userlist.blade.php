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
            <td valign="middle">{{ $loop->iteration }}</td>
            <td valign="middle">{{ strtoupper($user->name) }}</td>
            <td valign="middle">{{ $user->username }}</td>
            <td valign="middle">{{ strtoupper($user->role) }}</td>
            <td valign="middle">
              <button type="button" class="btn btn-warning btn-sm" href="#">Edit</button>
              <button type="button" class="btn btn-danger btn-sm" href="#">Delete</button>
            </td>
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