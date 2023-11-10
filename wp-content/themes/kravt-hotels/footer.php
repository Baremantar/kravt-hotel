<?php

$link = array();
$link[0] = '';
$link[1] = '';
$link[2] = '';

$links = array();
$links[0] = array();
$links[1] = array();

switch (get_site()->blog_id) {
    case 2:
        $link[0] = $GLOBALS['cgv']['vk_kazan'];
        $link[1] = $GLOBALS['cgv']['telegram_kazan'];
        $link[2] = $GLOBALS['cgv']['whatsapp_kazan'];
    break;
    case 3:
        $link[0] = $GLOBALS['cgv']['vk_nevsky'];
        $link[1] = $GLOBALS['cgv']['telegram_nevsky'];
        $link[2] = $GLOBALS['cgv']['whatsapp_nevsky'];
    break;
    case 4:
        $link[0] = $GLOBALS['cgv']['vk_albora'];
        $link[1] = $GLOBALS['cgv']['telegram_albora'];
        $link[2] = $GLOBALS['cgv']['whatsapp_albora'];
    break;
    case 5:
        $link[0] = $GLOBALS['cgv']['vk_sadovaya'];
        $link[1] = $GLOBALS['cgv']['telegram_sadovaya'];
        $link[2] = $GLOBALS['cgv']['whatsapp_sadovaya'];
    break;
    default:
        $link[0] = $GLOBALS['cgv']['vk_default'];
        $link[1] = $GLOBALS['cgv']['telegram_default'];
        $link[2] = $GLOBALS['cgv']['whatsapp_default'];
    break;
}

foreach (str_get_html(wp_nav_menu(['menu' => 'Menu in footer (Основные ссылки)', 'echo' => false,]))->find('a') as $element) {
    array_push($links[0], $element->outertext());
}

foreach (str_get_html(wp_nav_menu(['menu' => 'Menu in footer (Политика)', 'echo' => false,]))->find('a') as $element) {
    array_push($links[1], $element);
};


