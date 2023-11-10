<?php 
$data = [];
$whitePages = ['rooms', 'events', 'offers', 'services'];

foreach($whitePages as $element) {
    $templates = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'views/'.$element.'.php'
    ));
    array_push($data, $templates);
}
// echo '<pre>', print_r( $data , true), '</pre>';
// die();
?>
<section class="container container-spacing _section-know-roompage">
    <div class="kravt_roompage_know-title">
        <h2>Познакомиться c отелем</h2>
        <div class="navigation-arrows">
            <div class="swiper-know-nav-prev-button"></div>
            <div class="swiper-know-nav-next-button"></div>
        </div>
    </div>
    <div class="kravt_kazan_offers_container">
        <div class="swiper mySwiperRoompageKnow roompage-swiper-know">
            <div class="swiper-wrapper">   
            <?php foreach ($data as $value) {
                foreach ($value as $element) {?>

                <?php          
                if($element->post_parent == 0){  
                ?>
                <div class="swiper-slide kravt_roompage_know_slide-item" onclick="window.location.href = '<?= $element->guid?>'">
                    <div class="kravt_animation-wrapper">
                        <img src="<?= get_the_post_thumbnail_url($element)?>" width="520px" height="520px"/>
                    </div>
                    <div class="kravt_roompage_know_label">
                        <p><?= $element->post_title ?></p>
                    </div>
                </div>

            <?php }}}?>

            </div>
        </div>
    </div>
</section>