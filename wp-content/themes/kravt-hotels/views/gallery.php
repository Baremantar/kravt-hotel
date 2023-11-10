<?php
/*
Template Name: Gallery
*/

$dom = str_get_html(get_post()->post_content);
$data = array();
// в блоках на странице указываем класс custom_group и парсим
foreach ($dom->find('div.wp-block-custom-content-item-1') as $element) {
    array_push($data, $element->outertext());
}  


if (!isset($_GET['galleryId'])) {
get_header() ?>
<main>

    <section class="container kravt_gallery_container">
        <!-- Бургер меню -->
        
        <?php include(get_stylesheet_directory() . '/components/burger/custom_burger.php'); ?>

        <?php include(get_stylesheet_directory() . '/components/hero/breadcrumbs.php') ?>


        <div class="kravt_gallery_mask" id="gallery_opened">
            <div class="kravt_gallery_mask-content" id="mask_content">
                <div id="gallery_close" class="kravt_gallery_close-icon"></div>

                <img id="opened_img" src="https://flevix.com/wp-content/uploads/2019/07/Facebook-Loading-Icons-1.gif" width="100%" height="auto" />
                <div id="opened_div"></div>
                <div class="kravt_gallery_mask-controller">
                    <p id="gallery_opened_title">Ресторан</p>
                    <div class="navigation-arrows">
                        <div class="swiper-offer-nav-prev-button" id="gallery-prev">
                            <svg style="transform: rotate(180deg)" width="34" height="16" viewBox="0 0 34 16" fill="none" xmlns="http://www.w3.org/2000/svg'?>">
                                <path d="M33 7C33.5523 7 34 7.44772 34 8C34 8.55228 33.5523 9 33 9L33 7ZM0.292892 8.7071C-0.0976296 8.31658 -0.0976295 7.68341 0.292893 7.29289L6.65686 0.92893C7.04738 0.538406 7.68054 0.538406 8.07107 0.92893C8.46159 1.31945 8.46159 1.95262 8.07107 2.34314L2.41421 8L8.07107 13.6569C8.46159 14.0474 8.46159 14.6805 8.07107 15.0711C7.68054 15.4616 7.04738 15.4616 6.65685 15.0711L0.292892 8.7071ZM33 9L1 9L1 7L33 7L33 9Z" fill="white" />
                            </svg>

                        </div>
                        <div class="swiper-offer-nav-next-button" id="gallery-next">
                            <svg width="34" height="16" viewBox="0 0 34 16" fill="none" xmlns="http://www.w3.org/2000/svg'?>">
                                <path d="M1 7C0.447715 7 -4.82823e-08 7.44772 0 8C4.82823e-08 8.55228 0.447715 9 1 9L1 7ZM33.7071 8.7071C34.0976 8.31658 34.0976 7.68341 33.7071 7.29289L27.3431 0.92893C26.9526 0.538406 26.3195 0.538406 25.9289 0.92893C25.5384 1.31945 25.5384 1.95262 25.9289 2.34314L31.5858 8L25.9289 13.6569C25.5384 14.0474 25.5384 14.6805 25.9289 15.0711C26.3195 15.4616 26.9526 15.4616 27.3431 15.0711L33.7071 8.7071ZM1 9L33 9L33 7L1 7L1 9Z" fill="white" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h1>Галерея</h1>
        <div class="kravt_gallery_content">
            <div class="kravt_gallery_menu-mobile">
                <?php foreach ($data as $i => $item) {
                    if ($i == 0) {
                        foreach (str_get_html($item)->find('p') as $link) {?>
                            <a class="kravt_gallery_menu-mobile-active kravt_gallery_menu-mobile-item"><?= $link->plaintext ?></a>
                        <?php }
                    } else {
                        foreach (str_get_html($item)->find('p') as $link) { ?>
                            <a class="kravt_gallery_menu-mobile-item"><?= $link->plaintext ?></a>
                        <?php }
                    }
                } ?>
            </div>
            <div class="kravt_gallery_menu" id="sticky-sidebar-gallery">
                <?php foreach ($data as $i => $item) {
                    if ($i == 0) {
                        foreach (str_get_html($item)->find('p') as $i => $link) {
                            if($i == 0){?>
                                <a class="kravt_gallery_menu-active kravt_gallery_menu-item"><?= $link->plaintext ?></a>
                           <?php }
                            
                        }
                    } else {
                        foreach (str_get_html($item)->find('p') as $i => $link) {
                            if($i == 0){?>
                                <a class="kravt_gallery_menu-item"><?= $link->plaintext ?></a>
                            <?php }
                        }
                    }
                } ?>

                <button type="button" class="btn-default tour" onclick="window.open('<?php foreach($dom->find('.wp-block-custom-link a') as $element){echo $element->href;}?>', '_blank')">Смотреть 3D тур</button>
            </div>
            <div class="kravt_gallery_grids">
                <?php
                foreach ($data as $key => $item) { ?>
                    <?php if ($key == 0) {?>
                        <div class="kravt_gallery_grid" style="display: grid">
                            <?php foreach (str_get_html($item)->find('figure.wp-block-image') as $key => $image) {
                                if ($key < 6) {?>
                                    <img class="kravt_gallery_item" src="<?php foreach(str_get_html($image)->find('img') as $subElement){echo $subElement->src;} ?>" alt='<?php foreach(str_get_html($image)->find('figcaption') as $subElement){echo $subElement->plaintext;} ?>'/>
                                <?php }
                            } ?>
                        </div>    
                    <?php } else { ?>
                    <div class="kravt_gallery_grid">
                        <?php foreach (str_get_html($item)->find('figure.wp-block-image') as $key => $image) {
                            if ($key < 6) {?>
                                <img class="kravt_gallery_item" src="<?php foreach(str_get_html($image)->find('img') as $subElement){echo $subElement->src;} ?>" alt='<?php foreach(str_get_html($image)->find('figcaption') as $subElement){echo $subElement->plaintext;} ?>'/>
                            <?php }
                        } ?>
                    </div>
                <?php } }
                ?>
                <button type="button" class="btn-default" id='loadMore'>Показать еще</button>
            </div>
    </section>
</main>
<?php get_footer(); } else {
// $_GET['galleryId']
// $data - array from data with images

foreach (str_get_html($data[$_GET['galleryId']])->find('figure.wp-block-image') as $key => $image) {
    if ($key > $_GET['galleryLength']-1 && $key < $_GET['galleryLength']+6 ) {?>
        <img class="kravt_gallery_item" src="<?php foreach(str_get_html($image)->find('img') as $subElement){echo $subElement->src;} ?>" alt='<?php foreach(str_get_html($image)->find('figcaption') as $subElement){echo $subElement->plaintext;} ?>'/>
    <?php }
} 


}
?>