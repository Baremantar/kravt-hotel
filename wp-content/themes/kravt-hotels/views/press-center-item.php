<?php
/* 
*   Template name: Press center page
*   Template post type: post, page
*/

$dom = str_get_html(get_post()->post_content);

$template = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'views/press-center.php'
));

$data = get_posts( array(
	'numberposts' => -1,
	'category_name' => 'press-item',
	'post_type'   => 'post',
	'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
) );

get_header()
?>
<main class="press_center_item_main">
    <div class="kravt_dynamic_navigation _dynamic-white container negative">
        <a href="<?= get_blog_details( array( 'blog_id' => 1 ) )->home ?>">Kravt Hotels</a>
        <span>—</span>
        <a href="<?= get_post($template[0]->ID)->guid ?>">Пресс-центр</a>
        <span>—</span>
        <span class="kravt_dynamic_navigation-active press_item_breadcrumb"><?php the_title() ?></span>
    </div>
    <div class="container" style="width: 100%">
        <?php include(get_stylesheet_directory() . '/components/burger/default_burger.php'); ?>
    </div>
    <?php foreach ($dom->find('h1') as $key => $value) {
            $value->setAttribute('class','container press_item_head');
            echo $value->outertext();
        } ?>
    <section class="container container-spacing press_item_wrapper">
        <?php 
            foreach ($dom->find('span') as $key => $value) {
                $value->setAttribute('class','date');
                echo $value->outertext();
            };?>
        <div class="press_item_main">
            <?php 
                $html = $dom;
                foreach($html->find('h1') as $value){$value->outertext = '';};
                foreach($html->find('span') as $value){$value->outertext = '';};
                echo $html->outertext;
            ?>
        </div>
    </section>
    <section class="container container-spacing">
    <div class="kravt_roompage_others-title">
        <h2>Другие новости</h2>
        <div class="navigation-arrows">
            <div class="swiper-offer-nav-prev-button"></div>
            <div class="swiper-offer-nav-next-button"></div>
        </div>
    </div>
    <div class="kravt_kazan_offers_container">
        <div class="swiper mySwiperRoompageOthers roompage-swiper-others">
            <div class="kravt_swiper_side-hider _hider-others"></div>
            <div class="swiper-wrapper">

                <?php foreach ($data as $i => $element) {?>
                    <?php if($element->post_title !== get_the_title()) {?>
                        
                        <style>
                            <?php
                                echo '#roompage-others-'.++$i.':before{background-image: url('.get_the_post_thumbnail_url($element).')}'
                            ?>
                        </style>
    
                        <div class="swiper-slide kravt_roompage_others-slide" onclick="window.location.href = '<?= the_permalink($element) ?>'">
                            <div class="kravt_others-slide-wrapper">
                                <div id="roompage-others-<?= $i?>" class="kravt_roompage_others-slide-bg">
                                    <span><?= $element->post_title ?></span>
                                </div>
                            </div>
                            <p><?= $element->post_title ?></p>
                        </div>

                    <?php }; ?>
                <?php } ?>

            </div>
        </div>
    </div>
</section>
</main>
<?php get_footer() ?>