<div class="modal fade" id="modal-add-admin">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><span class="fa fa-user-plus"></span> Admin Add</h4>
			</div>
			
			<form class="form-horizontal" action="" method="post" data-url="{{ route('admin.adminStore') }}" role="form" id="form-add-admin" enctype="multipart/form-data">
				
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-md-8">
							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label"><span class="fa fa-user"></span></label>
								<div class="col-md-7 col-xs-12">
									<input type="text" class="form-control" name="name" placeholder="Enter your name" id="name" />
									<span class="error"></span>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label"><span class="fa fa-user-o"></span></label>
								<div class="col-md-7 col-xs-12">
									<input type="text" class="form-control" name="user_name" placeholder="Enter username" id="user_name" />
									<span class="error"></span>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label"><span class="fa fa-venus-mars"></span></label>
								<div class="col-md-7 col-xs-12">
									<select name="gender" id="gender" class="form-control">
										<option value="0">Male</option>
										<option value="1">Female</option>
									</select>
								</div>
							</div>
							

							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label"><span class="fa fa-envelope-o"></span></label>
								<div class="col-md-7 col-xs-12">
									<input type="email" class="form-control" name="email" placeholder="Enter your email" id="email" />
									<span class="error"></span>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label"><span class="fa fa-phone"></span></label>
								<div class="col-md-7 col-xs-12">
									<input type="number" class="form-control" name="phone" placeholder="Enter your phone number" id="phone" />
									<span class="error"></span>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label"><span class="fa fa-location-arrow"></span></label>
								<div class="col-md-7 col-xs-12">
									<input type="text" class="form-control" name="address" placeholder="Enter your address" id="address" />
									<span class="error"></span>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label"><span class="fa fa-key"></span></label>
								<div class="col-md-7 col-xs-12">
									<input type="password" class="form-control" name="password" placeholder="Enter your password" id="password" />
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label"><span class="fa fa-key"></span></label>
								<div class="col-md-7 col-xs-12">
									<input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Password Confirm"/>
									<span class="error"></span>
								</div>
							</div>

						</div>
						<div class="col-md-4">
							<div class="form-group">
								<span class="col-md-10 col-xs-12 btn btn-primary btn-file btn-file">
									<span class="fa fa-picture-o"></span> Image Upload<input type="file" name="image" id="image-upload" title="Browse file"/>
								</span>                                   					

								<br><div class="col-md-12">
									<img id='img-upload' src="" height="225px" width="225px" style="border-radius: 4px" /> 
								</div>                                          			
							</div>

						</div>

					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success">Add</button>
				</div>
			</form>
			
			
		</div>
	</div>
</div>