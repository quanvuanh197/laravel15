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
		<div class="panel panel-default" align="center">
			<div class="panel-heading">
				<h3>Bill Details</h3>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<div class="col-md-2">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4>Name</h4>
							</div>
							<div class="panel-body">
								{{$info_bill['name']}}
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4>Phone</h4>
							</div>
							<div class="panel-body">
								{{$info_bill['phone']}}
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4>Email</h4>
							</div>			
							<div class="panel-body">
								{{$info_bill['email']}}
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4>Address</h4>
							</div>	
							<div class="panel-body">
								{{$info_bill['address']}}
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4>Date</h4>
							</div>	
							<div class="panel-body">
								{{$info_bill['time']}}
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4>Bill Code</h4>
							</div>	
							<div class="panel-body">
								<h5>{{$info_bill['code']}}</h5>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4>Total</h4>
							</div>	
							<div class="panel-body">
								<h5>{{number_format($info_bill['total'])}} VNĐ</h5>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4>Tax</h4>
							</div>	
							<div class="panel-body">
								<h5>{{number_format($info_bill['tax'])}} VNĐ</h5>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4>Products</h4>
							</div>	
							<div class="panel-body">
								<table class="table table-hover" style="text-align: center;">
									<tr>
										<th>Name</th>
										<th>Color</th>
										<th>Image</th>
										<th>Size</th>
										<th>Quantity</th>
										<th>Price</th>
									</tr>
									@foreach($all_bill as $item)
									<tr>
										<td>{{$item['product_name']}}</td>
										<td><div style="height: 60px;width: 60px;background-color: {{$item['color']}};margin: 0 auto;"></div></td>
										<td><a href="single.html"><img src="{{asset('/storage')}}/{{$item['image']}}" height="150px" width="150px"></a></td>
										<td>{{$item['size']}}</td>
										<td>{{$item['quantity']}}</td>
										<td>{{number_format($item['price'])}}</td>
									</tr>
									@endforeach
								</table>
							</div>
						</div>
					</div>
					<div class="col-md-12" align="center">
						<button class="btn btn-primary" id="done-bill">Done</button>
					</div>
				</div>
			</div>
		</div>
		
		
	</div>
</div>
@endsection