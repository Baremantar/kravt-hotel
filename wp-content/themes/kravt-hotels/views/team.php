<?php
/* 
*   Template Name: Team
*/

$dom = str_get_html(get_post()->post_content);
$data = array();

foreach ($dom->find('.wp-block-custom-section') as $i => $element) {
    if ($i % 2 == 0) {
        array_push($data, $element->outertext());
    }
}

if (!isset($_GET['profileID'])) {


get_header();
?>

<div class="profile_popup_background"></div>

<main class="main_team">
    <?php include(get_stylesheet_directory() . '/components/hero/thumbnails.php') ?>
    <div class="kravt_hero_container bg-promotion">
        <div class="kravt_dynamic_navigation _dynamic-white container">
            <a href="<?= get_blog_details( array( 'blog_id' => 1 ) )->home ?>">Kravt Hotels</a>
            <span>—</span>
            <span class="kravt_dynamic_navigation-active">Команда</span>
        </div>

        <div class="container" style="width: 100%">
            <!-- Бургер меню -->
            <?php include(get_stylesheet_directory() . '/components/burger/default_burger.php'); ?>

            <div class="kravt_content team">
                <div class="kravt_hero_main _hero-group" style="width: 100%">
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

    <section class="container container-spacing founder">
        <?php foreach (str_get_html($data[0])->find('.wp-block-custom-section') as $i => $element) {
            if ($i == 0) { ?>

                <div class="founder_wrapper">

                    <div class="founder_mobile_text">
                        <?php 
                            foreach ($element->find('h2') as $i => $subElement) {if ($i == 0) {echo $subElement->outertext();}};
                            foreach ($element->find('span') as $i => $subElement) {echo $subElement->outertext();}; 
                        ?>
                    </div>
                    
                    <?php foreach ($element->find('img') as $i => $subElement) {if ($i == 0) {echo $subElement->outertext();}} ?>
                    
                    <div class="founder_text">
                        <?php 
                            foreach ($element->find('h2') as $i => $subElement) {if ($i == 0) {echo $subElement->outertext();}};
                            foreach ($element->find('span') as $i => $subElement) {echo $subElement->outertext();};
                            foreach ($element->find('p') as $i => $subElement) {if ($i == 0) {echo $subElement->outertext();}};
                        ?>
                        <span class="additional_link" data-profileid="0">Подробнее</span>
                    </div>

                </div>

        <?php }
        } ?>
    </section>

    <div id='profile_popup'>
        <div class="profile_popup_wrapper">
            <span class="profile_close">
                <?= file_get_contents(get_template_directory_uri().'/build/img/Close.svg') ?>
            </span>
            <div class="profile_main" data-profileid="0">
                <?php foreach (str_get_html($data[0])->find('.wp-block-custom-section') as $i => $element) {
                    if ($i == 0) {?>
                        <div class="profile_main_mobile">
                            <h2 class="name"><?php foreach ($element->find('h2') as $i => $subElement) {if ($i == 0) {echo $subElement->plaintext;}}; ?></h2>
                            <span class="specs"><?php foreach ($element->find('span') as $i => $subElement) {if ($i == 0) {echo $subElement->plaintext;}}; ?></span>
                            <p class="description"><?php foreach ($element->find('p') as $i => $subElement) {if ($i == 0) {echo $subElement->plaintext;}}; ?></p>
                        </div>
                        <?php foreach ($element->find('img') as $i => $subElement) {if ($i == 0) {echo $subElement->outertext();}} ?>
                        <div class="profile_description">
                            <h2 class="name"><?php foreach ($element->find('h2') as $i => $subElement) {if ($i == 0) {echo $subElement->plaintext;}}; ?></h2>
                            <span class="specs"><?php foreach ($element->find('span') as $i => $subElement) {if ($i == 0) {echo $subElement->plaintext;}}; ?></span>
                            <p class="description"><?php foreach ($element->find('p') as $i => $subElement) {if ($i == 0) {echo $subElement->plaintext;}}; ?></p>
                            <?php 
                                    $html = $element;
                                    foreach($html->find('h2') as $subElement){$subElement->outertext = '';};
                                    foreach($html->find('img') as $subElement){$subElement->outertext = '';};
                                    foreach($html->find('span') as $subElement){$subElement->outertext = '';};
                                    foreach($html->find('figure') as $subElement){$subElement->outertext = '';};
                                    foreach($html->find('p') as $i => $subElement){if($i == 0){$subElement->outertext = '';}};

                                    echo $html->outertext();
                                 ?>
                        </div>
                    <?php }
                } ?>
            </div>
            <div class="profile_slider">
                <div class="kravt_roompage_others-title">
                    <h2>Команда Kravt Group</h2>
                    <div class="navigation-arrows">
                        <div class="swiper-offer-nav-prev-button"></div>
                        <div class="swiper-offer-nav-next-button"></div>
                    </div>
                </div>
                <div class="swiper mySwiperTeam1">
                    <div class="swiper-wrapper">
                        <?php 
                        $b = 1;
                        foreach ($data as $i => $element) {
                            if ($i != 0) {
                                foreach (str_get_html($element)->find('.wp-block-custom-section') as $i => $subElement) {
                                    if ($i % 2 == 0) {?>
                                        <div class="swiper-slide profile" data-profileid="<?= $b++?>">
                                            <?php foreach ($subElement->find('img') as $i => $value) {if ($i == 0) {echo $value->outertext();}} ?>
                                            <div class="profile_text">
                                                <h3 class="name"><?php foreach ($subElement->find('h2') as $i => $value) {if ($i == 0) {echo $value->plaintext;}} ?></h3>
                                                <span class="department"><?php foreach ($subElement->find('span') as $i => $value) {echo $value->plaintext;}; ?></span>
                                            </div>
                                        </div>
                                    <?php }
                                }
                            }
                        }?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="container container-spacing our_team">
        <h2>Команда Kravt Group</h2>
        <div class="profile_wrapper">
            <?php foreach ($data as $key => $element) {
                if ($key != 0) {
                    foreach (str_get_html($element)->find('.wp-block-custom-section') as $b => $subElement) {
                        if ($b % 2 == 0) {?>
                            <div class="profile">
                                <?php foreach ($subElement->find('img') as $i => $value) {if ($i == 0) {echo $value->outertext();}} ?>
                                <div class="profile_text">
                                    <h3 class="name"><?php foreach ($subElement->find('h2') as $i => $value) {if ($i == 0) {echo $value->plaintext;}} ?></h3>
                                    <span class="department"><?php foreach ($subElement->find('span') as $i => $value) {echo $value->plaintext;}; ?></span>
                                    <p><?php foreach ($subElement->find('p') as $i => $value) {if ($i == 0) {echo $value->plaintext;}}; ?></p>
                                </div>
                                <span class="additional_link" data-profileid="<?= $key?>">Подробнее</span>
                            </div>
                        <?php }
                    }
                }
            }?>
        </div>
    </section>
</main>

<?php get_footer(); 
} else { ?>

<div class="profile_main" data-profileid="<?= $_GET['profileID']?>">
                <?php foreach (str_get_html($data[$_GET['profileID']])->find('.wp-block-custom-section') as $i => $element) {
                    if ($i == 0) {?>
                        <div class="profile_main_mobile">
                            <h2 class="name"><?php foreach ($element->find('h2') as $i => $subElement) {if ($i == 0) {echo $subElement->plaintext;}}; ?></h2>
                            <span class="specs"><?php foreach ($element->find('span') as $i => $subElement) {if ($i == 0) {echo $subElement->plaintext;}}; ?></span>
                            <p class="description"><?php foreach ($element->find('p') as $i => $subElement) {if ($i == 0) {echo $subElement->plaintext;}}; ?></p>
                        </div>
                        <?php foreach ($element->find('img') as $i => $subElement) {if ($i == 0) {echo $subElement->outertext();}} ?>
                        <div class="profile_description">
                            <h2 class="name"><?php foreach ($element->find('h2') as $i => $subElement) {if ($i == 0) {echo $subElement->plaintext;}}; ?></h2>
                            <span class="specs"><?php foreach ($element->find('span') as $i => $subElement) {if ($i == 0) {echo $subElement->plaintext;}}; ?></span>
                            <p class="description"><?php foreach ($element->find('p') as $i => $subElement) {if ($i == 0) {echo $subElement->plaintext;}}; ?></p>
                            <?php 
                                    $html = $element;
                                    foreach($html->find('h2') as $subElement){$subElement->outertext = '';};
                                    foreach($html->find('img') as $subElement){$subElement->outertext = '';};
                                    foreach($html->find('span') as $subElement){$subElement->outertext = '';};
                                    foreach($html->find('figure') as $subElement){$subElement->outertext = '';};
                                    foreach($html->find('p') as $i => $subElement){if($i == 0){$subElement->outertext = '';}};

                                    echo $html->outertext();
                                 ?>
                        </div>
                    <?php }
                } ?>
            </div>  

<?php }
    ?>