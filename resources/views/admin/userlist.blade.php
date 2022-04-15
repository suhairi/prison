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
        <a class="btn btn-primary btn-sm" href="{{ route('admin.register') }}"><i class='bx bx-user-plus'> </i> Add a User</a>
      </div>
    </div>
  </div> 
  <hr />
  

  <div class="row">
    <div class="mb-3">
      <div class="alert alert-warning">Edit/Deactivate sebelum order baru dibuat.</div>
      <table class="table table-bordered table-striped table-hover">
        <tr>
          <td width="150px"><strong>Total User</strong></td>
          <td>{{ $totalUsers }}</td>
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
          <th>No KP</th>
          <th>Section</th>
          <th>Role</th>         
          <th>Options</th>         
        </thead>
        @foreach($users as $user)
          <tr>
            <td valign="middle">{{ $loop->iteration }}</td>
            <td valign="middle">{{ strtoupper($user->name) }}</td>
            <td valign="middle">{{ $user->username }}</td>
            <td valign="middle">{{ $user->section }}</td>
            <td valign="middle">{{ strtoupper($user->role) }}</td>
            <td valign="middle">
              <a href="{{ route('admin.editUser', ['id' => $user->id]) }}"><button type="button" class="btn btn-warning btn-sm"> <i class='bx bx-edit-alt bx-spin-hover'> </i> Edit</button></a>
              <a href="{{ route('admin.setInactive', ['id' => $user->id]) }}"><button type="button" class="btn btn-danger btn-sm"> <i class="bx bx-trash bx-spin-hover"> </i> Deactivate</button></a>
            </td>
          </tr>
        @endforeach
      </table>
      <div class="row">
          <div class="mb-3">
            {!! $users->links() !!}
          </div>
        </div>
      

    </div>    
  </div>
</div>


@endsection