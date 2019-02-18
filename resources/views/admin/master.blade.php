<!DOCTYPE html>
<html lang="en">
<head>        
    <!-- META SECTION -->
    <title>Sale Admin</title>            
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">​

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->
    
    <!-- CSS INCLUDE -->       
    
    <link rel="stylesheet" type="text/css" id="theme" href="{{ asset('admin/css/theme-default.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css">
    <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>

    <!-- EOF CSS INCLUDE -->  
    <style type="text/css">
    table{
        font-size: 13px;
    }
    
    .image-product{
        height: 60px;
        width: 60px;
        margin: 0 auto;
    }

    .color-product{
        height: 60px;
        width: 60px;
        margin: 0 auto;
    }
    
    .btn-image-edit{
        float: left;
        border:none;
        margin-left: 10px;
        margin-right: 10px;
        color: white;
        width: 37px;
        height: 37px;
        background-color: #95b75d;
        position: relative;
        overflow: hidden;
        line-height: 37px;
    }

    .btn-image-edit:hover{
        background-color: white;
        border-style: solid;
        border-width: 1px;
        border-color: #95b75d;
        color: #95b75d;
    }

    .input-image-edit{
        position: absolute;
        opacity: 0;
        right: 0;
        top: 0;
    }

    .btn-image-delete{
        width: 37px;
        height: 37px;
        float: right;
        border:none;
        margin-left: 10px;
        margin-right: 10px;
        background-color: #E04B4A;
        color: white;
    }
    .btn-image-delete:hover{
        background-color: white;
        border-style: solid;
        border-width: 1px;
        color: #E04B4A;
        border-color: #E04B4A;
    }

    .table>tbody>tr>td{
        line-height: 60px;
    }
    
    td,
    th{
        text-align: center;
    }
    .modal {
      overflow-y:auto;
    }
    .modal-body{
        overflow:auto;
    }
    .color-product{
        border: 1px;
        border-color: #F5F5F5;
        border-style: solid;
    }
    .badge{
        background-color: white;
        color: black;
        font-size: 14px;
    }
    .list-group-item{
        font-weight: bold;
    }

#post-edit,
#post-detail,
#post-delete{
    padding: 6px 11px;
    margin-right: 1px;
}
#back>span,
#post-detail>span,
#post-edit>span,
#post-delete>span {
    height: 20px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    margin-right: 0px;
}


