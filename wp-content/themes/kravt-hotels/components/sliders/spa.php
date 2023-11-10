<?php $currentData = $data['section'][3];
$slider = array();
foreach (str_get_html($currentData)->find('.wp-block-custom-slider-item-1') as $i => $element) {
    array_push($slider, $element);
} 
?>


<section class="container container-spacing">
    <div class="kravt_spa_title">
        <?php $getHeader($currentData) ?>
        <div class="kravt_spa_title-row">
            <?php $getDescription($currentData) ?>
            <div class="navigation-arrows">
                <div class="kravt_spa_navigation-counters">
                    <span id="spa-counter-current">01</span>
                    <span id="spa-counter-max">/0<?= count($slider) ?></span>
                </div>
                <div class="swiper-nav-prev-button swiper-prev-spa" id="swiper-spa-prev"></div>
                <div class="swiper-nav-next-button swiper-next-spa" id="swiper-spa-next"></div>
            </div>
        </div>
    </div>
    <!-- SPA (mobile) 6.1 -->
    <div>
        <div class="kravt_spa_items spa_mobile">
            <div class="kravt_spa_side-hider"></div>
            <div class="kravt_spa_row">
                <?php
                foreach ($slider as $i => $element) {
                    if ($i < count($slider) / 2) { ?>
                        <div class="kravt_spa_box">
                            <img src="<?php foreach (str_get_html($element)->find('img') as $subElement) {
                                            echo $subElement->src;
                                        } ?>" />
                            <p><?php foreach (str_get_html($element)->find('p') as $subElement) {
                                    echo $subElement->plaintext;
                                }; ?></p>
                            <?php
                            foreach (str_get_html($element)->find('span') as $subElement) {
                                echo $subElement;
                            }; ?>
                        </div>
                <?php }
                } ?>
            </div>

            <div class="kravt_spa_row-bottom">
                <?php
                foreach ($slider as $i => $element) {
                    if ($i >= count($slider) / 2) { ?>
                        <div class="kravt_spa_box">
                            <img src="<?php foreach (str_get_html($element)->find('img') as $subElement) {
                                            echo $subElement->src;
                                        } ?>" />
                            <p><?php foreach (str_get_html($element)->find('p') as $subElement) {
                                    echo $subElement->plaintext;
                                }; ?></p>
                            <?php
                            foreach (str_get_html($element)->find('span') as $subElement) {
                                echo $subElement;
                            }; ?>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </div>

    <div class="kravt_spa_container">
        <div id="spa_current">
            <div class="kravt_animation-wrapper">
                <img src="<?php foreach (str_get_html($slider[count($slider) - 1])->find('img') as $element) {
                                                            echo $element->src;
                                                        } ?>" id="spa_current_img" onclick="window.location.href = '<?php foreach (str_get_html($slider[count($slider) - 1])->find('p a') as $subElement) {echo $subElement->href;}; ?>'" />
            </div>
            <div class="kravt_special_offer">
                <?php foreach (str_get_html($slider[count($slider) - 1])->find('p') as $element) {
                            $element->setAttribute('id', 'spa_current_p');
                            echo $element->outertext();
                        }; 
                    foreach (str_get_html($slider[count($slider) - 1])->find('span') as $element) {
                        $element->setAttribute('id', 'spa_current_span');
                        echo $element->outertext();
                    } ?>
            </div>
        </div>

        <div class="swiper mySwiperSpa swiper-spa" style="height: min-content; width: 100%; overflow: hidden">
            <div class="kravt_swiper_side-hider _hider-spa"></div>
            <div class="swiper-wrapper">
                <?php foreach ($slider as $element) { ?>
                    <div class="swiper-slide" onclick="window.location.href = '<?php foreach (str_get_html($element)->find('a') as $subElement) {echo $subElement->href;}; ?>'">
                        <div class="kravt_spa_slide-wrapper">
                            <div class="kravt_animation-wrapper">
                                <img src="<?php foreach (str_get_html($element)->find('img') as $subElement) {
                                                echo $subElement->src;
                                            } ?>" width="100%" height="310px" width="310px" />
                            </div>
                            <div class="kravt_spa_offer">
                                <p><?php foreach (str_get_html($element)->find('p') as $subElement) {
                                        echo $subElement->plaintext;
                                    }; ?></p>
                                <?php
                                foreach (str_get_html($element)->find('span') as $subElement) {
                                    echo $subElement;
                                }; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>