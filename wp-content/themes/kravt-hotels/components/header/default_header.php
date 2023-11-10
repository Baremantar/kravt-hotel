<?php 
global $dataSites;
$dataSites = array();
$dataSites['domains'] = array();
$dataSites['names'] = array();
$dataSites['id'] = array();
$dataSites['description'] = array();


foreach(get_sites() as $element){
    array_push($dataSites['description'], get_blog_option($element->blog_id, 'blogdescription' ));
    array_push($dataSites['domains'], get_blog_details( array( 'blog_id' => $element->blog_id ) )->home);
    array_push($dataSites['names'], get_blog_details( array( 'blog_id' => $element->blog_id ) )->blogname);
    array_push($dataSites['id'], get_blog_details( array( 'blog_id' => $element->blog_id ) )->blog_id);  
};  

array_splice($dataSites['description'], 0, 1);
array_splice($dataSites['domains'], 0, 1);
array_splice($dataSites['names'], 0, 1); 
array_splice($dataSites['id'], 0, 1); 

$whitePages = ['team', 'press-center', 'press-center-item', 'career', 'vacancy'];

foreach($whitePages as $element) {
    $templates = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'views/'.$element.'.php'
    ));

    foreach($templates as $value) {
        if (get_the_ID() == $value->ID) {
            $value = 'body-white fullHeight';
        } else { 
            $value = '_body-main'; 
        }
    }
    if(get_page_template_slug() == 'views/press-center-item.php' ||
       get_page_template_slug() == '' ||
       get_page_template_slug() == 'views/event-item.php' ||
       get_page_template_slug() == 'views/offer-item.php' ||
       get_page_template_slug() == 'views/service-item.php' ||
       get_page_template_slug() == 'views/services.php' ||
       get_page_template_slug() == 'views/press-center.php' ||
       get_page_template_slug() == 'views/team.php' ||
       get_page_template_slug() == 'views/sitemap.php' ||
       get_page_template_slug() == 'views/events-main.php' ||
       get_page_template_slug() == 'views/vacancy.php') {
        $value = 'body-white fullHeight';
    }
}

