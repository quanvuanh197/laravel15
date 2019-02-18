<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Shoes Store</title>
	<!-- custom-theme -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Downy Shoes Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	
	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //custom-theme -->
	<link href="{{asset('/shop/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="{{asset('/shop/css/shop.css')}}" type="text/css" media="screen" property="" />
	<link href="{{asset('/shop/css/style7.css')}}" rel="stylesheet" type="text/css" media="all" />
	<link href="{{asset('/shop/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
	<!-- font-awesome-icons -->
	<link href="{{asset('/shop/css/font-awesome.css')}}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
	<link rel="stylesheet" type="text/css" href="{{asset('/shop/css/checkout.css')}}">
	<!-- //font-awesome-icons -->
	@yield('css')
	<link href="//fonts.googleapis.com/css?family=Montserrat:100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800"
	rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
	<style type="text/css">
	#delete-product{
		background-color: #d9534f;
		border: 0;
		color: white;
		height: 30px;
	}
	.value{
		width: 50px;
		background-color: white;
		color: black;
	}
	.colr{
		width:15%;
		margin-left: 20px;
	}
	th,td{
		text-align: center;
	}
	.top_nav_right{
		margin-top: 48px;
	}
	.navbar{
		border: 0;
	}
	.navbar-nav>li>a{
		height: 40px;
		line-height: 7px;
		font-size: 13px;
	}
	.navbar-default .navbar-nav > li > a{
		color: white;
	}
	h4{
		margin: 0;
		font-family: 'Arial', sans-serif;
	}
	.flex-control-thumbs li{
		margin-right: 3px;
		margin-top: 3px;
	}
	.flex-control-thumbs li:nth-child(4){
		margin-right: 3px;
		margin-top: 3px;
	}
