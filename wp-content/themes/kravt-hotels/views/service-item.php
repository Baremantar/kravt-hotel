<?php
/*
*   Template Name: Service page
*   Template post type: post, page
*/

$dom = str_get_html(get_post()->post_content);
$data = array();
// в блоках на странице указываем класс custom_group и парсим
foreach ($dom->find('.wp-block-custom-section') as $i => $element) {
    if (($i % 2) == 0) {
        array_push($data, $element->outertext());
    }
};
$carousel = array();
foreach ($dom->find('.wp-block-custom-slider-item-1') as $element) {
    array_push($carousel, $element);
};

$rubrics = get_the_category();
$slugs = array_column($rubrics, 'slug');


get_header() ?>
<main class="kravt_excursion">
    <?php include(get_stylesheet_directory() . '/components/hero/thumbnails.php') ?>
    
    <?php include(get_stylesheet_directory() . '/components/modals/custom-modal.php') ?>
    
    <div class="kravt_hero_container bg-excursion">
        
    <?php include(get_stylesheet_directory() . '/components/hero/breadcrumbs.php') ?>

        <div class="kravt_mask_inner">
            <!-- Бургер меню -->

            <?php include(get_stylesheet_directory() . '/components/burger/custom_burger.php'); ?>

            <div class="kravt_content container kravt_heroMain-template">
                <div class="kravt_hero_main _hero_excursion_main_kazan">
                    <div class="kravt_excursion_hero_title">
                        <h1><?php the_title() ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="kravt_kazan_excursion_about_container">
        <div class="container">
            <div class="kravt_kazan_excursion_about_content">
                <div class="kravt_kazan_excursion_about_title spa">
                    <?php
                        foreach ($dom->find('span') as $i => $element) {
                            if ($i == 0) {
                                echo $element->outertext;
                            }
                        }; 

                        $button = false;
                        foreach($rubrics as $element) {
                            $slug = $element->slug;

                            if ($slug == 'spa') {
                        ?>
                            <button type="button" class="kravt_button-border _booking-link">Забронировать визит</button>
                        <?php
                                $button = true;
                            }

                            if ($slug == 'services' && $button === false) {
                        ?>
                            <button type="button" class="kravt_button-border _booking-link">Забронировать</button>
                        <?php
                            }
                        }
                    ?>
                </div>
                <div class="kravt_kazan_about_list">
                    <?php
                    foreach ($dom->find('.wp-block-custom-block span') as $element) { ?>
                    <div>
                        <span class="kravt_kazan-about-splitter">—</span>
                        <?= $element->outertext; ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    
    <section class="container container-spacing">
        <?php for($i=0;$i < count($data)-1 ;$i++){
            if($i % 2 == 0) {?>
                <div class="kravt_excursion_section-container-1">
                    <img src="<?php foreach (str_get_html($data[$i])->find('img') as $img) {echo $img->src;} ?>" />
                    <div>
                        <?php foreach (str_get_html($data[$i])->find('h2') as $h2) {echo $h2->outertext();} ?>
                        <?php foreach (str_get_html($data[$i])->find('span') as $span) {echo $span->outertext();} ?>
                    </div>
                </div>
            <?php } else {?>
                <div class="kravt_excursion_section-container-2">
                    <div>
                        <?php foreach (str_get_html($data[$i])->find('h2') as $h2) {echo $h2->outertext();} ?>
                        <?php foreach (str_get_html($data[$i])->find('span') as $span) {echo $span->outertext();} ?>
                    </div>
                <img src="<?php foreach (str_get_html($data[$i])->find('img') as $img) {echo $img->src;} ?>" />
                </div>
        <?php }} ?>
        <div class="kravt_excursion_section-container-3" style="background-image: url(<?php foreach (str_get_html($data[count($data)-1])->find('img') as $img) {echo $img->src;} ?>)">
            <div>
                <?php foreach (str_get_html($data[count($data)-1])->find('span') as $span) {echo $span->outertext();} ?>
                <?php 
                    foreach($rubrics as $element) {
                        switch ($element->slug) {
                            case 'excursions':
                                ?><button type="button" class="_booking-link">Выбрать даты</button><?php
                                break;
                            case 'spa':
                                $links = $dom->find(".wp-block-custom-link a");

                                if ($links[0]):
                                ?>
                                <button type="button" onclick='window.open("<?= $links[0]->href; ?>","_blank")'>Меню SPA</button>
                                <?php
                                endif;

                                if ($links[1]):
                                ?>
                                <button type="button" onclick='window.open("<?= $links[1]->href; ?>","_blank")'>Правила посещения</button>
                                <?php
                                endif;
                                break;
                        }
                    }
                ?>
            </div>
        </div>
        <span class="kravt_excursion_section-mobile-text">
            <?php foreach (str_get_html($data[count($data)-1])->find('span') as $span) {echo $span->plaintext;} ?>
        </span>

        <?php 
            foreach($rubrics as $element) {
                switch ($element->slug) {
                    case 'excursions':
                        ?><button type="button" class="kravt_excursion_section-mobile-button _booking-link">Выбрать даты</button><?php
                        break;
                }
            }
        ?>
    </section>

    <!-- Рестораны и кафе (7 секция) -->
    <?php if(count($carousel) != 0){?>
        <section class="container container-spacing">
            <div class="kravt_roompage_others-title">
                <h2>Похожие экскурсии</h2>
                <div class="navigation-arrows">
                    <div class="swiper-offer-nav-prev-button"></div>
                    <div class="swiper-offer-nav-next-button"></div>
                </div>
            </div>
            <div class="kravt_kazan_offers_container">
                <div class="swiper mySwiperRoompageOthers roompage-swiper-others">
                    <div class="kravt_swiper_side-hider _hider-others"></div>
                    <div class="swiper-wrapper">
                        <?php foreach ($carousel as $i => $element) { ?>
                        <style>
                        #service-item-popular-<?= ++$i ?>:before {
                            background-image: url(<?php foreach ($element->find('img') as $subElement) {
                                echo $subElement->src;
                            }
                            ?>);
                        }
                        </style>
                        <div class="swiper-slide kravt_roompage_others-slide"
                            onclick="window.location.href = `<?php foreach ($element->find('a') as $subElement) {echo $subElement->href;} ?>`">
                            <div class="kravt_others-slide-wrapper">
                                <div id="service-item-popular-<?= $i ?>" class="kravt_roompage_others-slide-bg">
                                    <span><?php foreach ($element->find('p') as $subElement) {
                                                    echo $subElement->plaintext;
                                                } ?></span>
                                </div>
                            </div>
                            <p><?php foreach ($element->find('p') as $subElement) {echo $subElement->plaintext;} ?></p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
    <!-- Рестораны и кафе (7 секция) -->

    <?php
        if (array_search('spa', $slugs) !== false) {
            include(get_stylesheet_directory() . '/components/forms/steps-form.php'); 
        }
    ?>
    
    
    <?php
    if (get_site()->blog_id != 1) {
        include(get_stylesheet_directory() . '/components/sliders/slider_main_links.php'); 
    } 
    ?>

</main>
<?php get_footer() ?>