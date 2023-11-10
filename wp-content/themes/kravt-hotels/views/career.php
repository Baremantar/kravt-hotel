<?php
/* 
*   Template Name: Career
*/

$dom = str_get_html(get_post()->post_content);

get_header();
?>
<main>
    <?php include(get_stylesheet_directory() . '/components/hero/thumbnails.php') ?>
    
    <div class="kravt_hero_container bg-promotion">
        <div class="kravt_dynamic_navigation _dynamic-white container">
            <a href="<?= get_blog_details( array( 'blog_id' => 1 ) )->home ?>">Kravt Hotels</a>
            <span>—</span>
            <span class="kravt_dynamic_navigation-active">Карьера</span>
        </div>

        <div class="container" style="width: 100%">
            <!-- Бургер меню -->
            <?php include(get_stylesheet_directory() . '/components/burger/default_burger.php'); ?>

            <div class="kravt_content">
                <div class="kravt_hero_main _hero-group career" style="width: 100%">
                    <div class="kravt_group_hero_title">
                        <h1><?php the_title() ?></h1>
                        <p class="kravt_hero_main-label"><?php foreach ($dom->find('p') as $key => $value) {
                            if ($key == 0) {
                                echo $value->plaintext;
                            }
                        } ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="kravt_kazan_excursion_about_container career">
        <div class="container">
            <div class="kravt_kazan_excursion_about_content">
                <div class="kravt_kazan_excursion_about_title career">
                    <?php
                    foreach ($dom->find('span') as $i => $element) {
                        if ($i == 0) {
                            echo $element->outertext;
                        }
                    } ?>
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
    <section class="container container-spacing career-benefits_wrapper">
        <?php foreach ($dom->find('.wp-block-custom-slider-item-1') as $key => $value) {?>
            <div class="career-benefits_item">
                <img src="<?php foreach ($value->find('img') as $subKey => $subValue) {echo $subValue->src;}?>" alt="">
                <div>
                    <?php foreach ($value->find('p') as $subKey => $subValue) {if($ifMobile()){echo strip_tags($subValue->outertext(), '<p>');}else echo $subValue->outertext();}?>
                    <?php foreach ($value->find('span') as $subKey => $subValue) {echo $subValue->outertext();}?>
                </div>
            </div>
        <?php } ?>
    </section>

    <?php foreach ($dom->find('.wp-block-custom-section') as $key => $value) {
        if($key == 0){?>
            <section class="container container-spacing career-vacancies_wrapper">
                <div class="vacancies_description">
                    <h2>Вакансии</h2>
                    <?php foreach ($value->find('span') as $subKey => $subValue) {echo $subValue->outertext();}?>
                    <button type="button" class="kravt_button-border" onclick="window.open('<?php foreach ($dom->find('.wp-block-custom-link a') as $subKey => $link) {if ($subKey == 0) {echo $link->href;}}?>', '_blank')">Смотреть все вакансии</button>
                </div>
                <div class="vacancies_wrapper">
                    <?php foreach ($value->find('.wp-block-custom-block') as $subKey => $subValue) {?>
                        <div class="career_vacancy">
                            <div class="vacancy_logo">
                                <?php foreach ($subValue->find('img') as $img) {echo $img->outertext;} ?>
                                <?php foreach ($subValue->find('p') as $subSubKey => $logoTitle) {if($subSubKey == 0){echo $logoTitle;}} ?>
                            </div> 
                            Получите возможность стать непосредственным участником интереснейших проектов высокого уровня, внося свой вклад в историю развития бренда Kravt Hotels.
                            <?php foreach ($subValue->find('p') as $subSubKey => $logoTitle) {if($subSubKey > 0 && $subSubKey < 3 ){echo $logoTitle;}} ?>
                            <a href="<?php foreach ($subValue->find('a') as $subSubKey => $logoTitle) {echo $logoTitle->href;} ?>">Подробнее</a>
                        </div>
                    <?php } ?>
                </div>
            </section>
        <?php }
    } ?>

    <?php foreach ($dom->find('.wp-block-custom-block.contacts') as $key => $value) { ?>
        <style>
            .container.container-spacing.career-feedback_wrapper {
                background-image: url(<?php foreach ($value->find('img') as $img) {echo $img->src;}  ?>);
            }
        </style>
             <section class="container container-spacing career-feedback_wrapper">
                <div>
                    <?php  
                        foreach ($value->find('p') as $p) {echo $p;} 
                    ?>
                    <button class="kravt_button-border _booking-link custom" type="button">Отправить запрос</button>
                </div>
            </section>
    <?php };?>

</main>
<?php  get_footer() ?>