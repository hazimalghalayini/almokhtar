<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title><?=$this->config->item('website_name').'-'.'إدارة الأخبار العاجلة'?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="<?php echo base_url(); ?>assets/admin/assets/bootstrap-rtl/css/bootstrap-rtl.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/admin/assets/bootstrap-rtl/css/bootstrap-responsive-rtl.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/admin/css/style.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/admin/css/style_responsive.css" rel="stylesheet" />
        <link href="<?php echo base_url().'assets/admin/css/'.CUSTOM_THEME.'.css'?>" rel="stylesheet" id="style_color" />

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/assets/uniform/css/uniform.default.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/assets/data-tables/DT_bootstrap.css" />
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
                                <li><a href="#">إدارة الأخبار العاجلة</a><span class="divider-last">&nbsp;</span></li>
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
                                    <h4><i class="icon-reorder"></i>جدول يحتوي على جميع الأخبار العاجلة</h4>
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
                                    <table class="table table-striped table-bordered" id="recent_news">
                                        <thead>
                                            <tr>
                                                <th style="width:8px;"></th>
                                                <th class="hidden-phone">التاريخ</th>
                                                <th class="hidden-phone">نص الخبر</th>
                                                <th class="hidden-phone">قائـمة المهام</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>

                                    <div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 id="myModalLabel1">إضافة خبر إلي الشريط الإخباري</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" id="add_form" onsubmit="return false;" class="form-horizontal">
                                                <div class="control-group">
                                                    <label class="control-label">تفاصيل الخبر</label>
                                                    <div class="controls">
                                                        <textarea class="span12" id="news_description" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <img id="loading-image1" class="hide" src="<?=  base_url()?>assets/admin/img/ajax-loader_dark.gif" />
                                            <button class="btn" data-dismiss="modal" aria-hidden="true">إلغاء</button>
                                            <button class="btn btn-primary" onclick="add_slide_news()">حفظ</button>
                                        </div>
                                    </div>

                                    <div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 id="myModalLabel1">حذف</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="control-group">
                                                <label class="control-label">تأهل تريد بالتأكيد حذف هذا الخبر ؟</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <img id="loading-image2" class="hide" src="<?=  base_url()?>assets/admin/img/ajax-loader_dark.gif" />
                                            <button class="btn" data-dismiss="modal" aria-hidden="true">إلغاء</button>
                                            <button class="btn btn-primary" onclick="delete_slide_news()">موافق</button>
                                        </div>
                                    </div>

                                    <div id="myModal3" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 id="myModalLabel1">تعديل بيانات الخبر</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" id="update_form" onsubmit="return false;" class="form-horizontal">
                                                <div class="control-group">
                                                    <label class="control-label">تفاصيل الخبر</label>
                                                    <div class="controls">
                                                        <textarea class="span12" id="news_description" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <img id="loading-image3" class="hide" src="<?=  base_url()?>assets/admin/img/ajax-loader_dark.gif" />
                                            <button class="btn" data-dismiss="modal" aria-hidden="true">إلغاء</button>
                                            <button class="btn btn-primary" onclick="update_slide_news()">تعديل</button>
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
        <script src="<?php echo base_url(); ?>assets/admin/js/scripts.js"></script>
        <script>
            jQuery(document).ready(function() {
                // initiate layout and plugins
                App.init();
                get_all_news();
            });

            var curr_id = null;
            var curr_obj = null;
            function setTarget(news_id, current) {
                curr_id = news_id;
                curr_obj = current;
            }

            function add_slide_news() {
                $('#loading-image1').show();
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url() . "admin/news/do_add_slide_news/"; ?>',
                    data: {
                        news_description: $('#news_description').val()
                    },
                    dataType: "json",
                    success: function(json) {
                        if (json['status'] == true) {
                            $('#status').removeClass().addClass('alert alert-success');
                            $('#message').html(json['msg']);
                            $('#add_form').trigger("reset");
                            get_all_news();
                        } else if (json['status'] == false) {
                            $('#status').removeClass().addClass('alert alert-error');
                            $('#message').html(json['msg']);
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

            function get_all_news(){
                var oTable = $('#recent_news').dataTable({
                    "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
                    "sPaginationType": "bootstrap",
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": '<?php echo base_url(); ?>admin/news/get_all_recent_news/',
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

            function delete_slide_news() {
                $('#loading-image2').show();
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url() . "admin/news/delete_slide_news/"; ?>',
                    data: {
                        news_id: curr_id
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
                        $('#loading-image2').hide();
                    }, complete: function() {
                        App.scrollTo();
                    }, error: function() {
                        $('#status').removeClass().addClass('alert alert-error');
                        $('#message').text("هناك خطأ في تخزين البيانات");
                    }
                });
            }

            function get_slide_news(news_id, current) {
                this.setTarget(news_id, current);
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url() . "admin/news/get_slide_news/"; ?>',
                    data: {
                        news_id: news_id
                    },
                    dataType: "json",
                    success: function(json) {
                        $('#myModal3 #news_description').val(json['news_description']);
                        $('#myModal3').modal('toggle');
                    }, error: function() {
                        $('#status').removeClass().addClass('alert alert-error');
                        $('#message').text("هناك خطأ في تخزين البيانات");
                    }
                });
            }
            
            function update_slide_news() {
                $('#loading-image3').show();
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url() . "admin/news/update_slide_news/"; ?>',
                    data: {
                        news_id: curr_id,
                        news_description: $('#myModal3 #news_description').val()
                    },
                    dataType: "json",
                    success: function(json) {
                        if (json['status'] == true) {
                            $('#status').removeClass().addClass('alert alert-success');
                            $('#message').html(json['msg']);
                            $('#update_form').trigger("reset");
                            get_all_news();
                        } else if (json['status'] == false) {
                            $('#status').removeClass().addClass('alert alert-error');
                            $('#message').html(json['msg']);
                        }
                        $('#myModal3').modal('toggle');
                        $('#loading-image3').show();
                    }, complete: function() {
                        App.scrollTo();
                    }, error: function() {
                        $('#status').removeClass().addClass('alert alert-error');
                        $('#message').text("هناك خطأ في تخزين البيانات");
                    }
                });
            }
        </script>
    </body>
    <!-- END BODY -->
</html>