</style>
</head>
<body>
	<input type="hidden" name="csrf" data="{{ csrf_token() }}">
	<!-- banner -->
	
	@if (Auth::guard('web')->user())
	
	<nav class="navbar navbar-default" style="margin-bottom: 0px;min-height: 40px;height: 40px">
		<div class="container-fluid" style="height: 40px;background-color: #212121;color: white">
			<ul class="nav navbar-nav" style="height: 40px">
				<li><a style="padding-top: 5px;padding-right: 5px"><img src="{{asset('storage')}}/{{Auth::guard('web')->user()->image}}" height="30px" width="30px"></a></li>&nbsp
				<li><a>{{ Auth::guard('web')->user()->name }}</a></li>
				<li class="pull-right" style="padding-top: 3px">
					<form action="{{route('logout')}}" method="post">
						@csrf
						<button class="btn btn-danger" type="submit"><span class="fa fa-power-off"></span></button>
					</form>
				</li>

			</ul>
		</div>
	</nav>
	
	@else
	
	<nav class="navbar navbar-default" style="margin-bottom: 0px;min-height: 40px;height: 40px">
		<div class="container-fluid" style="height: 40px;background-color: #212121;color: white">
			<ul class="nav navbar-nav" style="height: 40px">
				<li><a href="{{ route('login') }}" data-url="{{ asset('/user/cart/checklogin') }}" id="btn-login">Login</a></li>
				@include('/shops/check_login')
				<li><a href="#">Sign Up</a></li>
			</ul>
		</div>
	</nav>
	
	@endif	
	
	<div class="@yield('banner_top')" id="home">
		<div class="wrapper_top_w3layouts">

			<div class="header_agileits">
				<div class="@yield('logo')">
					<h1><a class="navbar-brand" href="{{route('shop')}}"><span>Quan</span> <i>Sneakers</i></a></h1>
				</div>
				<div class="overlay overlay-contentpush">
					<button type="button" class="overlay-close"><i class="fa fa-times" aria-hidden="true"></i></button>

					<nav>
						<ul>
							<li><a href="index.html" class="active">Home</a></li>
							<li><a href="about.html">About</a></li>
							<li><a href="404.html">Team</a></li>
							<li><a href="{{route('all')}}">Shop Now</a></li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
					</nav>
				</div>
				<div class="mobile-nav-button" style="margin-top: 87.2px">
					<button id="trigger-overlay" type="button"><i class="fa fa-bars" aria-hidden="true"></i></button>
				</div>
				<!-- cart details -->
				<div class="top_nav_right">
					<div class="shoecart shoecart2 cart cart box_1">
						<button class="top_shoe_cart" id="your-cart" data-url="{{asset('/user/cart')}}"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
					</div>
				</div>
				<!-- //cart details -->
				<!-- search -->
				<div class="search_w3ls_agileinfo">
					<div class="cd-main-header">
						<ul class="cd-header-buttons" style="margin-top: 40.4px">
							<li><a class="cd-search-trigger" href="#cd-search"> <span></span></a></li>
						</ul>
					</div>
					<div id="cd-search" class="cd-search">
						<form action="#" method="post">
							<input name="Search" type="search" placeholder="Click enter after typing...">
						</form>
					</div>
				</div>
				<!-- //search -->

				<div class="clearfix"></div>
			</div>
			@yield('slider')
		</div>
	</div>
	<!-- //banner -->
	<!-- /girds_bottom-->
	@yield('content')
	<!-- //grids_bottom2-->
	<!-- /Properties -->
	<div class="mid_slider_w3lsagile">
		<div class="col-md-3 mid_slider_text">
			<h5>Some More Shoes</h5>
		</div>
		<div class="col-md-9 mid_slider_info">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1" class=""></li>
					<li data-target="#myCarousel" data-slide-to="2" class=""></li>
					<li data-target="#myCarousel" data-slide-to="3" class=""></li>
				</ol>
				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<div class="row">
							<div class="col-md-3 col-sm-3 col-xs-3 slidering">
								<div class="thumbnail"><img src="{{asset('/shop/images/g1.jpg')}}" alt="Image" style="max-width:100%;"></div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3 slidering">
								<div class="thumbnail"><img src="{{asset('/shop/images/g2.jpg')}}" alt="Image" style="max-width:100%;"></div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3 slidering">
								<div class="thumbnail"><img src="{{asset('/shop/images/g3.jpg')}}" alt="Image" style="max-width:100%;"></div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3 slidering">
								<div class="thumbnail"><img src="{{asset('/shop/images/g4.jpg')}}" alt="Image" style="max-width:100%;"></div>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="row">
							<div class="col-md-3 col-sm-3 col-xs-3 slidering">
								<div class="thumbnail"><img src="{{asset('/shop/images/g5.jpg')}}" alt="Image" style="max-width:100%;"></div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3 slidering">
								<div class="thumbnail"><img src="{{asset('/shop/images/g6.jpg')}}" alt="Image" style="max-width:100%;"></div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3 slidering">
								<div class="thumbnail"><img src="{{asset('/shop/images/g2.jpg')}}" alt="Image" style="max-width:100%;"></div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3 slidering">
								<div class="thumbnail"><img src="{{asset('/shop/images/g1.jpg')}}" alt="Image" style="max-width:100%;"></div>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="row">
							<div class="col-md-3 col-sm-3 col-xs-3 slidering">
								<div class="thumbnail"><img src="{{asset('/shop/images/g1.jpg')}}" alt="Image" style="max-width:100%;"></div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3 slidering">
								<div class="thumbnail"><img src="{{asset('/shop/images/g2.jpg')}}" alt="Image" style="max-width:100%;"></div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3 slidering">
								<div class="thumbnail"><img src="{{asset('/shop/images/g3.jpg')}}" alt="Image" style="max-width:100%;"></div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3 slidering">
								<div class="thumbnail"><img src="{{asset('/shop/images/g4.jpg')}}" alt="Image" style="max-width:100%;"></div>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="row">
							<div class="col-md-3 col-sm-3 col-xs-3 slidering">
								<div class="thumbnail"><img src="{{asset('/shop/images/g1.jpg')}}" alt="Image" style="max-width:100%;"></div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3 slidering">
								<div class="thumbnail"><img src="{{asset('/shop/images/g2.jpg')}}" alt="Image" style="max-width:100%;"></div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3 slidering">
								<div class="thumbnail"><img src="{{asset('/shop/images/g3.jpg')}}" alt="Image" style="max-width:100%;"></div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3 slidering">
								<div class="thumbnail"><img src="{{asset('/shop/images/g4.jpg')}}" alt="Image" style="max-width:100%;"></div>
							</div>
						</div>
					</div>
				</div>
				<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
					<span class="fa fa-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
					<span class="fa fa-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
				<!-- The Modal -->

			</div>
		</div>

		<div class="clearfix"> </div>
	</div>
	<!--//banner -->

	<!-- /newsletter-->
	<div class="newsletter_w3layouts_agile">
		<div class="col-sm-6 newsleft">
			<h3>Sign up for Newsletter !</h3>
		</div>
		<div class="col-sm-6 newsright">
			<form action="#" method="post">
				<input type="email" placeholder="Enter your email..." name="email" required="">
				<input type="submit" value="Submit">
			</form>
		</div>

		<div class="clearfix"></div>
	</div>
	<!-- //newsletter-->
	<!-- footer -->
	<div class="footer_agileinfo_w3">
		<div class="footer_inner_info_w3ls_agileits">
			<div class="col-md-3 footer-left">
				<h2><a href="index.html"><span>Q</span>uan Sneaker </a></h2>
				<p>Lorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora.</p>
				<ul class="social-nav model-3d-0 footer-social social two">
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
			<div class="col-md-9 footer-right">
				<div class="sign-grds">
					<div class="col-md-4 sign-gd">
						<h4>Our <span>Information</span> </h4>
						<ul>
							<li><a href="index.html">Home</a></li>
							<li><a href="about.html">About</a></li>
							<li><a href="404.html">Services</a></li>
							<li><a href="404.html">Short Codes</a></li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
					</div>

					<div class="col-md-5 sign-gd-two">
						<h4>Store <span>Information</span></h4>
						<div class="address">
							<div class="address-grid">
								<div class="address-left">
									<i class="fa fa-phone" aria-hidden="true"></i>
								</div>
								<div class="address-right">
									<h6>Phone Number</h6>
									<p>+1 234 567 8901</p>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="address-grid">
								<div class="address-left">
									<i class="fa fa-envelope" aria-hidden="true"></i>
								</div>
								<div class="address-right">
									<h6>Email Address</h6>
									<p>Email :<a href="mailto:example@email.com"> mail@example.com</a></p>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="address-grid">
								<div class="address-left">
									<i class="fa fa-map-marker" aria-hidden="true"></i>
								</div>
								<div class="address-right">
									<h6>Location</h6>
									<p>Broome St, NY 10002,California, USA.

									</p>
								</div>
								<div class="clearfix"> </div>
							</div>
						</div>
					</div>
					<div class="col-md-3 sign-gd flickr-post">
						<h4>Flickr <span>Posts</span></h4>
						<ul>
							<li><a href="single.html"><img src="{{asset('/shop/images/t1.jpg')}}" alt=" " class="img-responsive" /></a></li>
							<li><a href="single.html"><img src="{{asset('/shop/images/t2.jpg')}}" alt=" " class="img-responsive" /></a></li>
							<li><a href="single.html"><img src="{{asset('/shop/images/t3.jpg')}}" alt=" " class="img-responsive" /></a></li>
							<li><a href="single.html"><img src="{{asset('/shop/images/t4.jpg')}}" alt=" " class="img-responsive" /></a></li>
							<li><a href="single.html"><img src="{{asset('/shop/images/t1.jpg')}}" alt=" " class="img-responsive" /></a></li>
							<li><a href="single.html"><img src="{{asset('/shop/images/t2.jpg')}}" alt=" " class="img-responsive" /></a></li>
							<li><a href="single.html"><img src="{{asset('/shop/images/t3.jpg')}}" alt=" " class="img-responsive" /></a></li>
							<li><a href="single.html"><img src="{{asset('/shop/images/t2.jpg')}}" alt=" " class="img-responsive" /></a></li>
							<li><a href="single.html"><img src="{{asset('/shop/images/t4.jpg')}}" alt=" " class="img-responsive" /></a></li>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="clearfix"></div>

			<p class="copy-right-w3ls-agileits">&copy 2018 Downy Shoes. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
		</div>
	</div>
	@include('/shops/view_bill_check')
