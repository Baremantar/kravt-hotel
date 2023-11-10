<?php
/*
Template Name: Homepage Custom Hotel
*/

$dom = get_post()->post_content;
global $data;
$data = array();
$data['section'] = array();
$data['section-1'] = array();
$data['content-item-1'] = array();

// в блоках на странице указываем класс custom_group и парсим

foreach (str_get_html($dom)->find('.wp-block-custom-section') as $i => $element) {
    if ($i % 2 == 0) {
        array_push($data['section'], $element->outertext());
    }
};

foreach (str_get_html($dom)->find('.wp-block-custom-section-1') as $i => $element) {
    if ($i % 2 == 0) {
        array_push($data['section-1'], $element->outertext());
    }
};
foreach (str_get_html($dom)->find('.wp-block-custom-content-item-1') as $i => $element) {
    if ($i % 2 == 0) {
        array_push($data['content-item-1'], $element->outertext());
    }
};

global $getHeader;
$getHeader = function ($attr) {
    foreach (str_get_html($attr)->find('h2') as $element) {
        echo $element;
    };
};

global $getDescription;
$getDescription = function ($attr) {
    foreach (str_get_html($attr)->find('span') as $i => $element) {
        if ($i == 0) {
            echo $element;
        }
    };
};

$hotel_num = array();
$hotel_num['big'] = array();
$hotel_num['mini'] = array();

foreach (str_get_html($data['section'][1])->find('.wp-block-custom-big-block-hotel-number') as $i => $element) {
    if ($i % 2 == 0) {
        array_push($hotel_num['big'], $element->outertext());
    }
};

foreach (str_get_html($data['section'][1])->find('.wp-block-custom-mini-block-hotel-number') as $i => $element) {
    if ($i % 2 == 0) {
        array_push($hotel_num['mini'], $element->outertext());
    }
};

$vk = '';
// $tel = '';
$tg = ''; 

switch (explode('.', $_SERVER['HTTP_HOST'])[0]) {
    case 'kazan':
        $vk = $GLOBALS['cgv']['vk_kazan'];
        $tg = $GLOBALS['cgv']['telegram_kazan'];
        // $tel = $GLOBALS['cgv']['phone_kazan'];
        break;
    case 'nevsky':
        $vk = $GLOBALS['cgv']['vk_nevsky'];
        $tg = $GLOBALS['cgv']['telegram_nevsky'];
        // $tel = $GLOBALS['cgv']['phone_nevsky'];
        break;
    case 'albora':
        $vk = $GLOBALS['cgv']['vk_albora'];
        $tg = $GLOBALS['cgv']['telegram_albora'];
        // $tel = $GLOBALS['cgv']['phone_albora'];
        break;
    case 'sadovaya':
        $vk = $GLOBALS['cgv']['vk_sadovaya'];
        $tg = $GLOBALS['cgv']['telegram_sadovaya'];
        // $tel = $GLOBALS['cgv']['phone_sadovaya'];
        break;
}

