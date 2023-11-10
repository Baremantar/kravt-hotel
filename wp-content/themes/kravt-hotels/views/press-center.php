<?php
/* 
*   Template Name: Press Center
*/

$dom = str_get_html(get_post()->post_content);
$data = array();

foreach ($dom->find('.press-wrapper') as $i => $element) {
    if ($i % 2 == 0) {
        array_push($data, $element->outertext());
    }
}

get_header();
?>
<main>
<?php include(get_stylesheet_directory() . '/components/hero/thumbnails.php') ?>

    <div class="kravt_hero_container bg-promotion">
        <div class="kravt_dynamic_navigation _dynamic-white container">
            <a href="<?= get_blog_details( array( 'blog_id' => 1 ) )->home ?>">Kravt Hotels</a>
            <span>—</span>
            <span class="kravt_dynamic_navigation-active">Пресс-центр</span>
        </div>

        <div class="container" style="width: 100%">
            <!-- Бургер меню -->
            <?php include(get_stylesheet_directory() . '/components/burger/default_burger.php'); ?>

            <div class="kravt_content">
                <div class="kravt_hero_main _hero-group" style="width: 100%">
                    <div class="kravt_group_hero_title">
                        <h1><?php the_title(); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="container container-spacing press_wrapper">
        <div class="press_toggler">
            <div class="press_links">
                <?php foreach ($data as $key => $value) {
                    foreach (str_get_html($value)->find('h2') as $subKey => $subValue) {
                        if ($subKey == 0) {?>
                            <a class="kravt_events_link event-link-handle" href="javascript:void(0)"><?= $subValue->plaintext ?></a>
                    <?php }}
                } ?>
            </div>
            <button class="kravt_button-border button-roompage _booking-link custom" type="button">Отправить запрос</button>
        </div>
        <div class="press_content">
            <div class="press_news press_item-wrapper">

                <?php foreach (str_get_html($data[0])->find('.wp-block-custom-slider-item-1') as $key => $value) {?>
                    <div class="press_news-item" onclick="window.location.href = '<?php foreach (str_get_html($value)->find('a') as $key => $subValue) {echo $subValue->href;}?>'">
                        <img src="<?php foreach (str_get_html($value)->find('img') as $key => $subValue) {echo $subValue->src;}?>">
                        <div>
                            <p><?php foreach (str_get_html($value)->find('p') as $key => $subValue) {echo $subValue->plaintext;}?></p>
                            <?php foreach (str_get_html($value)->find('span') as $key => $subValue) {echo $subValue->outertext();}?>
                        </div>
                    </div>
                <?php } ?>

            </div>
            <div class="press_legal press_item-wrapper">
                <?php 
                foreach (str_get_html($data[1])->find('.wp-block-custom-section-1') as $key => $value) {
                    if ($key == 1) {
                        foreach ($value->find('.wp-block-custom-section-1') as $key => $subValue) {
                            if ($key % 2 == 0) {?>
                                <div class="documents_wrapper">
                                    <h2 class="document_title"><?php foreach ($subValue->find('h2') as $subKey => $h2){echo $h2->plaintext;};echo file_get_contents(get_template_directory_uri().'/build/img/openArrow.svg') ?></h2>
                                    <div class="document_files">
                                        <?php foreach ($subValue->find('.wp-block-custom-content-p-span') as $subKey => $card) {?>
                                            <div>
                                                <span><?php foreach ($card->find('p') as $subKey => $p){echo $p;} ?></span>
                                                <a href="<?php foreach ($card->find('a') as $subKey => $a){echo $a->href;} ?>" target="_blank" >Посмотреть</a>
                                            </div>
                                        <?php } ?>
                                    </div> 
                                </div>
                            <?php }
                        }
                    }
                } 
                ?>
            </div>
            <div class="press_contacts press_item-wrapper">
                <?php foreach (str_get_html($data[2])->find('.wp-block-custom-block') as $key => $value) {?>
                    <div class="press_contact">
                        <p><?php foreach ($value->find('p') as $subKey => $p){if($subKey == 0){echo $p->plaintext;}} ?></p>
                        <span><?php foreach ($value->find('p') as $subKey => $p){if($subKey == 1){echo $p->plaintext;}} ?></span>
                        <div>
                            <span>
                                <?= file_get_contents(get_template_directory_uri().'/build/img/call.svg') ?>
                            </span>
                            <span>
                                Телефон</br>
                                <?php foreach ($value->find('p') as $subKey => $p){if($subKey == 2){echo $p->outertext();}} ?>
                            </span>
                        </div>
                        <div>
                            <span>
                                <?= file_get_contents(get_template_directory_uri().'/build/img/mail.svg') ?>
                            </span>
                            <span>
                                E-mail</br>
                                <?php foreach ($value->find('p') as $subKey => $p){if($subKey == 3){echo $p->outertext();}} ?>
                            </span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</main>
<?php 
get_footer(); ?>