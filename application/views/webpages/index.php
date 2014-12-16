<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?=$this->config->item('website_name').' - الرئيسية'?></title>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/webpages/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url(); ?>assets/webpages/images/favicon.ico" type="image/x-icon">
        <!-- bootstrap styles-->
        <link href="<?php echo base_url(); ?>assets/webpages/css/bootstrap.min.css" rel="stylesheet">
        <!-- google font -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>
        <!-- ionicons font -->
        <link href="<?php echo base_url(); ?>assets/webpages/css/ionicons.css" rel="stylesheet">
        <!-- animation styles -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/webpages/css/animate.css" />
        <!-- custom styles -->
        <link href="<?php echo base_url(); ?>assets/webpages/css/custom-red.css" rel="stylesheet" id="style">
        <!-- owl carousel styles-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/webpages/css/owl.carousel.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/webpages/css/owl.transitions.css">
        <!-- magnific popup styles -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/webpages/css/magnific-popup.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
    </head>
    <body>
        <!-- preloader start -->
        <div id="preloader">
            <div id="status"></div>
        </div>
        <!-- preloader end -->

        <!-- wrapper start -->
        <div class="wrapper"> 
            <!-- header toolbar start -->
            <?php $this->load->view('webpages/includes/header_toolbar'); ?>
            <!-- header toolbar end --> 

            <!-- header start -->
            <?php $this->load->view('webpages/includes/header'); ?>
            <!-- header end --> 

            <!-- nav and search start -->
            <?php $this->load->view('webpages/includes/head_menu'); ?>
            <!-- nav and search end--> 

            <!-- top sec start -->
            <div class="container">
                <div class="row"> 
                    <!-- hot news start -->
                    <?php $this->load->view('webpages/includes/hot_news'); ?>
                    <!-- hot news end --> 

                    <!-- banner outer start -->
                    <?php $this->load->view('webpages/includes/main_slider'); ?>
                    <!-- banner outer end --> 

                </div>
            </div>
            <!-- top sec end --> 

            <!-- data start -->
            <div class="container ">
                <div class="row "> 
                    <!-- left sec start -->
                    <div class="col-md-11 col-sm-11">
                        <div class="row"> 
                            <!-- News and Visual News start -->
                            <div class="col-sm-16">
                                <div class="row">
                                    <!-- News start -->
                                    <?php $this->load->view('webpages/includes/news_section'); ?>
                                    <!-- News end --> 

                                    <!-- Visual News start -->
                                    <?php $this->load->view('webpages/includes/visual_news'); ?>
                                    <!-- Visual News end --> 
                                </div>
                                <hr>
                            </div>
                            <!-- News and Visual News --> 

                            <!-- business_money & travel_tourism start -->
                            <div class="col-sm-16">
                                <div class="row">
                                    <!-- business_money start -->
                                    <?php $this->load->view('webpages/includes/business_money'); ?>
                                    <!-- business_money end --> 

                                    <!-- travel_tourism start -->
                                    <?php $this->load->view('webpages/includes/travel_tourism'); ?>
                                    <!-- travel_tourism end -->
                                </div>
                                <hr>
                            </div>
                            <!-- business_money & travel_tourism end --> 

                            <!--wide ad start-->
                            <?php $this->load->view('webpages/includes/wide_ad'); ?>
                            <!--wide ad end--> 

                            <!-- photo_gallary start-->
                            <?php $this->load->view('webpages/includes/photo_gallary'); ?>
                            <!-- photo_gallary end --> 

                            <!-- sport_section & literature_section start -->
                            <div class="col-sm-16">
                                <div class="row">
                                    <!--sport_section ad start-->
                                    <?php $this->load->view('webpages/includes/sport_section'); ?>
                                    <!--sport_section ad end--> 

                                    <!-- literature_section start-->
                                    <?php $this->load->view('webpages/includes/literature_section'); ?>
                                    <!-- literature_section end --> 

                                </div>
                                <hr>
                            </div>
                            <!-- sport_section & literature_section end -->

                            <!--wide ad start-->
                            <?php $this->load->view('webpages/includes/wide_ad'); ?>
                            <!--wide ad end-->

                            <!--Recent videos start-->
                            <?php $this->load->view('webpages/includes/video_gallary'); ?>
                            <!--Recent videos end--> 

                            <!--wide ad start-->
                            <?php $this->load->view('webpages/includes/wide_ad'); ?>
                            <!--wide ad end--> 

                        </div>
                    </div>
                    <!-- left sec end --> 
                    <!-- right sec start -->
                    <div class="col-sm-5 hidden-xs right-sec">
                        <div class="bordered top-margin">
                            <div class="row ">
                                <!--sidebar ad start-->
                                <?php $this->load->view('webpages/includes/sidebar_ad'); ?>
                                <!--sidebar ad end--> 
                                
                                <!-- social networks widget start -->
                                <?php $this->load->view('webpages/includes/social_networks_widget'); ?>
                                <!-- social networks widget end --> 

                                <!-- activities start -->
                                <?php $this->load->view('webpages/includes/activities_widget'); ?>
                                <!-- activities end --> 

                                <!--sidebar ad start-->
                                <?php $this->load->view('webpages/includes/sidebar_ad'); ?>
                                <!--sidebar ad end--> 

                                <!-- radio start -->
                                <?php $this->load->view('webpages/includes/soundcloud_widget'); ?>
                                <!-- radio end --> 

                                <!--sidebar ad start-->
                                <?php $this->load->view('webpages/includes/sidebar_ad'); ?>
                                <!--sidebar ad end--> 

                                <!-- currency start -->
                                <?php $this->load->view('webpages/includes/currency_widget'); ?>
                                <!-- currency end --> 

                                <!--sidebar ad start-->
                                <?php $this->load->view('webpages/includes/sidebar_ad'); ?>
                                <!--sidebar ad end-->  
                            </div>
                        </div>
                    </div>
                    <!-- right sec end --> 
                </div>
            </div>
            <!-- data end --> 

            <!-- Footer start -->
            <footer>
                <div class="top-sec">
                    <div class="container ">
                        <div class="row match-height-container">
                            <!--subscribe widget start-->
                            <?php $this->load->view('webpages/includes/subscribe_widget'); ?>
                            <!--subscribe widget end--> 

                            <!--tags widget start-->
                            <?php $this->load->view('webpages/includes/tags_widget'); ?>
                            <!--tags widget end--> 

                            <!--twitter widget start-->
                            <?php $this->load->view('webpages/includes/twitter_widget'); ?>
                            <!--twitter widget end--> 
                        </div>
                    </div>
                </div>
            </footer>
            <!-- Footer end -->
        </div>
        <!-- wrapper end --> 

        <!-- jQuery --> 
        <script src="<?php echo base_url(); ?>assets/webpages/js/jquery.min.js"></script> 
        <!--jQuery easing--> 
        <script src="<?php echo base_url(); ?>assets/webpages/js/jquery.easing.1.3.js"></script> 
        <!-- bootstrab js --> 
        <script src="<?php echo base_url(); ?>assets/webpages/js/bootstrap.js"></script> 
        <!--style switcher--> 
        <script src="<?php echo base_url(); ?>assets/webpages/js/style-switcher.js"></script> <!--wow animation--> 
        <script src="<?php echo base_url(); ?>assets/webpages/js/wow.min.js"></script> 
        <!-- time and date --> 
        <script src="<?php echo base_url(); ?>assets/webpages/js/moment.min.js"></script> 
        <!--news ticker--> 
        <script src="<?php echo base_url(); ?>assets/webpages/js/jquery.ticker.js"></script> 
        <!-- owl carousel --> 
        <script src="<?php echo base_url(); ?>assets/webpages/js/owl.carousel.js"></script> 
        <!-- magnific popup --> 
        <script src="<?php echo base_url(); ?>assets/webpages/js/jquery.magnific-popup.js"></script> 
        <!-- weather --> 
        <script src="<?php echo base_url(); ?>assets/webpages/js/jquery.simpleWeather.min.js"></script> 
        <!-- calendar--> 
        <script src="<?php echo base_url(); ?>assets/webpages/js/jquery.pickmeup.js"></script> 
        <!-- go to top --> 
        <script src="<?php echo base_url(); ?>assets/webpages/js/jquery.scrollUp.js"></script> 
        <!-- scroll bar --> 
        <script src="<?php echo base_url(); ?>assets/webpages/js/jquery.nicescroll.js"></script> 
        <script src="<?php echo base_url(); ?>assets/webpages/js/jquery.nicescroll.plus.js"></script> 
        <!--masonry--> 
        <script src="<?php echo base_url(); ?>assets/webpages/js/masonry.pkgd.js"></script> 
        <!--media queries to js--> 
        <script src="<?php echo base_url(); ?>assets/webpages/js/enquire.js"></script> 
        <!--custom functions--> 
        <script src="<?php echo base_url(); ?>assets/webpages/js/custom-fun.js"></script>
    </body>
</html>