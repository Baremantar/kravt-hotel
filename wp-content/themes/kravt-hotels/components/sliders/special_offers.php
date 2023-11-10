<?php $currentData = $data['section'][0] ?>

<section class="container">
    <div class="kravt_special_container">
        <div class="kravt_special_title" id="offers-title">
            <h2><?php foreach (str_get_html($currentData)->find('h2') as $element){echo $element->plaintext;}?></h2>
            <div>
                <a href="<?php foreach (str_get_html($currentData)->find('h2 a') as $element){echo $element->href;}?>">Смотреть все
                <img src="<?= get_template_directory_uri() . '/build/img/icons/arrow-extend.svg' ?>" />
            </a>
            </div>
            <?php $getDescription($currentData) ?>
        </div>
        <div class="swiper-button-next-el next-offer"></div>
        <!-- Safari flashing on last slide (!) -->
        <div class="swiper mySwiperOffers offer-swiper" id="offer-swiper">
            <div class="swiper-wrapper">
                <?php foreach (str_get_html($currentData)->find('.wp-block-custom-slider-item-1') as $element) { ?>
                    <a class="kravt_offer_carousel-item swiper-slide" href="<?php foreach (str_get_html($element)->find('a') as $subElement){echo $subElement->href;}?>">
                        <div class="kravt_offer_slide-wrapper">
                            <div class="kravt_animation-wrapper">
                                <img src="<?php foreach (str_get_html($element)->find('img') as $subElement) {
                                                echo $subElement->src;
                                            } ?>" width="100%" height="380px" />
                            </div>
                            <div class="kravt_special_offer">
                                <p><?php foreach (str_get_html($element)->find('p') as $subElement) {
                                    echo $subElement->plaintext;
                                }?></p>
                                <?php
                                foreach (str_get_html($element)->find('span') as $subElement) {
                                    echo $subElement->outertext();
                                }  ?>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</section>