get_header();
?>
<main>

    <?php include(get_stylesheet_directory() . '/components/modals/custom-modal.php') ?>


    <?php include(get_stylesheet_directory() . '/components/hero/thumbnails.php') ?>

    <div class="kravt_hero_container bg-kazan">

        <!-- burger background -->

        <?php include(get_stylesheet_directory() . '/components/burger/custom_burger.php'); ?>

        <!-- banner -->

        <div class="kravt_content container">
            <div class="kravt_hero_main _hero_main_kazan" style="max-width:1075px;width:100%;">
                <div class="kravt_kazan_hero_title">
                    <h1><?= get_the_title() ?></h1>
                </div>

                <div class="kravt_hero_main-row">
                    <div id="block-search">
                        <?php include(get_stylesheet_directory() . '/components/hero/tl-booking.php'); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <section class="container container-spacing">
        <div class="kravt_kazan_about_container">
            <div class="kravt_kazan_about_title">
                <h2><?php foreach (str_get_html($data['section'][0])->find('h2') as $element) {
                        echo $element->plaintext;
                    }; ?></h2>
                <?php $getDescription($data['section'][0]); ?>
                <div>
                    <a href="<?= $vk ?>" target="_blank"><img alt="VK" class="kravt_kazan_vkIcon-desktop" title="VK" src="<?= get_template_directory_uri() . '/build/img/socials/vk_negative.svg' ?>" width="55" height="55" /></a>
                    <a href="<?= $tg ?>" target="_blank"><img alt="TG" class="kravt_kazan_vkIcon-desktop" title="TG" src="<?= get_template_directory_uri() . '/build/img/socials/tg_negative.svg' ?>" width="55" height="55" /></a>
                </div>
                <button type="button" class="btn-default" style="max-width: fit-content; margin-top: 40px;" onclick="window.open('<?php foreach (str_get_html($data['section'][0])->find('.wp-block-custom-link a') as $element) {
                                                                                                                        echo $element->href;
                                                                                                                    }; ?>','_blank')">Смотреть 3D тур</button>
            </div>
            <div class="kravt_kazan_about_list">
                <?php foreach (str_get_html($data['section'][0])->find('.wp-block-custom-span') as $element) { ?>
                    <div>
                        <span class="kravt_kazan-about-splitter">—</span>
                        <?= $element->outertext(); ?>
                    </div>
                <?php }; ?>
            </div>
            <div class="kravt_kazan_vkIcon-mobile">
                <img alt="VK" title="VK" src="<?= get_template_directory_uri() . '/build/img/socials/vk_negative_dark.svg' ?>" width="32" height="32" onclick="window.open('<?= $vk?>', '_blank')"/>
            </div>
            <div class="kravt_kazan_vkIcon-mobile">
                <img alt="TG" title="TG" src="<?= get_template_directory_uri() . '/build/img/socials/tg_negative.svg' ?>" width="32" height="32" onclick="window.open('<?= $tg?>', '_blank')"/>
            </div>
        </div>
    </section>

    <section class="container container-spacing kravt_kazan_gallery">
        <?= $getHeader($data['section-1'][0]) ?>
        <!-- Рестораны и кафе (7 секция) -->
        <div class="kravt_roompage_know-title"></div>
        <div class="kravt_kazan_offers_container gallery">
            <div class="swiper mySwiperKazanResponsive">
                <div class="swiper-wrapper">
                    <?php foreach (str_get_html($data['section-1'][0])->find('img') as $element) { ?>
                        <div class="swiper-slide kravt_kazan_know_slide-item">
                            <img src="<?= $element->src ?>"/>
                            <div class="kravt_roompage_know_label">
                                <p><?= $element->getAttribute('alt') ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div id="content" class="kravt_kazan_gallery-desktop">
            <?php foreach (str_get_html($data['section-1'][0])->find('figure') as $i => $element) {
                if ($i !== 0){ ?>
                <div class="kravt_gallery_box" style='background-image: url("<?php foreach($element->find('img') as $subElement){echo $subElement->src;} ?>")' onclick='window.open("<?php foreach($element->find("figcaption a") as $subElement){echo $subElement->href;} ?>","_blank")'>
                    <p><?php foreach($element->find('figcaption') as $subElement){echo $subElement->plaintext;} ?></p>
                </div>
            <?php }} ?>
        </div>
    </section>

    <section class="container container-spacing">
        <div class="kravt_kazan_rooms_title">
            <?php $getHeader($data['section'][1]);
            $getDescription($data['section'][1])
            ?>

            <button class="kravt_button-border kravt_kazan_rooms-button" onclick="window.location.href = '<?php foreach(str_get_html($data['section'][1])->find('.wp-block-custom-link a') as $element){echo $element->href;}?>'">
                Показать все номера
            </button>
        </div>
        <div class="kravt_kazan_rooms-container">
            <div class="kravt_kazan_rooms-row">
                <?php
                    $room_link = null;
                    foreach (str_get_html($hotel_num['big'][0])->find('a') as $i => $element) {
                        $room_link = $element->href;
                    }
                ?>
                <div class="kravt_square kravt_kazan_rooms-item-wrapper-left" style="background-image: url('<?php foreach (str_get_html($hotel_num['big'][0])->find('img') as $i => $element) {
                                                                                                                echo $element->src;
                                                                                                            } ?>')" onclick="window.location.href = '<?php foreach (str_get_html($hotel_num['big'][0])->find('a') as $i => $element) {
                                                                                                                echo $element->href;
                                                                                                            } ?>'">
                    <?php foreach (str_get_html($hotel_num['big'][0])->find('p') as $i => $element) {
                        if ($i == 0) {
                            $element->setAttribute('class', 'badge');
                            echo $element->outertext();
                        }
                    } ?>
                    <div class="hovered" onclick="window.location.href = '<?php foreach (str_get_html($hotel_num['big'][0])->find('a') as $i => $element) {
                                            echo $element->href;
                                        } ?>'">
                        <div class="kravt_kazan_rooms-item">
                            <?php if($room_link): ?>
                            <a href="<?= $room_link ?>">
                                <img width="32" height="32" src="<?= get_template_directory_uri() . '/build/img/icons/openicon.svg' ?>" class="open_icon" />
                            </a>
                            <?php endif; ?>
                        </div>
                        <div class="kravt_kazan_rooms-about">
                            <?php foreach (str_get_html($hotel_num['big'][0])->find('p') as $i => $element) {
                                if ($i == 1) {
                                    echo $element->outertext();
                                }
                            } ?>
                        </div>
                    </div>

                    <?php if($room_link): ?>
                    <a href="<?= $room_link ?>" class="kravt_kazan_rooms_link"></a>
                    <?php endif; ?>
                </div>

                <?php
                    $room_link = null;
                    foreach (str_get_html($hotel_num['big'][1])->find('a') as $i => $element) {
                        $room_link = $element->href;
                    }
                ?>
                <div class="kravt_square kravt_kazan_rooms-item-wrapper-right" style="background-image: url('<?php foreach (str_get_html($hotel_num['big'][1])->find('img') as $i => $element) {
                                                                                                                    echo $element->src;
                                                                                                                } ?>')" onclick="window.location.href = '<?php foreach (str_get_html($hotel_num['big'][1])->find('a') as $i => $element) {
                                                                                                                    echo $element->href;
                                                                                                                } ?>'">
                    <?php foreach (str_get_html($hotel_num['big'][1])->find('p') as $i => $element) {
                        if ($i == 0) {
                            $element->setAttribute('class', 'badge');
                            echo $element->outertext();
                        }
                    } ?>
                    <div class="hovered" onclick="window.location.href = '<?php foreach (str_get_html($hotel_num['big'][0])->find('a') as $i => $element) {
                                            echo $element->href;
                                        } ?>'">
                        <div class="kravt_kazan_rooms-item">
                            <?php if($room_link): ?>
                            <a href="<?= $room_link ?>">
                                <img width="32" height="32" src="<?= get_template_directory_uri() . '/build/img/icons/openicon.svg' ?>" class="open_icon" />
                            </a>
                            <?php endif; ?>
                        </div>
                        <div class="kravt_kazan_rooms-about">
                            <?php foreach (str_get_html($hotel_num['big'][1])->find('p') as $i => $element) {
                                if ($i == 1) {
                                    echo $element->outertext();
                                }
                            } ?>
                        </div>
                    </div>

                    <?php if($room_link): ?>
                    <a href="<?= $room_link ?>" class="kravt_kazan_rooms_link"></a>
                    <?php endif; ?>
                </div>
            </div>

            <?php
                $room_link = null;
                foreach (str_get_html($hotel_num['big'][2])->find('a') as $i => $element) {
                    $room_link = $element->href;
                }
            ?>            
            <div class="kravt_kazan_rooms-row">
                <div class="kravt_square kravt_kazan_rooms-item-wrapper-left" style="background-image: url('<?php foreach (str_get_html($hotel_num['big'][2])->find('img') as $i => $element) {
                                                                                                                echo $element->src;
                                                                                                            } ?>')" onclick="window.location.href = '<?php foreach (str_get_html($hotel_num['big'][2])->find('a') as $i => $element) {
                                                                                                                echo $element->href;
                                                                                                            } ?>'">
                    <?php foreach (str_get_html($hotel_num['big'][2])->find('p') as $i => $element) {
                        if ($i == 0) {
                            $element->setAttribute('class', 'badge');
                            echo $element->outertext();
                        }
                    } ?>
                    <div class="hovered" onclick="window.location.href = '<?php foreach (str_get_html($hotel_num['big'][2])->find('a') as $i => $element) {
                                            echo $element->href;
                                        } ?>'">
                        <div class="kravt_kazan_rooms-item">
                            <?php if($room_link): ?>
                            <a href="<?= $room_link ?>">
                                <img width="32" height="32" src="<?= get_template_directory_uri() . '/build/img/icons/openicon.svg' ?>" class="open_icon" />
                            </a>
                            <?php endif; ?>
                        </div>
                        <div class="kravt_kazan_rooms-about">
                            <?php foreach (str_get_html($hotel_num['big'][2])->find('p') as $i => $element) {
                                if ($i == 1) {
                                    echo $element->outertext();
                                }
                            } ?>
                        </div>
                    </div>

                    <?php if($room_link): ?>
                    <a href="<?= $room_link ?>" class="kravt_kazan_rooms_link"></a>
                    <?php endif; ?>
                </div>

                <!-- item -->
                <div class="kravt_square kravt_kazan_rooms-item-wrapper-left item-mobile" style="background-image: url('<?php foreach (str_get_html($hotel_num['big'][3])->find('img') as $i => $element) {
                                                                                                                            echo $element->src;
                                                                                                                        } ?>')" onclick="window.location.href = '<?php foreach (str_get_html($hotel_num['big'][3])->find('a') as $i => $element) {
                                                                                                                            echo $element->href;
                                                                                                                        } ?>'">
                    <?php foreach (str_get_html($hotel_num['big'][3])->find('p') as $i => $element) {
                        if ($i == 0) {
                            $element->setAttribute('class', 'badge');
                            echo $element->outertext();
                        }
                    } ?>
                    <div class="hovered">
                        <div class="kravt_kazan_rooms-item">
                            <a href="<?php foreach (str_get_html($hotel_num['big'][3])->find('a') as $i => $element) {
                                            echo $element->href;
                                        } ?>">
                                <img width="32" height="32" src="<?= get_template_directory_uri() . '/build/img/icons/openicon.svg' ?>" class="open_icon" />
                            </a>
                        </div>
                        <div class="kravt_kazan_rooms-about">
                            <?php foreach (str_get_html($hotel_num['big'][3])->find('p') as $i => $element) {
                                if ($i == 1) {
                                    echo $element->outertext();
                                }
                            } ?>
                        </div>
                    </div>
                </div>
                <!-- item -->

                <div class="kravt_square kravt_kazan_rooms-item-wrapper-right item-desktop">
                    <div class="content-mini">
                        <style>
                            <?php $bg=array();
                                for ($i=0; $i < count($hotel_num['mini']); $i++) {
                                    foreach (str_get_html($hotel_num['mini'][$i])->find('img') as $element) {
                                        array_push($bg, $element->src);
                                    };
                                };
                                foreach($bg as $i=> $element) {
                                    $b=$i;
                                    echo '.content-mini-item-'.$b.'{background-image: url("'. $bg[$i] . '");}';
                                };
                                if (explode('.', $_SERVER['HTTP_HOST'])[0] == 'albora') {
                                   echo '.content-mini-item-0, .content-mini-item-1, .content-mini-item-2, .content-mini-item-3 {width: 50%;}';
                                };
                            ?>
                            
                        </style>
                        <div class="content-mini-row">
                            <?php for($a = 0; $a < count($hotel_num['mini']); $a++){?>
                            <div class="content-mini-item-<?= $a?>">
                                <?php foreach (str_get_html($hotel_num['mini'][$a])->find('p') as $i => $element) {
                                        if ($i == 0) {
                                            $element->setAttribute('class', 'kravt_kazan_rooms_mini-badge');
                                            echo $element->outertext();
                                        };
                                      }; 
                                ?>
                                <!-- mask -->
                                <div class="content-mini-item-mask">
                                    <div class="content-mini-item-mask-top">
                                        <?php foreach (str_get_html($hotel_num['mini'][$a])->find('p') as $i => $element) {
                                                if ($i == 1) {
                                                    $element->setAttribute('class', 'content-mini-item-mask-top');
                                                    echo $element->outertext();
                                                };
                                              }; 
                                        ?>
                                        <div style="display: flex; flex-direction: column">
                                            <span>Выберите подходящий</span>
                                            <div>
                                                <span>именно вам</span>
                                                <div>
                                                    <img width="10" height="14"
                                                        src="<?= get_template_directory_uri() . '/build/img/icons/arrow_down.svg'; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="kravt_button-border button-content-content"
                                        onclick="window.location = `${window.location.origin}` + '/rooms'">
                                        Посмотреть все
                                    </button>
                                </div>
                            </div>
                        
                        <?php };?>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="kravt_kazan_rooms-mobile-div">
            <?php foreach (str_get_html($data['section'][1])->find('.wp-block-group p') as $i => $element) {
                    echo $element->outertext();
            } ?>
            <div style="display: flex; flex-direction: column">
                <span>Выберите подходящий</span>
                <div>
                    <span>именно вам</span>
                    <div>
                        <img width="10" height="14" src="<?= get_template_directory_uri() . '/build/img/icons/arrow_down.svg'; ?>" />
                    </div>
                </div>
            </div>
            <button type="button" class="kravt_button-border button-content-content" onclick="window.location.href = window.location.origin + '/rooms/'">
                Посмотреть все
            </button>
        </div>
    </section>

    <section class="container container-spacing kravt_kazan_service">
    <?php 
            $serviceItems = array();
            foreach (str_get_html($data['section'][2])->find('.wp-block-custom-slider-item') as $i => $element) {
                array_push($serviceItems, $element);
            }; ?>

        <div class="kravt_kazan_service-title">
            <div class="info">
            <?php $getHeader($data['section'][2]);
            $getDescription($data['section'][2]) ?>
            </div>
            <?php if(count($serviceItems) > 3) {?>
            <div class="navigation-arrows">
                <div class="services-nav-prev-button"></div>
                <div class="services-nav-next-button"></div>
            </div>
            <?php } ?>
        </div>
        <?php if(get_site()->blog_id != 5){?>
        <button type="button" class="kravt_button-border kravt_kazan_service-button" onclick="window.location.href = '<?php foreach(str_get_html($data['section'][2])->find('.wp-block-custom-link a') as $element){echo $element->href;}?>'">
            Показать все
        </button>
        <?php } ?>

        <div class="kravt_kazan_service_content">
            <?php if(count($serviceItems) <= 3) {
                foreach ($serviceItems as $i => $element){ 
                    foreach ($element->find('img') as $subElement) {$src = $subElement->src;}; ?>
                    <a class="kravt_square kravt_kazan_service_item" href = '<?php foreach ($element->find('a') as $subElement) {echo $subElement->href;} ?>' target="_blank">
                        <div style="overflow: hidden; width: 100%; position: relative;">
                            <?php echo '<style>
                                #kazan-service-' . ++$i . '::before {
                                    background-image: url(' . $src . ');
                                }
                            </style>' ?>
                            <div id="kazan-service-<?= $i ?>" class="dg-service">
                            </div>
                        </div>
                        <p class="has-text-align-left"><?php foreach ($element->find('span') as $subElement) { echo $subElement->plaintext; }?></p>
                    </a>
                <?php }
            } else { ?>
            <div class="kravt_kazan_services_container">
                <div class="swiper mySwiperServices">
                    <div class="swiper-wrapper">
                        <?php foreach ($serviceItems as $i => $element) {?>
                            <div class="swiper-slide kravt_services-slide">
                                <a 
                                    href = '<?php foreach ($element->find('a') as $subElement) {echo $subElement->href;} ?> 'target="_blank" 
                                    class="kravt_services-slide"
                                >
                                    <img src="<?php foreach ($element->find('img') as $subElement) {echo $subElement->src;} ?>" alt="service">
                                </a>
                            <span>
                                <?php foreach ($element->find('span') as $subElement) { echo $subElement->plaintext;}?> 
                            </span>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        </div>
        <!-- service -->
        <div class="kravt_kazan_service-mobile">
            <div class="kravt_kazan_offers_container">
                <div class="swiper mySwiperRoompageOthers kazan-service-swiper custom">
                    <div class="kravt_swiper_side-hider _hider-others"></div>
                    <div class="swiper-wrapper">
                        <?php foreach (str_get_html($data['section'][2])->find('.wp-block-custom-slider-item') as $i => $element) {
                        ?>
                            <div class="swiper-slide kravt_roompage_others-slide">
                                <a style="background-image: url('<?php foreach ($element->find('img') as $subElement) {
                                                                        echo $subElement->src;
                                                                    } ?>')" href="<?php foreach ($element->find('a') as $subElement) {
                                                                                                                    echo $subElement->href;
                                                                                                                } ?>" class="kravt_roompage_others-slide-bg">
                                    <span class="fas">
                                        <?php
                                        foreach ($element->find('span') as $subElement) {
                                            echo $subElement->plaintext;
                                        }
                                        ?> </span>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- service -->
    </section>

    <!-- Рестораны и кафе (7 секция) -->
    <section class="kravt_kazan_events_spacing">
        <div class="container">
            <div class="kravt_kazan_events-title">
                <!-- row с титлом и навигацией -->
                <div>
                    <div>
                        <?php $getHeader($data['section-1'][1]); ?>
                    </div>
                    <div class="navigation-arrows">
                        <div class="kazanEvents-nav-prev-button"></div>
                        <div class="kazanEvents-nav-next-button"></div>
                    </div>
                </div>
                <!-- кнопка  -->
                <?php if(get_site()->blog_id != 5){?>
                <button type="button" class="kravt_button-border kravt_kazan_events-button" onclick="window.location = '<?php foreach(str_get_html($data['section-1'][1])->find('.wp-block-custom-link a') as $element){echo $element->href;}?>'">
                    Показать все
                </button>
                <?php } ?>

            </div>
            <div class="kravt_kazan_offers_container">
                <div class="swiper mySwiperKazanEvents">
                    <div class="swiper-wrapper">
                        <?php foreach (str_get_html($data['section-1'][1])->find('.wp-block-custom-slider-item') as $i => $element) {?>
                            <a class="swiper-slide kravt_kazan_events_slide-item" href='<?php foreach ($element->find('a') as $subElement) {echo $subElement->href;} ?>' target="_blank">
                                <div class="kravt_animation-wrapper">
                                    <img src="<?php foreach ($element->find('img') as $subElement) {echo $subElement->src;} ?>"/>
                                </div>
                                <p><?php foreach ($element->find('span') as $subElement) {echo  $subElement->plaintext;} ?></p>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php if(get_site()->blog_id != 5){?>
        <section class="container container-spacing kravt_kazan_wellness">
            <div class="kravt_kazan_wellness-title">
            <h2><?php
                foreach (str_get_html($data['section'][3])->find('h2') as $element) {
                    echo $element->plaintext;
                }
                ?></h2>
            <?php $getDescription($data['section'][3]); ?>
            <button 
                type="button" 
                class="kravt_button-border kravt_kazan_wellness-button" 
                onclick="window.location.href = '<?php 
                    foreach(str_get_html($data['section'][3])->find('.wp-block-custom-link a') as $element){
                        echo $element->href;
                    }
                ?>'">
                Подробнее
            </button>
            </div>
            <div style="overflow: hidden; width: 100%; position: relative">
            <div 
                class="kravt_square kravt_kazan_wellness-image" 
                style="background-image: url('<?php
                    foreach (str_get_html($data['section'][3])->find('img') as $element) {
                        echo $element->src;
                    }
                ?>')" 
                id="kazan-wellness-1" 
                onclick="window.location.href = '<?php 
                    foreach(str_get_html($data['section'][3])->find('.wp-block-custom-link a') as $element){
                        echo $element->href;
                    }?>'">
            </div>
            </div>

            <button type="button" class="kravt_button-border button-wellness"onclick="window.location.href = '<?php 
                    foreach(str_get_html($data['section'][3])->find('.wp-block-custom-link a') as $element){
                        echo $element->href;
                    }
                ?>'">Подробнее</button>
        </section>
    <?php } ?>

    <section class="container container-spacing kravt_kazan_restaraunts">
        <!-- column для кнопки и строки с титлом -->
        <div class="kravt_kazan_restaraunts-title">
            <!-- row с титлом и навигацией -->
            <div>
                <?php $getHeader($data['section-1'][2]); ?>
                <div class="navigation-arrows">
                    <div class="swiper-nav-prev-button"></div>
                    <div class="swiper-nav-next-button"></div>
                </div>
            </div>
            <!-- кнопка  -->
            <button type="button" class="kravt_button-border kravt_kazan_restaraunts-button" onclick="window.location.href = '<?php foreach(str_get_html($data['section-1'][2])->find('.wp-block-custom-link a') as $element){ echo $element->href;}?>'">
                Подробнее
            </button>
        </div>

        <div class="swiper mySwiperRestarauntsKazan kazan-swiper-restaraunts">
            <div class="swiper-wrapper">
                <?php
                foreach (str_get_html($data['section-1'][2])->find('.wp-block-custom-slider-item-1') as $element) { ?>
                    <div
                        onclick=" window.location.href = '<?php foreach(str_get_html($data['section-1'][2])->find('.wp-block-custom-link a') as $lnk){ echo $lnk->href;}?>'"
                        class="swiper-slide kravt_kazan_restaraunt_slide" 
                        style="background-image: url('<?php foreach ($element->find('img') as $subElement) {
                                                                                                                echo $subElement->src;
                                                                                                            } ?>')">
                        <div class="kravt_kazan_restaraunt_about-container">
                            <div class="kravt_kazan_restaraunt_about-content">
                                <!-- title -->
                                <div class="kravt_kazan_restaraunt-item_title">
                                    <p>Ресторан</p>
                                    <h2><?php foreach ($element->find('p') as $subElement) {
                                            echo $subElement->plaintext;
                                        } ?>
                                    </h2>
                                </div>
                                <!-- menu -->
                                <div class="kravt_kazan_restaraunt-item_menu">
                                    <div>
                                        <a href="<?php foreach ($element->find('a') as $i => $subElement) {
                                        if ($i == 0) {
                                            echo $subElement->href;
                                        }
                                    } ?>" target="_blank">Посмотреть меню</a>
                                        <img src="<?= get_template_directory_uri() . '/build/img/icons/openicon_sm.svg' ?>" width="16" height="16" />
                                    </div>
                                    <?php foreach ($element->find('a') as $i => $subElement) {
                                        if ($i != 0) {
                                            echo $subElement->outertext();
                                        }
                                    } ?>
                                </div>
                                <!-- button -->
                                <button type="button" class="kravt_button-border _booking-link">Забронировать стол</button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- Рестораны и кафе (7 секция) -->
    <section class="container container-spacing">
        <div class="kravt_kazan_offers-title">
            <div>
                <?php $getHeader($data['section-1'][3]); ?>
                <div class="navigation-arrows">
                    <div class="swiper-offer-nav-prev-button"></div>
                    <div class="swiper-offer-nav-next-button"></div>
                </div>
            </div>
            <button type="button" class="kravt_button-border kravt_kazan_offers-button" onclick="window.location.href = '<?php foreach(str_get_html($data['section-1'][3])->find('.wp-block-custom-link a') as $element){echo $element->href;}?>'">
                Посмотреть все
            </button>
        </div>
        <div class="kravt_kazan_offers_container">
            <div class="swiper mySwiperKazanOffers kazan-swiper-advantage">
                <div class="kravt_swiper_side-hider _hider-offers"></div>
                <div class="swiper-wrapper">
                    <?php foreach (str_get_html($data['section-1'][3])->find('.wp-block-custom-slider-item-1') as $element) { ?>
                        <a class="swiper-slide kravt_kazan_restaraunt_slide-item offers" href = '<?php foreach ($element->find('a') as $subElement) {echo $subElement->href;} ?>'>
                            <div class="kravt_animation-wrapper">
                                <img src="<?php foreach ($element->find('img') as $subElement) {
                                                echo $subElement->src;
                                            } ?>" width="660px" height="660px"/>
                            </div>
                            <div class="kravt_kazan_restaraunts_label">
                                <?php foreach ($element->find('p') as $subElement) {
                                    echo strip_tags($subElement->outertext(), '<p>');
                                } ?>
                                <?php foreach ($element->find('span') as $subElement) {
                                    echo $subElement->outertext();
                                } ?>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <div class="kravt_kazan_advantage-wrapper">
        <section class="container container-spacing">
            <div class="kravt_kazan_advantage-title">
                <h2><?php
                    foreach (str_get_html($data['content-item-1'][0])->find('p') as $i => $subElement) {
                        if ($i == 0) {
                            echo $subElement->plaintext;
                        }
                    };
                    ?></h2>
            </div>
            <div class="kravt_kazan_advantage_items">
                <div class="kravt_advantage_box-container">
                    <?php foreach (str_get_html($data['content-item-1'][0])->find('.wp-block-custom-slider-item-1') as $i => $element) {
                        if ($i <= 2) {
                    ?>
                            <div class="kravt_kazan_advantage_box">
                                <img src="<?php foreach ($element->find('img') as $subElement) {
                                                echo $subElement->src;
                                            } ?>" height="520px" width="520px"/>
                                <?php foreach ($element->find('p') as $subElement) {
                                    echo $subElement->outertext();
                                };
                                foreach ($element->find('span') as $subElement) {
                                    echo $subElement->outertext();
                                } ?>
                            </div>
                    <?php }
                    } ?>
                </div>
                <div class="kravt_advantage_box-container" style="margin-bottom: 0">
                    <?php foreach (str_get_html($data['content-item-1'][0])->find('.wp-block-custom-slider-item-1') as $i => $element) {
                        if ($i > 2) { ?>
                            <div class="kravt_kazan_advantage_box">
                                <img src="<?php foreach ($element->find('img') as $subElement) {
                                                echo $subElement->src;
                                            } ?>" height="520px" width="520px"/>
                                <?php foreach ($element->find('p') as $subElement) {
                                    echo $subElement->outertext();
                                };
                                foreach ($element->find('span') as $subElement) {
                                    echo $subElement->outertext();
                                } ?>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
        </section>
    </div>

    <div class="kravt_kazan_faq_wrapper">
        <section class="container container-spacing kravt_kazan_faq">
            <?php $getHeader($data['section-1'][4]) ?>
            <div class="kravt_kazan_faq_content">
                <div class="kravt_kazan_faq_accordion-container">
                    <?php foreach (str_get_html($data['section-1'][4])->find('.wp-block-custom-content-span-p') as $element) { ?>
                        <button type="button" class="kravt_kazan_faq_accordion">
                            <?php foreach ($element->find('span') as $i => $subElement) {
                                echo strip_tags($subElement->plaintext);
                            } ?> <span class="kravt_kazan_faq_accordion-toggles"></span>
                        </button>
                        <div class="faq_accordion_panel">
                            <?php foreach ($element->find('p') as $i => $subElement) {
                                echo $subElement->outertext();
                            } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="kravt_kazan_faq_links pad-left">
                    <?php foreach(str_get_html($data['section-1'][4])->find('.wp-block-custom-link a') as $i => $element){?>
                        <div class="kravt_roompage_faq-link">
                            <a href="<?php echo $element->href; ?>">
                                <?php echo $element->plaintext; ?>
                                <img src="<?= get_template_directory_uri() . '/build/img/icons/external.svg' ?>" style="display: inline; vertical-align: middle" />
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    </div>

    <div class="kravt_kazan_near-wrapper">
        <div class="kravt_kazan_near-container">
            <div class="kravt_kazan_near-content">
                <div class="kravt_kazan_near-label">
                    <div><img src="<?= get_template_directory_uri() . '/build/img/map-near/mob_logo.svg' ?>" /></div>
                    <p><?php
                        foreach (str_get_html($data['section-1'][5])->find('h2') as $element) {
                            echo $element->plaintext;
                        }
                        ?></p>
                </div>
                <!-- marker splitter -->
                <?php foreach (str_get_html($data['section-1'][5])->find('.wp-block-custom-beside-block') as $element) { ?>
                    <div class="kravt_kazan_near-marker">
                        <img src="<?php foreach ($element->find('img') as $subElement) {
                                        echo $subElement->src;
                                    } ?>" />
                        <?php foreach ($element->find('p') as $subElement) {
                            echo $subElement->outertext();
                        } ?>
                        <div>
                            <?php foreach ($element->find('span') as $subElement) {
                                echo $subElement->outertext();
                            } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <section class="kravt_kazan_contacts-container" id="contact">
        <div class="container">
            <?php $getHeader($data['section-1'][6]) ?>
            <div class="kravt_kazan_contacts-content">
                <?php foreach (str_get_html($data['section-1'][6])->find('.wp-block-custom-block') as $i => $element) {
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
                                <span>
                                    <a href="tel:<?php foreach (str_get_html($element)->find('span') as $subElement) {
                                    echo $subElement->plaintext;
                                };?>"><?php foreach (str_get_html($element)->find('span') as $subElement) {
                                    echo $subElement->plaintext;
                                };?></a>
                                </span>
                            </div>
                            <a href="<?php foreach (str_get_html($element)->find('span a') as $subElement) {echo str_replace(' ','', $subElement->href);};?>">Позвонить</a>
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
                            <a >Добро пожаловать!</a>
                        </div>
                <?php }
                }; ?>
            </div>
        </div>
    </section>

    <!-- Карта отелей (9 секция) -->
    <section id="map" class="kravt_map_container _map-kazan"></section>

</main>
<?php
get_footer();
?>