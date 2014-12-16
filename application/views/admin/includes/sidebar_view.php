<div id="sidebar" class="nav-collapse collapse">

    <div class="sidebar-toggler hidden-phone"></div>

    <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
    <div class="navbar-inverse">
        <form class="navbar-search visible-phone">
            <input type="text" class="search-query" placeholder="Search" />
        </form>
    </div>
    <!-- END RESPONSIVE QUICK SEARCH FORM -->
    <!-- BEGIN SIDEBAR MENU -->
    <ul class="sidebar-menu">
        <li class="has-sub active">
            <a href="javascript:;" class="">
                <span class="icon-box"> <i class="icon-tags"></i></span> إدارة الأخبار
                <span class="arrow"></span>
            </a>
            <ul class="sub">
                <li><a class="" href="<?php echo base_url() . "admin/news"; ?>">الرئيسية</a></li>
                <li><a class="" href="<?php echo base_url() . "admin/categories/manage_categories"; ?>">إدارة التصنيفات</a></li>
                <li><a class="" href="<?php echo base_url() . "admin/news/add_news"; ?>">إضافة خبر</a></li>
                <li><a class="" href="<?php echo base_url() . "admin/news/manage_news"; ?>">إدارة الأخبار</a></li>
                <li><a class="" href="<?php echo base_url() . "admin/media/manage_photos"; ?>">معرض الصور</a></li>
                <li><a class="" href="<?php echo base_url() . "admin/media/add_v_news"; ?>">إضافة خبر مرئي</a></li>
                <li><a class="" href="<?php echo base_url() . "admin/media/manage_v_news"; ?>">إدارة الأخبار المرئية</a></li>
                <li><a class="" href="<?php echo base_url() . "admin/media/add_video"; ?>">إضافة مقطع فيديو</a></li>
                <li><a class="" href="<?php echo base_url() . "admin/media/manage_videos"; ?>"> إدارة مقاطع الفيديو</a></li>
                <li><a class="" href="<?php echo base_url() . "admin/news/main_slider"; ?>">السلايدر الرئيسي</a></li>
                <li><a class="" href="<?php echo base_url() . "admin/news/recent_comments"; ?>">أحدث التعليقات</a></li>
            </ul>
        </li>
        <li class="has-sub">
            <a href="javascript:;" class="">
                <span class="icon-box"> <i class="icon-book"></i></span>  الصفحات الثابتة
                <span class="arrow"></span>
            </a>
            <ul class="sub">
                <li><a class="" href="<?php echo base_url() . "admin/pages/about_us"; ?>">من نحن</a></li>
                <li><a class="" href="<?php echo base_url() . "admin/pages/privacy_policy"; ?>">سياسة الإستخدام</a></li>
                <li><a class="" href="<?php echo base_url() . "admin/users/our_team"; ?>">فريق العمل</a></li>
            </ul>
        </li>
        <li><a class="" href="<?php echo base_url() . "admin/media/manage_ads/"; ?>"><span class="icon-box"><i class="icon-cogs"></i></span>إدارة الإعلانات</a></li>
        <li><a class="" href="<?php echo base_url() . "admin/settings/"; ?>"><span class="icon-box"><i class="icon-cogs"></i></span>إعدادات الموقع</a></li>
    </ul>
    <!-- END SIDEBAR MENU -->
</div>