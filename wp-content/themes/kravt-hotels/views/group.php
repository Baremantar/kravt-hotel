<?php
/* 
*   Template Name: About us
*/

$dom = str_get_html(get_post()->post_content);
$data = array();

foreach ($dom->find('.wp-block-custom-block') as $element) {
    array_push($data, $element->outertext());
}

$contentBlocks = array();
$contentBlocks[0] = array();
$contentBlocks[1] = array();

foreach (str_get_html($data[0])->find('.wp-block-custom-mini-block-hotel-number') as $i => $element) {
    if($i %2 == 0) {
        array_push($contentBlocks[0], $element);  
    }
}

foreach ($dom->find('.wp-block-custom-mini-block-hotel-number') as $i => $element) {
    if($i % 2 == 0) {
        array_push($contentBlocks[1], $element);  
    }
}

$vk = $GLOBALS['cgv']['vk_default'];
// $tel = $GLOBALS['cgv']['phone_default'];
$tg = $GLOBALS['cgv']['telegram_default'];

get_header();
?>
<main>
<?php include(get_stylesheet_directory() . '/components/hero/thumbnails.php') ?>
    <!-- Hero (1 секция) -->
    <div class="kravt_hero_container bg-group">
        <div class="kravt_dynamic_navigation _dynamic-white container">
        <a href="<?= get_blog_details( array( 'blog_id' => 1 ) )->home ?>">Kravt Hotels</a>
            <span>—</span>
            <span class="kravt_dynamic_navigation-active">О нас</span>
        </div>

        <div class="container" style="width: 100%">
            <!-- Бургер меню -->

            <?php include(get_stylesheet_directory() . '/components/burger/default_burger.php'); ?>
            

            <div class="kravt_content">
                <div class="kravt_hero_main _hero-group group" style="width: 100%">
                    <div class="kravt_group_hero_title group">
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

    <section class="container container-spacing">
        <p id="group_slide_title-mobile">
            <?php foreach (str_get_html($data[0])->find('p') as $i => $element) {
                if ($i == 0) {
                    echo $element->plaintext;
                }
            } ?>

        </p>
        <div class="kravt_group_slider-container">
            <div class="kravt_group_slider-img" id="group_slide_img"></div>
            <div class="kravt_group_slider-text">
                <div>
                    <p id="group_slide_title">
                        <?php foreach (str_get_html($data[0])->find('p.title') as $i => $element) {
                            if ($i == 0) {
                                echo $element->plaintext;
                            }
                        } ?>
                    </p>
                    <div class="kravt_group_slider-img" id="group_slide_img-mobile"></div>
                    <span id="group_slide_desc">
                        <?php foreach (str_get_html($data[0])->find('p.description') as $i => $element) {
                            if ($i == 0) {
                                echo $element->plaintext;
                            }
                        } ?>
                    </span>
                </div>
                <div>
                    <div class="kravt_group_slider-items">
                        <?php foreach ($contentBlocks[0] as $i => $element) {?>
                            <span 
                                id="group-slide-<?= $i ?>" 
                                class="kravt_group_slider-item" 
                                data-description="<?php foreach ($element->find('p.description') as $subElement) {echo $subElement->plaintext;} ?>" 
                                data-background="<?php foreach ($element->find('img') as $subElement) {echo $subElement->src;} ?>">
                                <?php foreach ($element->find('p.title') as $subElement) {echo $subElement->plaintext;} ?>
                            </span>
                        <?php } ?>
                    </div>
                    <div class="kravt_group_slider-progress-all"></div>
                    <div class="kravt_group_slider-progress-current" id="progress_current"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="container container-spacing" id="rewards">
        <div class="kravt_group_rewards-title">
            <h2>Наши награды</h2>
            <div class="navigation-arrows">
                <div class="swiper-offer-nav-prev-button"></div>
                <div class="swiper-offer-nav-next-button"></div>
            </div>
        </div>
        <div class="swiper mySwiperGroupRewards roompage-swiper-others">
            <div class="kravt_swiper_side-hider _hider-rewards"></div>
            <div class="swiper-wrapper">
                <!-- slide -->
                <?php foreach (str_get_html($data[1])->find('.wp-block-custom-award') as $i => $element) { ?>
                    <div class="swiper-slide kravt_group_rewards-slide">
                        <div class="kravt_group_rewards-item">
                            <div>
                                <?php foreach (str_get_html($element)->find('.award') as $subElement) {
                                    echo $subElement->outertext();
                                };
                                foreach (str_get_html($element)->find('img') as $i => $subElement) {
                                    if ($i == 0) {?>
                                    <img src="<?= $subElement->src;?>" class="_ico-travellers"/>
                                    <?php
                                    }
                                } ?>
                            </div>
                            <div class="kravt_group_rewards-reward-name">
                                <?php foreach (str_get_html($element)->find('.title') as $subElement) {
                                    echo $subElement->outertext();
                                }; ?>
                                <?php foreach (str_get_html($element)->find('span') as $subElement) {
                                    echo $subElement->outertext();
                                }; ?>
                            </div>
                        </div>
                        <div 
                            class="kravt_group_rewards-bg"
                            style="background-image: url(<?php foreach (str_get_html($element)->find('img') as $i => $subElement) {
                                                                                                if ($i == 1) {
                                                                                                    echo $subElement->src;
                                                                                                }
                                                                                            } ?>)">
                            <div class="kravt_group_rewards-bg-content">
                                <div>
                                    <?php 
                                        foreach (str_get_html($element)->find('.title') as $subElement) {
                                            echo $subElement->outertext();
                                        };
                                        foreach (str_get_html($element)->find('span') as $subElement) {
                                            echo $subElement->outertext();
                                        }; 
                                        foreach (str_get_html($element)->find('figure') as $key => $subElement) {
                                            if ($key == 0) {
                                                $classes = explode(' ', $subElement->getAttribute('class'));
                                            } 
                                        }; 
                                        foreach ($classes as $key => $classItem) {
                                            if ($classItem == 'invert') {
                                                foreach (str_get_html($element)->find('img') as $i => $img) {
                                                    if ($i == 0) {
                                                        $img->setAttribute('class', 'invert');
                                                        echo $img->outertext();
                                                    }
                                                }
                                            } else if ($classItem == 'colored') {
                                                foreach (str_get_html($element)->find('img') as $i => $img) {
                                                    if ($i == 0) {
                                                        echo $img->outertext();
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- slide -->
            </div>
        </div>
    </section>

    <section class="container container-spacing kravt_group_own-container">
        <div>
            <h2>
                <?php foreach ($contentBlocks[1][count($contentBlocks[1])-1]->find('p.title') as $i => $element) {
                    echo $element->plaintext;
                };?>
            </h2>
            <span>
                <?php foreach ($contentBlocks[1][count($contentBlocks[1])-1]->find('p.description') as $i => $element) {
                    echo $element->plaintext;
                }; ?>
            </span>
        </div>
        <div>
            <img src="<?php foreach ($contentBlocks[1][count($contentBlocks[1])-1]->find('img') as $element) {
                echo $element->src;
            };?>" />
        </div>
    </section>

    <section class="container container-spacing projects-container" id="projects">
        <h2>Наши проекты</h2>
        <div class="projects">
                <div class="projects__row">
                    <?php foreach (str_get_html($data[2])->find('img') as $element) {?> 
                        <div class="projects__item">
                            <?php echo $element->outertext(); ?>
                        </div>
                    <?php }?>
                </div>
        </div>
        <div class="projects-swiper swiper">
            <div class="swiper-wrapper">
                <?php foreach (str_get_html($data[2])->find('img') as $element) {?> 
                    <div class="swiper-slide">
                        <?php echo $element->outertext(); ?>
                    </div>
                <?php }?>
            </div>
        </div>
    </section>

    <section class="container container-spacing container-news" id="news">
        <h2>Новости</h2>
        <div class="kravt_group_news-container">
            <?php 
            foreach(str_get_html($data[3])->find('.wp-block-custom-news-block') as $i => $element){ ?>
                <div class="kravt_group_news-item">
                    <img class="kravt_group_news-item-preview" onclick="window.location.href = '<?php foreach($element->find('a') as $subElement){echo $subElement->href;}?>'" src="<?php foreach($element->find('img') as $subElement){echo $subElement->src;} ?>" />
                    <div>
                        <span class="kravt_group_news-item-date"><?php foreach($element->find('span') as $subElement){echo $subElement->plaintext;} ?></span>
                        <a href="<?php foreach($element->find('a') as $subElement){echo $subElement->href;}?>" class="kravt_group_news-item-heading">
                        <?php foreach($element->find('h2') as $subElement){echo $subElement->plaintext;} ?>
                        </a>
                        <a href="<?php foreach($element->find('a') as $subElement){echo $subElement->href;}?>" class="kravt_group_news-item-short"><?php foreach($element->find('p') as $subElement){echo $subElement->plaintext;} ?></a>
                        <div class="kravt_group_news-item-external">
                            <a href="<?php foreach($element->find('a') as $subElement){echo $subElement->href;}?>">Подробнее</a>
                            <div>
                                <img src="<?= get_template_directory_uri() . '/build/img/group/section-5/external.svg' ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kravt_group_news-item-splitter"></div>
            <?php } ?>
            <!-- item -->
            <div class="kravt_group_news-show-all" onclick="window.location.href = '<?php foreach(str_get_html($data[3])->find('.wp-block-custom-link a') as $element){echo $element->href;}?>'">
                <span>Все новости</span>
                <div>
                    <img src="<?= get_template_directory_uri() . '/build/img/group/section-5/external.svg' ?>" />
                </div>
            </div>
        </div>
    </section>

    <section class="kravt_group_career-container">
        <div class="container">
            <div class="kravt_group_career-title">
                <?php 
                    foreach($dom->find('.wp-block-custom-section h2') as $i => $element){echo $element;} 
                    foreach($dom->find('.wp-block-custom-section span') as $i => $element){if($i == 0){echo $element;}} 
                ?>
            </div>
            <div class="kravt_group_career-items">
                <?php foreach($dom->find('.wp-block-custom-section .wp-block-custom-slider-item-1') as $i => $element){?>
                    <div class="kravt_group_career-item">
                        <img src="<?php foreach($element->find('img') as $i => $subElement){echo $subElement->src;}  ?>" class="kravt_group_career-item-img" />
                        <?php 
                            foreach($element->find('p') as $i => $subElement){echo $subElement->outertext();}
                            foreach($element->find('span') as $i => $subElement){echo $subElement->outertext();}
                        ?>
                    </div>
                <?php } ?>
            </div>
            <div class="kravt_group_career-external" onclick="window.location.href = '<?php foreach($dom->find('.wp-block-custom-section .wp-block-custom-link a') as $element){echo $element->href;}?>'" style="cursor:pointer;">
                <span>
                    Присоединяйтесь к нашей команде лидеров и профессионалов
                    <img class="kravt_group_career-external-img-mobile" src="<?= get_template_directory_uri() . '/build/img/group/section-6/external.svg' ?>" />
                </span>
                <img class="kravt_group_career-external-img-desktop" src="<?= get_template_directory_uri() . '/build/img/group/section-6/external.svg' ?>" />
            </div>
        </div>
    </section>

    <section class="kravt_group_contacts-container custom" id="contact">
        <div class="container">
        <?php foreach ($dom->find('.wp-block-custom-section-1 h2') as $i => $element) {echo $element->outertext();}; ?>
            <div class="kravt_kazan_contacts-content">
                <?php foreach ($dom->find('.wp-block-custom-section-1 .wp-block-custom-block') as $i => $element) {
                    if ($i == 0) { ?>
                        <div class="kravt_kazan_contacts_card-white">
                            <div>
                                <?php
                                foreach (str_get_html($element)->find('p') as $subElement) {
                                    echo $subElement->outertext();
                                };
                                foreach (str_get_html($element)->find('span') as $subElement) {
                                    echo $subElement->outertext();
                                };
                                ?>
                            </div>
                            <!-- <a href="#">Проложить маршрут</a> -->
                        </div>
                    <?php }
                    if ($i == 1) { ?>
                        <div class="contacts_bg kravt_kazan_contacts_card-white" style='background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url("<?php
                                                                                                                foreach (str_get_html($element)->find('img') as $subElement) {
                                                                                                                    echo $subElement->src;
                                                                                                                }; ?>");background-repeat: no-repeat;
                                                                                                                background-size: cover;
                                                                                                                background-position: 50% 100%;'>
                            <div>
                                <?php
                                foreach (str_get_html($element)->find('p') as $subElement) {
                                    echo $subElement->outertext();
                                };?>
                                <?php foreach (str_get_html($element)->find('span') as $subElement) {
                                    echo $subElement->outertext;
                                 } ?>
                            </div>
                            <a href="<?php foreach (str_get_html($element)->find('span a') as $ls => $subElement) {if ($ls == 0){echo $subElement->href;}};?>">Позвонить</a>
                        </div>
                    <?php }
                    if ($i == 2) { ?>

                        <div class="kravt_kazan_contacts_card-white">
                            <div>
                                <?php
                                foreach (str_get_html($element)->find('p') as $subElement) {
                                    echo $subElement;
                                };
                                ?>
                                <div class="social">
                                    <img src="<?= get_template_directory_uri() . '/build/img/socials/vk_negative.svg' ?>" height="55" width="55" alt="VK" title="VK" onclick="window.open('<?= $vk?>', '_blank')"/>
                                    <img src="<?= get_template_directory_uri() . '/build/img/socials/tg_negative.svg' ?>" height="55" width="55" alt="TG" title="TG" onclick="window.open('<?= $tg?>', '_blank')"/>
                                </div>
                            </div>
                            <a>Добро пожаловать!</a>
                        </div>
                <?php }
                }; ?>
            </div>
        </div>
    </section>


    <!-- Карта отелей (9 секция) -->
    <section id="map" class="kravt_map_container _map-kazan"></section>

    <!-- sections -->
</main>
<?php get_footer(); ?>