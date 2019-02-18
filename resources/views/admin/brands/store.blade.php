<div class="modal fade" id="modal-add">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><span class="fa fa-plus"></span> Brand Add</h4>
            </div>
            <div class="modal-body" style="overflow: auto;">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">

                            <form class="form-horizontal" action="" method="post" data-url="{{ route('admin.brandStore') }}" role="form" id="form-add-brand" enctype="multipart/form-data">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-12 col-xs-12">
                                            <input type="text" class="form-control" name="name" placeholder="Enter name" id="name" />
                                        </div>
                                    </div>    
                                </div>

                                <div class="col-md-12" style="margin-top: 2em">

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3><span class="fa fa-picture-o"></span> Thumbnail</h3>
                                        </div>
                                        <div class="panel-body" align="center">  
                                            <img id='img-upload-add' height="150px" width="150px" />                  
                                        </div>
                                        <div class="panel-footer">
                                            <span class="btn btn-primary btn-file btn-file-add" style="margin-left: 25px">
                                                <span class="fa fa-picture-o"></span> Image Upload<input type="file" name="thumbnail" id="image-upload-add" onchange="checkFile(event)" title="Browse file"/>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>                      

                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" form="form-add-brand" class="btn btn-success">Add</button>
            </div>
        </div>
    </div>
</div>
