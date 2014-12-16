<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title><?= $this->config->item('website_name') . '-' . 'إضافة خبر جديد' ?></title>
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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/assets/chosen-bootstrap/chosen/chosen.css" />
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
                                <li><a href="#">إضافة خبر جديد </a><span class="divider-last">&nbsp;</span></li>
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
                                    <h4><i class="icon-reorder"></i>إضافة خبر جديد</h4>
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
                                            <label class="control-label">إسم التصنيف</label>
                                            <div class="controls">
                                                <select id="category_id" class="span11 chosen" data-placeholder="يجب إختيار التصنيف لهذا الخبر" tabindex="1">
                                                    <option value=""></option>
                                                    <?php
                                                    foreach ($categories as $category) {
                                                        ?>
                                                        <option value="<?= $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">الدولة</label>
                                            <div class="controls">
                                                <select id="country_id" class="span11 chosen" data-placeholder="يجب إختيار الدولة التي يخصها الخبر" tabindex="1">
                                                    <option value=""></option>
                                                    <?php
                                                    foreach ($countries as $country) {
                                                        ?>
                                                        <option value="<?= $country['id'] ?>"><?php echo $country['country_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">عنوان الخبر</label>
                                            <div class="controls">
                                                <input type="text" id="news_title" name="news_title" class="span11" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">صورة للخبر</label>
                                            <div class="controls">
                                                <input type="file" id="news_picture" name="news_picture" placeholder="أرفق صورة الخبر" class="input-medium" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">نص الخبر</label>
                                            <div class="controls">
                                                <textarea dir="rtl" class="span11" id="news_description" rows="6"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <img id="loading-image" class="hide" src="<?=  base_url()?>assets/admin/img/ajax-loader_dark.gif" />
                                            <button type="button" class="btn btn-success" onclick="add_news()">حـفظ</button>
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
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/assets/uniform/jquery.uniform.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/assets/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/ajaxfileupload.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/scripts.js"></script>
        <script>
            jQuery(document).ready(function() {
                // initiate layout and plugins
                App.init();
            });
            
            CKEDITOR.replace( 'news_description',
            {
                language: 'ar'
            });

            function add_news() {
                $('#loading-image').show();
                var a = CKEDITOR.instances.news_description.getData();
                var b = a.replace(/"/g, "--*");
                b = b.replace(/'/g, "++*");
                b = b.replace(/style/g, "+++");
                $.ajaxFileUpload({
                    url: '<?php echo base_url() . "admin/news/do_add_news/"; ?>',
                    secureuri: false,
                    fileElementId: 'news_picture',
                    data: {
                        category_id: $('#category_id').val(),
                        news_title: $('#news_title').val(),
                        country_id: $('#country_id').val(),
                        news_description: b,
                        news_picture: $('#news_picture').val()
                    }, dataType: "json",
                    success: function(json) {
                        if (json['status'] == true) {
                            $('#status').removeClass().addClass('alert alert-success');
                            $('#message').html(json['msg']);
                            $('#reset').trigger("reset");
                        } else if (json['status'] == false) {
                            $('#status').removeClass().addClass('alert alert-error');
                            $('#message').html(decodeEntities(json['msg']));
                        }
                        $('#loading-image').hide();
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
        <!-- END JAVASCRIPTS -->   
    </body>
    <!-- END BODY -->
</html>