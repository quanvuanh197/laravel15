<div class="modal fade" id="modal-edit-admin">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><span class="fa fa-edit"></span> Admin Edit</h4>
			</div>
			
			<form class="form-horizontal" action="" method="post" role="form" id="form-update-admin" enctype="multipart/form-data">
				
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-md-8">
							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label"><span class="fa fa-pencil-square-o"></span></label>
								<div class="col-md-7 col-xs-12">
									<input type="text" class="form-control" name="name" id="update-name" style="color: black">
									<span class="error"></span>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label"><span class="fa fa-user-o"></span></label>
								<div class="col-md-7 col-xs-12">
									<input type="text" class="form-control" name="user_name" placeholder="Enter username" id="update-user_name" />
									<span class="error"></span>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label"><span class="fa fa-venus-mars"></span></label>
								<div class="col-md-7 col-xs-12">
									<select name="gender" id="update-gender" class="form-control">
										<option id="update-gender-male" value="0">Male</option>
										<option id="update-gender-female" value="1">Female</option>
									</select>
								</div>
							</div>
							

							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label"><span class="fa fa-envelope-o"></span></label>
								<div class="col-md-7 col-xs-12">
									<input type="email" class="form-control" name="email" placeholder="Enter your email" id="update-email" />
									<span class="error"></span>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label"><span class="fa fa-phone"></span></label>
								<div class="col-md-7 col-xs-12">
									<input type="number" class="form-control" name="phone" placeholder="Enter your phone number" id="update-phone" />
									<span class="error"></span>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label"><span class="fa fa-location-arrow"></span></label>
								<div class="col-md-7 col-xs-12">
									<input type="text" class="form-control" name="address" placeholder="Enter your address" id="update-address" />
									<span class="error"></span>
								</div>
							</div>

						</div>
						<div class="col-md-4">
							<div class="form-group">
								<span class="col-md-10 col-xs-12 btn btn-primary btn-file btn-file-edit">
									<span class="fa fa-picture-o"></span> Image Upload<input type="file" name="image" id="update-image" title="Browse file"/>
								</span>                                   					

								<span class="error"></span><br>
								<br><div class="col-md-12">
									<img id='img-upload-update' height="210px" width="210px" style="border-radius: 4px" /> 
								</div>                                          			
							</div>

						</div>

					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-warning btn-password" id="id-password">Password Change</button>
					<button type="submit" class="btn btn-success">Update</button>
				</div>
			</form>	
			
		</div>
	</div>
</div>
<div class="modal fade" id="modal-edit-user-password">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" align="left">
				<h4 class="modal-title">Password Setting</h4>
			</div>
			<form class="form-horizontal" action="" method="post" role="form" id="form-update-user-password">

				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-md-12">

							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label"><span class="fa fa-key"></span></label>
								<div class="col-md-7 col-xs-12">
									<input type="password" class="form-control" name="password" placeholder="Enter new password" id="password_user"/>

								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label"><span class="fa fa-key"></span></label>
								<div class="col-md-7 col-xs-12">
									<input type="password" class="form-control" name="password_confirm" placeholder="Comfirm new password" id="password_confirm_user"/>

								</div>
							</div>


						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger btn-close-user-password">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>


		</div>
	</div>
</div>