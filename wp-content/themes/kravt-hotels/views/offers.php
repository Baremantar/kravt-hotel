<?php
/*
*   Template Name: Offers
*/

$dom = get_post()->post_content;
$data = array();
$data[0] = array();
$data[1] = array();

$count = 0 ;

foreach (str_get_html($dom)->find('.wp-block-custom-slider-item-1') as $i => $element) {
    ++$count;
};

if($count == 2) {
    foreach (str_get_html($dom)->find('.wp-block-custom-slider-item-1') as $i => $element) {
        if ($i < 1) {
            array_push($data[0], $element->outertext());
        }
        if ($i >= 1) {
            array_push($data[1], $element->outertext());
        }
    };
};
if($count == 3) {
    $data[2] = array();
    foreach (str_get_html($dom)->find('.wp-block-custom-slider-item-1') as $i => $element) {
        if ($i == 0) {
            array_push($data[0], $element->outertext());
        }
        if ($i == 1) {
            array_push($data[1], $element->outertext());
        }
        if ($i == 2) {
            array_push($data[2], $element->outertext());
        }
    };
};
if($count == 4) {
    foreach (str_get_html($dom)->find('.wp-block-custom-slider-item-1') as $i => $element) {
        if ($i < 2 ) {
            array_push($data[0], $element->outertext());
        }
        if ($i >= 2  ) {
            array_push($data[1], $element->outertext());
        }
    };
}
if($count == 5) {
    $data[2] = array();
    foreach (str_get_html($dom)->find('.wp-block-custom-slider-item-1') as $i => $element) {
        if ($i < 2 ) {
            array_push($data[0], $element->outertext());
        }
        if ($i >= 2 && $i < 4 ) {
            array_push($data[1], $element->outertext());
        }
        if ($i > 3 ) {
            array_push($data[2], $element->outertext());
        }
    };
};
if($count == 6) {
    $data[2] = array();
    foreach (str_get_html($dom)->find('.wp-block-custom-slider-item-1') as $i => $element) {
        if ($i < 2 ) {
            array_push($data[0], $element->outertext());
        }
        if ($i >= 2 && $i < 4 ) {
            array_push($data[1], $element->outertext());
        }
        if ($i > 3 ) {
            array_push($data[2], $element->outertext());
        }
    };
};
if($count == 7) {
    $data[2] = array();
    foreach (str_get_html($dom)->find('.wp-block-custom-slider-item-1') as $i => $element) {
        if ($i < 3 ) {
            array_push($data[0], $element->outertext());
        }
        if ($i >= 3 && $i < 5 ) {
            array_push($data[1], $element->outertext());
        }
        if ($i > 4 ) {
            array_push($data[2], $element->outertext());
        }
    };
};
if($count == 8) {
    $data[2] = array();
    foreach (str_get_html($dom)->find('.wp-block-custom-slider-item-1') as $i => $element) {
        if ($i < 3 ) {
            array_push($data[0], $element->outertext());
        }
        if ($i >= 3 && $i < 6 ) {
            array_push($data[1], $element->outertext());
        }
        if ($i > 5 ) {
            array_push($data[2], $element->outertext());
        }
    };
};
if($count == 9) {
    $data[2] = array();
    foreach (str_get_html($dom)->find('.wp-block-custom-slider-item-1') as $i => $element) {
        if ($i < 3 ) {
            array_push($data[0], $element->outertext());
        }
        if ($i >= 3 && $i < 6 ) {
            array_push($data[1], $element->outertext());
        }
        if ($i > 5 ) {
            array_push($data[2], $element->outertext());
        }
    };
};

get_header();
 ?>
<main <?php if($ifMobile()){echo 'style="padding-bottom:48px"';}?>>
    
    <?php include(get_stylesheet_directory() . '/components/hero/thumbnails.php') ?>
    <div class="kravt_hero_container bg-offers">
        
        <?php include(get_stylesheet_directory() . '/components/hero/breadcrumbs.php') ?>

        <div class="kravt_mask_inner">
            <!-- Бургер меню -->

            <?php include(get_stylesheet_directory() . '/components/burger/custom_burger.php'); ?>

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

    <div class="container container-spacing">
        <div class="kravt_offersPage-row">
            <!-- items -->
            <?php foreach ($data as $i => $element) {?>
            <div class="kravt_offersPage-col offers-col-<?= ++$i ?>">
                <?php foreach ($element as $subElement) { 
                    $link = '';
                    foreach(str_get_html($subElement)->find('a') as $a){$link = $a->href;};
                    ?>
                <div <?php if($link != ''){ ?> onclick="window.location.href = '<?php echo $link ?>'" <?php } ?> >
                    
                    <img src="<?php foreach (str_get_html($subElement)->find('img') as $i => $img) {
                                            if ($i == 0) {echo $img->src;}
                                        } ?>" />
                    <p><?php foreach (str_get_html($subElement)->find('p') as $p) {
                                    echo $p->plaintext;
                                } ?></p>
                    <?php foreach (str_get_html($subElement)->find('span') as $i => $span) {
                                echo $span->outertext();
                            } ?>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <section class="kravt_offersPage_about_container">
        <div class="container">
            <div class="kravt_offersPage_about_content">
                <div class="kravt_offersPage_about_title">
                    <?php foreach (str_get_html($dom)->find('.wp-block-custom-content-p-span p') as $element) {
                        echo $element->outertext();
                    } ?>
                    <?php foreach (str_get_html($dom)->find('.wp-block-custom-content-p-span span') as $element) {
                        echo $element->outertext();
                    } ?>
                </div>
                <div class="kravt_offersPage_about_list">
                    <?php foreach (str_get_html($dom)->find('.wp-block-custom-span') as $element) {
                    ?>
                    <div>
                        <span class="kravt_kazan-about-splitter">—</span>
                        <?php echo $element->outertext() ?>
                    </div>
                    <?php
                    } ?>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer() ?>