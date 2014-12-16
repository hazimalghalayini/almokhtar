<div id="header" class="navbar navbar-inverse navbar-fixed-top">
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="navbar-inner">
        <div class="container-fluid">
            <!-- BEGIN LOGO -->
            <a class="brand" href="<?php echo base_url() . "admin"; ?>">
                المختار
            </a>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a class="btn btn-navbar collapsed" id="main_menu_trigger" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="arrow"></span>
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <div id="top_menu" class="nav notify-row">
                <!-- BEGIN NOTIFICATION -->
                <ul class="nav top-menu">
                    <!-- BEGIN SETTINGS -->
                    <li class="dropdown">
                        <a class="dropdown-toggle element" data-placement="bottom" data-toggle="tooltip" href="<?php echo base_url() . "admin/settings/"; ?>" data-original-title="إعدادات الموقع">
                            <i class="icon-cog"></i>
                        </a>
                    </li>
                    <!-- END SETTINGS -->
                    <!-- BEGIN INBOX DROPDOWN -->
                    <li class="dropdown" id="header_inbox_bar">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-envelope-alt"></i>
                            <span id="msgNum" class="badge badge-important"></span>
                        </a>
                        <ul id="messages" class="dropdown-menu extended inbox">
                        </ul>
                    </li>
                    <!-- END INBOX DROPDOWN -->
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <li class="dropdown" id="header_notification_bar">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-bell-alt"></i>
                            <span id="noteNum" class="badge badge-warning"></span>
                        </a>
                        <ul id="notification" class="dropdown-menu extended notification">
                            
                        </ul>
                    </li>
                    <!-- END NOTIFICATION DROPDOWN -->
                </ul>
            </div>
            <!-- END  NOTIFICATION -->
            <div class="top-nav ">
                <ul class="nav pull-left top-menu" >
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img width="29px" height="29px" src="<?= base_url() . 'assets/admin/img/avatar.png' ?>" alt="">
                            <span class="username"><?= $this->session->userdata('username') ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href=""><i class="icon-user"></i> الصفحة الشخصية </a></li>
                            <li><a href=""><i class="icon-tasks"></i> جدولة المهام </a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url() . "admin/users/logout"; ?>"><i class="icon-key"></i> تسجـيل خـروج</a></li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
                <!-- END TOP NAVIGATION MENU -->
            </div>
        </div>
    </div>
    <!-- END TOP NAVIGATION BAR -->
</div>
<script>
    
    var getNotificationsNumber = function() {
        $.post('<?php echo base_url() . "admin/news/getNotificationsNumber/"; ?>', function(data) {
            var json = JSON.parse(data);
            $("#noteNum").html(json['comments_count']);
            var item = '';
            var a = json['latest_comments'];
            a.forEach(function(entry) {
                item += '<li>'+
                    '<a href="<?=base_url().'admin/news/recent_comments'?>">'+
                        '<span class="label label-info"><i class="icon-bullhorn"></i></span>'+
                        ' <strong>'+entry['name']+'</strong>: '+(entry['comment']).substring(0, 39)
                        +'<span class="small italic">'+entry['publishDate']+'</span>'+
                    '</a>'+
                '</li>';
            });
            item +='<li><a href="<?=base_url().'admin/news/recent_comments'?>">مشاهدة جميع التعليقات</a></li>';
            $('#notification').html(item);
            
            var m = json['latest_messages'];
            var item2 = '';
            m.forEach(function(entry) {
                item2 += '<li>'+
                    '<a href="#">'+
                        '<span class="label label-info"><i class="icon-bullhorn"></i></span>'+
                        ' <strong>'+entry['name']+'</strong>: '+(entry['msg']).substring(0, 39)
                        +'<span class="small italic">'+entry['publishDate']+'</span>'+
                    '</a>'+
                '</li>';
            });
            item2 +='<li><a href="">مشاهدة جميع الرسائل</a></li>';
            $('#messages').html(item2);
        });
    }
    var check_count = setInterval(getNotificationsNumber, 10*10000);
</script>