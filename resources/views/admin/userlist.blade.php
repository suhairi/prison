@extends('layouts.app')

@section('content')

<div class="row">

  @include('layouts.messages')
  <div class="row">
      <div class="mb-3">
        <h4>Active Users List</h4>
      </div>
  </div>
  <hr />
  <div class="row">
    <div class="mb-3">
      <div class="d-flex justify-content-end mb-4">
        <a class="btn btn-primary btn-sm" href="{{ route('admin.register') }}"><i class='bx bx-qr-scan'> </i> Add a User</a>
      </div>
    </div>
  </div> 
  <hr />
  

  <div class="row">
    <div class="mb-3">

      <table class="table table-bordered table-striped table-hover">
        <tr>
          <td width="150px"><strong>Total User</strong></td>
          <td>{{ count($users) }}</td>
        </tr>
        <tr>
          <td><strong>Active User</strong></td>
          <td><a href="{{ route('admin.userList') }}">{{ $totalActive }}</td>
        </tr>
        <tr>
          <td><strong>Inacative User</strong></td>
          <td><a href="{{ route('admin.inactivelist') }}">{{ $totalInActive }}</a></td>
        </tr>
        
      </table>
      
      <div class="d-flex justify-content-end mb-4">
            <a class="btn btn-primary btn-sm" href="{{ route('admin.usersPdf') }}"><i class="fa fa-solid fa-file-pdf"> </i> Export to PDF</a>
      </div>
      <table class="table table-bordered table-striped table-hover">
        <thead>
          <th>Bil</th>
          <th>Name</th>
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
              <a href="{{ route('admin.setInactive', ['id' => $user->id]) }}"><button type="button" class="btn btn-danger btn-sm">Inactive</button></a>
            </td>
          </tr>
        @endforeach
      </table>
      <div class="d-flex justify-content-center">
      </div>
      

    </div>    
  </div>
</div>


@endsection