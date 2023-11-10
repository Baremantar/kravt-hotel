<?php
/*
*   Template Name: Lk
*/

$dom = str_get_html(get_post()->post_content);
$data = array();



get_header() ?>
    <style>
        main {
            padding-bottom: 164px;
        }
        @media (max-width: 1000px) {
            main {
                padding-bottom: 48px;
            }
        }
    </style>
    <main class="main-wrapper-services">
        <?php include(get_stylesheet_directory() . '/components/hero/thumbnails.php') ?>
        <div class="kravt_hero_container bg-service">

            <?php include(get_stylesheet_directory() . '/components/hero/breadcrumbs.php') ?>


            <!-- Бургер меню -->

            <?php include(get_stylesheet_directory() . '/components/burger/custom_burger.php'); ?>

            <div class="kravt_content container kravt_heroMain-template">
                <div class="kravt_hero_main">
                    <div class="kravt_kazan_roompage_hero_title">
                        <h1>Личный кабинет</h1>
                    </div>
                </div>
            </div>
        </div>

        <div id="tl-guest-account"></div>


        <?php
        $lkId = '';
        switch (get_site()->blog_id) {
            case 1:
                break;
            case 2:
                $lkId = '.21849';
                break;
            case 3:
                $lkId = '.18115';
                break;
            case 4:
                $lkId = '.11535';
                break;
            case 5:
                $lkId = '.5128';
                break;
        } ?>
        <script type="text/javascript">
            (function(w){
                var q=[
                    ['setContext', 'TL-INT-kravt-affarts-dev_2022-08-30<?=$lkId?>', 'ru'],
                    ['embed', 'guest-account', {container: 'tl-guest-account'}]
                ];

                var h = ["ru-ibe.tlintegration.ru", "ibe.tlintegration.ru", "ibe.tlintegration.com"];
                var t = w.travelline = (w.travelline || {}),
                    ti = t.integration = (t.integration || {});
                ti.__cq = ti.__cq ? ti.__cq.concat(q) : q;
                if (!ti.__loader) {
                    ti.__loader = true;
                    var d = w.document, c = d.getElementsByTagName("head")[0] || d.getElementsByTagName("body")[0];
                    function e(s, f) {
                        return function () {
                            w.TL || (c.removeChild(s), f())
                        }
                    }
                    (function l(h) {
                        if (0 === h.length) return;
                        var s = d.createElement("script");
                        s.type = "text/javascript";
                        s.async = !0;
                        s.src = "https://" + h[0] + "/integration/loader.js";
                        s.onerror = s.onload = e(s, function () {
                            l(h.slice(1, h.length))
                        });
                        c.appendChild(s)
                    })(h);
                }
            })(window);
        </script>


    </main>
<?php get_footer() ?>