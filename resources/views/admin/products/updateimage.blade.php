<div class="modal fade" id="modal-edit-image">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Images Edit</h4>
			</div>
			<form class="form-horizontal" action="" method="post" role="form" id="form-edit-image-product" enctype="multipart/form-data">
				<input type="hidden" name="images_update" id="list_images_update">
				<input type="hidden" name="images_delete" id="list_images_delete">
				<div class="modal-body">
					<div class="panel panel-default" style="margin-top: 2em">
						<div class="panel-heading">
							<h3 class="panel-title">Current Images</h3>
						</div>
						<div class="panel-body">
							<div class="col-md-12" id="images_edit" align="center">

							</div>
						</div>
					</div>

					<div class="panel panel-default" style="margin-top: 2em">
						<div class="panel-heading">
							<h3><span class="fa fa-picture-o"></span> Add Images</h3>
						</div>
						<div class="panel-body">
							<input type="file" multiple class="file" data-preview-file-type="any" name="product_images_edit[]" />
						</div>
					</div>
				</div>
			</form>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" form="form-edit-image-product" class="btn btn-success">Save changes</button>
			</div>
		</div>
	</div>
</div>
