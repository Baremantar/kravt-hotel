<?php 
$data = array();

    $postslist = get_posts(array('posts_per_page' => -1, 'category_name' => 'offers'));    
    
    foreach ($postslist as $element) {
        if ($element->post_title != get_the_title()) {
            array_push($data, $element);
        }
    }
    
if(count($data) > 2 || count($data) > 1 && $ifMobile()){ 
    
?>
<section class="container container-spacing">
        <div class="kravt_roompage_others-title">
            <h2>Популярно</h2>
            <div class="navigation-arrows">
                <div class="swiper-offer-nav-prev-button"></div>
                <div class="swiper-offer-nav-next-button"></div>
            </div>
        </div>
        <div class="kravt_kazan_offers_container">
            <div class="swiper mySwiperRoompageOthers roompage-swiper-others">
                <div class="kravt_swiper_side-hider _hider-others"></div>
                    <div class="swiper-wrapper">
                        <style>
                            <?php
                                foreach ($data as $i=> $element) {
                                    echo '#service-item-popular-'.$i . '::before{background-image: url('. get_the_post_thumbnail_url($element) . ');}';
                                };
                            ?>
                        </style>

                        <?php foreach ($data as $i => $element) {?>
                            <div class="swiper-slide kravt_roompage_others-slide" onclick="window.location.href = '<?= get_permalink($element) ?>'">
                                <div class="kravt_others-slide-wrapper">
                                    <div id="service-item-popular-<?= $i?>" class="kravt_roompage_others-slide-bg">
                                        <span><?= $data[$i]->post_title ?></span>
                                    </div>
                                </div>

                                <p><?= $data[$i]->post_title ?></p>
                            </div>
                        <?php } ?>
                </div>
            </div>
        </div>
    </section>

<?php } else {
if (count($data) != 0) {?>

    <section class="container container-spacing">
        <div class="kravt_roompage_others-title">
            <h2>Популярно</h2>
        </div>
        <div class="kravt_kazan_offers_container">
            <div class="swiper roompage-swiper-others">
                <div class="kravt_swiper_side-hider _hider-others"></div>
                <div class="swiper-wrapper custom">
                        <style>
                        <?php foreach ($data as $i=> $element) {
                            echo '#service-item-popular-'.$i . '::before{background-image: url('. get_the_post_thumbnail_url($element) . ');}';
                        };?>
                        </style>
                
                    <?php foreach ($data as $i => $elements) {?>
                        <div class="swiper-slide kravt_roompage_others-slide" onclick="window.location.href = '<?= get_permalink($elements
                        ) ?>'">
                            <div class="kravt_others-slide-wrapper">
                                <div id="service-item-popular-<?= $i?>" class="kravt_roompage_others-slide-bg">
                                    <span><?= $data[$i]->post_title ?></span>
                                </div>
                            </div>
    
                            <p><?= $data[$i]->post_title ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

<?php }} ?>