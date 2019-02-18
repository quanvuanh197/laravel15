@extends('admin.master')
@section('breadcrumb')
Active Admins
@endsection
@section('active_admin')
active
@endsection

@section('active_admin1')
active
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title"><strong>Active Admins</strong></h2>

				<ul class="pull-right">
					<a type="button" class="btn btn-primary btn-add-admin" title="Add New" data-toggle="tooltip" id="post-detail"><span class="fa fa-user-plus"></span></a>
					@include('/admin/admins/store')
				</ul>
			</div>
			<div class="panel-body">

				<table class="table datatable" id="admin-active-table">
					<thead>
						<tr align="center" style="font-weight: bold;">
							<th>Id</th>
							<th>Name</th>
							<th>User Name</th>
							<th>Email</th>
							<th>Action</th>			
						</tr>
					</thead>
					
				</table>


			</div>
		</div>

	</div>
</div>
@include('/admin/admins/detail')
@include('/admin/admins/update')
@include('/admin/admins/deactivate')
@endsection

@section('script')
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	var table = $('#admin-active-table').DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			type: 'post',
			url: '/admin/adminsactive'

		},
		columns: [
		{ data: 'id', name: 'id' },
		{ data: 'name', name: 'name' },
		{ data: 'user_name', name: 'user_name' },
		{ data: 'email', name: 'email' },
		{ data: 'action', name: 'action' }

		]
	});

	$(document).ready(function () {
		$('.btn-add-admin').click(function(){
			$('#modal-add-admin').modal('show');

			$(document).on('change', '.btn-file :file', function() {
				var input = $(this),
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
				input.trigger('fileselect', [label]);
			});

			$('.btn-file :file').on('fileselect', function(event, label) {

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
						$('#img-upload').attr('src', e.target.result);
					}

					reader.readAsDataURL(input.files[0]);
				}
			}

			$("#image-upload").change(function(){
				readURL(this);
			});
		});

		$('#form-add-admin').on('submit',function(e){

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
					} else if(response.error_email) {
						toastr.error(response.error_email)
					} else {
						// hiện thông báo thêm mới thành công bằng toastr
						toastr.success('Add new successful!')
						//ẩn modal add đi
						$('#modal-add-admin').modal('hide');
						table.ajax.reload();
					}

				},
				error: function (jqXHR, textStatus, errorThrown) {
					//xử lý lỗi tại đây
				}
			})
		});

		$('#admin-active-table tbody').on('click', '.btn-show', function(event) {
			$('#modal-detail-admin').modal('show');

			var url = $(this).attr('data-url');

			$.ajax({
				//sử dụng phương thức get
				type: 'get',
				url: url,
				//nếu thực hiện thành công thì chạy vào success
				success: function (response) {
					//hiển thị dữ liệu được controller trả về vào trong modal
					$('#id').text(response.data['id']);
					$('#detail-active').text(response.data['active-sub']);
					$('#detail-name').text(response.data['name']);
					$('#detail-user_name').text(response.data['user_name']);
					$('#detail-email').text(response.data['email']);
					$('#detail-gender').text(response.data['gender-sub']);
					$('#detail-phone').text(response.data['phone']);
					$('#detail-address').text(response.data['address']);
					$('#detail-image').attr('src','{{asset('')}}storage/'+response.data.image);
				},
				error: function (jqXHR, textStatus, errorThrown) {
					//xử lý lỗi tại đây
				}
			})
		})

		$('#admin-active-table tbody').on('click', '.btn-edit', function(event) {
			$('#modal-edit-admin').modal('show');

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

			$("#update-image").change(function(){
				readURL(this);
			});
			
			var url = $(this).attr('data-url');

			$.ajax({
				//sử dụng phương thức get
				type: 'get',
				url: url,
				//nếu thực hiện thành công thì chạy vào success
				success: function (response) {
					//hiển thị dữ liệu được controller trả về vào trong modal
					$('#form-update-admin-password').attr('data-url','{{asset('admin/admins/updatePassword')}}/'+response.data['id']);
					$('#update-name').attr('value',response.data['name']);
					$('#update-user_name').attr('value',response.data['user_name']);
					$('#update-email').attr('value',response.data['email']);
					if (response.data['gender']==0) {
						$('#update-gender-male').attr('selected','');
						$('#update-gender-female').removeAttr('selected','');
					} else {
						$('#update-gender-male').removeAttr('selected','');
						$('#update-gender-female').attr('selected','');
					}
	
					$('#update-phone').attr('value',response.data['phone']);
					$('#update-address').attr('value',response.data['address']);
					if (response.data.image) {
						$('#img-upload-update').attr('src','{{asset('')}}storage/'+response.data.image);
					} else {
						$('#img-upload-update').removeAttr('src','{{asset('')}}storage/'+response.data.image);
					}
	

					$('#form-update-admin').attr('data-url','{{ asset('admin/admins/update') }}/'+response.data.id);
				},
				error: function (jqXHR, textStatus, errorThrown) {
					//xử lý lỗi tại đây
				}
			})
		});

		$('#form-update-admin').on('submit', function(e){
			e.preventDefault();

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
					// hiện thông báo thêm mới thành công bằng toastr
					if (response.error) {
						$.each(response.error, function( key, value ) {
							toastr.error(value)
						});
					} else {
						toastr.success('Update successful!')
						//ẩn modal add đi
						$('#modal-edit-admin').modal('hide');
						table.ajax.reload();
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {

				}
			})
		});

	// 	$('.btn-password').click(function(){
	// 		$('#modal-edit-user-password').modal('show');
	// 	});

	// 	$('.btn-close-user-password').click(function(){
	// 		$('#modal-edit-user-password').modal('hide');
	// 	});

	// 	$('#form-update-user-password').on('submit',function(e){
	// 		e.preventDefault();

	// 		var url = $(this).attr('data-url');

	// 		$.ajax({
	// 			//sử dụng phương thức post
	// 			type: 'post',
	// 			url: url,
	// 			data: new FormData(this),
	// 			dataType:'JSON',
	// 			contentType: false,
	// 			cache: false,
	// 			processData: false,
	
	// 			success: function (response) {
	// 				// hiện thông báo thêm mới thành công bằng toastr
	// 				if (response.error) {

	// 					$.each( response.error, function( key, value ) {
	// 						toastr.error(value)
	// 					});
	// 				} else {
	// 					toastr.success('Update password successful!')
	// 					//ẩn modal add đi
	// 					$('#modal-edit-user-password').modal('hide');
	
	// 				}
	// 			},
	// 			error: function (jqXHR, textStatus, errorThrown) {

	// 			}
	// 		})
	// 	});

		$('#admin-active-table tbody').on('click', '.btn-deactivate', function(event) {
			$('#modal-deactivate').modal('show');

			var id=$(this).attr('data-id');

			$('#form-deactivate').attr('data-url','{{ asset('admin/admins/deactivate') }}/'+id);
		});

		$('#form-deactivate').on('submit',function(e){
			e.preventDefault();
			var url = $(this).attr('data-url');
			$.ajax({
				type: 'post',
				url: url,
				data: { active: 0, },
				success: function (response) {
					// hiện thông báo thêm mới thành công bằng toastr
					toastr.success('Deactivate admin successful!')
					//ẩn modal add đi
					$('#modal-deactivate').modal('hide');
					table.ajax.reload();
				},
				error: function (jqXHR, textStatus, errorThrown) {
					//xử lý lỗi tại đây
				}
			})
		});
});
</script>
@endsection
