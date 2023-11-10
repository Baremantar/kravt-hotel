<?php
/*
*   Template Name: Services
*/

$dom = str_get_html(get_post()->post_content);
$data = array();
// в блоках на странице указываем класс custom_group и парсим
foreach ($dom->find('div.wp-block-custom-section') as $i => $element) {
    if (($i % 2) == 0) {
        array_push($data, $element->outertext);
    }
};


get_header() ?>
<style>
    main {
        padding-bottom: 164px;
    }
    @media (max-width: 1000px) {
        main {
            padding-bottom: 48px;
        }
    }
</style>
<main class="main-wrapper-services">
    <?php include(get_stylesheet_directory() . '/components/hero/thumbnails.php') ?>
    <div class="kravt_hero_container bg-service">
        
    <?php include(get_stylesheet_directory() . '/components/hero/breadcrumbs.php') ?>
    

        <!-- Бургер меню -->

        <?php include(get_stylesheet_directory() . '/components/burger/custom_burger.php'); ?>

        <div class="kravt_content container kravt_heroMain-template">
            <div class="kravt_hero_main">
                <div class="kravt_kazan_roompage_hero_title">
                    <h1>Услуги отеля</h1>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($data as $key => $value) {
        if($key % 2 == 0 ){?>

        <section class="container container-spacing container-service-spa">
            <div class="kravt_service_spa-container">
                <img src="<?php foreach (str_get_html($data[$key])->find('img') as $img) {
                                echo $img->src;
                            } ?>" />
                <!-- <div> -->
                    <?php foreach (str_get_html($data[$key])->find('h2') as $elem) {
                        echo $elem->outertext;
                    };
                    foreach (str_get_html($data[$key])->find('span') as $elem) {
                        echo $elem->outertext;
                    } ?>
                    <?php if (str_get_html($data[$key])->find('.wp-block-custom-link a')){?>
                        <button type="button" class="kravt_button-border" onclick="window.open('<?php foreach (str_get_html($data[$key])->find('.wp-block-custom-link a') as $elem) {echo $elem->href;} ?>', '_blank')">Подробнее</button>
                    <?php } ?>
                <!-- </div> -->
            </div>
        </section>
        <?php } else {?>

        <section class="container container-spacing container-service-fitness">
            <div class="kravt_service-fitness-content">
                <!-- <div> -->
                    <?php foreach (str_get_html($data[$key])->find('h2') as $elem) {
                        echo $elem->outertext;
                    };
                    foreach (str_get_html($data[$key])->find('span') as $elem) {
                        echo $elem->outertext;
                    } ?>
                    <?php if (str_get_html($data[$key])->find('.wp-block-custom-link a')){?>
                        <button type="button" class="kravt_button-border" onclick="window.open('<?php foreach (str_get_html($data[$key])->find('.wp-block-custom-link a') as $elem) {echo $elem->href;} ?>', '_blank')">Подробнее</button>
                    <?php } ?>
                <!-- </div> -->
                <img src="<?php foreach (str_get_html($data[$key])->find('img') as $img) {
                                echo $img->src;
                            } ?>" />
            </div>
        </section>

        <?php }
    } ?>
</main>
<?php get_footer() ?>