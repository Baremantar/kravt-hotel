<?php
/* 
*   Template name: Advantage page
*   Template post type: post, page
*/

$dom = str_get_html(get_post()->post_content);
get_header()
?>
<main style="background-color: white;">
    <?php include(get_stylesheet_directory() . '/components/hero/thumbnails.php') ?>

    <?php include(get_stylesheet_directory() . '/components/modals/custom-modal.php') ?>

    <div class="kravt_hero_container bg-offers">

        <?php include(get_stylesheet_directory() . '/components/hero/breadcrumbs.php') ?>


        <div class="kravt_mask_inner">
            <!-- Бургер меню -->

            <?php include(get_stylesheet_directory() . '/components/burger/default_burger.php'); ?>

            <div class="kravt_content container kravt_heroMain-template">
                <div class="kravt_hero_main _hero_offers_main_kazan">
                    <div class="kravt_offers_hero_title">
                        <h1><?= get_the_title() ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="kravt_offerItem_programm-container">
        <div class="container">
            <span>
                <?php foreach ($dom->find('p') as $i => $element) {
                    if ($i == 0) {
                        echo $element->plaintext;
                    }
                } ?>
            </span>


        </div>
    </div>

    <div class="container kravt_offerItem_list-container custom">
        <div>
            <ul>
                <?php foreach ($dom->find('li') as $element) {
                    echo $element->outertext();
                } ?>
            </ul>
            <button type="button" class="kravt_button-border <?php if (get_site()->blog_id != 1) {
                                                                    echo '_booking-link';
                                                                } else {
                                                                    echo 'button-roompage';
                                                                } ?>" <?php if (get_site()->blog_id == 1) {
                                                                            echo 'onclick="document.querySelector(`tl-search-form`).querySelector(`.sfl-submit-button.sfl-submit-button-input.standard-view-button`).click()"';
                                                                        } ?>>Забронировать</button>
        </div>
        <img src="<?php foreach ($dom->find('img') as $i => $element) {
                        if ($i == 0) {
                            echo $element->src;
                        }
                    } ?>" />
    </div>

    <?php
    foreach ($dom->find('span') as $i => $element) {
        $slide = $element;
    }
    ?>

    <div class="container">
        <?php
        if ($slide) :
        ?>
            <span class="kravt_offerItem_section-text-mobile">
                <?= $slide ?>
            </span>
        <?php
        endif;
        ?>

        <style>
            <?php
            foreach ($dom->find('img') as $i => $element) {
                if ($i == 1) {
                    $image = $element->src;
                }
            };
            echo '.kravt_offerItem_section-container-3 {background-image: url("' . $image . '")}'; ?>
        </style>

        <?php
        if ($slide) :
        ?>
            <div class="kravt_offerItem_section-container-3">
                <div>
                    <?= $slide ?>
                </div>
            </div>
        <?php
        endif;
        ?>
    </div>

    <!-- Рестораны и кафе (7 секция) -->
    <?php
    include(get_stylesheet_directory() . '/components/sliders/popular_offers.php');
    ?>

    <!-- Рестораны и кафе (7 секция) -->

    <?php
    if (get_site()->blog_id != 1) {
        include(get_stylesheet_directory() . '/components/sliders/slider_main_links.php');
    }
    ?>

</main>
<?php get_footer() ?>