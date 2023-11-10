<?php 
$postslist = get_posts(array('posts_per_page' => -1, 'category_name' => 'rooms-header'));

$postslist = array_reverse($postslist);
?>

<!-- Бургер меню -->
<div class="kravt_burger_container burger-bg-kazan" id="burger_container">
    <div class="kravt_burger_mask">
        <div class="kravt_burger_content">
            <div class="container">
                <div class="kravt_burger_mobile">
                    <div class="kravt_burger_mobile-links">
                        <a href="/lk">Личный кабинет</a>
                    </div>
                    
                    <div>
                        <button class="accordion" type="button">
                            Номера
                            <img src="<?= get_template_directory_uri() . '/build/img/icons/dropdown.svg' ?>" />
                        </button>
                        <div class="panel">
                            <div class="kravt_burger_mobile_accordions">
                                <a href="/rooms/">Посмотреть все</a>
   
                                <?php foreach ($postslist as $element) {?>
                                <a href="<?= get_post_permalink($element)?>"><?= get_the_title($element) ?></a>
                                <?php };
                                ?>

                                <?php if(get_site()->blog_id == 4){
                                    $whitePages = ['rooms'];
                                    foreach($whitePages as $element) {
                                        $restarauntTemplate = get_pages(array(
                                            'meta_key' => '_wp_page_template',
                                            'meta_value' => 'views/'.$element.'.php'
                                        ));
                                    
                                        foreach($restarauntTemplate as $element) {
                                            if (get_the_title($element) != 'Номера') {
                                            ?>
                                            <a href="<?= get_post_permalink($element)?>">
                                                <?= get_the_title($element) ?>
                                            </a>
                                        <?php }}
                                    }
                                } ?>
                            </div>
                        </div>
                        <div class="kravt_burger_mobile-links">
                            <?php foreach ($menu[4] as $i => $item) {
                                if($i != count($menu[4])-1) {
                                    echo $item->outertext();
                                }
                            } ?>
                        </div>
                    </div>
                    <div>
                        <?php $menu[4][count($menu[4]) - 1]->setAttribute('class', 'kravt_burger_mobile-link-kazan');
                        echo $menu[4][count($menu[4]) - 1]->outertext(); ?>
                        <!-- <div class="kravt_burger_mobile-locale">
                            <button type="button" class="_lang-active">RU</button>
                            <button type="button" >ENG</button>
                        </div> -->
                    </div>
                </div>
            </div>

            <div class="kravt_burger_desktop">
                <!-- desktop -->
                <div class="container burger-container">
                    <div class="kravt_burger_row-container">
                        <div class="kravt_burger_links-col">
                            <div class="kravt_burger_links-wrapper">
                                <div>
                                    <p>Отели</p>

                                    <?php for($i=0; $i< count($dataSites['domains']); $i++){ ?>
                                    <a href="<?= $dataSites['domains'][$i]?>" id="<?= $burgerHoverItems[$i]?>">
                                        <?= $dataSites['names'][$i]?>
                                        <span>г. <?= $dataSites['description'][$i]?></span>
                                        <!-- <span>Казань</span> -->
                                    </a>
                                    <?php } ?>

                                </div>
                                <?php $menu[1][1]->setAttribute('class', 'kravt_burger_down-link');
                                echo $menu[1][1]->outertext(); ?>
                            </div>
                        </div>

                        <div class="kravt_burger_links-col">
                            <div class="kravt_burger_links-wrapper">
                                <div class="kravt_burger_links-col">
                                    <p>О Kravt Hotels</p>
                                    <?php foreach ($menu[0] as $item) {
                                        if (strpos ( $item, 'Контакты') == false) {
                                            echo $item->outertext();
                                        }
                                    } ?>
                                </div>
                                <?php $menu[1][2]->setAttribute('class', 'kravt_burger_down-link');
                                echo $menu[1][2]->outertext(); ?>
                            </div>
                        </div>
                        <div class="kravt_burger_links-col">
                            <div class="kravt_burger_links-wrapper">
                                <div class="links-normal">
                                    <?= $menu[1][0]->outertext(); ?>
                                </div>
                                <?php $menu[1][3]->setAttribute('class', 'kravt_burger_down-link');
                                echo $menu[1][3]->outertext(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="https://affarts.com/" class="kravt_burger_developed">
                    <span> Сделано в </span>
                    <div>
                        <img alt="logo-developed" title="Affarts"
                            src="<?= get_template_directory_uri() . '/build/img/logo-white.svg' ?>" />
                    </div>
                </a>
                <!-- desktop -->
            </div>
        </div>
    </div>
</div>

<?php include(get_stylesheet_directory() . '/components/modals/main-modal.php'); ?>