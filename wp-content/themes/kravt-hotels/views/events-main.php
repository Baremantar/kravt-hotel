<?php
/* 
*   Template Name: Events main
*/

$dom = get_post()->post_content;
$data = array();

$data['city'] = array();

foreach (str_get_html($dom)->find('.wp-block-custom-section-city') as $key => $value) {
    if ($key % 2 == 0) {
        foreach ($value->find('h2') as $subKey => $subValue) {
            if ($subKey == 0) {
                // Получение DOM городов
                $data['city'][$subValue->plaintext] = array();
                $data['city'][$subValue->plaintext]['name'] = $subValue->plaintext;
                $data['city'][$subValue->plaintext]['html'] = $value->outertext;
                // Получение списка отелей
                $data['city'][$subValue->plaintext]['hotels'] = array();
                foreach ($value->find('.wp-block-custom-section-hotel-services') as $k => $v) {
                    if ($k % 2 == 0) {
                        foreach ($v->find('h2') as $kt => $t) {
                            if ($kt == 0) {
                                $data['city'][$subValue->plaintext]['hotels'][$t->plaintext] = array();

                                $data['city'][$subValue->plaintext]['hotels'][$t->plaintext]['name'] = $t->plaintext;
                                $data['city'][$subValue->plaintext]['hotels'][$t->plaintext]['html'] = $v->outertext;
                                
                                $data['city'][$subValue->plaintext]['hotels'][$t->plaintext]['events'] = array();
                                
                                foreach (str_get_html($data['city'][$subValue->plaintext]['hotels'][$t->plaintext]['html'])->find('.wp-block-custom-section-1') as $sk => $sv) { 
                                    if ($sk % 2 == 0) {
                                        foreach ($sv->find('h2') as $ssk => $ssv) {
                                            if ($ssk == 0) {

                                                $data['city'][$subValue->plaintext]['hotels'][$t->plaintext]['events'][$ssv->plaintext] = array();
                                                
                                                $data['city'][$subValue->plaintext]['hotels'][$t->plaintext]['events'][$ssv->plaintext]['name'] = $ssv->plaintext;
                                                $data['city'][$subValue->plaintext]['hotels'][$t->plaintext]['events'][$ssv->plaintext]['html'] = $sv->outertext;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                }
            }
            
        }

    }
}

$getDescription = function ($attr) {
    foreach (str_get_html($attr)->find('span') as $i => $element) {
        if ($i == 0) {
            echo $element;
        }
    };
};

// echo '<pre>', print_r( $data , true), '</pre>';  
// die();

if (!isset($_GET['siteHotel']) && !isset($_GET['siteCity']) && !isset($_GET['siteEvent'])) {


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
            <?php include(get_stylesheet_directory() . '/components/burger/default_burger.php'); ?>

            <div class="kravt_content container kravt_heroMain-template">
                <div class="kravt_hero_main _hero_restarauntsPage_main_kazan">
                    <div class="kravt_events_hero_title">
                        <h1><?php the_title(); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container kravt_promotion_pickers-container">

        <div class="kravt_promotion_pickers-item kravt_dropdown promotion cities">
            <p>Город</p>
            <div class="kravt_dropdown promotion">
                <div class="kravt_dropdown_label-hotels">
                    <span>Выберите</span>
                    <img src="<?= get_template_directory_uri() . '/build/img/promotion/down.svg'?>" />
                </div>
                <div class="kravt_dropdown_content ch kravt_dropdown-hotels rounded">
                    <?php foreach ($data['city'] as $key => $value) {?>
                        <a class="kravt_dropdown_link city"
                            data-city="<?= $key ?>">
                            <p><?= $value['name']?></p>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="kravt_promotion_pickers-item kravt_dropdown promotion hotels">
            <p>Отель</p>
            <div class="kravt_dropdown promotion">
                <div class="kravt_dropdown_label-hotels">
                    <span>Выберите</span>
                    <img src="<?= get_template_directory_uri() . '/build/img/promotion/down.svg'?>" />
                </div>
                <div class="kravt_dropdown_content ch kravt_dropdown-hotels rounded">
                    <?php foreach ($data['city'] as $key => $value) {
                            foreach ($value['hotels'] as $subKey => $subValue) {
                        ?>
                        <a class="kravt_dropdown_link hotels"
                            data-city="<?= $key ?>" data-hotel="<?= htmlentities($subKey)?>">
                            <p><?= $subValue['name']?></p>
                        </a>
                    <?php }} ?>
                </div>
            </div>
        </div>

        <div class="kravt_promotion_pickers-item kravt_dropdown promotion events">
            <p>Тип мероприятия</p>
            <div class="kravt_dropdown promotion">
                <div class="kravt_dropdown_label-hotels">
                    <span>Выберите</span>
                    <img src="<?= get_template_directory_uri() . '/build/img/promotion/down.svg'?>" />
                </div>
                <div class="kravt_dropdown_content kravt_dropdown-hotels rounded">
                    <?php foreach ($data['city'] as $key => $value) {
                            foreach ($value['hotels'] as $subKey => $subValue) {
                                foreach ($subValue['events'] as $sk => $sv) {?>
                                    <a class="kravt_dropdown_link events"
                                        data-city="<?= $key ?>" data-hotel="<?= htmlentities($subKey) ?>" data-event="<?= $sk?>">
                                        <p><?= $sv['name']?></p>
                                    </a>
                                <?php }
                            }
                        } 
                    ?>
                </div>
            </div>
        </div>

    </div>


    <!-- Рестораны и кафе (7 секция) -->
    <?php foreach (str_get_html(reset(reset(reset($data['city'])['hotels'])['events'])['html'])->find('.wp-block-custom-section') as $key => $element) { 
        if ($key % 2 == 0) {?>
        <section class="kravt_restaraunts kravt_restaraunts_wedding container-spacing kravt_events-slider">
            <div class="kravt_restaraunts_container events">
                <div class="kravt_events-mobile">
                    <div>
                        <p><?php foreach (str_get_html($element)->find('h2') as $subElement) {echo $subElement->plaintext;} ?></p>
                        <?php $getDescription($element); ?>
                    </div>
                        <button type="button" onclick="window.location.href = '<?php foreach(str_get_html($element)->find('a') as $i => $subElement){ if($i % 2 == 0){echo $subElement->href;};} ?>'">Подробнее</button>

                    <img src="<?php foreach (str_get_html($element)->find('.wp-block-gallery img') as $i => $subElement) {if ($i == 0) {echo $subElement->src;}} ?>">
                </div>
            </div>
            <div class="swiper mySwiperScreen swiper-screen">
                <div class="kravt_screen-swiper-arrow"></div>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide kravt_screen_slide kravt_screen-swiper-start" style="width: 63.5%">
                             
                            <div class="kravt_screen_slide-content">
                                <div class="kravt_screen-swiper-title b">
                                    <h2><?php foreach (str_get_html($element)->find('h2') as $subElement) {
                                            echo $subElement->plaintext;
                                        } ?></h2>
                                    <?php $getDescription($element) ?>
                                </div>
                                
                                <?php 
                                foreach (str_get_html($element)->find('a') as $k => $value) {?>
                                    <div class="kravt_screen-swiper-element">
                                        <a class="kravt_screen-swiper-element-main" href="<?= $value->href; ?>">Подробнее</a>
                                    </div>
                                <?php } ?>
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
    <?php }} ?>
</main>
<?php get_footer();
} else {
    // echo '<pre>', print_r( $_GET , true), '</pre>';
    
    // echo '<pre>', print_r( $data , true), '</pre>'; 
    // die();

    foreach (str_get_html($data['city'][$_GET['siteCity']]['hotels'][$_GET['siteHotel']]['events'][$_GET['siteEvent']]['html'])->find('.wp-block-custom-section') as $key => $element) {
        if ($key % 2 == 0) {?>

            <section class="kravt_restaraunts kravt_restaraunts_wedding container-spacing kravt_events-slider">
                <div class="kravt_restaraunts_container events">
                    <div class="kravt_events-mobile">
                        <div>
                            <p><?php foreach (str_get_html($element)->find('h2') as $subElement) {echo $subElement->plaintext;} ?></p>
                            <?php $getDescription($element); ?>
                        </div>
                            <button type="button" onclick="window.location.href = '<?php foreach(str_get_html($element)->find('a') as $i => $subElement){ if($i % 2 == 0){echo $subElement->href;};} ?>'">Подробнее</button>

                        <img src="<?php foreach (str_get_html($element)->find('.wp-block-gallery img') as $i => $subElement) {if ($i == 0) {echo $subElement->src;}} ?>">
                    </div>
                </div>
                <div class="swiper mySwiperScreen swiper-screen">
                    <div class="kravt_screen-swiper-arrow"></div>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide kravt_screen_slide kravt_screen-swiper-start" style="width: 63.5%">

                                <div class="kravt_screen_slide-content">
                                    <div class="kravt_screen-swiper-title b">
                                        <h2><?php foreach (str_get_html($element)->find('h2') as $subElement) {
                                                echo $subElement->plaintext;
                                            } ?></h2>
                                        <?php $getDescription($element) ?>
                                    </div>
                                        
                                    <?php 
                                    foreach (str_get_html($element)->find('a') as $k => $value) {?>
                                        <div class="kravt_screen-swiper-element">
                                            <a class="kravt_screen-swiper-element-main" href="<?= $value->href; ?>">Подробнее</a>
                                        </div>
                                    <?php } ?>
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

<?php }}} ?>