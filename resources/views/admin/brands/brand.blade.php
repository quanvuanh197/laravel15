@extends('admin.master')
@section('breadcrumb')
Brands Manager
@endsection
@section('active_brand')
active
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title"><strong>Brands Manager</strong></h2>

				<ul class="pull-right">
					<a type="button" class="btn btn-primary btn-add" title="Add New" data-toggle="tooltip" id="post-detail"><span class="fa fa-plus"></span></a>
					@include('/admin/brands/store')
				</ul>
			</div>
			<div class="panel-body">

				<table class="table datatable" id="brand-table">
					<thead>
						<tr align="center" style="font-weight: bold;">
							<th>Id</th>
							<th>Name</th>
							<th>Thumbnail</th>
							<th>Slug</th>
							<th>Action</th>			
						</tr>
					</thead>
					
				</table>


			</div>
		</div>

	</div>
</div>
@include('/admin/brands/update')
@include('/admin/brands/delete')
@endsection

@section('script')
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	var table = $('#brand-table').DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			type: 'post',
			url: '/admin/brands'

		},
		columns: [
		{ data: 'id', name: 'id' },
		{ data: 'name', name: 'name' },
		{ data: 'thumbnail', name: 'thumbnail' },
		{ data: 'slug', name: 'slug' },
		{ data: 'action', name: 'action' }

		]
	});

	function checkFile(event){
		if (URL.createObjectURL(event.target.files[0])) {
			var typeImage = event.target.files[0].name.split('.').pop();
			var sizeImage = event.target.files[0].size;
			if ((typeImage=='jpg'||typeImage=='jpeg'||typeImage=='png'||typeImage=='webp')&&sizeImage<=2500000) {
				$('#img-upload-add').attr('src', URL.createObjectURL(event.target.files[0]));
			} else {
				toastr.error('Only .JPG, .JPEG, .PNG, .WEBP and size of file less than 4mb');
			}
				
		}
				
	};

	function checkFileEdit(event){
		if (URL.createObjectURL(event.target.files[0])) {
			var typeImage = event.target.files[0].name.split('.').pop();
			var sizeImage = event.target.files[0].size;
			if ((typeImage=='jpg'||typeImage=='jpeg'||typeImage=='png'||typeImage=='webp')&&sizeImage<=2500000) {
				$('#img-upload-edit').attr('src', URL.createObjectURL(event.target.files[0]));
			} else {
				toastr.error('Only .JPG, .JPEG, .PNG, .WEBP and size of file less than 2.5mb');
			}
				
		}
				
	};

	$(document).ready(function () {
		$('#brand-table tbody').on('click', '.btn-delete', function(event) {
			$('#modal-delete').modal('show');
			$('#form-brand-delete').removeAttr('data-url');
			var url = $(this).attr('data-url');
			$('#form-brand-delete').attr('data-url', url);
		});

		$('#form-brand-delete').on('submit', function(e){
			e.preventDefault();

			var url = $(this).attr('data-url');

			$.ajax({
					//sử dụng phương thức get
				type: 'delete',
				url: url,
					//nếu thực hiện thành công thì chạy vào success
				success: function (response) {
					if (response.error) {
						toastr.error(response.error)
					} else if(response.success) {
						toastr.success('Delete successful!')
					}
						//ẩn modal add đi
					$('#modal-delete').modal('hide');
					table.ajax.reload();
						
				},
				error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
				}
			})

		});

		$('.btn-add').click(function(){
			$('#modal-add').modal('show');
			$("#img-upload-add").attr('src','https://i.vimeocdn.com/portrait/1274237_300x300');
			$('#form-add-brand')[0].reset();
		});

		$('#form-add-brand').on('submit',function(e){

			e.preventDefault();
			
			//lấy attribute data-url của form lưu vào biến url
			var url=$(this).attr('data-url');
			
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
					if (response.error) {
						$.each(response.error, function( key, value ) {
							toastr.error(value)
						});
					} else if(response.error_slug) {
						toastr.error(response.error_slug)
					} else {
						// hiện thông báo thêm mới thành công bằng toastr
						toastr.success('Add new successful!')
						//ẩn modal add đi
						$('#modal-add').modal('hide');
						table.ajax.reload();
					}

				},
				error: function (jqXHR, textStatus, errorThrown) {
					//xử lý lỗi tại đây
				}
			})
		});

		$('#brand-table tbody').on('click', '.btn-edit', function(event) {
			$('#modal-edit').modal('show');
			$('#form-edit-brand')[0].reset();
			$('#btn-edit-brand').attr('disabled','disabled');
			$('#img-edit-div').empty();

			var url = $(this).attr('data-url');

			$.ajax({
				type: 'get',
				url: url,

				success: function(response){
					$('#name-edit').attr('value',response.data.name);

					if (!response.data.thumbnail) {
						$('#img-edit-div').append("<img id='img-upload-edit' src='https://i.vimeocdn.com/portrait/1274237_300x300' height="+"150px"+" width="+"150px"+">")
					} else {
						$('#img-edit-div').append("<img id='img-upload-edit' src="+"/storage/"+response.data.thumbnail+" height="+"150px"+" width="+"150px"+">")
					}

					$('#form-edit-brand').attr('data-url','{{ asset('admin/brands/edit') }}/'+response.data.id)
				}
			});
		});

		$('#form-edit-brand').change(function(){
			$('#btn-edit-brand').removeAttr('disabled');
		});

		$('#form-edit-brand').on('submit',function(e){

			e.preventDefault();
			
			//lấy attribute data-url của form lưu vào biến url
			var url=$(this).attr('data-url');
			
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
					if (response.error) {
						$.each(response.error, function( key, value ) {
							toastr.error(value)
						});
					} else if(response.error_slug) {
						toastr.error(response.error_slug)
					} else {
						// hiện thông báo thêm mới thành công bằng toastr
						toastr.success('Edit successful!')
						//ẩn modal add đi
						$('#modal-edit').modal('hide');
						table.ajax.reload();
					}

				},
				error: function (jqXHR, textStatus, errorThrown) {
					//xử lý lỗi tại đây
				}
			})
		});

	});
</script>
@endsection
