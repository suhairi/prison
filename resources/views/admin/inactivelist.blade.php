@extends('layouts.app')

@section('content')

<div class="row">

  @include('layouts.messages')
  <div class="row">
      <h4>Inactive Users List</h4>
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
              <a href="{{ route('admin.setActive', ['id' => $user->id]) }}"><button type="button" class="btn btn-success btn-sm">Activate</button></a>
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