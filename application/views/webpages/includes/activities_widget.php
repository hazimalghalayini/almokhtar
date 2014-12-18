<div class="col-sm-16 bt-space wow fadeInUp animated" data-wow-delay="1s" data-wow-offset="130"> 
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-justified " role="tablist">
        <li><a href="#recent" role="tab" data-toggle="tab">الأحدث</a></li>
        <li class="active"><a href="#popular" role="tab" data-toggle="tab">الأكثر مشاهدة</a></li>
        <li><a href="#comments" role="tab" data-toggle="tab">الأكثر تعليقاً</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">




        <div class="tab-pane active" id="popular">
            <ul class="list-unstyled">

                <?php
                foreach ($widgetPopularNews as $news) {
                    echo '<li> <a href="' . base_url('news/post/' . $news->news_id) . '">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-5  col-md-4 "><img class="img-thumbnail pull-left" src="' . base_url('uploads/news/thumbs/' . $news->news_picture) . '" width="164" height="152" alt="' . $news->news_title . '"/> </div>';
                    echo '<div class="col-sm-11 col-md-12">';
                    echo '<h4>' . $news->news_title . '</h4>';
                    echo '<div class="text-danger sub-info">';
                    echo '<div class="time"><span class="ion-clock icon"></span> ' . date('Y-m-d', strtotime($news->publish_date)) . ' </div> ';
                    echo '<div class="comments"> <span class="ion-chatbubbles icon"> ' . $news->comments_count . ' </span></div>';
                    echo '<div class="stars"><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star-half"></span></div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</a> </li>';
                }
                ?>

                <!--                <li> <a href="#">
                                        <div class="row">
                                            <div class="col-sm-5  col-md-4 "><img class="img-thumbnail pull-left" src="<?php echo base_url(); ?>assets/webpages/images/popular/pop-5.jpg" width="164" height="152" alt=""/> </div>
                                            <div class="col-sm-11 col-md-12">
                                                <h4>أوكلاند يطيح بالتطواني بركلات الترجيح ..</h4>
                                                <div class="text-danger sub-info">
                                                    <div class="time"><span class="ion-clock icon"></span>Dec 16 2014</div>
                                                    <div class="comments"><span class="ion-chatbubbles icon"></span>351</div>
                                                    <div class="stars"><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star-half"></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </a> </li>-->
            </ul>
        </div>
        <div class="tab-pane" id="recent">
            <ul class="list-unstyled">

                <?php
                foreach ($widgetRecentNews as $news) {
                    echo '<li> ';
                    echo '<a href="' . base_url('news/post/' . $news->news_id) . '">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-5  col-md-4 "><img class="img-thumbnail pull-left" src="' . base_url('uploads/news/thumbs/' . $news->news_picture) . '" width="164" height="152" alt="' . $news->news_title . '"/> </div>';
                    echo '<div class="col-sm-11  col-md-12 ">';
                    echo '<h4>' . $news->news_title . '</h4>';
                    echo '<div class="text-danger sub-info">';
                    echo '<div class="time"><span class="ion-clock icon"></span> ' . date('Y-m-d', strtotime($news->publish_date)) . ' </div> ';
                    echo '<div class="comments"> <span class="ion-chatbubbles icon"> ' . $news->comments_count . ' </span></div>';
                    echo '<div class="stars"><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star-half"></span></div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</a> ';
                    echo '</li>';
                }
                ?>
                <!--
                                <li> 
                                    <a href="#">
                                        <div class="row">
                                            <div class="col-sm-5  col-md-4 "><img class="img-thumbnail pull-left" src="<?php echo base_url(); ?>assets/webpages/images/popular/pop-1.jpg" width="164" height="152" alt=""/> </div>
                                            <div class="col-sm-11  col-md-12 ">
                                                <h4>أوكلاند يطيح بالتطواني بركلات الترجيح ..</h4>
                                                <div class="text-danger sub-info">
                                                    <div class="time"><span class="ion-clock icon"></span>Dec 16 2014</div>
                                                    <div class="comments"><span class="ion-chatbubbles icon"></span>351</div>
                                                    <div class="stars"><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star-half"></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </a> 
                                </li>-->
            </ul>
        </div>
        <div class="tab-pane" id="comments">
            <ul class="list-unstyled">
                <li> <a href="#">
                        <div class="row">
                            <div class="col-sm-5  col-md-4 "><img class="img-thumbnail pull-left" src="<?php echo base_url(); ?>assets/webpages/images/comments/com-5.jpg" width="164" height="152" alt=""/> </div>
                            <div class="col-sm-11  col-md-12 ">
                                <h4>أوكلاند يطيح بالتطواني بركلات الترجيح ..</h4>
                                <p> أوكلاند سيتي النيوزيلندي على المغرب التطواني بطل المغرب 4-3 بركلات الترجيح في الرباط، ال..</p>
                            </div>
                        </div>
                    </a> </li>
            </ul>
        </div>
    </div>
</div>