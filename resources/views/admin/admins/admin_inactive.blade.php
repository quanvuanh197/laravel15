@extends('admin.master')
@section('breadcrumb')
Inactive Admins
@endsection
@section('active_admin')
active
@endsection

@section('active_admin2')
active
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title"><strong>Inactive Admins</strong></h2>

			</div>
			<div class="panel-body">

				<table class="table datatable" id="admin-inactive-table">
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
	@include('/admin/admins/detail')
	@include('/admin/admins/active')
	@include('/admin/admins/delete')
</div>
@endsection

@section('script')
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	var table = $('#admin-inactive-table').DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			type: 'post',
			url: '/admin/adminsinactive'

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
		$('#admin-inactive-table tbody').on('click', '.btn-show', function(event) {
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
		});

		$('#admin-inactive-table tbody').on('click', '.btn-active', function(event) {
			$('#modal-active').modal('show');

			var id=$(this).attr('data-id');

			$('#form-active').attr('data-url','{{ asset('admin/admins/active') }}/'+id);
		});

		$('#form-active').on('submit',function(e){
			e.preventDefault();
			var url = $(this).attr('data-url');
			$.ajax({
				type: 'post',
				url: url,
				data: { active: 1, },
				success: function (response) {
					// hiện thông báo thêm mới thành công bằng toastr
					toastr.success('Admin has been activated!')
					//ẩn modal add đi
					$('#modal-active').modal('hide');
					table.ajax.reload();
				},
				error: function (jqXHR, textStatus, errorThrown) {
					//xử lý lỗi tại đây
				}
			})
		});

		$('#admin-inactive-table tbody').on('click', '.btn-delete', function(event) {
			$('#modal-delete').modal('show');

			var id=$(this).attr('data-id');

			$('#form-delete').attr('data-url','{{ asset('admin/admins') }}/'+id);
		});

		$('#form-delete').on('submit',function(e){
			e.preventDefault();
			var url = $(this).attr('data-url');
			$.ajax({
				type: 'delete',
				url: url,
				
				success: function (response) {
					// hiện thông báo thêm mới thành công bằng toastr
					toastr.warning('Admin has been deleted!')
					//ẩn modal add đi
					$('#modal-delete').modal('hide');
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
