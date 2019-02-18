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
		<!-- tittle heading -->

		<!-- //tittle heading -->
		<!-- product left -->
		<div class="side-bar col-md-3">
			<div class="search-hotel">
				<h3 class="agileits-sear-head">Search Here..</h3>
				<form action="#" method="post">
					<input type="search" placeholder="Product name..." name="search" required="">
					<input type="submit" value=" ">
				</form>
			</div>
			<!-- price range -->
			<div class="range">
				<h3 class="agileits-sear-head">Price range</h3>
				<ul class="dropdown-menu6">
					<li>

						<div id="slider-range"></div>
						<input type="text" id="amount" style="border: 0; color: #ffffff; font-weight: normal;" />
					</li>
				</ul>
			</div>
			<!-- //price range -->
			<!--preference -->
			<div class="left-side">
				<h3 class="agileits-sear-head">Occasion</h3>
				<ul>
					<li>
						<input type="checkbox" class="checked">
						<span class="span">Casuals</span>
					</li>
					<li>
						<input type="checkbox" class="checked">
						<span class="span">Party</span>
					</li>
					<li>
						<input type="checkbox" class="checked">
						<span class="span">Wedding</span>
					</li>
					<li>
						<input type="checkbox" class="checked">
						<span class="span">Ethnic</span>
					</li>
				</ul>
			</div>
			<!-- // preference -->
			<!-- discounts -->
			<div class="left-side">
				<h3 class="agileits-sear-head">Discount</h3>
				<ul>
					<li>
						<input type="checkbox" class="checked">
						<span class="span">5% or More</span>
					</li>
					<li>
						<input type="checkbox" class="checked">
						<span class="span">10% or More</span>
					</li>
					<li>
						<input type="checkbox" class="checked">
						<span class="span">20% or More</span>
					</li>
					<li>
						<input type="checkbox" class="checked">
						<span class="span">30% or More</span>
					</li>
					<li>
						<input type="checkbox" class="checked">
						<span class="span">50% or More</span>
					</li>
					<li>
						<input type="checkbox" class="checked">
						<span class="span">60% or More</span>
					</li>
				</ul>
			</div>
			<!-- //discounts -->
			<!-- reviews -->
			<div class="customer-rev left-side">
				<h3 class="agileits-sear-head">Customer Review</h3>
				<ul>
					<li>
						<a href="#">
							<i class="fa fa-star" aria-hidden="true"></i>
							<i class="fa fa-star" aria-hidden="true"></i>
							<i class="fa fa-star" aria-hidden="true"></i>
							<i class="fa fa-star" aria-hidden="true"></i>
							<i class="fa fa-star" aria-hidden="true"></i>
							<span>5.0</span>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-star" aria-hidden="true"></i>
							<i class="fa fa-star" aria-hidden="true"></i>
							<i class="fa fa-star" aria-hidden="true"></i>
							<i class="fa fa-star" aria-hidden="true"></i>
							<i class="fa fa-star-o" aria-hidden="true"></i>
							<span>4.0</span>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-star" aria-hidden="true"></i>
							<i class="fa fa-star" aria-hidden="true"></i>
							<i class="fa fa-star" aria-hidden="true"></i>
							<i class="fa fa-star-half-o" aria-hidden="true"></i>
							<i class="fa fa-star-o" aria-hidden="true"></i>
							<span>3.5</span>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-star" aria-hidden="true"></i>
							<i class="fa fa-star" aria-hidden="true"></i>
							<i class="fa fa-star" aria-hidden="true"></i>
							<i class="fa fa-star-o" aria-hidden="true"></i>
							<i class="fa fa-star-o" aria-hidden="true"></i>
							<span>3.0</span>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-star" aria-hidden="true"></i>
							<i class="fa fa-star" aria-hidden="true"></i>
							<i class="fa fa-star-half-o" aria-hidden="true"></i>
							<i class="fa fa-star-o" aria-hidden="true"></i>
							<i class="fa fa-star-o" aria-hidden="true"></i>
							<span>2.5</span>
						</a>
					</li>
				</ul>
			</div>
			<!-- //reviews -->
			<!-- deals -->
			<div class="deal-leftmk left-side">
				<h3 class="agileits-sear-head">Special Deals</h3>
				<div class="special-sec1">
					<div class="col-xs-4 img-deals">
						<img src="images/s4.jpg" alt="">
					</div>
					<div class="col-xs-8 img-deal1">
						<h3>Shuberry Heels</h3>
						<a href="single.html">$180.00</a>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="special-sec1">
					<div class="col-xs-4 img-deals">
						<img src="images/s2.jpg" alt="">
					</div>
					<div class="col-xs-8 img-deal1">
						<h3>Chikku Loafers</h3>
						<a href="single.html">$99.00</a>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="special-sec1">
					<div class="col-xs-4 img-deals">
						<img src="images/s1.jpg" alt="">
					</div>
					<div class="col-xs-8 img-deal1">
						<h3>Bella Toes</h3>
						<a href="single.html">$165.00</a>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="special-sec1">
					<div class="col-xs-4 img-deals">
						<img src="images/s5.jpg" alt="">
					</div>
					<div class="col-xs-8 img-deal1">
						<h3>Red Bellies</h3>
						<a href="single.html">$225.00</a>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="special-sec1">
					<div class="col-xs-4 img-deals">
						<img src="images/s3.jpg" alt="">
					</div>
					<div class="col-xs-8 img-deal1">
						<h3>(SRV) Sneakers</h3>
						<a href="single.html">$169.00</a>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<!-- //deals -->

		</div>
		<!-- //product left -->
		<!-- product right -->
		<div class="left-ads-display col-md-9">
			<div class="wrapper_top_shop" align="center">
				<div class="clearfix"></div>
				<!-- product-sec1 -->
				<div class="product-sec1">
					<!--/mens-->
					@foreach($datas as $data)
					<div class="col-md-4 product-men" style="margin-bottom: 20px;padding: 0px">
						<div class="product-shoe-info shoe" style="width: 260.844px;height: 365.844px;margin: 0">
							<div class="men-pro-item">
								<div class="men-thumb-item">
									@if(isset($data->image))
									<img src="{{asset('storage')}}/{{$data->image}}" alt="">
									@else
									<img src="https://i.vimeocdn.com/portrait/1274237_300x300" alt="">
									@endif
									<div class="men-cart-pro">
										<div class="inner-men-cart-pro">
											<a href="{{asset('/user/cart/detail')}}/{{$data->slug}}" class="link-product-add-cart">Quick View</a>
										</div>
									</div>
									<span class="product-new-top">New</span>
								</div>
								<div class="item-info-product">
									<h4 style="margin-top: 10px">
										<a href="{{asset('/user/cart/detail')}}/{{$data->slug}}">{{$data->name}} </a>
									</h4>
									<div class="info-product-price">
										<div class="grid_meta">
											<div class="product_price">
												<div class="grid-price ">
													<span class="money ">{{number_format($data->sale_price)}} VNĐ</span>
												</div>
											</div>
											<ul class="stars">
												<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
												<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
												<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
												<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
												<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
											</ul>
										</div>
										<div class="shoe single-item hvr-outline-out">
											
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					<div class="col-md-12" align="content">
						{{ $datas->links() }}
					</div>
					<!-- //mens -->
					<div class="clearfix"></div>

				</div>

				<!-- //product-sec1 -->
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('/shop/css/jquery-ui1.css')}}">
@endsection

@section('script')
<script type="text/javascript" src="{{asset('/shop/js/jquery-ui.js')}}"></script>
<script>
		//<![CDATA[ 
		$(window).load(function () {
			$("#slider-range").slider({
				range: true,
				min: 0,
				max: 9000,
				values: [50, 6000],
				slide: function (event, ui) {
					$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
				}
			});
			$("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));

		}); //]]>
	</script>
	@endsection