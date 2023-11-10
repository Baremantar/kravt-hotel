<?php 

$category = ['rooms'];
if(get_site()->blog_id == 4) {
    if(has_category('lux-room')){
        array_push($category,'lux-room');
    } elseif (has_category('junior-suite')) {
        array_push($category,'junior-suite');
    } elseif (has_category('superior-room')) {
        array_push($category,'superior-room');
    } else {
        $category = ['rooms'];
    }

}

$data = array();

foreach ($category as $key => $value) {
    $dataItem = get_posts( array(
        'numberposts' => -1,
        'category_name' => $value,
        'post_type'   => 'post',
        'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
    ) );

    array_push($data, $dataItem);
}

?>
<section class="container container-spacing">
    <div class="kravt_roompage_others-title">
        <h2>Другие номера</h2>
        <div class="navigation-arrows">
            <div class="swiper-offer-nav-prev-button"></div>
            <div class="swiper-offer-nav-next-button"></div>
        </div>
    </div>
    <div class="kravt_kazan_offers_container">
        <div class="swiper mySwiperRoompageOthers roompage-swiper-others">
            <div class="kravt_swiper_side-hider _hider-others"></div>
            <div class="swiper-wrapper">

                <?php foreach ($data[0] as $i => $element) {?>
                    <?php if($element->post_title !== get_the_title()) {?>
                        <style>
                            <?php
                                echo '#roompage-others-'.++$i.':before{background-image: url('.get_the_post_thumbnail_url($element).')}'
                            ?>
                        </style>
    
                        <div class="swiper-slide kravt_roompage_others-slide" onclick="window.location.href = '<?= the_permalink($element) ?>'">
                            <div class="kravt_others-slide-wrapper">
                                <div id="roompage-others-<?= $i?>" class="kravt_roompage_others-slide-bg">
                                    <span><?= $element->post_title ?></span>
                                </div>
                            </div>
                            <p><?= $element->post_title ?></p>
                        </div>

                    <?php }; ?>
                <?php } ?>

            </div>
        </div>
    </div>
</section>