</div>
<!-- //footer -->
<a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!-- js -->
<script type="text/javascript" src="{{asset('/shop/js/jquery-2.1.4.min.js')}}"></script>
<!-- //js -->
<!-- /nav -->
<script src="{{asset('/shop/js/modernizr-2.6.2.min.js')}}"></script>
<script src="{{asset('/shop/js/classie.js')}}"></script>
<script src="{{asset('/shop/js/demo1.js')}}"></script>
<!-- //nav -->
<!-- cart-js -->
{{-- <script src="{{asset('/shop/js/minicart.js')}}"></script>
<script>
	shoe.render();

	shoe.cart.on('shoe_checkout', function (evt) {
		var items, len, i;
		alert(items);
		if (this.subtotal() > 0) {
			items = this.items();

			for (i = 0, len = items.length; i < len; i++) {}
		}
});
</script> --}}
<!-- //cart-js -->
<!--search-bar-->
<script src="{{asset('/shop/js/search.js')}}"></script>
<!--//search-bar-->
@yield('script')
<!-- js for portfolio lightbox -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="{{asset('/shop/js/move-top.js')}}"></script>
<script type="text/javascript" src="{{asset('/shop/js/easing.js')}}"></script>
<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$(".scroll").click(function (event) {
			event.preventDefault();
			$('html,body').animate({
				scrollTop: $(this.hash).offset().top
			}, 1000);
		});
	});
