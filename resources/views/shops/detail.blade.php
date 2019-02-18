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
		<div class="col-md-4 single-right-left ">
			<div class="grid images_3_of_2">
				<div class="flexslider">

					<ul class="slides">
						@if(isset($data['images']))
						@foreach($data['images'] as $image)
						<li data-thumb="{{asset('/storage')}}/{{$image['image']}}">
							<div class="thumb-image"> <img src="{{asset('/storage')}}/{{$image['image']}}" data-imagezoom="true" class="img-responsive"> </div>
						</li>
						@endforeach
						@else
						<li data-thumb="https://i.vimeocdn.com/portrait/1274237_300x300">
							<div class="thumb-image"> <img src="https://i.vimeocdn.com/portrait/1274237_300x300" data-imagezoom="true" class="img-responsive"> </div>
						</li>
						@endif
					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="col-md-8 single-right-left simpleCart_shelfItem">
			<h3>{{$data['product']['name']}}</h3><br>
			<h6 id="size-code">{{$data['product']['code']}}</h6>
			<div class="rating1">
				<ul class="stars">
					<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
					<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
					<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
					<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
					<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
				</ul>
			</div>
			<p><span class="item_price">{{number_format($data['product']['sale_price'])}} VNĐ</span>
			</p>
			<div class="occasional">
				<h5>Color : </h5>
				<div style="height: 50px;width:50px;background-color: {{$data['product']['color']}}">
				</div>
			</div>
			
			<div class="color-quality">
				<div class="color-quality-right">
					<h5 style="color: #AA0000">Brand : {{$data['brand']['name']}}</h5>
				</div>
			</div>

			<div class="occasional">
				<h5 style="color: #003366">Total Quantity : {{$data['total_quantity']}} shoes</h5>
			</div>

			<div class="occasional">
				<h5>Buy Quantity : <p id="quantity-remaining"></p></h5>
				<div class="quantity" id="div-quantity">
					<h6>Select size to see remaining quantity</h6>
				</div>
			</div>
			
			
			<div class="occasional" id="myDiv">
				<h5>Sizes :</h5>
				<input type="hidden" name="product_id" id="product_id" value="{{$data['product']['id']}}">
				@foreach($data['sizes'] as $size)
				<div class="colr ert">
					<label class="radio"><input class="radio_btn" data-url="{{asset('/user/cart/findsize')}}/{{$size['id']}}" size_id="{{$size['id']}}" type="radio" name="size" value="34"><i></i>{{$size['size']}}</label>
				</div>

				@endforeach
				<div class="clearfix"> </div>
			</div>
			<div class="occasion-cart">
				<div class="shoe single-item single_page_b">
					<button type="button" color-code="{{$data['product']['color']}}" title="Add to cart" data-toggle="tooltip" class="btn btn-primary" id="btn-add2cart" data-url="{{asset('/user/cart')}}/{{$data['product']['id']}}">Add to cart</button>
				</div>

			</div>
			<ul class="social-nav model-3d-0 footer-social social single_page">
				<li class="share">Share On : </li>
				<li>
					<a href="#" class="facebook">
						<div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
						<div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div>
					</a>
				</li>
				<li>
					<a href="#" class="twitter">
						<div class="front"><i class="fa fa-twitter" aria-hidden="true"></i></div>
						<div class="back"><i class="fa fa-twitter" aria-hidden="true"></i></div>
					</a>
				</li>
				<li>
					<a href="#" class="instagram">
						<div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
						<div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div>
					</a>
				</li>
				<li>
					<a href="#" class="pinterest">
						<div class="front"><i class="fa fa-linkedin" aria-hidden="true"></i></div>
						<div class="back"><i class="fa fa-linkedin" aria-hidden="true"></i></div>
					</a>
				</li>
			</ul>

		</div>
		<div class="clearfix"> </div>
		<!--/tabs-->
		<div class="responsive_tabs">
			<div id="horizontalTab">
				<ul class="resp-tabs-list">
					<li>Description</li>
					<li>Reviews</li>
					<li>Information</li>
				</ul>
				<div class="resp-tabs-container">
					<!--/tab_one-->
					<div class="tab1">

						<div class="single_page">
							<p>{{$data['product']['description']}}</p>
						</div>
					</div>
					<!--//tab_one-->
					<div class="tab2">

						<div class="single_page">
							<div class="bootstrap-tab-text-grids">
								<div class="bootstrap-tab-text-grid">
									<div class="bootstrap-tab-text-grid-left">
										<img src="images/t1.jpg" alt=" " class="img-responsive">
									</div>
									<div class="bootstrap-tab-text-grid-right">
										<ul>
											<li><a href="#">Admin</a></li>
											<li><a href="#"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</a></li>
										</ul>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elPellentesque vehicula augue eget.Ut enim ad minima veniam,
											quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis
										autem vel eum iure reprehenderit.</p>
									</div>
									<div class="clearfix"> </div>
								</div>
								<div class="add-review">
									<h4>add a review</h4>
									<form action="#" method="post">
										<input type="text" name="Name" required="Name">
										<input type="email" name="Email" required="Email">
										<textarea name="Message" required=""></textarea>
										<input type="submit" value="SEND">
									</form>
								</div>
							</div>

						</div>
					</div>
					<div class="tab3">

						<div class="single_page">
							<h6>{{$data['product']['name']}}</h6>
							{!!$data['product']['info']!!}
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--//tabs-->
		<!-- /new_arrivals -->
		{{-- <div class="new_arrivals">
			<h3>Featured Products</h3>
			<!-- /womens -->
			<div class="col-md-3 product-men women_two">
				<div class="product-shoe-info shoe">
					<div class="men-pro-item">
						<div class="men-thumb-item">
							<img src="images/s4.jpg" alt="">
							<div class="men-cart-pro">
								<div class="inner-men-cart-pro">
									<a href="single.html" class="link-product-add-cart">Quick View</a>
								</div>
							</div>
							<span class="product-new-top">New</span>
						</div>
						<div class="item-info-product">
							<h4>
								<a href="single.html">Shuberry Heels </a>
							</h4>
							<div class="info-product-price">
								<div class="grid_meta">
									<div class="product_price">
										<div class="grid-price ">
											<span class="money ">$575.00</span>
										</div>
									</div>
									<ul class="stars">
										<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
										<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
										<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
										<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
										<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
									</ul>
								</div>
								<div class="shoe single-item hvr-outline-out">
									<form action="#" method="post">
										<input type="hidden" name="cmd" value="_cart">
										<input type="hidden" name="add" value="1">
										<input type="hidden" name="shoe_item" value="Shuberry Heels">
										<input type="hidden" name="amount" value="575.00">
										<button type="submit" class="shoe-cart pshoe-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>

										<a href="#" data-toggle="modal" data-target="#myModal1"></a>
									</form>

								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 product-men women_two">
				<div class="product-shoe-info shoe">
					<div class="men-pro-item">
						<div class="men-thumb-item">
							<img src="images/s5.jpg" alt="">
							<div class="men-cart-pro">
								<div class="inner-men-cart-pro">
									<a href="single.html" class="link-product-add-cart">Quick View</a>
								</div>
							</div>
							<span class="product-new-top">New</span>
						</div>
						<div class="item-info-product">
							<h4>
								<a href="single.html">Red Bellies </a>
							</h4>
							<div class="info-product-price">
								<div class="grid_meta">
									<div class="product_price">
										<div class="grid-price ">
											<span class="money ">$325.00</span>
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
									<form action="#" method="post">
										<input type="hidden" name="cmd" value="_cart">
										<input type="hidden" name="add" value="1">
										<input type="hidden" name="shoe_item" value="Red Bellies">
										<input type="hidden" name="amount" value="325.00">
										<button type="submit" class="shoe-cart pshoe-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>

										<a href="#" data-toggle="modal" data-target="#myModal1"></a>
									</form>

								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 product-men women_two">
				<div class="product-shoe-info shoe">
					<div class="men-pro-item">
						<div class="men-thumb-item">
							<img src="images/s7.jpg" alt="">
							<div class="men-cart-pro">
								<div class="inner-men-cart-pro">
									<a href="single.html" class="link-product-add-cart">Quick View</a>
								</div>
							</div>
							<span class="product-new-top">New</span>
						</div>
						<div class="item-info-product">
							<h4>
								<a href="single.html">Running Shoes</a>
							</h4>
							<div class="info-product-price">
								<div class="grid_meta">
									<div class="product_price">
										<div class="grid-price ">
											<span class="money ">$875.00</span>
										</div>
									</div>
									<ul class="stars">
										<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
										<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
										<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
										<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
										<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
									</ul>
								</div>
								<div class="shoe single-item hvr-outline-out">
									<form action="#" method="post">
										<input type="hidden" name="cmd" value="_cart">
										<input type="hidden" name="add" value="1">
										<input type="hidden" name="shoe_item" value="Running Shoes">
										<input type="hidden" name="amount" value="875.00">
										<button type="submit" class="shoe-cart pshoe-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>

										<a href="#" data-toggle="modal" data-target="#myModal1"></a>
									</form>

								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 product-men women_two">
				<div class="product-shoe-info shoe">
					<div class="men-pro-item">
						<div class="men-thumb-item">
							<img src="images/s8.jpg" alt="">
							<div class="men-cart-pro">
								<div class="inner-men-cart-pro">
									<a href="single.html" class="link-product-add-cart">Quick View</a>
								</div>
							</div>
							<span class="product-new-top">New</span>
						</div>
						<div class="item-info-product">
							<h4>
								<a href="single.html">Sukun Casuals</a>
							</h4>
							<div class="info-product-price">
								<div class="grid_meta">
									<div class="product_price">
										<div class="grid-price ">
											<span class="money ">$505.00</span>
										</div>
									</div>
									<ul class="stars">
										<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
										<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
										<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
										<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
										<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
									</ul>
								</div>
								<div class="shoe single-item hvr-outline-out">
									<form action="#" method="post">
										<input type="hidden" name="cmd" value="_cart">
										<input type="hidden" name="add" value="1">
										<input type="hidden" name="shoe_item" value="Sukun Casuals">
										<input type="hidden" name="amount" value="505.00">
										<button type="submit" class="shoe-cart pshoe-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>

										<a href="#" data-toggle="modal" data-target="#myModal1"></a>
									</form>

								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>

			<!-- //womens -->
			<div class="clearfix"></div>
		</div> --}}
		<!--//new_arrivals-->


	</div>
