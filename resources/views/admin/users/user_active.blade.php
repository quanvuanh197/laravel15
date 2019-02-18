@extends('admin.master')
@section('breadcrumb')
Active Users
@endsection
@section('active_user')
active
@endsection

@section('active_user1')
active
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title"><strong>Active Users</strong></h2>

				<ul class="pull-right">
					<a type="button" class="btn btn-primary btn-add" title="Add New" id="post-detail" data-toggle="tooltip"><span class="fa fa-user-plus"></span></a>
					@include('/admin/users/store')
				</ul>
			</div>
			<div class="panel-body">

				<table class="table datatable" id="user-active-table">
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

		@include('/admin/users/detail')
		@include('/admin/users/update')
		@include('/admin/users/deactivate')
@endsection

@section('script')
<script type="text/javascript">

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	var table = $('#user-active-table').DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			type: 'post',
			url: '/admin/usersactive'

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
		$('.btn-add').click(function(){
			$('#modal-add-user').modal('show');

			$(document).on('change', '.btn-file-add :file', function() {
				var input = $(this),
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
				input.trigger('fileselect1', [label]);
			});

			$('.btn-file-add :file').on('fileselect1', function(event, label) {

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
						$('#img-upload-add').attr('src', e.target.result);
					}

					reader.readAsDataURL(input.files[0]);
				}
			}

			$("#image-upload-add").change(function(){
				readURL(this);
			});
		});

		$('#form-add-user').on('submit',function(e){

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
					} else {
						// hiện thông báo thêm mới thành công bằng toastr
						toastr.success('Add new successful!')
						//ẩn modal add đi
						$('#modal-add-user').modal('hide');
						table.ajax.reload();
						
					}

				},
				error: function (jqXHR, textStatus, errorThrown) {
					//xử lý lỗi tại đây
				}
			})
		});

		$('#user-active-table tbody').on('click', '.btn-show-user', function(event) {
			$('#modal-detail-user').modal('show');

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
		});

		$('#user-active-table tbody').on('click', '.btn-edit-user', function(event) {
			$('#modal-edit-user').modal('show');

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
					$('#form-update-user-password').attr('data-url','{{asset('admin/users/updatePassword')}}/'+response.data['id']);
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


					$('#form-update-user').attr('data-url','{{ asset('admin/users/update') }}/'+response.data.id);

				},
				error: function (jqXHR, textStatus, errorThrown) {
					//xử lý lỗi tại đây
				}
			})
		});

		$('#form-update-user').on('submit', function(e){
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
						$('#modal-edit-user').modal('hide');
						table.ajax.reload();
						
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {

				}
			})
		});

		$('.btn-password').click(function(){
			$('#modal-edit-user-password').modal('show');
		});

		$('.btn-close-user-password').click(function(){
			$('#modal-edit-user-password').modal('hide');
		});

		$('#form-update-user-password').on('submit',function(e){
			e.preventDefault();

			var url = $(this).attr('data-url');

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

						$.each( response.error, function( key, value ) {
							toastr.error(value)
						});
					} else {
						toastr.success('Update password successful!')
						//ẩn modal add đi
						$('#modal-edit-user-password').modal('hide');
						table.ajax.reload();

					}
				},
				error: function (jqXHR, textStatus, errorThrown) {

				}
			})
		});

		$('#user-active-table tbody').on('click', '.btn-deactivate-user', function(event) {
			$('#modal-deactivate').modal('show');

			var id=$(this).attr('data-id');

			$('#form-deactivate').attr('data-url','{{ asset('admin/users/deactivate') }}/'+id);
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
					toastr.success('Deactivate user successful!')
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
