<div class="modal fade" id="modal-view-bill-check">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{route('showBill')}}" method="get">
				<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">HELLO</h4>
				</div>
				<div class="modal-body">

					<div id="view-bill-btn"></div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger pull-left" onclick="noViewBill(event)">No</button>
					<button type="submit" class="btn btn-primary">Yes</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('input[name="csrf"]').attr('data')
		}
	});

	function noViewBill(event){
		$('#modal-view-bill-check').modal('hide');
		$.ajax({
			type: 'get',
			url: '{{asset('/user/cart/delete')}}',

			success: function (response) {
				if (response.success) {
					toastr.success('Thank you for your purchase!')
					alert('Thank you for your purchase!');
					window.location.href = '{{asset('/user/shops/all')}}';
					
				}	
			},
		})
	}
</script>