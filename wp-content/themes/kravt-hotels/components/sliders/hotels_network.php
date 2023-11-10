<?php $currentData = $data['section'][1];
$slider = array(); 
foreach (str_get_html($currentData)->find('.wp-block-custom-slider-content-p-span-multiple') as $i => $element) {
    if ($i % 2 == 0){
        array_push($slider, $element->outertext());
    }
}

$blogs = get_sites();
$frontPages = array();
foreach ($blogs as $key => $value) {
    array_push($frontPages, 'http://'.($value->domain));
}
echo '<pre>', print_r( get_page_by_path( $frontPages[1]) , true), '</pre>';  
?>

<section class="container-spacing container kravt_restaraunts">
    <div class="kravt_restaraunts-title">
        <div class="kravt_restaraunts-title-content">
            <?php $getHeader($currentData);
            $getDescription($currentData) ?>
        </div>
        <div class="navigation-arrows">
            <div class="swiper-nav-prev-button"></div>
            <div class="swiper-nav-next-button"></div>
        </div>
    </div>

    <div class="kravt_restaraunts_container">
        <div class="swiper mySwiper swiperHotels">
            <div class="kravt_swiper_side-hider _hider-hotels"></div>
            <div class="swiper-wrapper">
                <?php foreach ($slider as $i => $element) { ?>
                    <div class="kravt_hotels_carousel-item swiper-slide" onclick="window.location.href= '<?php foreach (str_get_html($element)->find('p a') as $subElement){echo $subElement->href;}?>'">
                        <style>
                            <?php
                            foreach (str_get_html($element)->find('img') as $subElement) {
                                $source = $subElement->src;
                                echo '#main-hotels-' . ++$i . '::before{background-image:url("' . $source . '")!important;}';
                            }
                            ?>
                        </style>
                        <div id="main-hotels-<?= $i ?>" class="main-hotels">
                            <div class="kravt_hotels_carousel_item-content">
                                <div>
                                    <p><?php foreach (str_get_html($element)->find('.title') as $subElement) {
                                        echo $subElement->plaintext;
                                    };?></p>
                                    <?php
                                    foreach (str_get_html($element)->find('.city') as $subElement) {
                                        echo $subElement->outertext();
                                    }; ?>
                                </div>
                                <?php
                                foreach (str_get_html($element)->find('.description') as $subElement) {
                                    $subElement->setAttribute('class', 'kravt_hotels_carousel-desc');
                                    echo $subElement->outertext();
                                };
                                ?>
                            </div>
                        </div>
                    </div>
                <?php  } ?>
            </div>
        </div>
    </div>
</section>