if (get_page_template_slug() == 'views/homepage.php' ||
    get_page_template_slug() == 'views/promotion.php' ||
    get_page_template_slug() == 'views/events-main.php' ||
    get_page_template_slug() == 'views/event-item.php' ||
    get_page_template_slug() == 'views/offer-item.php'
) {
?>
    <body class="<?= $value ?>" id="scrollbar-init" style="overflow-x: hidden;">
        <header class="kravt_header" id="kravt_header">
            <nav class="kravt_content kravt_navbar container" id="header">
                <div class="navbar_scrolled_mask" id="scrolled_mask"></div>
                <div class="kravt-logo main" onclick="window.location.href = window.location.origin" >
                    <?= file_get_contents(get_template_directory_uri() . '/build/img/logos/KH.svg') ?>
                </div>
                <div class="kravt_dropdown" id="header_picker">
                    <div class="kravt_dropdown_label kravt_dropdown_hotel-button">
                        <div class="kravt_dropdown_label-hotels">
                            Отели
                            <div>
                                <img src="<?= get_template_directory_uri() . '/build/img/icons/arrow_down_white.svg' ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="kravt_dropdown_content kravt_dropdown-hotels rounded">
                        <?php for($i=0; $i< count($dataSites['domains']); $i++){ ?>
                            <a href="<?= $dataSites['domains'][$i]?>" class="kravt_dropdown_link">
                                <p><?= $dataSites['names'][$i]?></p>
                                <span>г. <?= $dataSites['description'][$i]?></span>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="kravt_navigation" id="navigation_links">
                    <?php foreach (str_get_html(wp_nav_menu(['menu' => 'Menu in header (Шапка главная)', 'echo' => false,]))->find('a') as $element) {
                            echo $element->outertext;
                        } ?>
                </div>
                <a href="tel:<?= str_replace(' ', '', $GLOBALS['cgv']['phone_default']) ?>" id="phone_button" class="kravt_hero_phone-button">
                    <?= $GLOBALS['cgv']['phone_default']; ?>
                </a>
                <div class="kravt_social_wrapper _wrapper-social-desktop">
                    <img src="<?= get_template_directory_uri() . '/build/img/socials/tg.svg' ?>" alt="TG" title="Telegram" onclick="window.open('<?= $GLOBALS['cgv']['telegram_default']?>','_blank')"/>
                    <img src="<?= get_template_directory_uri() . '/build/img/socials/vk.svg' ?>" alt="VK" title="VKontakte" onclick="window.open('<?= $GLOBALS['cgv']['vk_default']?>','_blank')"/>
                </div>

                <a href="/lk" id="lk_button" class="kravt_hero_phone-button">
                    Личный кабинет
                </a>

                <!-- <div class="kravt_locale">
                    <a href="#" class="kravt_link">RU</a> <span class="kravt_link">/</span>
                    <a href="#" class="kravt_link">ENG</a>
                </div> -->
                <div class="kravt_hero_icons-group">
                    <img class="kravt_hero_burger" src="<?= get_template_directory_uri() . '/build/img/icons/burger.svg' ?>" alt="Menu" title="Menu" id="burger_icon" onclick="checkState()" />
                </div>
            </nav>
            <nav class="kravt_content kravt_navbar container" id="header_burger">
                <div id="navbar_darked" class="navbar_darked"></div>
                <div class="kravt-logo main">
                    <?= file_get_contents(get_template_directory_uri() . '/build/img/logos/KH.svg') ?>
                </div>
                <div class="kravt_social_wrapper _wrapper-social-mobile">
                    <img src="<?= get_template_directory_uri() . '/build/img/socials/tg.svg' ?>" alt="TG" title="Telegram" onclick="window.open('<?= $GLOBALS['cgv']['telegram_default']?>','_blank')"/>
                    <img src="<?= get_template_directory_uri() . '/build/img/socials/vk.svg' ?>" alt="VK" title="VKontakte" onclick="window.open('<?= $GLOBALS['cgv']['vk_default']?>','_blank')"/>
                </div>
                <div class="kravt_burger_header">
                    <a href="tel:<?= str_replace(' ', '', $GLOBALS['cgv']['phone_default']) ?>" id="phone_button" class="kravt_hero_phone-button">
                        <?= $GLOBALS['cgv']['phone_default']; ?>
                    </a>
                    <div class="kravt_social_wrapper _wrapper-social-desktop">
                        <img src="<?= get_template_directory_uri() . '/build/img/socials/tg.svg' ?>" alt="TG" title="Telegram" onclick="window.open('<?= $GLOBALS['cgv']['telegram_default']?>','_blank')"/>
                        <img src="<?= get_template_directory_uri() . '/build/img/socials/vk.svg' ?>" alt="VK" title="VKontakte" onclick="window.open('<?= $GLOBALS['cgv']['vk_default']?>','_blank')"/>
                    </div>
                    <!-- <div class="kravt_locale">
                        <a href="#" class="kravt_link">RU</a> <span class="kravt_link">/</span>
                        <a href="#" class="kravt_link">ENG</a>
                    </div> -->
                    <div class="kravt_hero_icons-group">
                        <img class="kravt_hero_burger" src="<?= get_template_directory_uri() . '/build/img/icons/close_icon.svg' ?>" alt="Menu" title="Menu" id="burger_icon" onclick="checkState()" />
                    </div>
                </div>
                <?php if ($_SERVER['REQUEST_URI'] != '/') {?>
                    <div id="tl-search-form" class="tl-container" style="display:none">
                        <noindex>
                            <a href="http://www.travelline.ru/products/tl-hotel/" rel='nofollow' target="_blank">TravelLine</a>
                        </noindex>
                    </div>
                <?php } ?>
            </nav>
        </header>
<?php } else {?>
    <body class="<?php echo $value; if(is_404()){ echo ' error_page';}?>" id="scrollbar-init" style="overflow-x: hidden;">
        <header class="kravt_header header_main" id="kravt_header" <?php if(get_page_template_slug() == 'views/press-center-item.php' || get_page_template_slug() == 'views/vacancy.php' || get_page_template_slug() == '' || get_page_template_slug() == 'views/sitemap.php') {echo "data-negative='1'";} ?>>
            <nav class="kravt_content kravt_navbar container" id="header">
                <div class="navbar_scrolled_mask" id="scrolled_mask"></div>
                <div class="kravt-logo main" onclick="window.location.href = window.location.origin" >
                    <?= file_get_contents(get_template_directory_uri() . '/build/img/logos/KH.svg') ?>
                </div>
                <div class="kravt_navigation default-custom" id="navigation_links">
                    <div class="kravt_dropdown" id="header_picker">
                        <div class="kravt_dropdown_label kravt_dropdown_hotel-button">
                            <div class="kravt_dropdown_label-hotels">
                                Отели
                                <div>
                                    <img src="<?= get_template_directory_uri() . '/build/img/icons/arrow_down_white.svg' ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="kravt_dropdown_content kravt_dropdown-hotels rounded">
                            <?php for($i=0; $i< count($dataSites['domains']); $i++){ ?>
                                <a href="<?= $dataSites['domains'][$i]?>" class="kravt_dropdown_link">
                                    <p><?= $dataSites['names'][$i]?></p>
                                    <span>г. <?= $dataSites['description'][$i]?></span>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                    <?php 
                    foreach ($menu[4] as $key => $value) {
                        if (str_get_html($value)->plaintext == 'Пресс-центр') {?>
                            <div class="kravt_dropdown" id="header_picker">
                                <div class="kravt_dropdown_label kravt_dropdown_group-button press-center">
                                    <div class="kravt_dropdown_label-hotels">
                                        Пресс-центр
                                        <div>
                                            <img
                                                src="<?= get_template_directory_uri() . '/build/img/icons/arrow_down_white.svg' ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="kravt_dropdown_content kravt_dropdown-hotels rounded">
                                    <?php
                                        $pressCenterItems = get_pages(array(
                                            'meta_key' => '_wp_page_template',
                                            'meta_value' => 'views/press-center.php'
                                        ));

                                        $i = 0;
                                        foreach (str_get_html($pressCenterItems[0]->post_content)->find('.press-wrapper') as $key => $value) {
                                            if ($key % 2 == 0) {    
                                                foreach ($value->find('h2') as $subKey => $subValue) {
                                                    if ($subKey == 0) { ?>
                                                        <a href="<?= get_permalink($pressCenterItems[0]).'?tab='.$i++?>" class="kravt_dropdown_link">
                                                            <p><?= $subValue->plaintext; ?></p>
                                                        </a>
                                                    <?php }
                                                }
                                            }
                                        }    
                                    ?>
                                </div>
                            </div>
                        <?php } else {
                            echo $value->outertext;
                        } 
                    }
                    // } ?>
                </div>
                <a id="phone_button" class="kravt_hero_phone-button default">
                    Забронировать
                </a>
                <!-- <div class="kravt_locale">
                    <a href="#" class="kravt_link">RU</a> <span class="kravt_link">/</span>
                    <a href="#" class="kravt_link">ENG</a>
                </div> -->
                <div class="kravt_hero_icons-group">
                    <img class="kravt_hero_burger" src="<?= get_template_directory_uri() . '/build/img/icons/burger.svg' ?>" alt="Menu" title="Menu" id="burger_icon" onclick="checkState()" />
                </div>
            </nav>
            <nav class="kravt_content kravt_navbar container" id="header_burger">
                <!-- <div class="navbar_scrolled_mask" id="scrolled_mask"></div> -->
                <div id="navbar_darked" class="navbar_darked"></div>
                <div class="kravt-logo main">
                    <?= file_get_contents(get_template_directory_uri() . '/build/img/logos/KH.svg') ?>
                </div>
                <div class="kravt_social_wrapper _wrapper-social-mobile">
                    <img src="<?= get_template_directory_uri() . '/build/img/socials/tg.svg' ?>" alt="TG" title="Telegram" onclick="window.open('<?= $GLOBALS['cgv']['telegram_default']?>','_blank')"/>
                    <img src="<?= get_template_directory_uri() . '/build/img/socials/vk.svg' ?>" alt="VK" title="VKontakte" onclick="window.open('<?= $GLOBALS['cgv']['vk_default']?>','_blank')"/>
                </div>
                <div class="kravt_burger_header">
                    <a href="tel:<?= str_replace(' ', '', $GLOBALS['cgv']['phone_default']) ?>" id="phone_button" class="kravt_hero_phone-button">
                        <?= $GLOBALS['cgv']['phone_default']; ?>
                    </a>
                    <div class="kravt_social_wrapper _wrapper-social-desktop">
                        <img src="<?= get_template_directory_uri() . '/build/img/socials/tg.svg' ?>" alt="TG" title="Telegram" onclick="window.open('<?= $GLOBALS['cgv']['telegram_default']?>','_blank')"/>
                        <img src="<?= get_template_directory_uri() . '/build/img/socials/vk.svg' ?>" alt="VK" title="VKontakte" onclick="window.open('<?= $GLOBALS['cgv']['vk_default']?>','_blank')"/>
                    </div>
                    <!-- <div class="kravt_locale">
                        <a href="#" class="kravt_link">RU</a> <span class="kravt_link">/</span>
                        <a href="#" class="kravt_link">ENG</a>
                    </div> -->
                    <div class="kravt_hero_icons-group">
                        <img class="kravt_hero_burger" src="<?= get_template_directory_uri() . '/build/img/icons/close_icon.svg' ?>" alt="Menu" title="Menu" id="burger_icon" onclick="checkState()" />
                    </div>
                </div>
                    <div id="tl-search-form" class="tl-container" style="display:none">
                                    <noindex><a href="http://www.travelline.ru/products/tl-hotel/" rel='nofollow'
                                            target="_blank">TravelLine</a></noindex>
                    </div>
            </nav>
        </header>
<?php }?>