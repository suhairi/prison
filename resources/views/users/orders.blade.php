@extends('layouts.app')

@section('content')

<div class="row">
	@include('layouts.messages')
	<div class="row">
		<h4>Order</h4>
	</div>
	<hr />

	<div class="row">
		<form method="POST" action="{{ route('user.order') }}"> 
			@csrf
			<input type="hidden" name="countProducts" value="{{ count($products) }}">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<th>Bil</th>
					<th>Products</th>
					<th>Price (RM)</th>
					<th>Quantity</th>
					<th>Options</th>
				</thead>
				@foreach($products as $product)
					<tr>
						<td valign="middle"> - {{ $loop->iteration }}</td>
						<td valign="middle">{{ $product->name }}</td>
						<td align="right" valign="middle">{{ number_format($product->price, 2) }}</td>
						<td width="10%">
							<input id="quantity[{{ $loop->iteration }}]" class="form-control form-control-sm w-10" type="number" step=1 name="quantity" value="0" required placeholder="Quantity" />
						</td>
						<td align="center">
							<input type="checkbox" name="{{ $product->id }}" />
						</td>
					</tr>
				@endforeach
				<tr>
					<td colspan="3" align="right"><strong>JUMLAH BESAR (RM)</strong></td>
					<td align="right"><strong>100.00</strong></td>
					<td>&nbsp;</td>
				</tr>
			</table>

		</form>
	</div>

	<script>
		$(document).ready(function(){
		  alert('here');
		});
	</script>


</div>


@endsection