</style>                                  
</head>
<body>
    <!-- START PAGE CONTAINER -->
    <div class="page-container">

        <!-- START PAGE SIDEBAR -->
        <div class="page-sidebar">
            <!-- START X-NAVIGATION -->
            <ul class="x-navigation">
                <li class="xn-logo">
                    <a href="index.html">Admin Page</a>
                    <a href="#" class="x-navigation-control"></a>
                </li>
                <li class="xn-profile">
                    <a href="#" class="profile-mini">
                        <img src="/storage/{{Auth::guard('admin')->user()->image}}"/>
                    </a>
                    <div class="profile">
                        <div class="profile-image">
                            <img src="/storage/{{Auth::guard('admin')->user()->image}}"/>
                        </div>
                        <div class="profile-data">
                            <div class="profile-data-name">{{Auth::guard('admin')->user()->name}}</div>
                            <div class="profile-data-title">{{Auth::guard('admin')->user()->email}}</div>
                        </div>
                        <div class="profile-controls">
                            <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                            <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                        </div>
                    </div>                                                                        
                </li>

                <li class="@yield('active_dashbroad')">
                    <a href="{{asset('')}}admin/dashbroad"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>                        
                </li>

                <li class="xn-openable @yield('active_admin')">
                    <a href="#"><span class="fa fa-user"></span> <span class="xn-text">Admins Manager</span></a>
                    <ul>                                    
                        <li class="@yield('active_admin1')"><a href="{{ route('admin.formAdminActive') }}">Active Admins</a></li>
                        <li class="@yield('active_admin2')"><a href="{{ route('admin.formAdminInactive') }}">Inactive Admins</a></li>
                    </ul>                        
                </li>

                <li class="xn-openable @yield('active_user')">
                    <a href="#"><span class="fa fa-group"></span> <span class="xn-text">Users Manager</span></a>
                    <ul>                                    
                        <li class="@yield('active_user1')"><a href="{{ route('admin.formUserActive') }}">Active Users</a></li>
                        <li class="@yield('active_user2')"><a href="{{ route('admin.formUserInactive') }}">Inactive Users</a></li>
                    </ul>                        
                </li>

                <li class="xn-openable @yield('active_product')">
                    <a href="#"><span class="fa fa-archive"></span> <span class="xn-text">Products Manager</span></a>
                    <ul>                                    
                        <li class="@yield('active_product1')"><a href="{{ route('admin.formProductStock') }}">In Stock</a></li>
                        <li class="@yield('active_product2')"><a href="{{ route('admin.formProductOutStock') }}">Out Of Stock</a></li>
                    </ul>                        
                </li>

                <li class="@yield('active_brand')">
                    <a href="{{ route('admin.formBrand') }}"><span class="fa fa-sticky-note-o"></span> <span class="xn-text">Brands Manager</span></a>
                </li>

                <li class="@yield('active_tag')">
                    <a href="{{ route('admin.formTag') }}"><span class="fa fa fa-tags"></span> <span class="xn-text">Tags Manager</span></a>
                </li>

                <li class="@yield('active_size')">
                    <a href="{{ route('admin.formSize') }}"><span class="xn-text">Sizes Manager</span></a>
                </li>

                <li class="xn-openable @yield('active_bill')">
                    <a href="#"> <span class="xn-text">Bills Manager</span></a>
                    <ul>                                    
                        <li class="@yield('active_bill1')"><a {{-- href="{{ route('admin.formProcessedBill') }}" --}}>Processed</a></li>
                        <li class="@yield('active_bill2')"><a {{-- href="{{ route('admin.formNoProcessBill') }}" --}}>No Process</a></li>
                    </ul>                        
                </li>
            </ul>
            <!-- END X-NAVIGATION -->
        </div>
        <!-- END PAGE SIDEBAR -->

        <!-- PAGE CONTENT -->
        <div class="page-content" style="overflow: auto;">

            <!-- START X-NAVIGATION VERTICAL -->
            <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                <!-- TOGGLE NAVIGATION -->
                <li class="xn-icon-button">
                    <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                </li>
                <!-- END TOGGLE NAVIGATION -->
                <!-- SEARCH -->
                <li class="xn-search">
                    <form role="form">
                        <input type="text" name="search" placeholder="Search..."/>
                    </form>
                </li>   
                <!-- END SEARCH -->
                <!-- SIGN OUT -->
                <li class="xn-icon-button pull-right">
                    <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>                        
                </li> 
                <!-- END SIGN OUT -->
                <!-- MESSAGES -->
                <li class="xn-icon-button pull-right">
                    <a href="#"><span class="fa fa-comments"></span></a>
                    <div class="informer informer-danger">4</div>
                    <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="fa fa-comments"></span> Messages</h3>                                
                            <div class="pull-right">
                                <span class="label label-danger">4 new</span>
                            </div>
                        </div>
                        <div class="panel-body list-group list-group-contacts scroll" style="height: 200px;">
                            <a href="#" class="list-group-item">
                                <div class="list-group-status status-online"></div>
                                <img src="assets/images/users/user2.jpg" class="pull-left" alt="John Doe"/>
                                <span class="contacts-title">John Doe</span>
                                <p>Praesent placerat tellus id augue condimentum</p>
                            </a>
                            <a href="#" class="list-group-item">
                                <div class="list-group-status status-away"></div>
                                <img src="assets/images/users/user.jpg" class="pull-left" alt="Dmitry Ivaniuk"/>
                                <span class="contacts-title">Dmitry Ivaniuk</span>
                                <p>Donec risus sapien, sagittis et magna quis</p>
                            </a>
                            <a href="#" class="list-group-item">
                                <div class="list-group-status status-away"></div>
                                <img src="assets/images/users/user3.jpg" class="pull-left" alt="Nadia Ali"/>
                                <span class="contacts-title">Nadia Ali</span>
                                <p>Mauris vel eros ut nunc rhoncus cursus sed</p>
                            </a>
                            <a href="#" class="list-group-item">
                                <div class="list-group-status status-offline"></div>
                                <img src="assets/images/users/user6.jpg" class="pull-left" alt="Darth Vader"/>
                                <span class="contacts-title">Darth Vader</span>
                                <p>I want my money back!</p>
                            </a>
                        </div>     
                        <div class="panel-footer text-center">
                            <a href="pages-messages.html">Show all messages</a>
                        </div>                            
                    </div>                        
                </li>
                <!-- END MESSAGES -->
                <!-- TASKS -->
                <li class="xn-icon-button pull-right">
                    <a href="#"><span class="fa fa-tasks"></span></a>
                    <div class="informer informer-warning">3</div>
                    <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="fa fa-tasks"></span> Tasks</h3>                                
                            <div class="pull-right">
                                <span class="label label-warning">3 active</span>
                            </div>
                        </div>
                        <div class="panel-body list-group scroll" style="height: 200px;">                                
                            <a class="list-group-item" href="#">
                                <strong>Phasellus augue arcu, elementum</strong>
                                <div class="progress progress-small progress-striped active">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
                                </div>
                                <small class="text-muted">John Doe, 25 Sep 2014 / 50%</small>
                            </a>
                            <a class="list-group-item" href="#">
                                <strong>Aenean ac cursus</strong>
                                <div class="progress progress-small progress-striped active">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">80%</div>
                                </div>
                                <small class="text-muted">Dmitry Ivaniuk, 24 Sep 2014 / 80%</small>
                            </a>
                            <a class="list-group-item" href="#">
                                <strong>Lorem ipsum dolor</strong>
                                <div class="progress progress-small progress-striped active">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%;">95%</div>
                                </div>
                                <small class="text-muted">John Doe, 23 Sep 2014 / 95%</small>
                            </a>
                            <a class="list-group-item" href="#">
                                <strong>Cras suscipit ac quam at tincidunt.</strong>
                                <div class="progress progress-small">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100%</div>
                                </div>
                                <small class="text-muted">John Doe, 21 Sep 2014 /</small><small class="text-success"> Done</small>
                            </a>                                
                        </div>     
                        <div class="panel-footer text-center">
                            <a href="pages-tasks.html">Show all tasks</a>
                        </div>                            
                    </div>                        
                </li>
                <!-- END TASKS -->
            </ul>
            <!-- END X-NAVIGATION VERTICAL -->                     

            <!-- START BREADCRUMB -->
            <ul class="breadcrumb">
                <li>Home</li>                    
                <li class="active">@yield('breadcrumb')</li>
            </ul>
            <!-- END BREADCRUMB -->                       

            <!-- PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap">

             @yield('content')

         </div>

         <!-- END PAGE CONTENT WRAPPER -->                                 
     </div>     
     <!-- END PAGE CONTENT -->
 </div>
 <!-- END PAGE CONTAINER -->

 <!-- MESSAGE BOX-->
 <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
            <div class="mb-content">
                <p>Are you sure you want to log out?</p>                    
                <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
            </div>

            <div class="mb-footer">
                <form action="{{route('admin.logout')}}" method="post">
                    @csrf
                    <div class="pull-right">
                        <button type="submit" class="btn btn-success btn-lg">Yes</button>
                        <button class="btn btn-default btn-lg mb-control-close">No</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
