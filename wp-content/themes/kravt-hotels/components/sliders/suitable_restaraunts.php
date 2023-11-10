<?php  
$data = array();

if (get_site()->blog_id != 1) {
    $postslist = get_posts(array('posts_per_page' => -1, 'category_name' => 'restaurants'));
    
    foreach ($postslist as $element) {
        if ($element->post_title != get_the_title()) {
            array_push($data, $element);
        }
    };
} else {
    $dom = str_get_html(get_post()->post_content);

    foreach ($dom->find('.wp-block-custom-section-1 .wp-block-custom-slider-item') as $element) {
        array_push($data, $element);
    };
}

?>
<?php if(count($data) > 2 || count($data) >= 2 && $ifMobile()){ ?>
    <section class="container container-spacing <?php if (get_site()->blog_id == 1){echo "last";}?>">
            <div class="kravt_roompage_others-title">
                <h2>Подходящие залы</h2>
                <div class="navigation-arrows">
                    <div class="swiper-offer-nav-prev-button"></div>
                    <div class="swiper-offer-nav-next-button"></div>
                </div>
            </div>
            <div class="kravt_kazan_offers_container">
                <div class="swiper mySwiperRoompageOthers roompage-swiper-others">
                    <div class="kravt_swiper_side-hider _hider-others"></div>
                    <div class="swiper-wrapper">
                        <style>
                            <?php foreach ($data as $i => $element) {
                                $b = $i;
                                if (get_site()->blog_id != 1) {
                                    $imageSrc = get_the_post_thumbnail_url($element);
                                } else {
                                    foreach($element->find('img') as $img){$imageSrc = $img->src;};
                                }
                                if ($b > 2) {
                                    echo '#restaraunt-item-' . ++$b . '::before{
                                        background-image: url("' . $imageSrc . '");                                        
                                        transition: .5s;
                                        height: 100%;
                                        width: 100%;
                                        content: "";
                                        position: absolute;
                                        background-repeat: no-repeat;
                                        background-size: cover;
                                        z-index: -1;
                                    }';
                                } else {
                                    echo '#restaraunt-item-' . ++$b . '::before{
                                        background-image: url("' . $imageSrc . '");  ;
                                        }';
                                }
                            } ?>
                        </style>
                        <?php foreach ($data as $i => $element) {
                            ?>
                            <div class="swiper-slide kravt_roompage_others-slide" onclick="window.location.href = '<?php if (get_site()->blog_id != 1) { get_permalink($element); } else { foreach($element->find('a') as $a){echo $a->href;}} ?>'">
                                <div class="kravt_others-slide-wrapper">
                                    <div id="restaraunt-item-<?= ++$i ?>" class="kravt_roompage_others-slide-bg">
                                        <span><?php if (get_site()->blog_id != 1) {
                                            echo get_the_title($element) ;
                                        } else {
                                            foreach($element->find('span') as $span){echo $span->plaintext;}
                                        }?></span>
                                    </div>
                                </div>
                        
                                <p><?php if (get_site()->blog_id != 1) {
                                            echo get_the_title($element) ;
                                        } else {
                                            foreach($element->find('span') as $span){echo $span->plaintext;}
                                        }?></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
<?php } else {?>

    <section class="container container-spacing <?php if (get_site()->blog_id == 1){echo "last";}?>">
            <div class="kravt_roompage_others-title">
                <?php if(count($data) == 2 ){echo '<h2>Подходящие залы</h2>';} else {echo '<h2>Подходящий зал</h2>';} ?>
                
            </div>
            <div class="kravt_kazan_offers_container">
                <div class="swiper roompage-swiper-others">
                    <div class="kravt_swiper_side-hider _hider-others"></div>
                    <div class="swiper-wrapper custom">
                        <style>
                            <?php foreach ($data as $i => $element) {
                                $b = $i;
                                if (get_site()->blog_id != 1) {
                                    $imageSrc = get_the_post_thumbnail_url($element);
                                } else {
                                    foreach($element->find('img') as $img){$imageSrc = $img->src;};
                                }
                                if ($b > 2) {
                                    echo '#restaraunt-item-' . ++$b . '::before{
                                        background-image: url("' . $imageSrc . '");                                        
                                        transition: .5s;
                                        height: 100%;
                                        width: 100%;
                                        content: "";
                                        position: absolute;
                                        background-repeat: no-repeat;
                                        background-size: cover;
                                        z-index: -1;
                                    }';
                                } else {
                                    echo '#restaraunt-item-' . ++$b . '::before{
                                        background-image: url("' . $imageSrc . '");  ;
                                        }';
                                }
                            } ?>
                            @media (max-width:1000px) {
                                <?php echo '#restaraunt-item-' . ++$b . '::before:hover{}'?>
                            }
                        </style>
                        <?php foreach ($data as $i => $element) {?>
                            <div class="swiper-slide kravt_roompage_others-slide" onclick="window.location.href = '<?php if(get_site()->blog_id !== 1){echo get_permalink($element);} else {foreach($element->find('a') as $a){echo $a->href;}} ?>'">
                                <div class="kravt_others-slide-wrapper">
                                    <div id="restaraunt-item-<?= ++$i ?>" class="kravt_roompage_others-slide-bg">
                                    <span><?php if (get_site()->blog_id != 1) {
                                            echo get_the_title($element) ;
                                        } else {
                                            foreach($element->find('span') as $span){echo $span->plaintext;}
                                        }?></span>
                                    </div>
                                </div>
                        
                                <p><?php if (get_site()->blog_id != 1) {
                                            echo get_the_title($element) ;
                                        } else {
                                            foreach($element->find('span') as $span){echo $span->plaintext;}
                                        }?></p>
                            </div>
                        <?php
                        } ?>
                    </div>
                </div>
            </div>
        </section>

<?php } ?>
