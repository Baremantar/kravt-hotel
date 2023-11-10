<?php
/* 
*   Template name: Room page
*   Template post type: post, page
*/

$dom = get_post()->post_content;
$data = array();
$carousel = array();

foreach (str_get_html($dom)->find('.wp-block-gallery img') as $item) {
    array_push($carousel, $item->src);
};

get_header();
?>
<main style="background-color: white;">
    <?php include(get_stylesheet_directory() . '/components/hero/thumbnails.php') ?>
    <div class="kravt_hero_container bg-roompage">
        
        <?php include(get_stylesheet_directory() . '/components/hero/breadcrumbs.php') ?>
        <!-- Бургер меню -->

        <?php include(get_stylesheet_directory() . '/components/burger/custom_burger.php'); ?>

        <div class="kravt_content container kravt_heroMain-template">
            <div class="kravt_hero_main _hero_rooms_main_kazan">
                <div class="kravt_kazan_roompage_hero_title">
                    <h1><?= get_the_title()?></h1>
                </div>
            </div>
        </div>
    </div>
    </div>

    <section class="kravt_chars_container">
        <div class="container">
            <div class="kravt_kazan_roompage-content">
                <div class="kravt_kazan_roompage-aboutSide">
                    <span><?php
                            foreach (str_get_html($dom)->find('.description-full') as $item) {
                                echo $item->plaintext;
                            }; ?></span>
                    <div class="kravt_kazan_rooms_list">
                        <?php if($ifMobile()){?>
                            <button type="button" class="kravt_button-border button-roompage">
                                Выбрать даты
                            </button>
                        <?php } ?>
                    </div>
                </div>
                <div class="kravt_kazan_rooms-aboutProps _roompage-prop">
                    <div class="kravt_kazan_rooms_prop">
                        <div>
                            <span>Площадь номера, </span>
                            <span class="kravt_kazan_rooms_metre-badge">м2</span>
                        </div>
                        <?php foreach (str_get_html($dom)->find('span.square') as $span) {
                            echo $span->outertext();
                        } ?>
                    </div>
                    <div class="kravt_kazan_rooms_prop">
                        <span>Количество гостей</span>
                        <?php foreach (str_get_html($dom)->find('span.guests') as $span) {
                            echo $span->outertext();
                        } ?>
                    </div>
                    <div class="kravt_kazan_rooms_prop">
                        <span>Сплит-система</span>
                        <?php foreach (str_get_html($dom)->find('span.splitSystem') as $span) {
                            if ($span->plaintext == '+') { ?>
                        <img src="<?= get_template_directory_uri() . '/build/img/icons/access.svg' ?>" width="36"
                            height="36" />
                        <?php };
                        }; ?>
                    </div>
                    <div class="kravt_kazan_rooms_prop">
                        <div>
                            <span>Шумоизоляция, </span>
                            <span class="kravt_kazan_rooms_metre-badge">уровень</span>
                        </div>
                        <?php foreach (str_get_html($dom)->find('span.soundproofing') as $span) {
                            echo $span->outertext();
                        }; ?>
                    </div>
                    <div class="kravt_kazan_rooms_prop">
                        <span>Шведский стол</span>
                        <?php foreach (str_get_html($dom)->find('span.sweedishTable') as $span) {
                            echo $span->outertext();
                        }; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container kravt_roompage_swiper-container">
        <h2>Удобства</h2>
        <div class="kravt_swiper-nav-wrapper">
            <div class="swiper-roompage-icons-button-prev"></div>
            <div class="swiper-roompage-icons-button-next"></div>
        </div>
        <div class="swiper mySwiperIcons">
            <div class="swiper-wrapper">
                <?php foreach (str_get_html($dom)->find('.wp-block-custom-slider-item') as $item) { ?>
                <div class="swiper-slide swiper-slide-icons">
                    <div>
                        <?php foreach (str_get_html($item)->find('img') as $img) { ?>
                        <img src="<?= $img->src; ?>" />
                        <?php };
                            foreach (str_get_html($item)->find('span') as $item) {
                                echo $item->outertext();
                            }; ?>
                    </div>
                </div>
                <?php }; ?>
            </div>
        </div>
        <div class="kravt_roompage-swiper-wrapper">
            <div class="swiper mySwiperRoompage">
                <div>
                    <div class="swiper-roompage-button-prev"></div>
                    <div class="swiper-roompage-button-next"></div>
                </div>
                <div class="swiper-wrapper">
                    <?php
                    foreach ($carousel as $item) {
                    ?>
                    <div class="swiper-slide">
                        <img src="<?= $item; ?>" width="100%" />
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <section class="kravt_roompage_faq-container">
        <div class="container">
            <h2>Правила проживания</h2>
            <div class="kravt_kazan_faq_content">
                <div class="kravt_kazan_faq_accordion-container">
                    <?php foreach (str_get_html($dom)->find('.wp-block-custom-content-span-p') as $item) {
                    ?>
                    <button type="button" class="kravt_kazan_faq_accordion">
                        <?php foreach ($item->find('span') as $span) {
                                echo $span->plaintext;
                            } ?> <span class="kravt_kazan_faq_accordion-toggles"></span>
                    </button>
                    <div class="faq_accordion_panel">
                        <?php foreach ($item->find('p') as $p) {
                                echo $p->outertext();
                            }; ?>
                    </div>
                    <?php
                    }; ?>
                </div>

                <div class="kravt_kazan_faq_links">
                    <?php foreach (str_get_html($dom)->find('.wp-block-custom-link a') as $element) {?>
                    <div class="kravt_roompage_faq-link">
                        <a href="<?= $element->href;?>"><?= $element->plaintext;?>
                        <img src="<?= get_template_directory_uri() . '/build/img/icons/external.svg' ?>"
                            style="display: inline; vertical-align: middle;" /></a>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Рестораны и кафе (7 секция) -->
    <?php include( get_stylesheet_directory() . '/components/sliders/other_rooms.php' ) ?>
    

    <!-- Рестораны и кафе (7 секция) -->
    <?php include(get_stylesheet_directory() . '/components/sliders/slider_main_links.php'); ?>
</main>
<?php get_footer(); ?>