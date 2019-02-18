<div class="modal fade" id="modal-add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><span class="fa fa-cart-plus"></span> Product Add</h4>
            </div>
            <div class="modal-body" style="overflow: auto;">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">

                            <form class="form-horizontal" action="" method="post" data-url="{{ route('admin.productStore') }}" role="form" id="form-add-product" enctype="multipart/form-data">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="col-md-2 col-xs-12 control-label">Name</label>
                                        <div class="col-md-10 col-xs-12">
                                            <input type="text" class="form-control" name="name" placeholder="Enter name" id="name" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 col-xs-12 control-label">Brands</label>
                                        <div class="col-md-10 col-xs-12">
                                            <select name="brand_id" id="brand_id" class="form-control">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 col-xs-12 control-label">Color</label>
                                        <div class="col-md-10 col-xs-12 input-group colorpicker-component" id="color_picker">
                                            <input type="text" class="form-control" name="color" id="color" placeholder="Press the right button to select or enter color code"/>
                                            <span class="input-group-addon" style="background-color: #d9d3d3;border-color: #d9d3d3"><i></i></span>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 col-xs-12 control-label">Description</label>
                                        <div class="col-md-10 col-xs-12">
                                            <textarea class="form-control" name="description" id="description" rows="5">
                                            </textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 col-xs-12 control-label">Info</label>
                                        <div class="col-md-10 col-xs-12">
                                            <textarea name="info" placeholder="Enter content"></textarea>

                                            <script>
                                                CKEDITOR.replace( 'info' );
                                            </script>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 col-xs-12 control-label">Price (VNĐ)</label>
                                        <div class="col-md-10 col-xs-12 input-group">
                                            <input type="number" class="form-control price" name="price" placeholder="Enter price" id="price" />
                                            <span class="input-group-addon" id="price_input"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 col-xs-12 control-label">Sale Price (VNĐ)</label>
                                        <div class="col-md-10 col-xs-12 input-group">
                                            <input type="number" class="form-control price" name="sale_price" placeholder="Enter sale price" id="sale_price" />
                                            <span class="input-group-addon" id="sale_price_input"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3><span class="fa fa-picture-o"></span> Thumbnail</h3>
                                        </div>
                                        <div class="panel-body" align="center">  
                                            <img id='img-upload-add' height="150px" width="150px" />                  
                                        </div>
                                        <div class="panel-footer">
                                            <span class="btn btn-primary btn-file btn-file-add" style="margin-left: 15px">
                                                <span class="fa fa-picture-o"></span> Image Upload<input type="file" name="image" id="image-upload-add" title="Browse file"/>
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
                                                <div class="col-md-12">
                                                    <input type="text" class="tagsinput" id="tags"/>
                                                    <input type="hidden" name="tags" id="tagtest">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default" style="margin-top: 2em">
                                    <div class="panel-body">
                                        <h3><span class="fa fa-picture-o"></span> Images Detail</h3>
                                        <input type="file" multiple class="file" data-preview-file-type="any" name="product_images[]" />
                                    </div>
                                </div>
                                
                                <div class="panel panel-default" style="margin-top: 2em">
                                    <div class="panel-body">
                                        <h3>Sizes And Quantity</h3><br>
                                        <div id="size_input_group" class="col-md-12">

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
                <button type="submit" form="form-add-product" class="btn btn-success">Add</button>
            </div>
        </div>
    </div>
</div>