<!-- END MESSAGE BOX-->

<!-- START PRELOADS -->

<audio id="audio-alert" src="{{ asset('admin/audio/alert.mp3') }}" preload="auto"></audio>
<audio id="audio-fail" src="{{ asset('admin/audio/fail.mp3') }}" preload="auto"></audio>
<!-- END PRELOADS -->                  

<!-- START SCRIPTS -->
<!-- START PLUGINS -->
<script type="text/javascript" src="{{ asset('admin/js/plugins/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/plugins/jquery/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/plugins/bootstrap/bootstrap.min.js') }}"></script>        
<!-- END PLUGINS -->

<!-- START THIS PAGE PLUGINS-->        
<script type='text/javascript' src='{{ asset('admin/js/plugins/icheck/icheck.min.js') }}'></script>        
<script type="text/javascript" src="{{ asset('admin/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('admin/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>

<script type="text/javascript" src="{{ asset('admin/js/plugins/fileinput/fileinput.min.js') }}"></script>        
<script type="text/javascript" src="{{ asset('admin/js/plugins/filetree/jqueryFileTree.js') }}"></script>
<script>
    $(function(){
        $("#thumbnail").fileinput({
            showUpload: false,
            showCaption: false,
            browseClass: "btn btn-danger",
            fileType: "any"
        });            
        $("#filetree").fileTree({
            root: '/',
            script: 'assets/filetree/jqueryFileTree.php',
            expandSpeed: 100,
            collapseSpeed: 100,
            multiFolder: false                    
        }, function(file) {
            alert(file);
        }, function(dir){
            setTimeout(function(){
                page_content_onresize();
            },200);                    
        });                
    });            
</script>


<!-- END THIS PAGE PLUGINS-->        

<!-- START TEMPLATE -->
<script type="text/javascript" src="{{ asset('admin/js/plugins.js') }}"></script>        
<script type="text/javascript" src="{{ asset('admin/js/actions.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/ntc.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
<script type="text/javascript" src="{{ asset('admin/js/plugins/tagsinput/jquery.tagsinput.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Buttons/2.0.0/js/buttons.min.js"></script>
<!-- Bootstrap JavaScript -->
<!-- END TEMPLATE -->
<!-- END SCRIPTS -->
@yield('toastr')
@yield('script')
</body>
</html>

@yield('ajax')