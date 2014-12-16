<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title><?= $this->config->item('website_name') . '-' . 'إعدادات الموقع' ?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="<?php echo base_url(); ?>assets/admin/assets/bootstrap-rtl/css/bootstrap-rtl.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/admin/assets/bootstrap-rtl/css/bootstrap-responsive-rtl.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/admin/css/style.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/admin/css/style_responsive.css" rel="stylesheet" />
        <link href="<?php echo base_url() . 'assets/admin/css/' . CUSTOM_THEME . '.css' ?>" rel="stylesheet" id="style_color" />

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
                                <li><a href="#">إعدادات الموقع</a><span class="divider-last">&nbsp;</span></li>
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
                                    <h4><i class="icon-reorder"></i>إعدادات الموقع</h4>
                                    <span class="tools">
                                        <a href="javascript:;" class="icon-chevron-down"></a>
                                    </span>
                                </div>
                                <div class="widget-body form">
                                    <!-- Start Alert Message -->
                                    <div id="status" class="alert alert-info">
                                        <span id="message">الرجاء وضع الروابط الأصلية للصفحات وليس الإختصارات</span>
                                    </div>
                                    <!-- End Alert Message -->
                                    <!-- BEGIN FORM-->
                                    <form method="POST" id="add_form" onsubmit="return false;" class="form-horizontal">
                                        <div class="control-group">
                                            <label class="control-label">إيميل الموقع</label>
                                            <div class="controls">
                                                <div class="input-icon left">
                                                    <i class="icon-envelope"></i>
                                                    <input id="email" class="span5" dir="ltr" placeholder="Email Address" value="<?=$settings['email']?>" type="email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">صفحة الفيس بوك</label>
                                            <div class="controls">
                                                <div class="input-icon left">
                                                    <i class="icon-facebook"></i>
                                                    <input id="facebook" dir="ltr" class="span5" value="<?=$settings['facebook']?>" placeholder="Facebook Page" type="url">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">صفحة التويتر</label>
                                            <div class="controls">
                                                <div class="input-icon left">
                                                    <i class="icon-twitter"></i>
                                                    <input id="twitter" dir="ltr" class="span5 " value="<?=$settings['twitter']?>" placeholder="Twitter Page" type="url">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">صفحة قوقل بلس</label>
                                            <div class="controls">
                                                <div class="input-icon left">
                                                    <i class="icon-google-plus"></i>
                                                    <input id="google-plus" dir="ltr" class="span5 " value="<?=$settings['google_plus']?>" placeholder="Google+ Page" type="url">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">صفحة اليوتيوب</label>
                                            <div class="controls">
                                                <div class="input-icon left">
                                                    <i class="icon-play"></i>
                                                    <input id="youtube" dir="ltr" class="span5" value="<?=$settings['youtube']?>" placeholder="Youtube Page" type="url">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">صفحة بنترست </label>
                                            <div class="controls">
                                                <div class="input-icon left">
                                                    <i class="icon-pinterest"></i>
                                                    <input id="pinterest" dir="ltr" class="span5" value="<?=$settings['pinterest']?>" placeholder="Pinterest Page" type="url">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">صفحة الRSS</label>
                                            <div class="controls">
                                                <div class="input-icon left">
                                                    <i class="icon-rss"></i>
                                                    <input id="rss" dir="ltr" class="span5" value="<?=$settings['rss']?>" placeholder="RSS Page" type="url">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="button" class="btn btn-success" onclick="update_settings()">حـفظ</button>
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
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/scripts.js"></script>
        <script>
                jQuery(document).ready(function() {
                    // initiate layout and plugins
                    App.init();
                });

                function update_settings() {
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url() . "admin/settings/update_settings/"; ?>',
                        data: {
                            email: $('#email').val(),
                            facebook: $('#facebook').val(),
                            twitter: $('#twitter').val(),
                            rss: $('#rss').val(),
                            google_plus: $('#google-plus').val(),
                            youtube: $('#youtube').val(),
                            pinterest: $('#pinterest').val()
                        },
                        dataType: "json",
                        success: function(json) {
                            if (json['status'] == true) {
                                $('#status').removeClass().addClass('alert alert-success');
                                $('#message').html(json['msg']);
                            } else if (json['status'] == false) {
                                $('#status').removeClass().addClass('alert alert-error');
                                $('#message').html(json['msg']);
                            }
                            $('#myModal1').modal('toggle');
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