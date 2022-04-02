@extends('layouts.app')

@section('content')

<?php use Carbon\Carbon; ?>

<div class="row">
	@include('layouts.messages')
	<div class="row">
		<h4>User Not Order List</h4>
	</div>
	<hr />

	<div class="row">

		<table class="table table-bordered table-striped table-hover">
			<tr>
				<td width="150px"><strong>Total Users</strong></td>
				<td><a href="{{ route('admin.userList') }}">{{ $totalUsers }}</a></td>
			</tr>
			<tr>
				<td width="100px"><strong>Total Ordered</strong></td>
				<td><a href="#">{{ $totalOrdered }}</a></td>
			</tr>
			<tr>
				<td width="100px"><strong>Total Not Ordered</strong></td>
				<td><a href="{{ route('admin.usernotorderlist') }}">{{ count($users) }}</a></td>
			</tr>
			
			
		</table>
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<th>No</th>
				<th>Name</th>
				<th>No KP</th>
				<th>No SMPP</th>
				<th>Status</th>
			</thead>
			@foreach($users as $user)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->username }}</td>
					<td>{{ $user->nosmpp }}</td>
					<td>{{ strtoupper($user->status) }}</td>
				</tr>
			@endforeach
		</table>

	</div>

</div>

@endsection