</script>
<!-- //end-smoth-scrolling -->

<script type="text/javascript" src="{{asset('/shop/js/bootstrap-3.1.1.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@yield('ajax')
@extends('shops/cart')
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('input[name="csrf"]').attr('data')
		}
	});

	$('#done-bill').on('click', function() {
		$.ajax({
			type: 'get',
			url: '{{asset('/user/cart/delete')}}',

			success: function (response) {
				if (response.success) {
					window.location.href = '{{asset('/user/shops/all')}}';
				}
				
			},
			error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
			}
		})
	});

	$('#submit-login').on('click',function(){
		var url = $(this).attr('data-url');

		$.ajax({
			type: 'get',
			url: url,
			data:{
				name: $('#name-login').val(),
				phone: $('#phone-login').val(),
				email: $('#email-login').val(),
				address: $('#address-login').val(),
			},
			success: function (response) {
				if (response.error) {
					$.each(response.error, function( key, value ) {
						toastr.error(value)
					});
				} else if (response.ok) {
					toastr.success(response.ok)
					$('#modal-view-bill-check').modal('show');
					$('#view-bill-btn').empty();
					$('#view-bill-btn').append("<input type='hidden' value='1' name='user_login'><input type='hidden' value="+response.code+" name='code_bill'><h4>Order success, Do you want to see the bill?</h4>");
				}
				
				
			},
			error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
					}
				})
	});

	$('#submit-not-login').on('click',function(){
		var url = $(this).attr('data-url');

		$.ajax({
			type: 'get',
			url: url,
			data:{
				name: $('#name-not-login').val(),
				phone: $('#phone-not-login').val(),
				email: $('#email-not-login').val(),
				address: $('#address-not-login').val(),
			},
			success: function (response) {
				if (response.error) {
					$.each(response.error, function( key, value ) {
						toastr.error(value)
					});
				} else if (response.ok) {
					toastr.success(response.ok)
					$('#modal-view-bill-check').modal('show');
					$('#view-bill-btn').empty();
					$('#view-bill-btn').append("<input type='hidden' value='0' name='user_login'><input type='hidden' value="+response.code+" name='code_bill'><h4>Order success, Do you want to see the bill?</h4>");
					
				}
				
			},
			error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
					}
				})
	});

	$('#btn-login').on('click', function(e) {
		e.preventDefault();

		var login = $(this).attr('href');

		var url = $(this).attr('data-url');

		$.ajax({
			type: 'get',
			url: url,
			success: function (response) {
				if (response.cart) {
					$('#modal-check-login').modal('show');
					$('.btn-accept-login').removeAttr('href');
					$('.btn-accept-login').attr('href',login);
				} else {
					window.location.href = login;
				}
				
			},
			error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
					}
				})
	});

	$('.radio_btn').click(function(){
		if ($(this).is(':checked'))
		{
			$('#btn-add2cart').removeAttr('size_id');
			var url = $(this).attr('data-url');
			var product_id = $('#product_id').val();
			var size_id = $(this).attr('size_id');
			$('#btn-add2cart').attr('size_id', size_id);
			$.ajax({
				type: 'get',
				url: url,
				data: {
					product_id: product_id,
				},

				success: function (response) {
					$('#quantity-remaining').empty();
					$('#size-code').empty();
					$('#div-quantity').empty();
					$('#quantity-remaining').append(response.data.quantity+' shoes');
					$('#size-code').append(response.data.size_code);
					$('#div-quantity').append('<div class="quantity-select"><button class="entry value-minus" id="value-minus" onclick="qtyMinus('+response.data.quantity+')">&nbsp;</button><input type="number" id="quantity-input" name="qty" max='+response.data.quantity+' class="entry value" value="1"/><button class="entry value-plus" id="value-plus" onclick="qtyPlus('+response.data.quantity+')">&nbsp;</button></div>');
				},
				error: function (jqXHR, textStatus, errorThrown) {
							//xử lý lỗi tại đây
						}
					}) 	
		}
	});

	$('#btn-add2cart').on('click',function(){
		var url = $(this).attr('data-url');
		var quantity = $('#quantity-input').val();
		var size_id = $(this).attr('size_id');
		var color = $(this).attr('color-code');

		$.ajax({
			type: 'post',
			url: url,
			data: {
				size_id: size_id,
				quantity: quantity,
				color: color,
			},
			success: function (response) {
				if (response.success) {
					toastr.success('Add to cart successfully!')
				} else if (response.error_qty) {
					toastr.error(response.error_qty)
				} else {
					toastr.error(response.error)
				}
				
			},
			error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
					}
				})
	});
	$('#your-cart').on('click',function(){
		$('#modal-cart').modal('show');
		$('#cart-content').empty();
		$('#total-price').empty();
		$('#tax').empty();
		var url = $(this).attr('data-url');
		$.ajax({
			type: 'get',
			url: url,
			success: function (response) {
				$.each(response.data.cart_detail, function( key, value ) {	
					$('#cart-content').append( "<tr><td>"+value.id+"</td><td>"+value.name+"</td><td><div style="+'height:45px;with=45px;background-color:'+value.options.color+';margin:0 auto'+"></div></td><td><img src="+'{{asset("storage")}}/'+value.options.image+" height='70px' width='70px'>"+"</td><td>"+value.options.size+"</td><td><button id='minus-one' onclick='minusOne("+value.options.size_id+")' data-url="+'{{asset("/user/cart/minusone")}}/'+value.id+">-</button>"+"</td><td>"+value.qty+"</td><td><button id='plus-one' onclick='plusOne("+value.options.size_id+")' data-url="+'{{asset("/user/cart/plusone")}}/'+value.id+">+</button>"+"</td><td>"+value.price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")+"</td><td><button id='delete-product' onclick='delProduct("+value.options.size_id+")' data-url="+'{{asset("/user/cart/deleteproduct")}}/'+value.id+">Delete</button>"+"</td></tr>" );
				});
				$('#total-price').append('<h4>'+response.data.total+' VNĐ</h4>');
				$('#tax').append('<h4>'+response.data.tax+' VNĐ</h4>');
				$('#btn-delete-cart').attr('data-url','{{ asset('user/cart/delete') }}');
			},
			error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
					}
				})
	});

</script>
</body>

</html>