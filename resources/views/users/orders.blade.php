@extends('layouts.app')

@section('content')

<?php use Carbon\Carbon; ?>

<div class="row">
	@include('layouts.messages')
	<div class="row">
		<h4>Order</h4>
	</div>
	<hr />

	<div class="row">

		<table class="table table-bordered">
			<tr>
				<td width="25%"><strong>Name </strong></td>
				<td>{{ $user->name }}</td>
			</tr>
			<tr>
				<td><strong>No KP </strong> </td>
				<td>{{ $user->username }}</td>
			</tr>
			<tr>
				<td><strong>No SMPP </strong> </td>
				<td>{{ $user->nosmpp }}</td>
			</tr>
			<tr>
				<td><strong>Status </strong></td>
				<td>{{ strtoupper($user->status) }}</td>
			</tr>			
			@if($ordered)
				<tr>
					<td><strong>Date </strong></td>
					<td>{{ $order->created_at }}</td>
				</tr>
				<tr>
					<td><strong>Order </strong></td>
					<td><font color="green"><strong><a href="{{ route('user.userShowOrdered', ['id' => $order->id]) }}"> Ordered!</a></strong></font></td>
				</tr>
			@else
				<tr>
					<td><strong>Date </strong></td>
					<td>{{ Carbon::now() }}</td>
				</tr>
			@endif
			@if($locker->lock == 'yes')
				<tr>
					<td><strong>Message </strong></td>
					<td class="alert alert-danger"><strong>Order has been locked!</strong></td>
				</tr>
			@endif

		</table>

		@if(!$ordered && $locker->lock == 'no')
			<form method="POST" action="{{ route('user.order') }}"> 
				@csrf
				<input type="hidden" name="countProducts" value="{{ count($products) }}">
				<table class="table table-bordered table-striped table-hover" id="tblProducts">
					<thead>
						<th>Bil</th>
						<th>Products</th>
						<th>Price (RM)</th>
						<th>Quantity</th>
						<th>Subtotal</th>
					</thead>
					@foreach($products as $product)
						<tbody>
							<tr>
								<td valign="middle" align="center">{{ $loop->iteration }}</td>
								<td valign="middle">{{ $product->name }}</td>
								<td align="right" valign="middle">
									<input class="form-control form-control-sm text-align-right price" id="price" value="{{ number_format($product->price, 2) }}" name="price[{{ $product->id }}]" readonly>
								</td>
								<td width="10%">
									<input id="{{ $product->id }}" class="form-control form-control-sm w-10 qty" id="qty" type="number" step=1 name="qty[{{ $product->id }}]" value="0" required placeholder="Quantity" onClick="this.select();" />
								</td>
								<td align="right" valign="middle" width="10%">
									<input class="form-control form-control-sm text-align-right subtot" value="0.00" name="subtot" readonly>
								</td>
							</tr>
						</tbody>
					@endforeach
					<tfoot>
						<tr>
							<td colspan="4" align="right"><strong>JUMLAH BESAR (RM)</strong></td>
							<td align="right"><input name="grandTotal" class="grdtot" value="0" readonly></td>
						</tr>
					</tfoot>
				</table>
				<div align="right">
					<button type="submit" class="btn btn-primary btn-sm" id="btnSubmit">
		                <span data-feather="user-plus"></span> 
		                Make Order
		            </button>
	            </div>

			</form>
		@endif
	</div>

</div>


@endsection