<?php $currentData = $data['section'][4];
$slider = array();
foreach (str_get_html($currentData)->find('.wp-block-custom-slider-item-1') as $i => $element) {
    array_push($slider, $element->outertext());
};

?>

<section class="container-spacing kravt_restaraunts _main-restaraunts container">
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
    <div class="kravt_restaraunts_container custom">
        <div class="swiper mySwiperRestaraunts swiper-restaraunts">
            <div class="kravt_swiper_side-hider _hider-restaraunts"></div>
            <div class="swiper-wrapper">
                <?php foreach ($slider as $element) { ?>
                    <div class="swiper-slide kravt_restaraunt_slide" onclick="window.location.href = '<?php foreach (str_get_html($element)->find('p a') as $i => $subElement) {echo $subElement->href;};?>'">
                        <div class="kravt_restaraunt_slide-wrapper">
                            <div class="kravt_animation-wrapper" style="height: 100%">
                                <img src="<?php foreach (str_get_html($element)->find('img') as $subElement) {
                                                echo $subElement->src;
                                            } ?>" />
                            </div>
                            <div class="kravt_restaraunts_label">
                                <p><?php foreach (str_get_html($element)->find('p') as $i => $subElement) {
                                        echo $subElement->plaintext;
                                };?></p><?php
                                foreach (str_get_html($element)->find('span') as $subElement) {
                                    echo $subElement->outertext();
                                } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>