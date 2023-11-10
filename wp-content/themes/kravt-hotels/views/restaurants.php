<?php
/* 
*   Template Name: Restaurants
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

</header>
<main>
    <?php include(get_stylesheet_directory() . '/components/hero/thumbnails.php') ?>

    <?php include(get_stylesheet_directory() . '/components/modals/custom-modal.php') ?>

    <div class="kravt_hero_container bg-restaraunts">
        
        <?php include(get_stylesheet_directory() . '/components/hero/breadcrumbs.php') ?>
    
        <div class="kravt_mask_inner">
            <!-- Бургер меню -->

            <?php include(get_stylesheet_directory() . '/components/burger/custom_burger.php'); ?>

            <div class="kravt_content container kravt_heroMain-template">
                <div class="kravt_hero_main _hero_restarauntsPage_main_kazan">
                    <div class="kravt_excursion_hero_title">
                        <h1><?= the_title() ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="kravt_restarauntsPage_about_container">
        <div class="container">
            <div class="kravt_offersPage_about_content rest">
                <div class="kravt_restarauntsPage_about_title">
                    <span><?php foreach (str_get_html($dom)->find('p') as $i => $element) {
                        if ($i == 0) {
                            echo $element->plaintext;
                        }
                    } ?></span>
                </div>
                <div class="kravt_offersPage_about_list">
                    <?php foreach (str_get_html($dom)->find('.wp-block-custom-span') as $i => $element) { ?>
                    <div>
                        <span class="kravt_kazan-about-splitter">—</span>
                        <?= $element->outertext(); ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Рестораны и кафе (7 секция) -->
    <?php foreach ($data as $element) { ?>
    <section class="kravt_restaraunts container-spacing">
        <div class="kravt_restaraunts_container">
            <div class="kravt_restaraunts-mobile">
                <div>
                    <p><?php foreach (str_get_html($element)->find('h2') as $i => $subElement) {
                                            echo $subElement->plaintext;
                                        } ?></p>
                    <?php $getDescription($element) ?>
                    <a class="additionalRest" href="<?php foreach (str_get_html($element)->find('.wp-block-custom-link a') as $i => $subElement) {
                                        if ($i == 0) {
                                            echo $subElement->href;
                                        }
                                    } ?>">Подробнее о ресторане</a>
                    <div>
                         <?php 
                        $links = array();
                        foreach (str_get_html($element)->find('.wp-block-custom-link a') as $i => $subElement) {
                                array_push($links, $subElement->outertext());
                        }
                        foreach ($links as $i => $subElement) {
                            if ($i > 0) {
                                echo $subElement;
                            }
                        } ?>

                    </div>
                </div>
                <button type="button" class="_booking-link">Забронировать стол</button>
                <?php foreach (str_get_html($element)->find('.wp-block-gallery img') as $ii => $subElement) {
                        echo '<img src="' . $subElement->src . '" />';
                    } ?>
            </div>
        </div>
        <div class="swiper mySwiperScreen swiper-screen">
            <div class="kravt_screen-swiper-arrow"></div>
            <div class="swiper-wrapper">
                <div class="swiper-slide kravt_screen_slide kravt_screen-swiper-start" style="width: 63.5%">
                    <!-- item -->
                    <div class="kravt_screen_slide-content">
                        <div class="kravt_screen-swiper-title">
                            <h2><?php foreach (str_get_html($element)->find('h2') as $i => $subElement) {
                                                    echo $subElement->plaintext;
                                                } ?></h2>
                            <?php $getDescription($element) ?>
                        </div>
                        <div class="kravt_screen-swiper-element">

                        <?php foreach (str_get_html($links[0])->find('a') as $i => $subElement) {
                                    $subElement->setAttribute('class','kravt_screen-swiper-element-main');
                                    echo $subElement->outertext();}
                        ?>
                            
                        </div>
                        <div class="kravt_screen-swiper-element">
                        
                            <div>
                                
                            <?php foreach ($links as $i => $subElement) {
                                if ($i > 0) {
                                    echo $subElement;
                                }
                            } ?>

                            </div>
                        </div>
                        <div class="kravt_screen-swiper-element">
                        </div>

                    </div>

                </div>
                <div style="
            width: 63.5%;
            background-image: url('<?php foreach (str_get_html($element)->find('.wp-block-gallery img') as $i => $subElement) {
                                        if ($i == 0) {
                                            echo $subElement->src;
                                        }
                                    } ?>');
          " class="swiper-slide kravt_screen_slide">
                    <div class="kravt_screen-swiper-actions">
                        <button type="button" onclick="window.open('<?php foreach (str_get_html($links[1])->find('a') as $i => $subElement) {echo $subElement->href;}?>', '_blank')
                        ">Посмотреть меню</button>
                        <button type="button" class="_booking-link">Забронировать стол</button>
                    </div>
                </div>
                <div style="
            width: 63.5%;
            background-image: url('<?php foreach (str_get_html($element)->find('.wp-block-gallery img') as $i => $subElement) {
                                        if ($i == 1) {
                                            echo $subElement->src;
                                        }
                                    } ?>');
          " class="swiper-slide kravt_screen_slide">
                    <!-- item -->
                </div>
            </div>
        </div>
        </div>
    </section>
    <?php
    } ?>
</main>

<?php get_footer() ?>