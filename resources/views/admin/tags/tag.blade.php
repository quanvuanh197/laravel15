@extends('admin.master')
@section('breadcrumb')
Tags Manager
@endsection
@section('active_tag')
active
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title"><strong>Tags Manager</strong></h2>

				<ul class="pull-right">
					<a type="button" class="btn btn-primary btn-add" title="Add New" data-toggle="tooltip" id="post-detail"><span class="fa fa-plus"></span></a>
					@include('/admin/tags/store')
				</ul>
			</div>
			<div class="panel-body">

				<table class="table datatable" id="tag-table">
					<thead>
						<tr align="center" style="font-weight: bold;">
							<th>Id</th>
							<th>Tag</th>
							<th>Slug</th>
							<th>Action</th>			
						</tr>
					</thead>
					
				</table>


			</div>
		</div>

	</div>
</div>
@include('/admin/tags/update')
@include('/admin/tags/delete')
@endsection

@section('script')
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	var table = $('#tag-table').DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			type: 'post',
			url: '/admin/tags'

		},
		columns: [
		{ data: 'id', name: 'id' },
		{ data: 'tag', name: 'tag' },
		{ data: 'slug', name: 'slug' },
		{ data: 'action', name: 'action' }

		]
	});

	$(document).ready(function () {
		$('#tag-table tbody').on('click', '.btn-delete', function(event) {
			$('#modal-delete').modal('show');
			$('#form-tag-delete').removeAttr('data-url');
			var url = $(this).attr('data-url');
			$('#form-tag-delete').attr('data-url', url);
		});

		$('#form-tag-delete').on('submit', function(e){
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
			$('#form-add-tag')[0].reset();
		});

		$('#form-add-tag').on('submit',function(e){

			e.preventDefault();
			
			//lấy attribute data-url của form lưu vào biến url
			var url=$(this).attr('data-url');
			var data = $('#tag').val();
			$.ajax({
				//sử dụng phương thức post
				type: 'post',
				url: url,
				data: { tag: data },
				
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

		$('#tag-table tbody').on('click', '.btn-edit', function(event) {
			$('#modal-edit').modal('show');
			$('#form-edit-tag')[0].reset();
			$('#btn-edit-tag').attr('disabled','disabled');
			$('#img-edit-div').empty();

			var url = $(this).attr('data-url');

			$.ajax({
				type: 'get',
				url: url,

				success: function(response){
					$('#tag-edit').attr('value',response.data.tag);

					$('#form-edit-tag').attr('data-url','{{ asset('admin/tags/edit') }}/'+response.data.id)
				}
			});
		});

		$('#form-edit-tag').change(function(){
			$('#btn-edit-tag').removeAttr('disabled');
		});

		$('#form-edit-tag').on('submit',function(e){

			e.preventDefault();
			
			//lấy attribute data-url của form lưu vào biến url
			var url=$(this).attr('data-url');
			
			$.ajax({
				//sử dụng phương thức post
				type: 'post',
				url: url,
				data: { tag: $('#tag-edit').val() },
				
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
