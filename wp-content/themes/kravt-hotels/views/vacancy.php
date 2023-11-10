<?php
/* 
*   Template name: Vacancy page
*   Template post type: post, page
*/

$dom = str_get_html(get_post()->post_content);

$template = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'views/career.php'
));

$data = get_posts( array(
	'numberposts' => -1,
	'category_name' => 'vacancy',
	'post_type'   => 'post',
	'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
) );


// mayonnaise on escalator, its going upstairs to see ur later bye bye

get_header()
?>
<main class="press_center_item_main">

    <div class="container" style="width: 100%">
        <!-- Бургер меню -->
        <?php include(get_stylesheet_directory() . '/components/burger/default_burger.php'); ?>
    </div>
    
    <div class="kravt_dynamic_navigation _dynamic-white container negative">
        <a href="<?= get_blog_details( array( 'blog_id' => 1 ) )->home ?>">Kravt Hotels</a>
        <span>—</span>
        <a href="<?= get_post($template[0]->ID)->guid ?>">Карьера</a>
        <span>—</span>
        <span class="kravt_dynamic_navigation-active press_item_breadcrumb"><?php the_title() ?></span>
    </div>
    <div class="container" style="width: 100%">
        <?php include(get_stylesheet_directory() . '/components/burger/default_burger.php'); ?>
    </div>
    <h1 class="container press_item_head"><?php the_title() ?></h1>
    <section class="container container-spacing press_item_wrapper vacancy">
        <?php 
            foreach ($dom->find('span') as $key => $value) {
                if ($key == 0) {
                    $value->setAttribute('class','date');
                    echo $value->outertext();
                }
            };?>
        <div class="press_item_main">
            <?php 
            $html = $dom;
                foreach($html->find('span') as $value){$value->outertext = '';};
                foreach($html->find('.wp-block-custom-link') as $value){$value->outertext = '';};
                echo $html->outertext;
            ?>
            <button class="kravt_button-border button-roompage _booking-link custom" type="button">Отправить запрос</button>
        </div>
    </section>
    <section class="container container-spacing vacancy">
    <div class="kravt_roompage_others-title">
        <h2>Другие Вакансии</h2>
        <div class="navigation-arrows vacancy">
            <div class="swiper-offer-nav-prev-button"></div>
            <div class="swiper-offer-nav-next-button"></div>
        </div>
    </div>
    <div class="kravt_kazan_offers_container">
        <div class="swiper swiperVacancies vacancy-swiper-others">
            <div class="swiper-wrapper vacancies_wrapper">
                
                <?php foreach ($data as $i => $element) {?>
                    <?php if($element->post_title !== get_the_title()) {?>

                        <div class="career_vacancy swiper-slide">
                            <div class="career_vacancy-wrapper">
                                <div class="vacancy_logo">
                                    <?= file_get_contents(get_template_directory_uri().'/build/img/kravt-logo.svg') ?>
                                    <?php foreach (str_get_html(get_post($element)->post_content)->find('span') as $subKey => $logoTitle) {echo ($subKey == 1) ? $logoTitle->outertext() : '';} ?>
                                </div> 
                                <p><?= $element->post_title ?></p>
                                <p><?php foreach (str_get_html(get_post($element)->post_content)->find('span') as $subKey => $logoTitle) {echo ($subKey == 2) ? $logoTitle->plaintext : '';} ?></p>
                                <a href="<?= the_permalink($element) ?>">Подробнее</a>
                            </div>
                        </div>

                    <?php }; ?>
                <?php } ?>
            
            </div>
        </div>
    </div>
    <button type="button" class="kravt_button-border" onclick="window.open('<?php foreach($dom->find('.wp-block-custom-link a') as $value){echo $value->href;}?>','_blank')">Смотреть все вакансии</button>
</section>
</main>
<?php get_footer() ?>