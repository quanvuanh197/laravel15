@extends('shops.master')

@section('banner_top')
banner_top innerpage
@endsection

@section('logo')
logo inner_page_log
@endsection

@section('content')
<div class="ads-grid_shop">
	<div class="shop_inner_inf">
		<div class="privacy about">
			<h3>Chec<span>kout</span></h3><br>

			<div class="checkout-right">
				<h4>Your shopping cart contains: <span>{{$data['count']}} shoes</span></h4><br>
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3>Cart Detail</h3>
						</div>
						<div class="panel-body">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Name</th>
										<th>Color</th>
										<th>Image</th>
										<th>Size</th>
										<th>Quantity (pair)</th>
										<th>Price/1 shoes (VNĐ)</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data['products'] as $product)
									<tr class="rem1">
										<td>{{$product->name}}</td>
										<td><div style="height: 60px;width: 60px;background-color: {{$product->options->color}};margin: 0 auto;"></div></td>
										<td><a href="single.html"><img src="{{asset('/storage')}}/{{$product->options->image}}" height="150px" width="150px"></a></td>
										<td>{{$product->options->size}}</td>
										<td>{{$product->qty}}</td>
										<td>{{number_format($product->price)}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="checkout-left">
				<div class="col-md-4">
					<div class="panel panel-default" style="text-align: center;">
						<div class="panel-heading">
							<h4>Total</h4>
						</div>
						<div class="panel-body">
							<h4>{{$data['total']}} VNĐ</h4>
						</div>
					</div>
				</div>
				
				<div class="col-md-8 address_form">
					<div class="panel panel-default">
						<div class="panel-heading" style="text-align: center;">
							<h3>Add a new Details</h3>
						</div>
						<div class="panel-body">
							
							<section class="creditly-wrapper wrapper">
								<div class="information-wrapper">
									@if(isset($data['customer_info']))
									<form method="post" id="form-pay-login">
										<div class="first-row form-group">
											<div class="controls">
												<label class="control-label">Full name: </label>
												<input class="billing-address-name form-control" type="text" name="name" id="name-login" value="{{$data['customer_info']['name']}}">
											</div>
											<div class="controls">
												<label class="control-label">Mobile number:</label>
												<input class="form-control" style="padding: 5px;padding-left: 9px" type="number" id="phone-login" name="phone" value="{{$data['customer_info']['phone']}}">
											</div>
											<div class="card_number_grids">
												<div class="card_number_grid_right">
													<label class="control-label">Email: </label>
													<input class="billing-address-name form-control" type="email" name="email" id="email-login" value="{{$data['customer_info']['email']}}">
												</div>
												<div class="card_number_grid_right">
													<label class="control-label">Adress: </label>
													<input class="billing-address-name form-control" type="text" name="address" id="address-login" value="{{$data['customer_info']['address']}}">
												</div>
												<div class="clear"> </div>
											</div>
										</div>
									</form>
									
									@else
									<form method="post" id="form-pay-not-login">
										<div class="first-row form-group">
											<div class="controls">
												<label class="control-label">Full name: </label>
												<input class="billing-address-name form-control" type="text" name="name" id="name-not-login">
											</div>
											<div class="controls">
												<label class="control-label">Mobile number:</label>
												<input type="number" class="form-control" style="padding: 5px;padding-left: 9px" id="phone-not-login" >
											</div>
											<div class="card_number_grids">
												<div class="card_number_grid_right">
													<label class="control-label">Email: </label>
													<input class="billing-address-name form-control" type="email" name="email" id="email-not-login">
												</div>
												<div class="card_number_grid_right">
													<label class="control-label">Adress: </label>
													<input class="billing-address-name form-control" type="text" name="address" id="address-not-login">
												</div>
												<div class="clear"> </div>
											</div>
										</div>
									</form>

									@endif
								</div>
							</section>
							
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="panel panel-default" style="text-align: center;">
						<div class="panel-heading">
							<h4>Tax (21%)</h4>
						</div>
						<div class="panel-body">
							<h4>{{$data['tax']}} VNĐ</h4>
						</div>
					</div>
				</div>

				<div class="checkout-right-basket col-md-4" align="center">

					@if(isset($data['customer_info']))

					<a type="submit" id="submit-login" data-url="{{asset('/user/cart/payment')}}" class="btn btn-primary">Order </a>

					@else

					<a type="submit" id="submit-not-login" data-url="{{asset('/user/cart/payment')}}" class="btn btn-primary">Order </a>

					@endif

				</div>
				
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
</div>
@endsection