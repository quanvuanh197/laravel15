<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><span class="fa fa-cart-plus"></span> Product Edit</h4>
            </div>
            <div class="modal-body" style="overflow: auto;">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">

                            <form class="form-horizontal" action="" method="post" role="form" id="form-edit-product" enctype="multipart/form-data">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="col-md-2 col-xs-12 control-label">Name</label>
                                        <div class="col-md-10 col-xs-12">
                                            <input type="text" class="form-control" name="name" placeholder="Enter name" id="name-update" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 col-xs-12 control-label">Brands</label>
                                        <div class="col-md-10 col-xs-12">
                                            <select name="brand_id" id="brand_id-update" class="form-control">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 col-xs-12 control-label">Color</label>
                                        <div class="col-md-10 col-xs-12 input-group colorpicker-component" id="color_picker-update">
                                        	<span class="input-group-addon" style="background-color:white; color: black; border-color: #d9d3d3">Color pick&nbsp <i id="picker" style="width: 19px; height: 19px; border-color: #d9d3d3; border-style: solid; border-width:1px; background-color: white"></i></span>
                                            <input type="text" class="form-control" name="color" id="color-update" placeholder="Press the right button to select or enter color code"/>
                                            
                                            <span class="input-group-addon" id="current_color">Current color</span>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 col-xs-12 control-label">Description</label>
                                        <div class="col-md-10 col-xs-12">
                                            <textarea class="form-control" style="color: black" name="description" id="description-update" rows="5">
                                            </textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 col-xs-12 control-label">Info</label>
                                        <div class="col-md-10 col-xs-12">
                                            <textarea name="info" id="info-update"></textarea>

                                            <script>
                                                CKEDITOR.replace( 'info-update' );
                                            </script>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 col-xs-12 control-label">Price (VNĐ)</label>
                                        <div class="col-md-10 col-xs-12 input-group">
                                            <input type="number" class="form-control" name="price" placeholder="Enter price" id="price-update" />
                                            <span class="input-group-addon" id="price_input_update"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 col-xs-12 control-label">Sale Price (VNĐ)</label>
                                        <div class="col-md-10 col-xs-12 input-group">
                                            <input type="number" class="form-control" name="sale_price" placeholder="Enter sale price" id="sale_price-update" />
                                            <span class="input-group-addon" id="sale_price_input_update"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3><span class="fa fa-picture-o"></span> Thumbnail</h3>
                                        </div>
                                        <div class="panel-body" id="img-profile">
                                             
                                        </div>
                                        <div class="panel-footer">
                                            <span class="btn btn-primary btn-file btn-file-add" style="margin-left: 15px">
                                                <span class="fa fa-picture-o"></span> Image Upload<input type="file" name="image" id="image-upload-update" title="Browse file"/>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Tags</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <div class="col-md-12" id="tag_input">
                                                    <input type="text" class="tagsinput" id="tags_edit"/>
                                                    <input type="hidden" name="tags" id="tagtest_edit">
                                                </div>
                                            </div>
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
                <button type="submit" form="form-edit-product" class="btn btn-success" id="btn-edit-submit" disabled>Edit</button>
            </div>
        </div>
    </div>
</div>

