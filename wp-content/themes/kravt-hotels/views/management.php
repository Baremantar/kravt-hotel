<?php
/* 
*   Template Name: Management
*/
$dom = str_get_html(get_post()->post_content);
$data = array();

foreach ($dom->find('.wp-block-custom-block') as $element) {
    array_push($data, $element->outertext());
}

$block1 = str_get_html($data[0]);

$block2 = array();
foreach (str_get_html($data[1])->find('.wp-block-custom-mini-block-hotel-number') as $item) {
    if (!$item->parent() || !$item->parent()->hasClass('wp-block-custom-mini-block-hotel-number')) {
        array_push($block2, $item->outertext());
    }
}

$block3 = $data[2];

$block4 = $data[3];

get_header();
?>

<main>
    <?php include(get_stylesheet_directory() . '/components/hero/thumbnails.php') ?>
    <!-- Hero (1 секция) -->
    <div class="kravt_hero_container bg-group">
        <div class="kravt_dynamic_navigation _dynamic-white container">
            <a href="<?= get_blog_details(array('blog_id' => 1))->home ?>">Kravt Hotels</a>
            <span>—</span>
            <span class="kravt_dynamic_navigation-active">Управление</span>
        </div>

        <div class="container" style="width: 100%">
            <!-- Бургер меню -->

            <?php include(get_stylesheet_directory() . '/components/burger/default_burger.php'); ?>

            <div class="kravt_content">
                <div class="kravt_hero_main _hero-group group" style="width: 100%">
                    <div class="kravt_group_hero_title group">
                        <h1><?php the_title() ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Первый блок О нас -->
    <section class="container container-spacing kravt_group_own-container container_management-about">
        <div>
            <?php
            $img = $block1->find('img')[0]->src;
            ?>
            <img src="<?= $img ?>" />
        </div>
        <div>
            <h2>
                <?php
                $title = $block1->find('p.title')[0]->plaintext;
                echo $title;
                ?>
            </h2>
            <span>
                <?php
                $description = $block1->find('p.description')[0]->plaintext;
                echo $description;
                ?>
            </span>
        </div>
    </section>

    <!-- Второй блок из трех (управление) -->
    <?php
    foreach ($block2 as $i => $item) :
        $item = str_get_html($item);
    ?>
        <section class="container container-spacing kravt_group_own-container <?= $i % 2 != 0 ? 'kravt_group_own-container_reverse' : '' ?>">
            <div>
                <h2>
                    <?php
                    $title = $item->find('p.title')[0]->plaintext;
                    echo $title;
                    ?>
                </h2>
                <span>
                    <?php
                    $description = $item->find('p.description')[0]->plaintext;
                    echo $description;
                    ?>
                </span>
            </div>
            <div>
                <?php
                $img = $item->find('img')[0]->src;
                ?>
                <img src="<?= $img ?>" />
            </div>
        </section>
    <?php
    endforeach;
    ?>

    <!-- Третий блок - слайдер -->
    <section class="container container-spacing">
        <p id="group_slide_title-mobile">
            <?php foreach (str_get_html($block3)->find('p') as $i => $element) {
                if ($i == 0) {
                    echo $element->plaintext;
                }
            } ?>

        </p>
        <div class="kravt_group_slider-container">
            <div class="kravt_group_slider-img" id="group_slide_img"></div>
            <div class="kravt_group_slider-text">
                <div>
                    <p id="group_slide_title">
                        <?php foreach (str_get_html($block3)->find('p.title') as $i => $element) {
                            if ($i == 0) {
                                echo $element->plaintext;
                            }
                        } ?>
                    </p>
                    <div class="kravt_group_slider-img" id="group_slide_img-mobile"></div>
                    <span id="group_slide_desc">
                        <?php foreach (str_get_html($block3)->find('p.description') as $i => $element) {
                            if ($i == 0) {
                                echo $element->plaintext;
                            }
                        } ?>
                    </span>
                </div>
                <div>
                    <div class="kravt_group_slider-items">
                        <?php
                        $slides = array();
                        foreach (str_get_html($block3)->find('.wp-block-custom-mini-block-hotel-number') as $item) {
                            if (!$item->parent() || !$item->parent()->hasClass('wp-block-custom-mini-block-hotel-number')) {
                                array_push($slides, $item->outertext());
                            }
                        }

                        foreach ($slides as $i => $element) {
                            $element = str_get_html($element);
                        ?>
                            <span id="group-slide-<?= $i ?>" class="kravt_group_slider-item" data-description="<?php foreach ($element->find('p.description') as $subElement) {
                                                                                                                    echo $subElement->plaintext;
                                                                                                                } ?>" data-background="<?php foreach ($element->find('img') as $subElement) {
                                                                                                                                            echo $subElement->src;
                                                                                                                                        } ?>">
                                <?php foreach ($element->find('p.title') as $subElement) {
                                    echo $subElement->plaintext;
                                } ?>
                            </span>
                        <?php } ?>
                    </div>
                    <div class="kravt_group_slider-progress-all"></div>
                    <div class="kravt_group_slider-progress-current" id="progress_current"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Четвёртый блок - Наши проекты -->
    <section class="container container-spacing projects-container" id="projects">
        <h2>Наши проекты</h2>
        <div class="projects">
            <div class="projects__row">
                <?php foreach (str_get_html($block4)->find('img') as $element) { ?>
                    <div class="projects__item">
                        <?php echo $element->outertext(); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="projects-swiper swiper">
            <div class="swiper-wrapper">
                <?php foreach (str_get_html($block4)->find('img') as $element) { ?>
                    <div class="swiper-slide">
                        <?php echo $element->outertext(); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <?php
        $contacts = $dom->find('.wp-block-custom-block.contacts');
    ?>

    <?php foreach ($contacts as $key => $value) { ?>
        <style>
            .container.container-spacing.career-feedback_wrapper {
                background-image: url(<?php foreach ($value->find('img') as $img) {
                                            echo $img->src;
                                        }  ?>);
            }
        </style>
        <section class="container container-spacing career-feedback_wrapper container_management_contacts">
            <div>
                <?php
                foreach ($value->find('p') as $p) {
                    echo $p;
                }
                ?>

                <?php

                ?>
                <a href="<?php foreach ($value->find('.telegram') as $subElement) {
                                echo $subElement->plaintext;
                            } ?>" target="_blank"><img src="<?= get_template_directory_uri() . '/build/img/socials/tg_negative.svg' ?>" width="55" height="55" /></a>
                <button class="kravt_button-border _booking-link custom" type="button">Отправить запрос</button>
            </div>
        </section>
    <?php }; ?>

    <section id="map" class="kravt_map_container"></section>
</main>

<?php
get_footer();
