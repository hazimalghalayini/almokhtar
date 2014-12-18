<div class="nav-search-outer"> 
    <!-- nav start -->
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container">
            <div class="row">
                <div class="col-sm-16"> <a href="javascript:;" class="toggle-search pull-left"><span class="ion-ios-search"></span></a>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-collapse">
                        <ul class="nav navbar-nav text-uppercase main-nav ">
                            <li class="active"><a href="index-2.html">الرئيسية</a></li>

                            <?php
                            foreach ($categories as $category) {
                                echo '<li><a href="javascript:void(0)">' . $category['category_name'] . '</a></li>';
                            }
                            ?>

<!--<li class="dropdown"> <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">الأخبار<span class="ion-ios-arrow-down nav-icn"></span></a>-->
                            <!--                                <ul class="dropdown-menu text-capitalize mega-menu" role="menu">
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-sm-16">
                                                                            <div class="row">
                                                                                <div class="col-xs-16 col-sm-16 col-md-6 col-lg-6">
                                                                                    <ul class="mega-sub">
                                                                                        <li><a href="#"><span class="ion-ios-arrow-left nav-sub-icn pull-right" style="padding-right:20px;"></span>أخبار سياسية</a> </li>
                                                                                        <li><a href="#"><span class="ion-ios-arrow-left nav-sub-icn pull-right" style="padding-right:20px;"></span>أخبار إقتصادية</a> </li>
                                                                                        <li><a href="#"><span class="ion-ios-arrow-left nav-sub-icn pull-right" style="padding-right:20px;"></span>أخبار مرئية</a> </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="col-sm-10 mega-sub-topics hidden-sm hidden-xs">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-8">
                                                                                            <div class="vid-thumb">
                                                                                                <h4>بعد امتناعهم عن توليد سيدة بكفر الدوار.. إحالة مدير مستشفى و7 أطباء للمحاكمة</h4>
                                                                                                <div class="sub-box"><img class="img-thumbnail" src="http://media.linkonlineworld.com/img/Large/2014/12/13/2014_12_13_11_41_24_853.jpg" width="300" height="132" alt=""/> </div>
                                                                                                </a> </div>
                                                                                        </div>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="sub-topic-thumb">
                                                                                                <h4>السيسي يوجه رسالة هامة إلى الشعب المصري في الاحتفال بعيد العِلم</h4>
                                                                                                <a href="#">
                                                                                                    <div class="sub-box"><img class="img-thumbnail" src="http://media.linkonlineworld.com/img/Large/2014/12/13/2014_12_13_12_57_33_523.jpg" width="300" height="132" alt=""/> </div>
                                                                                                </a> </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        
                                                        <li class="dropdown"> <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">الرياضة<span class="ion-ios-arrow-down nav-icn"></span></a>
                                                            <ul class="dropdown-menu text-capitalize mega-menu" role="menu">
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-sm-16">
                                                                            <div class="row">
                                                                                <div class="col-xs-16 col-sm-16 col-md-6 col-lg-6">
                                                                                    <ul class="mega-sub">
                                                                                        <li><a href="#"><span class="ion-ios-arrow-left nav-sub-icn pull-right" style="padding-right:20px;"></span>رياضة عربية</a> </li>
                                                                                        <li><a href="#"><span class="ion-ios-arrow-left nav-sub-icn pull-right" style="padding-right:20px;"></span>رياضة عالمية</a> </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="col-sm-10 mega-sub-topics hidden-sm hidden-xs">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-8">
                                                                                            <div class="vid-thumb">
                                                                                                <h4>عفريت الأهلي: جوزيه وجه لي السباب في أول حديث معه!</h4>
                                                                                                <a class="popup-youtube" href="https://www.youtube.com/watch?v=PJzWw4cTNqw">
                                                                                                    <div class="vid-box"><span class="ion-ios-film"></span><img class="img-thumbnail" src="http://i.arabia.eurosport.com/2013/08/18/1077215-17170064-640-360.jpg" width="300" height="132" alt=""/> </div>
                                                                                                </a> </div>
                                                                                        </div>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="sub-topic-thumb">
                                                                                                <h4> ريال مدريد فشل في مهرجان الغطس للجميع فأحرز أهدافاً رائعة</h4>
                                                                                                <a href="#">
                                                                                                    <div class="sub-box"><img class="img-thumbnail" src="http://i.arabia.eurosport.com/2014/12/12/1370463-29403294-640-360.jpg" width="300" height="132" alt=""/> </div>
                                                                                                </a> </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </li>-->
                            <!--                            <li><a href="javascript:void(0)">المال والأعمال</a></li>
                                                        <li><a href="javascript:void(0)" >السياحة والسفر</a></li>
                                                        <li> <a href="javascript:void(0)">الأدب</a></li>
                                                        <li> <a href="javascript:void(0)">الترفية</a></li>-->
                            <li class="dropdown"> <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">المختار في<span class="ion-ios-arrow-down nav-icn"></span></a>
                                <ul class="dropdown-menu text-capitalize" role="menu">
                                    <li class="hidden"></li>
                                    <li><a href="blog-masonry.html"><span class="ion-ios-arrow-left nav-sub-icn pull-right"></span>المختار العام</a></li>
                                    <li><a href="blog-masonry.html"><span class="ion-ios-arrow-left nav-sub-icn pull-right"></span>مصر</a></li>
                                    <li><a href="post-item-details.html"><span class="ion-ios-arrow-left nav-sub-icn pull-right"></span>السعودية</a></li>
                                    <li><a href="post-item-details.html"><span class="ion-ios-arrow-left nav-sub-icn pull-right"></span>قطر</a></li>
                                    <li><a href="post-item-details.html"><span class="ion-ios-arrow-left nav-sub-icn pull-right"></span>الإمارات</a></li>
                                    <li><a href="post-item-details.html"><span class="ion-ios-arrow-left nav-sub-icn pull-right"></span>سورية</a></li>
                                    <li><a href="post-item-details.html"><span class="ion-ios-arrow-left nav-sub-icn pull-right"></span>الأردن</a></li>
                                    <li><a href="post-item-details.html"><span class="ion-ios-arrow-left nav-sub-icn pull-right"></span>لبنان</a></li>
                                    <li><a href="post-item-details.html"><span class="ion-ios-arrow-left nav-sub-icn pull-right"></span>الكويت</a></li>
                                    <li><a href="post-item-details.html"><span class="ion-ios-arrow-left nav-sub-icn pull-right"></span>فلسطين</a></li>
                                    <li><a href="post-item-details.html"><span class="ion-ios-arrow-left nav-sub-icn pull-right"></span>العراق</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- nav end --> 
        <!-- search start -->

        <div class="search-container ">
            <div class="container">
                <form action="#" method="" role="search">
                    <input id="search-bar" placeholder="ابحث عن ..." autocomplete="off">
                </form>
            </div>
        </div>
        <!-- search end --> 
    </nav>
    <!--nav end--> 
</div>