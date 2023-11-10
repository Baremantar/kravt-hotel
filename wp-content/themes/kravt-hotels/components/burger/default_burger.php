<div class="kravt_burger_container" id="burger_container">
    <div class="kravt_burger_mask">
        <div class="kravt_burger_content">
            <div class="container">
                <div class="kravt_burger_mobile">
                    <div class="kravt_burger_mobile-links">
                        <a href="/lk">Личный кабинет</a>
                    </div>

                    <div>
                        <button class="accordion">
                            Отели
                            <img src="<?= get_template_directory_uri() . '/build/img/icons/dropdown.svg' ?>" />
                        </button>
                        <div class="panel">
                            <div class="kravt_burger_mobile_accordions">
                                <?php foreach ($menu[5] as $element) {
                                    echo $element->outertext();
                                };
                                ?>
                            </div>
                        </div>
                        <button class="accordion">
                            О Kravt Hotels <img src="<?= get_template_directory_uri() . '/build/img/icons/dropdown.svg' ?>" />
                        </button>
                        <div class="panel">
                            <div class="kravt_burger_mobile_accordions">
                                <?php foreach ($menu[0] as $item) {
                                    echo $item->outertext();
                                } ?>
                            </div>
                        </div>
                        <div class="kravt_burger_mobile-links">
                            <?php foreach ($menu[3] as $item) {
                                echo $item->outertext();
                            } ?>
                        </div>
                    </div>
                    <!-- <div class="kravt_burger_mobile-locale">
                        <button class="_lang-active">RU</button>
                        <button>ENG</button>
                    </div> -->
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
                                    <p>О KRAVT HOTELS</p>
                                    <?php foreach ($menu[0] as $item) {
                                        echo $item->outertext();
                                    } ?>
                                </div>
                                <?php $menu[1][2]->setAttribute('class', 'kravt_burger_down-link');
                                echo $menu[1][2]->outertext();
                                ?>
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
                <a href="http://affarts.com/" class="kravt_burger_developed">
                    <span> Сделано в </span>
                    <div>
                        <img alt="logo-developed" title="Affarts" src="<?= get_template_directory_uri() . '/build/img/logo-white.svg' ?>" />
                    </div>
                </a>
                <!-- desktop -->
            </div>
        </div>
    </div>
</div>

<?php include(get_stylesheet_directory() . '/components/modals/main-modal.php'); ?>