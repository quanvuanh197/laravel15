@extends('admin.master')
@section('breadcrumb')
Out Stock Products
@endsection
@section('active_product')
active
@endsection

@section('active_product2')
active
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title"><strong>Out Stock Products</strong></h2>
			</div>
			<div class="panel-body">

				<table class="table datatable" id="product-outstock-table">
					<thead>
						<tr align="center" style="font-weight: bold;">
							<th>Id</th>
							<th>Brand</th>
							<th>Name</th>
							<th>Thumbnail</th>
							<th>Code</th>
							<th>Color</th>
							<th>Sale price (VNĐ)</th>
							<th>Action</th>		
						</tr>
					</thead>
					
				</table>


			</div>
		</div>

	</div>
</div>
@include('/admin/products/detail')
@include('/admin/products/update')
@include('/admin/products/updateimage')
@include('/admin/products/updatesize')
@include('/admin/products/delete')

@endsection

@section('script')
<script type="text/javascript">
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		var imageUpdate = [];
		var imageDelete = [];
		function loadFile(id){
			if (URL.createObjectURL(event.target.files[0])) {
				var typeImage = event.target.files[0].name.split('.').pop();
				var sizeImage = event.target.files[0].size;
				if ((typeImage=='jpg'||typeImage=='jpeg'||typeImage=='png')&&sizeImage<=2500000) {
					$('#img-upload-update-'+id).attr('src', URL.createObjectURL(event.target.files[0]));
			
					imageUpdate.push(id);
					$('#list_images_update').attr('value', imageUpdate);
				} else {
					toastr.error('Only JPG, JPEG, PNG and size of file less than 4mb');
				}
				
			}
				
		};

		function deleteFile(id){
			// $('.in').remove();
			$('#content-image-'+id).remove();
			
			imageDelete.push(id);
			$('#list_images_delete').attr('value', imageDelete);
		}

		

		$('#price-update').change(function(){
			var price_format = $('#price-update').val().toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			$('#price_input_update').text(price_format);
		});
		$('#sale_price-update').change(function(){
			var price_format = $('#sale_price-update').val().toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			$('#sale_price_input_update').text(price_format);
		});
		
		$('#price').change(function(){
			
			var price_format = $('#price').val().toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			$('#price_input').text(price_format);
		});

		$('#sale_price').change(function(){
			
			var price_format = $('#sale_price').val().toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			$('#sale_price_input').text(price_format);
		});

		var table = $('#product-outstock-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: {
				type: 'post',
				url: '/admin/productsoutstock'

			},
			columns: [
			{ data: 'id', name: 'id' },
			{ data: 'brand_id', name: 'brand_id' },
			{ data: 'name', name: 'name' },
			{ data: 'image', name: 'image' },
			{ data: 'code', name: 'code' },
			{ data: 'color', name: 'color' },
			{ data: 'sale_price', name: 'sale_price' },
			{ data: 'action', name: 'action' }
			]
		});



		$(document).ready(function () {

			$('#product-outstock-table tbody').on('click', '.btn-delete-product', function(event) {
				$('#modal-product-delete').modal('show');
				$('#form-product-delete').removeAttr('data-url');
				var url = $(this).attr('data-url');
				$('#form-product-delete').attr('data-url', url);
			});

			$('#form-product-delete').on('submit', function(e){
				e.preventDefault();

				var url = $(this).attr('data-url');

				$.ajax({
					//sử dụng phương thức get
					type: 'delete',
					url: url,
					//nếu thực hiện thành công thì chạy vào success
					success: function (response) {
					
						toastr.success('Delete successful!')
						//ẩn modal add đi
						$('#modal-product-delete').modal('hide');
						table.ajax.reload();
						
					},
					error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
					}
				})

			});

			$('#product-outstock-table tbody').on('click', '.btn-show', function(event) {
				$('#modal-detail').modal('show');
				$('#detail-color').empty();
				var url = $(this).attr('data-url');

				$.ajax({
					//sử dụng phương thức get
					type: 'get',
					url: url,
					//nếu thực hiện thành công thì chạy vào success
					success: function (response) {
						//hiển thị dữ liệu được controller trả về vào trong modal
						$('#detail-name').text(response.data.product['name']);
						$('#detail-brand').text(response.data.product['brand']);
						$('#detail-code').text(response.data.product['code']);
						if (response.data.product['color']) {
							$('#detail-color').append('<div class="color-product" style="background-color:'+response.data.product['color']+'; height:30px; width:30px"></div>');
						} else {
							$('#detail-color').append('<h5>Unknown</h5>')
						}
						
						$('#detail-price').text(response.data.product['price_format']);
						$('#detail-sale_price').text(response.data['sale_price_format']);
						if (response.data.product['image']) {
							$('#detail-image').empty();
							$('#detail-image').append("<img src="+"/storage/"+response.data.product['image']+" height="+"120px"+" width="+"120px"+">");
						} else {
							$('#detail-image').empty();
							$('#detail-image').append("<h3>Unknown</h3>");
						}
						$('#detail-info').empty();
						$('#detail-info').append(response.data.product['info']);
						

						if (response.data.images!=null) {
							$('#images-product').empty();
							$.each(response.data.images, function( key, value ) {
								$('#images-product').append("<img class="+"col-md-4"+" src="+"/storage/"+value.image+" style="+"border:1px;border-color:#F5F5F5;border-style:ridge;margin-bottom:3px;"+">");
							});
						} else {
							$('#images-product').empty();
							$('#images-product').append("<h2>Unknown</h2>");
						}

						if (response.data.sizes!=null) {
							$('#detail-size').empty();
							$.each(response.data.sizes, function( key, value ) {
								$('#detail-size').append( "<tr><td>"+value.size_name+"</td><td>"+value.quantity+"</td></tr>" );
							});
						} else {
							$('#detail-size').empty();
							$('#detail-size').append("<tr><td colspan="+"2"+"><h2>Unknown</h2></td></tr>");
						}

						if (response.data.tags!=null) {
							$('#detail-tag').empty();
							
							$.each(response.data.tags, function( key, value ) {
								$('#detail-tag').append( "<li><a href="+"#"+">"+value.tag_name+"</a></li>" );
							});
						} else {
							$('#detail-tag').empty();
							$('#detail-tag').append("<h3>Unknown</h3>");
						}

					},
					error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
					}
				})
			});

			$('#product-outstock-table tbody').on('click', '.btn-edit', function(event) {
				$('#modal-edit').modal('show');
				$('#form-edit-product')[0].reset();
				$('#btn-edit-submit').attr('disabled','disabled');
				$(document).on('change', '.btn-file-edit :file', function() {
					var input = $(this),
					label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
					input.trigger('fileselect', [label]);
				});

				$('.btn-file-edit :file').on('fileselect', function(event, label) {

					var input = $(this).parents('.form-group').find(':text'),
					log = label;

					if( input.length ) {
						input.val(log);
					} else {
						if( log ) alert(log);
					}

				});

				function readURL(input) {
					if (input.files && input.files[0]) {
						var reader = new FileReader();

						reader.onload = function (e) {
							$('#img-upload-update').attr('src', e.target.result);
						}

						reader.readAsDataURL(input.files[0]);
					}
				}

				$("#image-upload-update").change(function(){
					readURL(this);
				});

				var url = $(this).attr('data-url');
				var url_brand=$(this).attr('brand-url');

				

				$("#color_picker-update").colorpicker();

				$.ajax({
					//sử dụng phương thức get
					type: 'get',
					url: url,
					//nếu thực hiện thành công thì chạy vào success
					success: function (response) {
						$('#picker').attr('style',style="width:19px;height:19px;border-color:#d9d3d3;border-style:solid;border-width:1px;background-color:white");
						$('#img-profile').empty();
						if (response.data.product['image']) {
							$('#img-profile').append('<img id='+'img-upload-update'+' height="150px" width="150px" src='+'/storage/'+response.data.product['image']+'/>');
						} else {
							$('#img-profile').append('<img id='+'img-upload-update'+' height="150px" width="150px" src="https://i.vimeocdn.com/portrait/1274237_300x300"/>');
						}
						
						$('#name-update').attr('value',response.data.product['name']);
						
						$('#current_color').attr('style',style="background-color:"+response.data.product['color']+";");
						$('#color-update').attr('value',response.data.product['color'])

						$('#description-update').text(response.data.product['description']);
						
						
						CKEDITOR.instances['info-update'].setData(response.data.product['info']);
						

						$('#price-update').attr('value',response.data.product['price']);
						var price_format_edit = response.data.product['price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						$('#price_input_update').text(price_format_edit);

						$('#sale_price-update').attr('value',response.data.product['sale_price']);
						var sale_price_format_edit = response.data.product['sale_price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						$('#sale_price_input_update').text(sale_price_format_edit);

						if (response.data.tags!=null) {
							$('#tags_edit').importTags('');
							$.each(response.data.tags, function( key, value ) {
								$('#tags_edit').addTag(value.tag_name);
							});
						} else {
							$('#tags_edit').importTags('');
						}

						brand_id = response.data.product.brand_id;
						$('#form-edit-product').attr('data-url','{{ asset('admin/products/edit') }}/'+response.data.product.id);
					},
					error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
					}
				})

				$.ajax({
					//sử dụng phương thức get
					type: 'get',
					url: url_brand,
					//nếu thực hiện thành công thì chạy vào success
					success: function (response) {
						$('#brand_id-update').empty();
						$.each(response.brands_data, function( key, value ) {

							if (brand_id == value.id) {
								$('#brand_id-update').append( "<option value="+value.id+" selected>"+value.name+"</option>" );
							} else {
								$('#brand_id-update').append( "<option value="+value.id+">"+value.name+"</option>" );
							}	
							
						});			
						
					},
					error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
					}
				})
				
			});

	$('#form-edit-product').change(function(){
		$('#btn-edit-submit').removeAttr('disabled');
	});

	$('#form-edit-product').on('submit', function(e){
		e.preventDefault();
		CKEDITOR.instances['info-update'].updateElement();
		var url=$(this).attr('data-url');
		var tags = $('#tags_edit').val();
		var array = tags.split(",");
		$('#tagtest_edit').attr('value', array);

		$.ajax({
			//sử dụng phương thức post
			type: 'post',
			url: url,
			data: new FormData(this),
			dataType:'JSON',
			contentType: false,
			cache: false,
			processData: false,

			success: function (response) {
						// hiện thông báo thêm mới thành công bằng toastr
				if (response.error) {
					$.each(response.error, function( key, value ) {
						toastr.error(value)
					});
				} else if (response.error_slug){

					toastr.error('Name already exesist!')

				} else {
					toastr.success('Update successful!')
											//ẩn modal add đi
					$('#modal-edit').modal('hide');
					table.ajax.reload();
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {

			}		
		})
	});
	

	$('#product-outstock-table tbody').on('click', '.btn-edit-image', function(event) {
		$('#modal-edit-image').modal('show');
		$('#form-edit-image-product')[0].reset();
		$('#list_images_update').removeAttr('value');
		$('#list_images_delete').removeAttr('value');
		$('#images_edit').empty();
		imageUpdate = [];
		imageDelete = [];
		var url = $(this).attr('data-url');

		$.ajax({
					//sử dụng phương thức get
			type: 'get',
			url: url,
					//nếu thực hiện thành công thì chạy vào success
			success: function (response) {
				if (response.data.images!=null) {
					$('#images_edit').empty();
					$.each(response.data.images, function( key, value ) {
						$('#images_edit').append("<div class="+'col-md-4'+" id="+'content-image-'+value.id+"><div class="+'panel panel-default'+" style="+'margin-top:2em'+" id="+'panel-image-edit'+value.id+"><div class="+'panel-body'+"><img id="+'img-upload-update-'+value.id+" src="+"/storage/"+value.image+" height="+'150px'+" width="+'150px'+"/></div></div></div>");
						$('#panel-image-edit'+value.id).append('<div class="panel-footer"><div class="btn-image-edit" title="Edit" data-toggle="tooltip"><i class="fa fa-edit" aria-hidden="true"></i><input type="file" class="input-image-edit" name='+'image-edit-single-'+value.id+' onchange="loadFile('+value.id+')"></input></div><button class="btn-image-delete" id='+'btn-image-delete-'+value.id+' title="Delete" onclick="deleteFile('+value.id+')"><i class="fa fa-trash-o" aria-hidden="true"></i></button></div>');
					});
				}

				$('#form-edit-image-product').attr('data-url','{{ asset('admin/products/images') }}/'+response.data.product_id);		
						
			},
			error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
			}
		})
	});

	$('#form-edit-image-product').on('submit',function(e){
		e.preventDefault();

		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: 'post',
			data: new FormData(this),
			dataType:'JSON',
			contentType: false,
			cache: false,
			processData: false,

			success: function (response) {
					// hiện thông báo thêm mới thành công bằng toastr
				if (response.error) {
					$.each(response.error, function( key, value ) {
						toastr.error(value)
					});
				} else {
					toastr.success('Update images successful!')
											//ẩn modal add đi
					$('#modal-edit-image').modal('hide');
					table.ajax.reload();
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {

			} 
		})
		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	});

	$('#product-outstock-table tbody').on('click', '.btn-edit-quantity', function(event) {
		$('#modal-size-edit').modal('show');
		$('#size_input_group-update').empty();
		$('#form-edit-size-product')[0].reset();
		var url = $(this).attr('data-url');
		var size_url = $(this).attr('size-url');
		var product_id = $(this).attr('product_id');
		
		$.ajax({
			//sử dụng phương thức get
			type: 'get',
			url: size_url,
			//nếu thực hiện thành công thì chạy vào success
			success: function (response) {
				$('#size_input_group-update').empty();
				$.each(response.sizes_data, function( key, value ) {
					$('#size_input_group-update').append( "<div class="+"col-md-6 "+"style="+"margin-top:2em"+"><div class="+"input-group"+"> <span class="+"input-group-addon"+"><span>Size "+key+"</span></span> <input name="+key+" id="+"size_"+value.id+" type="+"number"+" class="+"form-control "+"placeholder='Enter Quantity' /> </div></div>" );

				});

			},
			error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
			}
		})

		$.ajax({
			//sử dụng phương thức get
			type: 'get',
			url: url,
			//nếu thực hiện thành công thì chạy vào success
			success: function (response) {
				if (response.data.sizes!=null) {
							
					$.each(response.data.sizes, function( key, value ) {
						$("#size_"+key+"").attr('value',value.quantity);
					});
				}

			},
			error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
			}
		})

		
		$('#form-edit-size-product').attr('data-url','{{ asset('admin/products/sizes') }}/'+product_id);
	});

	$('#form-edit-size-product').on('submit',function(e){
		e.preventDefault();

		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: 'post',
			data: new FormData(this),
			dataType:'JSON',
			contentType: false,
			cache: false,
			processData: false,

			success: function (response) {
					// hiện thông báo thêm mới thành công bằng toastr
				if (response.error) {
					$.each(response.error, function( key, value ) {
						toastr.error(value)
					});
				} else {
					toastr.success('Update quantity successful!')
											//ẩn modal add đi
					$('#modal-size-edit').modal('hide');
					table.ajax.reload();
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {

			} 
		})
		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	});

});


</script>
@endsection