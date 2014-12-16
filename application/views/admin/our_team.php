<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title><?=$this->config->item('website_name').'-'.'فريق العمل'?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="<?php echo base_url(); ?>assets/admin/assets/bootstrap-rtl/css/bootstrap-rtl.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/admin/assets/bootstrap-rtl/css/bootstrap-responsive-rtl.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/admin//css/style.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/admin/css/style_responsive.css" rel="stylesheet" />
        <link href="<?php echo base_url().'assets/admin/css/'.CUSTOM_THEME.'.css'?>" rel="stylesheet" id="style_color" />

        <link  href="<?php echo base_url(); ?>assets/admin/assets/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/admin/assets/data-tables/DT_bootstrap.css" type="text/css" rel="stylesheet">
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="fixed-top">
        <!-- BEGIN HEADER -->
        <?php $this->load->view('admin/includes/header_view'); ?>
        <!-- END HEADER -->
        <!-- BEGIN CONTAINER -->
        <div id="container" class="row-fluid">
            <!-- BEGIN SIDEBAR -->
            <?php $this->load->view('admin/includes/sidebar_view'); ?>
            <!-- END SIDEBAR -->
            <!-- BEGIN PAGE -->
            <div id="main-content">
                <!-- BEGIN PAGE CONTAINER-->
                <div class="container-fluid">
                    <!-- BEGIN PAGE HEADER-->
                    <div class="row-fluid">
                        <div class="span12">
                            <!-- BEGIN THEME CUSTOMIZER-->
                            <?php $this->load->view('admin/includes/themes_view'); ?>
                            <!-- END THEME CUSTOMIZER-->
                            <!-- BEGIN PAGE TITLE & BREADCRUMB-->     
                            <h3 class="page-title">
                                قسم الأخبار
                            </h3>
                            <ul class="breadcrumb">
                                <li>
                                    <a href="#"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                                </li>
                                <li>
                                    <a href="#">قسم الأخبار</a> <span class="divider">&nbsp;</span>
                                </li>
                                <li>
                                    <a href="#">فريق العمل</a> <span class="divider-last">&nbsp;</span>
                                </li>
                            </ul>
                            <!-- END PAGE TITLE & BREADCRUMB-->
                        </div>
                    </div>
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->          
                    <!-- BEGIN ADVANCED TABLE widget-->
                    <div class="row-fluid">
                        <div class="span12">
                            <!-- BEGIN EXAMPLE TABLE widget-->
                            <div class="widget">
                                <div class="widget-title">
                                    <h4><i class="icon-reorder"></i>جدول يحتوي على معلومات فريق العمل   </h4>
                                    <span class="tools">
                                        <a href="javascript:;" class="icon-chevron-down"></a>
                                    </span>
                                </div>
                                <div class="widget-body">
                                    <!-- Start Alert Message -->
                                    <div id="status" class="alert">
                                        <span id="message"></span>
                                    </div>
                                    <!-- End Alert Message -->
                                    <span>
                                        <a href="#myModal1" role="button" class="btn btn-primary" data-toggle="modal"><i class="icon-pencil icon-white"></i> إضافة جديد</a>
                                    </span>
                                    <div class="space7"></div>
                                    <table class="table table-striped table-bordered" id="users">
                                        <thead>
                                            <tr>
                                                <th style="width:8px;"></th>
                                                <th class="hidden-phone">الإسم بالكامل</th>
                                                <th class="hidden-phone">المسمى الوظيفي</th>
                                                <th class="hidden-phone">تاريخ الإضافة</th>
                                                <th class="hidden-phone">قائـمة المهام</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    
                                    <div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 id="myModalLabel1">إضافة بيانات العضو</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" id="update_form" onsubmit="return false;" class="form-horizontal">
                                                <div class="control-group">
                                                    <label class="control-label">الإسم بالكامل</label>
                                                    <div class="controls">
                                                        <input class="span12" id="full_name" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">المسمى الوظيفي</label>
                                                    <div class="controls">
                                                        <input class="span12" id="job_name" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">صورة العضو</label>
                                                    <div class="controls">
                                                        <input type="file" id="user_picture" name="user_picture" placeholder="أرفق صورة العضو" class="input-medium" />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <img id="loading-image1" class="hide" src="<?=  base_url()?>assets/admin/img/ajax-loader_dark.gif" />
                                            <button class="btn" data-dismiss="modal" aria-hidden="true">إلغاء</button>
                                            <button class="btn btn-primary" onclick="add_user()">إضافة</button>
                                        </div>
                                    </div>
                                    
                                    <div id="myModal3" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 id="myModalLabel1">تعديل بيانات العضو</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" id="update_form" onsubmit="return false;" class="form-horizontal">
                                                <div class="control-group">
                                                    <label class="control-label">الإسم بالكامل</label>
                                                    <div class="controls">
                                                        <input class="span12" id="full_name" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">المسمى الوظيفي</label>
                                                    <div class="controls">
                                                        <input class="span12" id="job_name" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">صورة العضو</label>
                                                    <div class="controls">
                                                        <input type="file" id="user_picture2" name="user_picture2" placeholder="أرفق صورة العضو" class="input-medium" />
                                                        <input type="hidden" id="old_picture" name="old_picture" class="input-medium" />
                                                        <img src="" id="current_picture" />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <img id="loading-image2" class="hide" src="<?=  base_url()?>assets/admin/img/ajax-loader_dark.gif" />
                                            <button class="btn" data-dismiss="modal" aria-hidden="true">إلغاء</button>
                                            <button class="btn btn-primary" onclick="update_user()">تعديل</button>
                                        </div>
                                    </div>
                                    
                                    <div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 id="myModalLabel1">حذف</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="control-group">
                                                <label class="control-label">تأهل تريد بالتأكيد حذف هذا العضو ؟</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <img id="loading-image3" class="hide" src="<?=  base_url()?>assets/admin/img/ajax-loader_dark.gif" />
                                            <button class="btn" data-dismiss="modal" aria-hidden="true">إلغاء</button>
                                            <button class="btn btn-primary" onclick="delete_user()">موافق</button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE widget-->
                        </div>
                    </div>
                    <!-- END ADVANCED TABLE widget-->
                    <!-- END PAGE CONTENT-->
                </div>
                <!-- END PAGE CONTAINER-->
            </div>
            <!-- END PAGE -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <?php $this->load->view('admin/includes/footer_view'); ?>
        <!-- END FOOTER -->
        <!-- BEGIN JAVASCRIPTS -->
        <!-- Load javascripts at bottom, this will reduce page load time -->
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery-1.8.3.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/assets/bootstrap-rtl/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery.blockui.js"></script>
        <!-- ie8 fixes -->
        <!--[if lt IE 9]>
        <script src="js/excanvas.js"></script>
        <script src="js/respond.js"></script>
        <![endif]-->   
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/assets/uniform/jquery.uniform.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/assets/data-tables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/assets/data-tables/DT_bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/ajaxfileupload.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/scripts.js"></script>
        <script>
            jQuery(document).ready(function() {
                // initiate layout and plugins
                App.init();
                get_all_members();
            });
            
            var curr_id = null;
            var curr_obj = null;
            function setTarget(news_id, current) {
                curr_id = news_id;
                curr_obj = current;
            }
            
            function add_user() {
                $('#loading-image1').show();
                $.ajaxFileUpload({
                    url: '<?php echo base_url() . "admin/users/do_add_user/"; ?>',
                    secureuri: false,
                    fileElementId: 'user_picture',
                    data: {
                        full_name: $('#myModal1 #full_name').val(),
                        job_name: $('#myModal1 #job_name').val(),
                        user_picture: $('#myModal1 #user_picture').val()
                    }, dataType: "json",
                    success: function(json) {
                        if (json['status'] == true) {
                            $('#status').removeClass().addClass('alert alert-success');
                            $('#message').html(json['msg']);
                            $('#add_form').trigger("reset");
                            get_all_members();
                        } else if (json['status'] == false) {
                            $('#status').removeClass().addClass('alert alert-error');
                            $('#message').html(decodeEntities(json['msg']));
                        }
                        $('#myModal1').modal('toggle');
                        $('#loading-image1').hide();
                    }, complete: function() {
                        App.scrollTo();
                    }, error: function() {
                        $('#status').removeClass().addClass('alert alert-error');
                        $('#message').text("هناك خطأ في تخزين البيانات");
                    }
                });
            }
            
            function update_user() {
                $('#loading-image2').show();
                $.ajaxFileUpload({
                    url: '<?php echo base_url() . "admin/users/do_update_user/"; ?>',
                    secureuri: false,
                    fileElementId: 'user_picture2',
                    data: {
                        user_id: curr_id,
                        full_name: $('#myModal3 #full_name').val(),
                        job_name: $('#myModal3 #job_name').val(),
                        user_picture2: $('#myModal3 #user_picture2').val(),
                        old_picture: $('#myModal3 #old_picture').val()
                    }, dataType: "json",
                    success: function(json) {
                        if (json['status'] == true) {
                            $('#status').removeClass().addClass('alert alert-success');
                            $('#message').html(json['msg']);
                            $('#update_form').trigger("reset");
                            get_all_members();
                        } else if (json['status'] == false) {
                            $('#status').removeClass().addClass('alert alert-error');
                            $('#message').html(decodeEntities(json['msg']));
                        }
                        $('#myModal3').modal('toggle');
                        $('#loading-image2').hide();
                    }, complete: function() {
                        App.scrollTo();
                    }, error: function() {
                        $('#status').removeClass().addClass('alert alert-error');
                        $('#message').text("هناك خطأ في تخزين البيانات");
                    }
                });
            }
            
            function get_user(user_id, current) {
                this.setTarget(user_id, current);
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url() . "admin/users/get_user/"; ?>',
                    data: {
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function(json) {
                        $('#myModal3 #full_name').val(json['full_name']);
                        $('#myModal3 #job_name').val(json['job_name']);
                        $('#myModal3 #current_picture').attr('src', '<?php echo base_url(); ?>uploads/users/thumbs/'+json['user_picture']);
                        $('#myModal3 #old_picture').val(json['user_picture']);
                        $('#myModal3').modal('toggle');
                    }, error: function() {
                        $('#status').removeClass().addClass('alert alert-error');
                        $('#message').text("هناك خطأ في تخزين البيانات");
                    }
                });
            }
            
            function get_all_members() {
                var oTable = $('#users').dataTable({
                    "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
                    "sPaginationType": "bootstrap",
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": '<?php echo base_url(); ?>admin/users/get_our_team/',
                    "iDisplayStart ": 10,
                    "oLanguage": {
                        "sProcessing": "<img src='<?php echo base_url(); ?>assets/admin/img/loading.gif'>"
                    },
                    'fnServerData': function(sSource, aoData, fnCallback)
                    {
                        $.ajax
                        ({
                            'dataType': 'json',
                            'type': 'POST',
                            'url': sSource,
                            'data': aoData,
                            'success': fnCallback
                        });
                    }, "bSort": false,
                       "bDestroy": true
                });
            }
            
            function delete_user() {
                $('#loading-image3').show();
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url() . "admin/users/delete_user/"; ?>',
                    data: {
                        user_id: curr_id
                    },
                    dataType: "json",
                    success: function(json) {
                        if (json['status'] == true) {
                            $(curr_obj).parents('tr').remove();
                            $('#status').removeClass().addClass('alert alert-success');
                            $('#message').html(json['msg']);
                        } else if (json['status'] == false) {
                            $('#status').removeClass().addClass('alert alert-error');
                            $('#message').html(json['msg']);
                        }
                        $('#myModal2').modal('toggle');
                        $('#loading-image3').hide();
                    }, complete: function() {
                        App.scrollTo();
                    }, error: function() {
                        $('#status').removeClass().addClass('alert alert-error');
                        $('#message').text("هناك خطأ في تخزين البيانات");
                    }
                });
            }
            
            function decodeEntities(s) {
                    var str, temp = document.createElement('p');
                    temp.innerHTML = s;
                    str = temp.textContent || temp.innerText;
                    temp = null;
                    return str;
                }
        </script>
    </body>
    <!-- END BODY -->
</html>
