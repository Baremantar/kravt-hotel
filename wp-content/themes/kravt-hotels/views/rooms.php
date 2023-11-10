<?php
/* 
*   Template Name: Rooms
*/

global $post;
$actual_link = explode('?', $_SERVER['REQUEST_URI'])[0];

if (get_site()->blog_id == 4) {
    if ($actual_link == '/rooms/') {
        $postslist = [];
    }
    elseif ($actual_link == '/junior-suite/') {
        $postslist = get_posts(array('posts_per_page' => -1, 'category__and' => [13,19]));
    }
    elseif ($actual_link == '/superior-rooms/') {
        $postslist = get_posts(array('posts_per_page' => -1, 'category__and' => [18, 13]));
    }
    elseif ($actual_link == '/suites/') {
        $postslist = get_posts(array('posts_per_page' => -1, 'category__and' => [13,20]));
    }
} else {
    $postslist = get_posts(array('posts_per_page' => -1, 'category_name' => 'rooms-banner'));
}


$data = array();
$data[0] = array();
$data[1] = array();

foreach ($postslist as $element) {

    array_push($data[0], $element);

}
$data[0] = array_reverse($data[0]);

$dom = get_post()->post_content;

foreach (str_get_html($dom)->find('.wp-block-custom-section') as $i => $element) {
    if ($i % 2 == 0) {
        array_push($data[1], $element->outertext());
    }
}

global $getDescription;
$getDescription = function ($attr) {
    foreach (str_get_html($attr)->find('span') as $i => $element) {
        if ($i == 0) {
            echo $element;
        }
    };
};
global $getHeader;
$getHeader = function ($attr) {
    foreach (str_get_html($attr)->find('h2') as $element) {
        echo $element;
    };
};



get_header() ?>
<main class='main_rooms'>
    <?php include(get_stylesheet_directory() . '/components/hero/thumbnails.php') ?>
    <div class="kravt_hero_container bg-rooms">
        
        <?php include(get_stylesheet_directory() . '/components/hero/breadcrumbs.php') ?>

        <!-- Бургер меню -->

        <?php include(get_stylesheet_directory() . '/components/burger/custom_burger.php'); ?>

        <div class="kravt_content container kravt_heroMain-template-rooms">
            <div class="kravt_hero_main _hero_rooms_main_kazan">
                <div class="kravt_kazan_rooms_hero_title">
                    <h1><?= the_title() ?></h1>
                    <div>
                        <?php if(get_site()->blog_id != 4){
                            foreach ($data[0] as $element) { ?>
                                <a href="<?= get_post_permalink($element) ?>"><?= get_the_title($element) ?></a>
                            <?php }
                        } else {
                            if (explode('?', $_SERVER['REQUEST_URI'])[0] == '/rooms/'){
                                $pages_with_template_filename = get_pages( [
                                    'meta_key' => '_wp_page_template',
                                    'meta_value' => 'views/rooms.php'
                                ] );

                                $otherLinks = get_posts(array('posts_per_page' => -1, 'category' => [13, -18, -19, -20]));
                                foreach ($otherLinks as $element) {
                                    array_push($pages_with_template_filename, $element);
                                };

                                foreach ($pages_with_template_filename as $element) {
                                    if ($element->post_title != 'Номера') {?>
                                        <a href="<?= get_permalink($element) ?>"><?= $element->post_title ?></a>
                                    <?php }
                                }
                            } else {
                             //   foreach ($data[0] as $element) { ?>
                                    <!-- <a href="<?php//= get_post_permalink($element); ?>"><?php//= get_the_title($element); ?></a> -->
                                <?php // }
                            }
                            
                        }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php foreach ($data[1] as $element) { ?>
    <section id="standart" class="container container-spacing">
        <div style="display: flex;align-items: center;justify-content: space-between;">
            <h2><?php foreach (str_get_html($element)->find('h2') as $subElement) {
                                echo $subElement->plaintext;
                            } ?></h2>
            <button type="button" class="btn-default"
                onclick="window.open('<?php foreach (str_get_html($element)->find('.wp-block-custom-link a') as $i => $subElement) {if($i == 0){echo $subElement->href;}} ?>', '_blank')">Смотреть
                3D тур</button>
        </div>
        <div class="kravt_kazan_rooms-content">
            <div class="kravt_kazan_rooms-aboutSide">
                <span><?php $getDescription($element) ?></span>
                <div class="kravt_kazan_rooms_extended"
                    onclick="window.location.href = '<?php foreach (str_get_html($element)->find('.wp-block-custom-link a') as $listItem) {if($i == 1){echo $subElement->href;}} ?>'">
                    <span>Подробнее</span>
                    <img src="<?= get_template_directory_uri() . '/build/img/icons/extended.svg' ?>" width="12"
                        height="12" />
                </div>
                <div class="kravt_kazan_rooms_splitter"></div>
                <div class="kravt_kazan_rooms_list">
                    <p>В номере:</p>
                    <ul>
                        <?php foreach (str_get_html($element)->find('li') as $listItem) {
                                echo $listItem->outertext();
                            } ?>
                    </ul>
                    <a href="/#" class="kravt_kazan_rooms_extend-list dropdown">Смотреть полный список</a>
                </div>
            </div>
            <div class="kravt_kazan_rooms-aboutProps">
                <div class="kravt_kazan_rooms_prop">
                    <div>
                        <span>Площадь номера, </span>
                        <span class="kravt_kazan_rooms_metre-badge">м2</span>
                    </div>
                    <?php foreach (str_get_html($element)->find('span.square') as $span) {
                            echo $span->outertext();
                        } ?>
                </div>
                <div class="kravt_kazan_rooms_prop">
                    <span>Количество гостей</span>
                    <?php foreach (str_get_html($element)->find('span.guests') as $span) {
                            echo $span->outertext();
                        } ?>
                </div>
                <div class="kravt_kazan_rooms_prop">
                    <span>Сплит-система</span>
                    <?php foreach (str_get_html($element)->find('span.splitSystem') as $span) {
                            if ($span->plaintext == '+') { ?>
                    <img src="<?= get_template_directory_uri() . '/build/img/icons/access.svg' ?>" width="36"
                        height="36" />
                    <?php }
                        } ?>
                </div>
                <div class="kravt_kazan_rooms_prop">
                    <span>Количество кроватей</span>
                    <?php foreach (str_get_html($element)->find('span.beds') as $span) {
                            echo $span->outertext();
                        } ?>
                </div>
                <div class="kravt_kazan_rooms_prop">
                    <span>Шведский стол</span>
                    <?php foreach (str_get_html($element)->find('span.sweedishTable') as $span) {
                            echo $span->outertext();
                        } ?>
                </div>
            </div>
        </div>
        <div class="kravt_animation-wrapper _animation-wrapper-rooms">
            <img onclick="window.location.href = '<?php foreach (str_get_html($element)->find('.wp-block-custom-link a') as $listItem) {if($i == 1){echo $subElement->href;}} ?>'"
                src="<?php foreach (str_get_html($element)->find('img') as $i => $image) {echo $image->src;} ?>"
                class="kravt_kazan_rooms_preview" />
        </div>
    </section>
    <?php } ?>
</main>
<?php get_footer() ?>