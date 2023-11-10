<?php
/* 
*   Template Name: Events
*/

$dom = get_post()->post_content;
$data = array();

foreach (str_get_html($dom)->find('.wp-block-custom-section') as $i => $element) {
    if ($i % 2 == 0) {
        array_push($data, $element->outertext());
    }
}

global $getDescription;
$getDescription = function ($attr) {
    foreach (str_get_html($attr)->find('span') as $i => $element) {
        if ($i == 0) {
            echo $element;
        }
    };
};

get_header() ?>
<style>
    @media (max-width: 1000px){
        main {
            padding-bottom: 48px;
        }
    }
</style>
<main>
    <?php include(get_stylesheet_directory() . '/components/hero/thumbnails.php') ?>
    <div class="kravt_hero_container bg-events">

    <?php include(get_stylesheet_directory() . '/components/hero/breadcrumbs.php') ?>

        <div class="kravt_mask_inner">
            <!-- Бургер меню -->
            <?php include(get_stylesheet_directory() . '/components/burger/custom_burger.php'); ?>

            <div class="kravt_content container kravt_heroMain-template">
                <div class="kravt_hero_main _hero_restarauntsPage_main_kazan">
                    <div class="kravt_events_hero_title">
                        <h1>Ваши события в отеле</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="kravt_events_about_container">
        <div class="container">
            <div class="kravt_events_about_content">
                <div class="kravt_events_about_title">
                    <?php foreach (str_get_html($dom)->find('p') as $i => $element) {
                        if ($i == 0) {
                            echo $element->outertext();
                        }
                    } ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Рестораны и кафе (7 секция) -->
    <?php foreach ($data as $key => $element) { ?>
        <section class="kravt_restaraunts kravt_restaraunts_wedding container-spacing kravt_events-slider">
            <div class="kravt_restaraunts_container events">
                <div class="kravt_events-mobile">
                    <p><?php foreach (str_get_html($element)->find('h2') as $subElement) {
                                    echo $subElement->plaintext;
                                } ?></p>

                    <img src="<?php foreach (str_get_html($element)->find('.wp-block-gallery img') as $i => $subElement) {
                                            if ($i == 0) {
                                                echo $subElement->src;
                                            }
                                        } ?>">


                    <?php $getDescription($element) ?>                    

                    <?php if (get_site()->blog_id == 5 && $key == 2 ) {} else{?>
                        <button type="button" onclick="window.location.href = '<?php foreach (str_get_html($element)->find('.wp-block-custom-link a') as $i => $subElement) {
                            if($i % 2 == 0) {
                                    echo $subElement->href;
                                }} ?>'">Подробнее</button>
                    <?php } ?>
                </div>
            </div>
            <div class="swiper mySwiperScreen swiper-screen">
                <div class="kravt_screen-swiper-arrow"></div>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide kravt_screen_slide kravt_screen-swiper-start" style="width: 63.5%">
                            <!-- item -->
                            <div class="kravt_screen_slide-content">
                                <div class="kravt_screen-swiper-title b">
                                    <h2><?php foreach (str_get_html($element)->find('h2') as $subElement) {
                                            echo $subElement->plaintext;
                                        } ?></h2>
                                    <?php $getDescription($element) ?>
                                </div>
                                <?php 
                                $link = str_get_html($element)->find('a', 1);
                                if (is_object($link)){?>
                                    <div class="kravt_screen-swiper-element">
                                        <a class="kravt_screen-swiper-element-main" href="<?php foreach (str_get_html($element)->find('a') as $subElement) {echo $subElement->href;} ?>">Подробнее</a>
                                    </div>
                                <?php } else {} ?>
                            </div>
                        </div>
                        <div style="
                                width: 63.5%;
                                background-image: url('<?php foreach (str_get_html($element)->find('.wp-block-gallery img') as $i => $subElement) {if ($i == 0) {echo $subElement->src;}} ?>');" 
                            class="swiper-slide kravt_screen_slide">
                        </div>
                        <div style="
                                width: 63.5%;
                                background-image: url('<?php foreach (str_get_html($element)->find('.wp-block-gallery img') as $i => $subElement) {if ($i == 1) {echo $subElement->src;}} ?>');" 
                            class="swiper-slide kravt_screen_slide">
                            <!-- item -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
</main>
<?php get_footer() ?>