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
						<td valign="middle" align="center">{{ $loop->iteration }}</td>
						<td valign="middle">{{ $product->name }}</td>
						<td align="right" valign="middle">
							<input class="form-control form-control-sm text-align-right price" value="{{ number_format($product->price, 2) }}" name="price" readonly>
						</td>
						<td width="10%">
							<input id="{{ $product->id }}" class="form-control form-control-sm w-10 qty" type="number" step=1 name="qty" value="0" required placeholder="Quantity" onClick="this.select();" />
						</td>
						<td align="right" valign="middle" width="10%">
							<input class="form-control form-control-sm text-align-right subtot" value="0.00" name="subtot" readonly>
						</td>

					</tbody>
				@endforeach
				<tfoot>
					<td colspan="4" align="right"><strong>JUMLAH BESAR (RM)</strong></td>
					<td align="right"><input name="" class="grdtot" value="" readonly></td>
				</tfoot>
			</table>

		</form>
	</div>

</div>


@endsection