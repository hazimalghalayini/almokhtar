<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title><?=$this->config->item('website_name').'-'.'إضافة إعلان جديد'?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="<?php echo base_url(); ?>assets/admin/assets/bootstrap-rtl/css/bootstrap-rtl.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/admin/assets/bootstrap-rtl/css/bootstrap-responsive-rtl.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/admin/css/style.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/admin/css/style_responsive.css" rel="stylesheet" />
        <link href="<?php echo base_url().'assets/admin/css/'.CUSTOM_THEME.'.css'?>" rel="stylesheet" id="style_color" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/assets/bootstrap-daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/assets/uniform/css/uniform.default.css" />
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
                                <li><a href="#">إضافة إعلان جديد</a><span class="divider-last">&nbsp;</span></li>
                            </ul>
                            <!-- END PAGE TITLE & BREADCRUMB-->
                        </div>
                    </div>
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="row-fluid">
                        <div class="span12">
                            <!-- BEGIN SAMPLE FORM widget-->
                            <div class="widget">
                                <div class="widget-title">
                                    <h4><i class="icon-reorder"></i>إضافة إعلان جديد</h4>
                                    <span class="tools">
                                        <a href="javascript:;" class="icon-chevron-down"></a>
                                    </span>
                                </div>
                                <div class="widget-body form">
                                    <!-- Start Alert Message -->
                                    <div id="status" class="alert">
                                        <span id="message"></span>
                                    </div>
                                    <!-- End Alert Message -->
                                    <!-- BEGIN FORM-->
                                    <form method="POST" id="add_form" onsubmit="return false;" class="form-horizontal">
                                        <div class="control-group">
                                            <label class="control-label">الجهة المعلنة</label>
                                            <div class="controls">
                                                <input type="text" id="name" class="span5" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">الإعلان</label>
                                            <div class="controls">
                                                <input type="file" id="file_source" name="file_source" placeholder="أرفق الإعلان" class="input-medium" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">مكان إظهار الإعلان</label>
                                            <div class="controls">
                                                <label class="radio">
                                                    <input type="radio" name="place" value="t" />
                                                    في الأعلى
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="place" value="m" />
                                                    في الوسط
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="place" value="l" />
                                                    في القائمة الجانبية
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">الـتاريخ</label>
                                            <div class="controls">
                                                <div id="form-date-range" class="btn span5">
                                                    <i class="icon-calendar"></i>
                                                    &nbsp;<span id="date_range" value=""></span>
                                                    <b class="caret"></b>
                                                </div>&nbsp;
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <img id="loading-image" class="hide" src="<?=  base_url()?>assets/admin/img/ajax-loader_dark.gif" />
                                            <button type="button" class="btn btn-success" onclick="add_ads()">حـفظ</button>
                                            <button type="reset" id="reset" class="btn">إلغاء</button>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
                                </div>
                            </div>
                            <!-- END SAMPLE FORM widget-->
                        </div>
                    </div>
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
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/assets/bootstrap-daterangepicker/date.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/assets/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/ajaxfileupload.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/scripts.js"></script>
        <script>
            jQuery(document).ready(function() {
                // initiate layout and plugins
                App.init();
            });

            function add_ads() {
                    var date_range = (($('#form-date-range span').text()).replace(/\s/g, '').split('-'));
                    $('#loading-image1').show();
                    $.ajaxFileUpload({
                        url: '<?php echo base_url() . "admin/media/do_add_ads/"; ?>',
                        secureuri: false,
                        fileElementId: 'file_source',
                        data: {
                            name: $('#name').val(),
                            start_date: date_range[0],
                            end_date: date_range[1],
                            place: $("input:radio[name=place]:checked").val(),
                            file_source: $('#file_source').val()
                        }, dataType: "json",
                        success: function(json) {
                            if (json['status'] == true) {
                                $('#status').removeClass().addClass('alert alert-success');
                                $('#message').html(json['msg']);
                                $('#add_form').trigger("reset");
                                get_all_photos();
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
        </script>
        <!-- END JAVASCRIPTS -->   
    </body>
    <!-- END BODY -->
</html>