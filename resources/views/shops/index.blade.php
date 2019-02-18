@extends('shops.master')

@section('banner_top')
banner_top
@endsection

@section('logo')
logo
@endsection

@section('content')

<div class="grids_bottom">
	<div class="style-grids">
		<div class="col-md-6 style-grid style-grid-1">
			<img src="{{asset('/shop/images/b1.jpg')}}" alt="shoe">
		</div>
	</div>
	<div class="col-md-6 style-grid style-grid-2">
		<div class="style-image-1_info">
			<div class="style-grid-2-text_info">
				<h3>Nike DOWNSHIFTER</h3>
				<p>Itaque earum rerum hic tenetur a sapiente delectus reiciendis maiores alias consequatur.sed quia non numquam eius modi
				tempora incidunt ut labore et dolore .</p>
				<div class="shop-button">
					<a href="shop.html">Shop Now</a>
				</div>
			</div>
		</div>
		<div class="style-image-2">
			<img src="{{asset('/shop/images/b2.jpg')}}" alt="shoe">
			<div class="style-grid-2-text">
				<h3>Air force</h3>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</div>
<!-- //grids_bottom-->
<!-- /girds_bottom2-->
<div class="grids_sec_2">
	<div class="style-grids_main">
		<div class="col-md-6 grids_sec_2_left">
			<div class="grid_sec_info">
				<div class="style-grid-2-text_info">
					<h3>Sneakers</h3>
					<p>Itaque earum rerum hic tenetur a sapiente delectus reiciendis maiores alias consequatur.sed quia non numquam eius modi
					tempora incidunt ut labore .</p>
					<div class="shop-button">
						<a href="shop.html">Shop Now</a>
					</div>
				</div>
			</div>
			<div class="style-image-2">
				<img src="{{asset('/shop/images/b4.jpg')}}" alt="shoe">
				<div class="style-grid-2-text">
					<h3>Air force</h3>
				</div>
			</div>
		</div>
		<div class="col-md-6 grids_sec_2_left">

			<div class="style-image-2">
				<img src="{{asset('/shop/images/b3.jpg')}}" alt="shoe">
				<div class="style-grid-2-text">
					<h3>Air force</h3>
				</div>
			</div>
			<div class="grid_sec_info last">
				<div class="style-grid-2-text_info">
					<h3>Sneakers</h3>
					<p>Itaque earum rerum hic tenetur a sapiente delectus reiciendis maiores alias consequatur.sed quia non numquam eius modi
					tempora incidunt ut labore .</p>
					<div class="shop-button two">
						<a href="shop.html">Shop Now</a>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
@endsection

@section('slider')
<!-- /slider -->
<div class="slider">
	<div class="callbacks_container">
		<ul class="rslides callbacks callbacks1" id="slider4">

			<li>
				<div class="banner-top2">
					<div class="banner-info-wthree">
						<h3>Nike</h3>
						<p>See how good they feel.</p>

					</div>

				</div>
			</li>
			<li>
				<div class="banner-top3">
					<div class="banner-info-wthree">
						<h3>Heels</h3>
						<p>For All Walks of Life.</p>

					</div>

				</div>
			</li>
			<li>
				<div class="banner-top">
					<div class="banner-info-wthree">
						<h3>Sneakers</h3>
						<p>See how good they feel.</p>

					</div>

				</div>
			</li>
			<li>
				<div class="banner-top1">
					<div class="banner-info-wthree">
						<h3>Adidas</h3>
						<p>For All Walks of Life.</p>

					</div>

				</div>
			</li>
		</ul>
	</div>
	<div class="clearfix"> </div>
</div>
<!-- //slider -->
<ul class="top_icons">
	<li><a href="#"><span class="fa fa-facebook" aria-hidden="true"></span></a></li>
	<li><a href="#"><span class="fa fa-twitter" aria-hidden="true"></span></a></li>
	<li><a href="#"><span class="fa fa-linkedin" aria-hidden="true"></span></a></li>
	<li><a href="#"><span class="fa fa-google-plus" aria-hidden="true"></span></a></li>

</ul>
@endsection
@section('script')
<script src="{{asset('/shop/js/responsiveslides.min.js')}}"></script>
<script>
	$(function () {
		$("#slider4").responsiveSlides({
			auto: true,
			pager: true,
			nav: true,
			speed: 1000,
			namespace: "callbacks",
			before: function () {
				$('.events').append("<li>before event fired.</li>");
			},
			after: function () {
				$('.events').append("<li>after event fired.</li>");
			}
		});
	});
</script>
@endsection