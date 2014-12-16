<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title><?=$this->config->item('website_name').'-'.'السلايدر'?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="<?php echo base_url(); ?>assets/admin/assets/bootstrap-rtl/css/bootstrap-rtl.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/admin/assets/bootstrap-rtl/css/bootstrap-responsive-rtl.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/admin/css/style.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/admin/css/style_responsive.css" rel="stylesheet" />
        <link href="<?php echo base_url().'assets/admin/css/'.CUSTOM_THEME.'.css'?>" rel="stylesheet" id="style_color" />
        
        <link href="<?php echo base_url(); ?>assets/admin/assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/assets/uniform/css/uniform.default.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/assets/chosen-bootstrap/chosen/chosen.css" />
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
                                إدراة الأخبار
                            </h3>
                            <ul class="breadcrumb">
                                <li>
                                    <a href="#"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                                </li>
                                <li>
                                    <a href="#">قسم الأخبار</a> <span class="divider">&nbsp;</span>
                                </li>
                                <li><a href="#">إدارة الأخبار</a><span class="divider-last">&nbsp;</span></li>
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
                                    <h4><i class="icon-reorder"></i>جدول يحتوي على جميع الأخبار</h4>
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
                                    <form method="POST" id="add_form" onsubmit="return false;" class="form-horizontal">
                                        <div class="control-group">
                                            <label class="control-label">إسم التصنيف</label>
                                            <div class="controls">
                                                <select id="category_id" class="span4 chosen" data-placeholder="عرض الأخبار حسب التصنيف" tabindex="1">
                                                    <option value="showed" selected="">ما تم عرضة</option>
                                                    <option value="">عرض الكل</option>
                                                    <?php
                                                    foreach ($categories as $category) {
                                                        ?>
                                                        <option value="<?= $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                                <div class="controls">
                                                        <button id="refresh" onclick="get_all_news()" class="btn btn-primary">تحديث الجدول </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    
                                    <div class="space7"></div>
                                    
                                    <div class="span12 hide">
                                        <div class="thumbnail">
                                            <div class="item">
                                                <a class="fancybox-button" data-rel="fancybox-button" title="Photo" href="#">
                                                    <div class="zoom">
                                                        <img src="#">
                                                        <div class="zoom-icon"></div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered" id="news">
                                        <thead>
                                            <tr>
                                                <th style="width:8px;"></th>
                                                <th class="hidden-phone">صورة الخبر</th>
                                                <th class="hidden-phone">عنوان الخبر</th>
                                                <th class="hidden-phone">نص الخبر</th>
                                                <th class="hidden-phone">إسم التصنيف</th>
                                                <th class="hidden-phone">تاريخ الإضافة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
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
        <script src="<?php echo base_url(); ?>assets/admin/assets/fancybox/source/jquery.fancybox.pack.js"></script>
        <!-- ie8 fixes -->
        <!--[if lt IE 9]>
        <script src="js/excanvas.js"></script>
        <script src="js/respond.js"></script>
        <![endif]-->   
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/assets/uniform/jquery.uniform.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/assets/data-tables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/assets/data-tables/DT_bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/assets/ckeditor/ckeditor.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/scripts.js"></script>
        <script>
            jQuery(document).ready(function() {
                // initiate layout and plugins
                App.init();
                get_all_news();
            });

            function get_all_news() {
                var oTable = $('#news').dataTable({
                    "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
                    "sPaginationType": "bootstrap",
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": '<?php echo base_url(); ?>admin/news/get_main_slider/',
                    "iDisplayStart ": 10,
                    "oLanguage": {
                        "sProcessing": "<img src='<?php echo base_url(); ?>assets/admin/img/ajax-loader_dark.gif'>"
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
                    "bDestroy": true,
                    "fnServerParams": function(aoData) {
                        aoData.push({"name": "category_id", "value": $('#category_id').val()});
                    }
                });
            }

            function put_news_in_slider(news_id, current,status) {
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url() . "admin/news/put_news_in_slider/"; ?>',
                    data: {
                        news_id: news_id,
                        status: status
                    },
                    dataType: "json",
                    success: function(json) {
                        if (json['status'] === true) {
                            if(status == 1){
                                $(current).parent().empty().html('<button onClick="put_news_in_slider('+news_id+', this,'+0+')"><i class="warning icon-star-empty"></i></button>');
                            }else if(status == 0){
                                $(current).parent().empty().html('<button onClick="put_news_in_slider('+news_id+', this,'+1+')"><i class="warning icon-star"></i></button>');
                            }
                            $('#status').removeClass().addClass('alert alert-success');
                            $('#message').html(json['msg']);
                            $('#reset').click;
                        } else if (json['status'] === false) {
                            $('#status').removeClass().addClass('alert alert-error');
                            $('#message').html(json['msg']);
                        }
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
