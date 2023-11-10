<?php
/* 
*   Template Name: Promotion
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
                            }
                        }
                    }

                }
            }
            
        }

    }
}


// echo '<pre>', print_r( $data['city'] , true), '</pre>';  
// die();

if (!isset($_GET['siteHotel']) && !isset($_GET['siteCity'])) {

get_header();

?>
<main>
    <?php include(get_stylesheet_directory() . '/components/hero/thumbnails.php') ?>
    <div class="kravt_hero_container bg-promotion">
        <div class="kravt_dynamic_navigation _dynamic-white container">
            <a href="<?= get_blog_details( array( 'blog_id' => 1 ) )->home ?>">Kravt Hotels</a>
            <span>—</span>
            <span class="kravt_dynamic_navigation-active">Акции</span>
        </div>

        <div class="kravt_mask_inner">
            <!-- Бургер меню -->
            <?php include(get_stylesheet_directory() . '/components/burger/default_burger.php'); ?>

            <div class="kravt_content container kravt_heroMain-template">
                <div class="kravt_hero_main _hero_offers_main_kazan">
                    <div class="kravt_offers_hero_title">
                        <h1>
                            Специальные <br />
                            предложения
                        </h1>
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

        <div class="kravt_promotion_pickers-item kravt_dropdown promotion">
            <p>Отель</p>
            <div class="kravt_dropdown promotion">
                <div class="kravt_dropdown_label-hotels">
                    <span>Выберите</span>
                    <img src="<?= get_template_directory_uri() . '/build/img/promotion/down.svg'?>" />
                </div>
                <div class="kravt_dropdown_content kravt_dropdown-hotels rounded">
                    <?php foreach ($data['city'] as $key => $value) {
                            foreach ($value['hotels'] as $subKey => $subValue) {
                        ?>
                        <a class="kravt_dropdown_link hotels"
                            data-city="<?= $key ?>" data-hotel="<?= $subKey?>">
                            <p><?= $subValue['name']?></p>
                        </a>
                    <?php }} ?>
                </div>
            </div>
        </div>

    </div>

                            
    <?php $i = 1;
    foreach (str_get_html(reset(reset($data['city'])['hotels'])['html'])->find('.wp-block-custom-section-1') as $key => $value) {
        if ($key % 2 == 0) {?>
    <section class="container container container-spacing promotion <?php if($i == 1){echo 'first';} else if($i == 3){echo 'last';}?>">
        <div class="kravt_roompage_know-title">
            <?php foreach ($value->find('h2') as $subValue) {echo $subValue->outertext();} ?>
            <div class="navigation-arrows">
                <div class="swiper-promotion-<?= $i?>-nav-prev-button"></div>
                <div class="swiper-promotion-<?= $i?>-nav-next-button"></div>
            </div>
        </div>
        <div class="kravt_kazan_offers_container promotion">
            <div class="swiper mySwiperPromotionRow<?= $i++?> roompage-swiper-know">
                <div class="swiper-wrapper">

                    <?php foreach ($value->find('.wp-block-custom-slider-item-1') as $subValue) {?>
                        <div class="swiper-slide kravt_promotion_row_slide-item"
                            onclick="window.location.href = '<?php foreach($subValue->find('a') as $a){echo $a->href;}?>'">
                            <div class="kravt_animation-wrapper">
                                <img width="100%" height="368px"
                                    src="<?php foreach($subValue->find('img') as $img){echo $img->src;}?>" />
                            </div>
                            <div class="kravt_promotion-row_label">
                                <p><?php foreach($subValue->find('p') as $p){echo $p->plaintext;}?></p>
                                <?php foreach($subValue->find('span') as $span){echo $span->outertext();}?>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </section>
    
    <?php }} ?>
</main>

<?php 
get_footer();

} else {
    $i = 1;
    foreach (str_get_html($data['city'][$_GET['siteCity']]['hotels'][$_GET['siteHotel']]['html'])->find('.wp-block-custom-section-1') as $key => $value) {
        if ($key % 2 == 0) {
    ?>
    <section class="container container container-spacing promotion">
        <div class="kravt_roompage_know-title">
            <?php foreach ($value->find('h2') as $subValue) {echo $subValue->outertext();} ?>
            <div class="navigation-arrows">
                <div class="swiper-promotion-<?= $i?>-nav-prev-button"></div>
                <div class="swiper-promotion-<?= $i?>-nav-next-button"></div>
            </div>
        </div>
        <div class="kravt_kazan_offers_container promotion">
            <div class="swiper mySwiperPromotionRow<?= $i++?> roompage-swiper-know">
                <div class="swiper-wrapper">

                <?php foreach ($value->find('.wp-block-custom-slider-item-1') as $subValue) {?>
                        <div class="swiper-slide kravt_promotion_row_slide-item"
                            onclick="window.location.href = '<?php foreach($subValue->find('a') as $a){echo $a->href;}?>'">
                            <div class="kravt_animation-wrapper">
                                <img width="100%" height="368px"
                                    src="<?php foreach($subValue->find('img') as $img){echo $img->src;}?>" />
                            </div>
                            <div class="kravt_promotion-row_label">
                                <p><?php foreach($subValue->find('p') as $p){echo $p->plaintext;}?></p>
                                <?php foreach($subValue->find('span') as $span){echo $span->outertext();}?>
                            </div>
                        </div>
                    <?php } ?>
                    
                </div>
            </div>
        </div>
    </section>
<?php } } }?>