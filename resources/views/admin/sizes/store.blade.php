<div class="modal fade" id="modal-add">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><span class="fa fa-plus"></span> Size Add</h4>
            </div>
            <div class="modal-body" style="overflow: auto;">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">

                            <form class="form-horizontal" action="" method="post" data-url="{{ route('admin.sizeStore') }}" role="form" id="form-add-size">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-12 col-xs-12">
                                            <input type="text" class="form-control" name="size" placeholder="Enter size" id="size" />
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
                <button type="submit" form="form-add-size" class="btn btn-success">Add</button>
            </div>
        </div>
    </div>
</div>
