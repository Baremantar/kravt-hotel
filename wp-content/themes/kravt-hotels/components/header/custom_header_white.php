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



$logoIcon = '';
switch (get_site()->blog_id) {
    case 2:
        $logoIcon = file_get_contents(get_template_directory_uri() . '/build/img/logos/kazan.svg');
        break;
    case 3:
        $logoIcon = file_get_contents(get_template_directory_uri() . '/build/img/logos/nevsky.svg');
        break;
    case 4:
        $logoIcon = file_get_contents(get_template_directory_uri() . '/build/img/logos/albora.svg');
        break;
    case 5:
        $logoIcon = file_get_contents(get_template_directory_uri() . '/build/img/logos/kravt-hotel.svg');
        break;
    default:
        $logoIcon = file_get_contents(get_template_directory_uri() . '/build/img/logos/kravt-group.svg');
        break;
};

$postslist = get_posts(array('posts_per_page' => -1, 'category_name' => 'rooms-header'));

$postslist = array_reverse($postslist);

$mobile = array();
$mobile[0] = '';
$mobile[1] = '';
switch (explode('.', $_SERVER['HTTP_HOST'])[0]) {
    case 'kazan':
        $mobile[0] = $GLOBALS['cgv']['phone_kazan'];
        $mobile[1] = str_replace(' ','', $mobile[0]);
        break;
    case 'nevsky':
        $mobile[0] = $GLOBALS['cgv']['phone_nevsky'];
        $mobile[1] = str_replace(' ','', $mobile[0]);
        break;
    case 'albora':
        $mobile[0] = $GLOBALS['cgv']['phone_albora'];
        $mobile[1] = str_replace(' ','', $mobile[0]);
        break;
    case 'sadovaya':
        $mobile[0] = $GLOBALS['cgv']['phone_sadovaya'];
        $mobile[1] = str_replace(' ','', $mobile[0]);
        break;
};

?>

<body class="kravt_gallery">
    <header class="kravt_header" id="kravt_header">
        <?php if (!$ifMobile()) { ?><div class="kravt_wrapper"><?php } ?>
            <nav class="kravt_navigation_gallery kravt_content kravt_navbar container" id="header">
                <div class="navbar_scrolled_mask" id="scrolled_mask"></div>
                <div class="kravt-logo black" onclick="window.location.href = window.location.origin">
                        <?= $logoIcon ?>
                </div>
                <div class="kravt_navigation" id="navigation_links">
                    <a href="http://<?= get_site(1)->domain ?>">KRAVT HOTELS</a>
                    <div class="kravt_dropdown" id="header_picker">
                        <div class="kravt_dropdown_label kravt_dropdown_group-button">
                            <div class="kravt_dropdown_label-hotels">
                                Номера
                                <div>
                                    <img
                                        src="<?= get_template_directory_uri() . '/build/img/icons/arrow_down_white.svg' ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="kravt_dropdown_content kravt_dropdown-hotels rounded">
                            <?php foreach ($postslist as $element) {?>
                            <a href="<?= get_post_permalink($element)?>" class="kravt_dropdown_link">
                                <p><?= get_the_title($element) ?></p>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                    <?php foreach ($menu[4] as $i => $item) {
                        if($i != count($menu[4])-1){
                            echo $item->outertext();
                        }
                    } ?>
                </div>
                <a href="tel:<?= $mobile[1] ?>" id="phone_button" class="kravt_hero_phone-button">
                    <?= $mobile[0] ?>
                </a>
                <div class="kravt_hero_icons-group">
                    <img class="kravt_hero_call" src="<?= get_template_directory_uri() . '/build/img/icons/call.svg' ?>"
                        alt="Call" title="Call" width="28px" height="28px" onclick="window.open('tel:<?= $mobile[1] ?>');"/>
                    <img class="kravt_hero_burger"
                        src="<?= get_template_directory_uri() . '/build/img/icons/burger.svg' ?>" alt="Menu"
                        title="Menu" id="burger_icon" onclick="checkState()" />
                </div>
            </nav>
            <!-- Навбар -->
            <nav class="kravt_content kravt_navbar container" id="header_burger">
                <!-- <div class="navbar_scrolled_mask" id="scrolled_mask"></div> -->
                <div id="navbar_darked" class="navbar_darked"></div>
                <div class="kravt-logo">
                        <?= $logoIcon ?>
                </div>
                <div class="kravt_burger_header">
                    <a href="tel:+780080080080" id="phone_button" class="kravt_hero_phone-button">
                        +7 800 800-800-80
                    </a>
                    <div class="kravt_social_wrapper">
                        <img src="<?= get_template_directory_uri() . '/build/img/socials/vk.svg' ?>" alt="VK"
                            title="VKontakte" />
                        <img src="<?= get_template_directory_uri() . '/build/img/socials/tg.svg' ?>" alt="TG"
                            title="Telegram" />
                    </div>
                    <!-- <div class="kravt_locale">
                        <a href="#" class="kravt_link">RU</a> <span class="kravt_link">/</span>
                        <a href="#" class="kravt_link">ENG</a>
                    </div> -->
                    <div class="kravt_hero_icons-group">
                        <img class="kravt_hero_call"
                            src="<?= get_template_directory_uri() . '/build/img/icons/call.svg' ?>" alt="Call"
                            title="Call" width="28px" height="28px" />
                        <img class="kravt_hero_burger"
                            src="<?= get_template_directory_uri() . '/build/img/icons/close_icon.svg' ?>" alt="Menu"
                            title="Menu" id="burger_icon" onclick="checkState()" />
                    </div>
                </div>
            </nav>
            <?php if (!$ifMobile()) { ?>
            <div class="kravt_hero_main-row">
                <div id="block-search">
                    <div id="tl-search-form" class="tl-container">
                        <noindex><a href="https://www.travelline.ru/products/tl-hotel/" rel="nofollow"
                                target="_blank">TravelLine</a></noindex>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </header>