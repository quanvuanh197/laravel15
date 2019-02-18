@extends('admin.master')
@section('breadcrumb')
Sizes Manager
@endsection
@section('active_size')
active
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title"><strong>Sizes Manager</strong></h2>

				<ul class="pull-right">
					<a type="button" class="btn btn-primary btn-add" title="Add New" data-toggle="tooltip" id="post-detail"><span class="fa fa-plus"></span></a>
					@include('/admin/sizes/store')
				</ul>
			</div>
			<div class="panel-body">

				<table class="table datatable" id="size-table">
					<thead>
						<tr align="center" style="font-weight: bold;">
							<th>Id</th>
							<th>Size</th>
							<th>Action</th>			
						</tr>
					</thead>
					
				</table>


			</div>
		</div>

	</div>
</div>
@include('/admin/sizes/update')
@include('/admin/sizes/delete')
@endsection

@section('script')
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	var table = $('#size-table').DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			type: 'post',
			url: '/admin/sizes'

		},
		columns: [
		{ data: 'id', name: 'id' },
		{ data: 'size', name: 'size' },
		{ data: 'action', name: 'action' }

		]
	});

	$(document).ready(function () {
		$('#size-table tbody').on('click', '.btn-delete', function(event) {
			$('#modal-delete').modal('show');
			$('#form-size-delete').removeAttr('data-url');
			var url = $(this).attr('data-url');
			$('#form-size-delete').attr('data-url', url);
		});

		$('#form-size-delete').on('submit', function(e){
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
			$('#form-add-size')[0].reset();
		});

		$('#form-add-size').on('submit',function(e){

			e.preventDefault();
			
			//lấy attribute data-url của form lưu vào biến url
			var url=$(this).attr('data-url');
			var data = $('#size').val();
			$.ajax({
				//sử dụng phương thức post
				type: 'post',
				url: url,
				data: { size: data },
				
				success: function (response) {
					if (response.error) {
						$.each(response.error, function( key, value ) {
							toastr.error(value)
						});
					} else if(response.error_size) {
						toastr.error(response.error_size)
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

		$('#size-table tbody').on('click', '.btn-edit', function(event) {
			$('#modal-edit').modal('show');
			$('#form-edit-size')[0].reset();
			$('#btn-edit-size').attr('disabled','disabled');
			$('#img-edit-div').empty();

			var url = $(this).attr('data-url');

			$.ajax({
				type: 'get',
				url: url,

				success: function(response){
					$('#size-edit').attr('value',response.data.size);

					$('#form-edit-size').attr('data-url','{{ asset('admin/sizes/edit') }}/'+response.data.id)
				}
			});
		});

		$('#form-edit-size').change(function(){
			$('#btn-edit-size').removeAttr('disabled');
		});

		$('#form-edit-size').on('submit',function(e){

			e.preventDefault();
			
			//lấy attribute data-url của form lưu vào biến url
			var url=$(this).attr('data-url');
			
			$.ajax({
				//sử dụng phương thức post
				type: 'post',
				url: url,
				data: { size: $('#size-edit').val() },
				
				success: function (response) {
					if (response.error) {
						$.each(response.error, function( key, value ) {
							toastr.error(value)
						});
					} else if(response.error_size) {
						toastr.error(response.error_size)
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
