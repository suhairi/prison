@extends('layouts.app')

@section('content')

<div class="row">

  @include('layouts.messages')
  <div class="row">
      <h4>Active Users List</h4>
  </div>
  <hr />

  <div class="row">
    <div class="mb-3">
      
      <div class="d-flex justify-content-end mb-4">
            <a class="btn btn-primary btn-sm" href="#"><i class="fa fa-solid fa-file-pdf"> </i> Export All to PDF</a>
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
            <td valign="middle"><a href="{{ route('admin.showOrdered', ['id' => $user->user_id]) }}" >{{ strtoupper($user->name) }}</a></td>
            <td valign="middle">{{ $user->username }}</td>
            <td valign="middle">{{ strtoupper($user->role) }}</td>
            <td valign="middle">
              <a class="btn btn-primary btn-sm" href="#"><i class="fa fa-solid fa-file-pdf"> </i> Export to PDF</a>
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