</div>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('/shop/css/jquery-ui1.css')}}">
<link rel="stylesheet" href="{{asset('/shop/css/flexslider.css')}}" type="text/css" media="screen" />
<link href="{{asset('/shop/css/easy-responsive-tabs.css')}}" rel='stylesheet' type='text/css' />
@endsection

@section('script')
<script type="text/javascript">
	function qtyPlus(remain_qty){
		var current_quantity = $('#quantity-input').val();
		var quantity = parseInt(current_quantity)+1;
		if (quantity > remain_qty) {
			toastr.warning('Limit in stock!')
		} else {
			$('#quantity-input').attr('value', quantity);
		}	
	}

	function qtyMinus(remain_qty){
		var current_quantity = $('#quantity-input').val();
		if (current_quantity <= 1) {
			toastr.warning('At least one pair of shoes!')
		} else {
			var quantity = parseInt(current_quantity)-1;

			$('#quantity-input').attr('value', quantity);
		}
		
	}
	
</script>
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
	<!-- single -->
	<script src="{{asset('/shop/js/imagezoom.js')}}"></script>
	<!-- single -->
	<!-- script for responsive tabs -->
	<script src="{{asset('/shop/js/easy-responsive-tabs.js')}}"></script>
	<script>
		$(document).ready(function () {
			$('#horizontalTab').easyResponsiveTabs({
				type: 'default', //Types: default, vertical, accordion           
				width: 'auto', //auto or any width like 600px
				fit: true, // 100% fit in a container
				closed: 'accordion', // Start closed if in accordion view
				activate: function (event) { // Callback function if tab is switched
					var $tab = $(this);
					var $info = $('#tabInfo');
					var $name = $('span', $info);
					$name.text($tab.text());
					$info.show();
				}
			});
			$('#verticalTab').easyResponsiveTabs({
				type: 'vertical',
				width: 'auto',
				fit: true
			});
		});
	</script>
	<!-- FlexSlider -->
	<script src="{{asset('/shop/js/jquery.flexslider.js')}}"></script>
	<script>
		// Can also be used with $(document).ready()
		$(window).load(function () {
			$('.flexslider').flexslider({
				animation: "slide",
				controlNav: "thumbnails"
			});
		});
	</script>
	<!-- //FlexSlider-->
	@endsection