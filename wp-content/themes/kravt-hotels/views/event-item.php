<?php
/* 
*   Template name: Event page
*   Template post type: post, page
*/

$dom = get_post()->post_content;
$data = array();

foreach (str_get_html($dom)->find('.wp-block-custom-block .wp-block-custom-slider-item') as $element) {
    array_push($data, $element);
};


get_header();
?>
<main>
    <?php include(get_stylesheet_directory() . '/components/hero/thumbnails.php') ?>
    
    <?php include(get_stylesheet_directory() . '/components/modals/custom-modal.php') ?>
    
    <div class="kravt_hero_container bg-eventItem">
        <?php include(get_stylesheet_directory() . '/components/hero/breadcrumbs.php') ?>
        <div class="kravt_mask_inner">
            <!-- Бургер меню -->
            <?php include(get_stylesheet_directory() . '/components/burger/custom_burger.php'); ?>

            <div class="kravt_content container kravt_heroMain-template">
                <div class="kravt_hero_main _hero_restarauntsPage_main_kazan">
                    <div class="kravt_excursion_hero_title">
                        <h1><?php the_title() ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="kravt_eventItem-form-action-container">
        <div class="container">
            <div class="kravt_eventItem-form-action-content">
                <div>
                    <span>
                    <?php foreach (str_get_html($dom)->find('p') as $i => $element) {
                        if ($i == 0) {
                            echo $element->plaintext;
                        }
                    } ?>
                    </span>
                    <button type="button" class="_booking-link">Оставить заявку</button>
                </div>
            </div>
        </div>
    </div>

    <div class="kravt_eventItem-steps-container container">
        <div class="kravt_eventItem-steps-col">
            <div>
                <?php
                foreach (array_splice($data, 0, count($data) / 2) as $element) {
                ?>
                    <div class="kravt_eventItem <?php if(get_site()->blog_id == 1){echo 'custom';}?>">
                        <img src="<?php foreach ($element->find('img') as $subElement) {echo $subElement->src;} ?>" width="750px" height="750px" <?php if(get_site()->blog_id == 1){?>onclick="window.location.href = '<?php foreach ($element->find('span a') as $subElement) {echo $subElement->href;} ?>'"<?php }?>>
                        <?php foreach ($element->find('span') as $subElement) {
                            echo $subElement->outertext();
                        } ?>
                    </div>
                <?php
                };
                ?>
            </div>
        </div>
        <div class="kravt_eventItem-steps-col f">
            <div>
                <?php
                    foreach (array_splice($data, (count($data) / 2) - 1, count($data)) as $element) {
                ?>
                    <div class="kravt_eventItem <?php if(get_site()->blog_id == 1){echo 'custom';}?>">
                        <img src="<?php foreach ($element->find('img') as $subElement) {echo $subElement->src;} ?>" width="750px" height="750px" <?php if(get_site()->blog_id == 1){?>onclick="window.location.href = '<?php foreach ($element->find('span a') as $subElement) {echo $subElement->href;} ?>'"<?php }?>>
                        <?php 
                                foreach ($element->find('span') as $subElement) {
                                    echo $subElement->outertext();
                                }
                        ?>
                    </div>
                <?php };?>
            </div>
        </div>
    </div>

    <div class="kravt_eventItem_notice-wrapper">
        <div class="container kravt_eventItem_notice-container">
            <?php foreach (str_get_html($dom)->find('.wp-block-custom-content-p-span-multiple') as $element) {
                echo $element->outertext();
            } ?>
        </div>
    </div>
    
    <?php include(get_stylesheet_directory() . '/components/sliders/suitable_restaraunts.php');?>

    <!-- Рестораны и кафе (7 секция) -->
    <?php
        if (get_site()->blog_id != 1) {
            include(get_stylesheet_directory() . '/components/sliders/slider_main_links.php'); 
        } 
    ?>

</main>
<?php get_footer() ?>