// Another footer for 404 page
if (!is_404()){

    if (get_post()->post_name == 'gallery') {
        echo '<div class="kravt_gallery_footer">';
    };

    $whitePages = ['views/rooms.php', 'views/custom-hotel.php'];

?>

<div class="container contfut <?php

if (is_single()){
    if (get_the_category()[0]->slug == 'offers' ||
        get_the_category()[0]->slug == 'events' ||
        get_the_category()[0]->slug == 'restaurants' ||
        get_the_category()[0]->slug == 'services'
        ){
        echo 'grey';
    };
    if (get_the_category()[0]->slug == 'events') {
        echo ' f';
    };
}

foreach($whitePages as $element) {
        if (get_page_template_slug() == $element) {
            echo 'white';
        }
}

if (get_page_template_slug() == 'views/promotion.php') {
    echo 'fullwhite';
}

if (get_page_template_slug() == 'views/team.php' ||
    get_page_template_slug() == '' ||
    get_page_template_slug() == 'views/press-center.php' ||
    get_page_template_slug() == 'views/press-center-item.php' ||
    get_page_template_slug() == 'views/services.php' ||
    get_page_template_slug() == 'views/sitemap.php' ||
    get_page_template_slug() == 'views/vacancy.php' ||
    get_page_template_slug() == 'views/career.php'
    ) {
    echo 'grey';
}
?>">
    <footer class="kravt_footer_container">
        <h2 class="kravt_footer_title">Kravt Hotels</h2>
        <span class="kravt_footer_description">
            <?= $GLOBALS['cgv']['text_in_footer'] ?>
        </span>

        <div class="kravt_footer_socials">
            <a href="<?= $link[0]?>" target="_blank"><img alt="vk" title="vk"
                    src="<?= get_template_directory_uri() . '/build/img/socials/vk_negative.svg' ?>" width="24"
                    height="24" /></a>
            <a href="<?= $link[1]?>" target="_blank"><img alt="telegram" title="Telegram"
                    src="<?= get_template_directory_uri() . '/build/img/socials/tg_negative.svg' ?>" width="24"
                    height="24" /></a>
            <!-- <a href="<?//= $link[2]?>"><img alt="WhatsApp" title="WhatsApp"
                    src="<?//= get_template_directory_uri() . '/build/img/socials/wa_negative.svg' ?>" width="24"
                    height="24" /></a> -->
        </div>
        <?php
            $a = 8;
            $b = 4;
        ?>
        <div class="kravt_footer_links-container <?php if (count($links[0]) <= $a) {echo 'custom';} ?>">
            <?php
            for ($i=0; $i < (count($links[0])/$b); $i++) {?>
            <div class="kravt_footer_links">
                <?php
                    for($j = $i * $b; $j < ($i + 1) * $b; $j++) {
                        if (isset($links[0][$j])){echo $links[0][$j];};
                    } ?>
            </div>
            <?php }
             ?>
        </div>
        <div class="kravt_footer_divider"></div>
        <div class="kravt_footer_content">
            <div class="kravt_footer_logo">
                <img alt="Logo" title="Kravt Group" width="140" height="40"
                    src="<?= get_template_directory_uri() . '/build/img/logos/KH.svg' ?>"
                    onclick="window.location.href = 'http://<?= get_site(1)->domain ?>'" />

                <span>© <?= date("Y")?> Кравт Хотелс</span>
            </div>
            <div class="kravt_footer_link-group">
                <?php foreach ($links[1] as $element) {
                    $element->setAttribute('class', 'kravt_footer_link');
                    echo $element->outertext();
                } ?>
            </div>
            <div class="kravt_footer_developed">
                <a href="https://affarts.ru/" target="_blank">
                    <span> Дизайн и разработка </span>
                    <img alt="logo-footer" title="Affarts"
                        src="<?= get_template_directory_uri() . '/build/img/affarts.svg' ?>" />
                </a>
            </div>
        </div>
        <div class="kravt_footer_content-medium">
            <div class="kravt_footer_logo">
                <img alt="Logo" title="Kravt Group" width="140" height="40"
                    src="<?= get_template_directory_uri() . '/build/img/logos/KH.svg' ?>" onclick="window.location.href = 'http://<?= get_site(1)->domain ?>'"/>
                <span>© <?= date("Y")?> Кравт Групп</span>
            </div>
            <div class="kravt_footer_content-medium-right">
                <div class="kravt_footer_developed">
                    <a href="https://affarts.com/" target="_blank">
                        <span> Дизайн и разработка </span>
                        <img alt="logo-footer" title="Affarts"
                            src="<?= get_template_directory_uri() . '/build/img/affarts.svg' ?>" />
                    </a>
                </div>
                <div class="kravt_footer_link-group">
                    <?php foreach ($links[1] as $element) {
                    $element->setAttribute('class', 'kravt_footer_link');
                    echo $element->outertext();
                } ?>
                </div>
            </div>
        </div>
    </footer>
</div>
<?php if (get_post()->post_name == 'gallery') {echo '</div>';};?>
    <span id='toTop'>Наверх<?= file_get_contents(get_template_directory_uri() . '/build/img/arrowTop.svg')?></span>
<?php wp_footer(); } else {?>
    <footer class="container footer_404">
        <div class="info">
            <span>г. Санкт-Петербург, ул. Садовая, д. 25</span>
            <a href="tel:<?= $GLOBALS['cgv']['phone_default']?>"><?= $GLOBALS['cgv']['phone_default']?></a>
            <a href="mailto:<?= $GLOBALS['cgv']['base_department']?>"><?= $GLOBALS['cgv']['base_department']?></a>
        </div>
        <div class="socials">
            <a href="<?= $GLOBALS['cgv']['vk_default']?>" target="_blank">
                <img src="<?= get_template_directory_uri() . '/build/img/socials/vk_dark.svg' ?>" alt="VK" title="VKontakte" />
            </a>
            <a href="<?= $GLOBALS['cgv']['telegram_default']?>" target="_blank">
                <img src="<?= get_template_directory_uri() . '/build/img/socials/tg_dark.svg' ?>" alt="TG" title="Telegram" />
            </a>
            <!-- <a href="<?= $GLOBALS['cgv']['whatsapp_default']?>" target="_blank">
                <img src="<?= get_template_directory_uri() . '/build/img/socials/wa_dark.svg' ?>" alt="WA" title="Whatsapp" />
            </a> -->
        </div>
    </footer>
<?php wp_footer();} ?>


</body>

</html>
