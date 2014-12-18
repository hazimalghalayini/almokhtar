<div  class="col-sm-16 banner-outer wow fadeInLeft animated" data-wow-delay="1s" data-wow-offset="50">
    <div class="row">
        <div class="col-sm-16 col-md-10 col-lg-8"> 

            <!-- carousel start -->
            <div id="sync1" class="owl-carousel">

                <?php
                foreach ($main_slider as $news) {
                    echo '<div class="box item"> <a href="' . base_url('news/post/' . $news->news_id) . '">';
                    echo '<div class="carousel-caption">' . $news->news_title . '</div>';
                    echo '<img  src="' . base_url('uploads/news/' . $news->news_picture) . '" width="762" height="360" alt="' . $news->news_title . '" title="' . $news->news_title . '"/>';
                    echo '<div class="overlay"></div>';
                    echo '<div class="overlay"></div>';
                    echo '<div class="overlay-info">';
                    echo '<div class="cat">';
                    echo '<p class="cat-data"><span class="ion-model-s"></span>' . $news->categoryName . '</p>';
                    echo '</div>';
                    echo '<div class="info">';
                    echo '<p><span class="ion-clock"></span>' . date('Y-m-d', strtotime($news->publish_date)) . '<span class="ion-chatbubbles"></span>' . $news->comments_count . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                }
                ?>

            </div>
            <div class="row">
                <div id="sync2" class="owl-carousel">

                    <?php
                    foreach ($main_slider as $news) {
                        echo '<div class="item"><img class=" img-responsive" src="' . base_url('uploads/news/thumbs/' . $news->news_picture) . '" width="762" height="360" alt=""/></div>';
                    }
                    ?>

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-8 hidden-sm hidden-xs">
            <div class="row">
                <div class="col-lg-6 hidden-md"><a href="#">
                        <div class="box">
                            <div class=" carousel-caption">ليوناردو دى كابريو ينفصل عن صديقته بعد علاقة دامت عاما</div>
                            <img class="match-height" src="<?php echo base_url(); ?>assets/webpages/images/banner-static/bs-1.jpg" width="236" height="480"  alt="" />
                            <div class="overlay"></div>
                            <div class="overlay-info">
                                <div class="cat">
                                    <p class="cat-data"><span class="ion-model-s"></span>رياضة</p>
                                </div>
                                <div class="info">
                                    <p><span class="ion-clock"></span>Dec 16 2014<span class="ion-chatbubbles"></span>351</p>
                                </div>
                            </div>
                        </div>
                    </a> </div>
                <div class="col-md-16 col-lg-10">
                    <div class="row">
                        <div class="col-sm-16 right-img-top "> <a href="#">
                                <div class="box">
                                    <div class="carousel-caption">ليوناردو دى كابريو ينفصل عن صديقته بعد علاقة دامت عاما</div>
                                    <img class="img-responsive" src="<?php echo base_url(); ?>assets/webpages/images/banner-static/bs-2.jpg" width="440" height="292" alt=""/>
                                    <div class="overlay"></div>
                                    <div class="overlay-info">
                                        <div class="cat">
                                            <p class="cat-data"><span class="ion-model-s"></span>سفر</p>
                                        </div>
                                        <div class="info">
                                            <p><span class="ion-clock"></span>Dec 16 2014<span class="ion-chatbubbles"></span>351</p>
                                        </div>
                                    </div>
                                </div>
                            </a> </div>
                        <div class="col-sm-16 right-img-btm "> <a href="#">
                                <div class="box">
                                    <div class="carousel-caption">ليوناردو دى كابريو ينفصل عن صديقته بعد علاقة دامت عاما</div>
                                    <img class="img-responsive" src="<?php echo base_url(); ?>assets/webpages/images/banner-static/bs-3.jpg" width="440" height="292" alt=""/>
                                    <div class="overlay"></div>
                                    <div class="overlay-info">
                                        <div class="cat">
                                            <p class="cat-data"><span class="ion-model-s"></span>أخبار</p>
                                        </div>
                                        <div class="info">
                                            <p><span class="ion-clock"></span>Dec 16 2014<span class="ion-chatbubbles"></span>351</p>
                                        </div>
                                    </div>
                                </div>
                            </a> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>