<div class="col-xs-16 col-sm-11 business  wow fadeInLeft animated science" data-wow-delay="0.5s" data-wow-offset="130">
    <div class="main-title-outer pull-left">
        <div class="main-title1">أخر الأخبار</div>
        <div class="span-outer"><span class="pull-left text-danger last-update"><span class="ion-plus icon"></span><a href="">عرض المزيد</a></span> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-16 col-sm-16">
            <div class="row">

                
                <div class="col-md-8 col-sm-7 col-xs-16b left-bordered">
                    <ul class="list-unstyled">
                        <?php
                        if ($recentNews) {
                            $x = 2;
                            foreach ($recentNews as $news) {
                                if ($x === 2) {
                                    echo '<li> <a href="' . base_url('news/post/' . $news->news_id) . '">';
                                    echo '<div class="row">';
                                    echo '<div class="col-sm-5 hidden-sm hidden-md"><img class="img-thumbnail pull-left" src="' . base_url('uploads/news/thumbs/' . $news->news_picture) . '" width="76" height="76" alt="' . $news->news_title . '"/> </div>';
                                    echo '<div class="col-sm-16 col-md-16 col-lg-11">';
                                    echo '<h4>' . $news->news_title . '</h4>';
                                    echo '<div class="text-danger sub-info">';
                                    echo '<div class="time"><span class="ion-clock icon"></span>' . date('Y-m-d', strtotime($news->publish_date)) . '</div>';
                                    echo '<div class="comments"><span class="ion-chatbubbles icon"></span>' . $news->comments_count . '</div>';
                                    echo '<div class="stars"><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star-half"></span></div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</a>';
                                    echo '</li>';
                                } else {
                                    
                                }
                                $x++;
                            }
                        } else {
                            echo 'لا يوجد أخبار';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>