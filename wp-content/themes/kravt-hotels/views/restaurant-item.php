<?php
/* 
*   Template name: Restaurant page
*   Template post type: post, page
*/

$dom = get_post()->post_content;

get_header() ?>

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
                        <h1><?= get_the_title() ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="container kravt_restarauntItem_about">
        <div class="kravt_restarauntItem_about_left-side">
            <span>
                <?php foreach (str_get_html($dom)->find('p') as $i => $item) {
                    if ($i == 0) {
                        echo $item->plaintext;
                    }
                }; ?>
            </span>
        </div>
        <div class="kravt_restarauntItem_about_right-side">
            <div class="kravt_restarauntItem_about-links">
                <a class="kravt_restarauntItem_about_head-link" href="<?php foreach (str_get_html($dom)->find('a') as $i => $subElement) {
                                        if ($i == 1) {
                                            echo $subElement->href;
                                        }
                                    } ?>">Посмотреть меню</a>
                <div>
                <?php foreach (str_get_html($dom)->find('a') as $i => $subElement) {
                                        if ($i != 0) {
                                            echo $subElement->outertext();
                                        }
                                    } ?>
                </div>
            </div>
        </div>
    </section>

    <div class="kravt_restarauntItem_data-container">
        <div class="container">
            <div class="kravt_restarauntItem_data-chars">
                <div class="kravt_restarauntItem_data-chars-lines">
                    <div>
                        <span>Режим работы</span>
                        <?php foreach (str_get_html($dom)->find('.wp-block-custom-restaraunt-type span') as $i => $item) {
                            if ($i == 0) {
                                echo $item->outertext();
                            }
                        }; ?>
                    </div>
                    <div>
                        <span>Кухня</span>
                        <?php foreach (str_get_html($dom)->find('.wp-block-custom-restaraunt-type span') as $i => $item) {
                            if ($i == 1) {
                                echo $item->outertext();
                            }
                        }; ?>
                    </div>
                    <div>
                        <span>Вместимость</span>
                        <?php foreach (str_get_html($dom)->find('.wp-block-custom-restaraunt-type span') as $i => $item) {
                            if ($i == 2) {
                                echo $item->outertext();
                            }
                        }; ?>
                    </div>
                </div>
                <button type="button" class="kravt_restarauntItem_data-button _booking-link"">
                    Забронировать стол
                </button>
            </div>
        </div>
    </div>
    <div class="kravt_restarauntItem_swiper-container">
        <div class="container kravt_restarauntItem-swiper-wrapper">
            <div class="swiper mySwiperRoompage restaurant">
                <div>
                    <div class="swiper-roompage-button-prev"></div>
                    <div class="swiper-roompage-button-next"></div>
                </div>
                <div class="swiper-wrapper">
                    <?php foreach (str_get_html($dom)->find('.wp-block-gallery') as $i => $item) {
                            foreach ($item->find('img') as $subItem) { ?>
                    <div class="swiper-slide">
                        <img src="<?= $subItem->src ?>" width="1080px" height="800px"/>
                    </div>
                    <?php 
                        }
                    }; ?>
                </div>
            </div>
        </div>
    </div>

    <secton class="container container-spacing kravt_restarauntItem_breakfast-container">
        <div>
            <?php foreach (str_get_html($dom)->find('.wp-block-custom-section') as $item) {
                foreach ($item->find('h2') as $subItem) {
                    echo $subItem->outertext();
                }
                foreach ($item->find('span') as $subItem) {
                    echo $subItem->outertext();
                }
            } ?>
        </div>
        <img src="<?php foreach (str_get_html($dom)->find('.wp-block-custom-section img') as $item) {
                        echo $item->src;
                    } ?>" height="auto" />
    </secton>
    <?php 
        include(get_stylesheet_directory() . '/components/sliders/other_restaurants.php');
     ?>

    <!-- Рестораны и кафе (7 секция) -->
    <?php include(get_stylesheet_directory() . '/components/sliders/slider_main_links.php'); ?>

</main>
<?php get_footer() ?>