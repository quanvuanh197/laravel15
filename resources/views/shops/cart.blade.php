<div class="modal fade" id="modal-cart">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Your Cart</h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-default">
					<div class="panel-body">
						<table class="table table-hover">
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Color</th>
								<th>Image</th>
								<th>Size</th>
								<th>-1 pair</th>
								<th>Quantity</th>
								<th>+1 pair</th>	
								<th>Price/1 shoes (VNĐ)</th>
								<th>Action</th>
							</tr>
							<tbody id="cart-content">
								
							</tbody>
							
						</table>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading" align="center">
						<h3>Total Price</h3>
					</div>
					<div class="panel-body" id="total-price" align="center">
						
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" align="center">
						<h3>Tax (21%)</h3>
					</div>
					<div class="panel-body" id="tax" align="center">
						
					</div>
				</div>
			</div>
			<div class="modal-footer">
				
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger pull-left" id="btn-delete-cart">Delete all</button>
				<button type="button" data-url="{{asset('/user/cart/checkcart')}}" href="{{asset('/user/cart/checkout')}}" class="btn btn-success btn-checkout">Check out</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	function delProduct(size_id){
		var url = $('#delete-product').attr('data-url');

		$.ajax({
			type: 'get',
			url: url,
			data: { size_id:size_id },
			success: function (response) {
				if (response.delete){
					$('#cart-content').empty();
					$('#total-price').empty();
					$('#tax').empty();

					$.each(response.data, function( key, value ) {	
						$('#cart-content').append( "<tr><td>"+value.id+"</td><td>"+value.name+"</td><td><div style="+'height:45px;with=45px;background-color:'+value.options.color+';margin:0 auto'+"></div></td><td><img src="+'{{asset("storage")}}/'+value.options.image+" height='70px' width='70px'>"+"</td><td>"+value.options.size+"</td><td><button id='minus-one' onclick='minusOne("+value.options.size_id+")' data-url="+'{{asset("/user/cart/minusone")}}/'+value.id+">-</button>"+"</td><td>"+value.qty+"</td><td><button id='plus-one' onclick='plusOne("+value.options.size_id+")' data-url="+'{{asset("/user/cart/plusone")}}/'+value.id+">+</button>"+"</td><td>"+value.price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")+"</td><td><button id='delete-product' onclick='delProduct("+value.options.size_id+")' data-url="+'{{asset("/user/cart/deleteproduct")}}/'+value.id+">Delete</button>"+"</td></tr>" );
					});
					$('#total-price').append('<h4>'+response.total+' VNĐ</h4>');
					$('#tax').append('<h4>'+response.tax+' VNĐ</h4>');
					toastr.warning(response.delete)
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
			}
		})
	}

	function minusOne(size_id){
		var url = $('#minus-one').attr('data-url');

		$.ajax({
			type: 'get',
			url: url,
			data: { size_id:size_id },
			success: function (response) {
				if (response.success) {
					$('#cart-content').empty();
					$('#total-price').empty();
					$('#tax').empty();

					$.each(response.data, function( key, value ) {	
						$('#cart-content').append( "<tr><td>"+value.id+"</td><td>"+value.name+"</td><td><div style="+'height:45px;with=45px;background-color:'+value.options.color+';margin:0 auto'+"></div></td><td><img src="+'{{asset("storage")}}/'+value.options.image+" height='70px' width='70px'>"+"</td><td>"+value.options.size+"</td><td><button id='minus-one' onclick='minusOne("+value.options.size_id+")' data-url="+'{{asset("/user/cart/minusone")}}/'+value.id+">-</button>"+"</td><td>"+value.qty+"</td><td><button id='plus-one' onclick='plusOne("+value.options.size_id+")' data-url="+'{{asset("/user/cart/plusone")}}/'+value.id+">+</button>"+"</td><td>"+value.price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")+"</td><td><button id='delete-product' onclick='delProduct("+value.options.size_id+")' data-url="+'{{asset("/user/cart/deleteproduct")}}/'+value.id+">Delete</button>"+"</td></tr>" );
					});
					$('#total-price').append('<h4>'+response.total+' VNĐ</h4>');
					$('#tax').append('<h4>'+response.tax+' VNĐ</h4>');
					toastr.success('Delete from the cart successfully!')
				} else if(response.delete){
					$('#cart-content').empty();
					$('#total-price').empty();
					$('#tax').empty();

					$.each(response.data, function( key, value ) {	
						$('#cart-content').append( "<tr><td>"+value.id+"</td><td>"+value.name+"</td><td><div style="+'height:45px;with=45px;background-color:'+value.options.color+';margin:0 auto'+"></div></td><td><img src="+'{{asset("storage")}}/'+value.options.image+" height='70px' width='70px'>"+"</td><td>"+value.options.size+"</td><td><button id='minus-one' onclick='minusOne("+value.options.size_id+")' data-url="+'{{asset("/user/cart/minusone")}}/'+value.id+">-</button>"+"</td><td>"+value.qty+"</td><td><button id='plus-one' onclick='plusOne("+value.options.size_id+")' data-url="+'{{asset("/user/cart/plusone")}}/'+value.id+">+</button>"+"</td><td>"+value.price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")+"</td><td><button id='delete-product' onclick='delProduct("+value.options.size_id+")' data-url="+'{{asset("/user/cart/deleteproduct")}}/'+value.id+">Delete</button>"+"</td></tr>" );
					});
					$('#total-price').append('<h4>'+response.total+' VNĐ</h4>');
					$('#tax').append('<h4>'+response.tax+' VNĐ</h4>');
					toastr.warning(response.delete)
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
			}
		})
	}

	function plusOne(size_id){
		var url = $('#plus-one').attr('data-url');

		$.ajax({
			type: 'get',
			url: url,
			data: { size_id:size_id },
			success: function (response) {
				if (response.success) {
					$('#cart-content').empty();
					$('#total-price').empty();
					$('#tax').empty();

					$.each(response.data, function( key, value ) {	
						$('#cart-content').append( "<tr><td>"+value.id+"</td><td>"+value.name+"</td><td><div style="+'height:45px;with=45px;background-color:'+value.options.color+';margin:0 auto'+"></div></td><td><img src="+'{{asset("storage")}}/'+value.options.image+" height='70px' width='70px'>"+"</td><td>"+value.options.size+"</td><td><button id='minus-one' onclick='minusOne("+value.options.size_id+")' data-url="+'{{asset("/user/cart/minusone")}}/'+value.id+">-</button>"+"</td><td>"+value.qty+"</td><td><button id='plus-one' onclick='plusOne("+value.options.size_id+")' data-url="+'{{asset("/user/cart/plusone")}}/'+value.id+">+</button>"+"</td><td>"+value.price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")+"</td><td><button id='delete-product' onclick='delProduct("+value.options.size_id+")' data-url="+'{{asset("/user/cart/deleteproduct")}}/'+value.id+">Delete</button>"+"</td></tr>" );
					});
					$('#total-price').append('<h4>'+response.total+' VNĐ</h4>');
					$('#tax').append('<h4>'+response.tax+' VNĐ</h4>');
					toastr.success('Add to cart successfully!')
				} else if(response.error_qty){
					toastr.error(response.error_qty)
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
			}
		})
	}

	$('.btn-checkout').on('click',function(e){
		e.preventDefault();

		var url = $(this).attr('data-url');
		var redirect = $(this).attr('href');

		$.ajax({
			type: 'get',
			url: url,
			success: function (response) {
				if (response.error) {
					toastr.error(response.error)
				} else {
					window.location.href = "{{asset('/user/cart/checkout')}}";
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
			}

		})
	});

	$('#btn-delete-cart').on('click',function(){
		var url = $(this).attr('data-url');

		$.ajax({
			type: 'get',
			url: url,
			success: function (response) {
				if (response.success) {
					$('#modal-cart').modal('hide');
					toastr.warning('Delete cart successfully!')

				} else if(response.error) {
					toastr.error(response.error)
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
			}
		})
	});
</script>