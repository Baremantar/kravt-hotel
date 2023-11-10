<?php $currentData = $data['section'][5];
$slider = array();
foreach (str_get_html($currentData)->find('.wp-block-custom-hotel-type') as $i => $element) {
    array_push($slider, $element->outertext());
};
?>

<section class="container kravt_restaraunts">
    <div class="kravt_restaraunts-title">
        <div class="kravt_restaraunts-title-content">
            <?php $getHeader($currentData);
            $getDescription($currentData) ?>
        </div>
    </div>
    <div class="kravt_contacts_container">
        <div class="contact-cards">
            <div class="contact-cards__items">
                <?php foreach ($slider as $element) { ?>
                    <div class="card-box-contact">
                        <div class="kravt_contacts_item-wrapper">
                            <div class="kravt_contacts_slide-item">
                                <img class="kravt_contacts_img" src="<?php foreach (str_get_html($element)->find('img') as $subElement) {
                                                                            echo $subElement->src;
                                                                        } ?>" alt="KRAVT Nevsky" title="KRAVT Nevsky">
                                <?php foreach (str_get_html($element)->find('a') as $i => $subElement) {
                                    if ($i == 0) {
                                        $subElement->setAttribute('class', 'kravt_contacts_item_hotel');
                                        $subElement->setAttribute('target', '_blank');
                                        echo $subElement->outertext();
                                    }
                                } ?>
                                <div class="kravt_contacts_contact _contact-head">
                                    <p>Адрес</p>
                                    <?php foreach (str_get_html($element)->find('.address') as $i => $subElement) {
                                        echo $subElement->outertext();
                                    } ?>
                                </div>
                                <div class="kravt_contacts_contact">
                                    <p>Телефон</p>
                                    <?php foreach (str_get_html($element)->find('.phone') as $i => $subElement) {
                                        echo $subElement->outertext();
                                    } ?>
                                </div>
                                <div class="kravt_contacts_contact">
                                    <p>Почта</p>
                                    <?php foreach (str_get_html($element)->find('.email') as $i => $subElement) {
                                        echo $subElement->outertext();
                                    } ?>
                                </div>
                            </div>
                            <div class="kravt_contacts_socials">
                                <!-- <a href="<?php foreach(str_get_html($element)->find('.inst') as $subElement){echo $subElement->plaintext;}?>" target="_blank" ><img src="<?= get_template_directory_uri() . '/build/img/socials/instagram_negative.svg'?>" width="20" height="20" /></a> -->
                                <a href="<?php foreach(str_get_html($element)->find('.telegram') as $subElement){echo $subElement->plaintext;}?>" target="_blank" ><img src="<?= get_template_directory_uri() . '/build/img/socials/tg_negative.svg' ?>" width="20" height="20" /></a>
                                <!-- <a href="<?php foreach(str_get_html($element)->find('.viber') as $subElement){echo $subElement->plaintext;}?>" target="_blank" ><img src="<?= get_template_directory_uri() . '/build/img/socials/viber_negative.svg' ?>" width="20" height="20" /></a> -->
                                <!-- <a href="<?php foreach(str_get_html($element)->find('.whatsapp') as $subElement){echo $subElement->plaintext;}?>" target="_blank" ><img src="<?= get_template_directory_uri() . '/build/img/socials/wa_negative.svg' ?>" width="20" height="20" /></a> -->
                                <a href="<?php foreach(str_get_html($element)->find('.vk') as $subElement){echo $subElement->plaintext;}?>" target="_blank" ><img src="<?= get_template_directory_uri() . '/build/img/socials/vk_negative-dark.svg' ?>" width="20" height="20" /></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!-- <button class="kravt_button-border _button-spa">Показать все отели</button> -->
        </div>
        <div class="swiper contacts-swiper">
            <div class="swiper-wrapper">
                <?php foreach ($slider as $element) { ?>
                    <div class="swiper-slide">
                        <div class="card-box-contact">
                            <div class="kravt_contacts_item-wrapper">
                                <div class="kravt_contacts_slide-item">
                                    <img class="kravt_contacts_img" src="<?php foreach (str_get_html($element)->find('img') as $subElement) {
                                                                                echo $subElement->src;
                                                                            } ?>" alt="KRAVT Nevsky" title="KRAVT Nevsky">
                                    <?php foreach (str_get_html($element)->find('a') as $i => $subElement) {
                                        if ($i == 0) {
                                            $subElement->setAttribute('class', 'kravt_contacts_item_hotel');
                                            $subElement->setAttribute('target', '_blank');
                                            echo $subElement->outertext();
                                        }
                                    } ?>
                                    <div class="kravt_contacts_contact _contact-head">
                                        <p>Адрес</p>
                                        <?php foreach (str_get_html($element)->find('.address') as $i => $subElement) {
                                            echo $subElement->outertext();
                                        } ?>
                                    </div>
                                    <div class="kravt_contacts_contact">
                                        <p>Телефон</p>
                                        <?php foreach (str_get_html($element)->find('.phone') as $i => $subElement) {
                                            echo $subElement->outertext();
                                        } ?>
                                    </div>
                                    <div class="kravt_contacts_contact">
                                        <p>Почта</p>
                                        <?php foreach (str_get_html($element)->find('.email') as $i => $subElement) {
                                            echo $subElement->outertext();
                                        } ?>
                                    </div>
                                </div>
                                <div class="kravt_contacts_socials">
                                <!-- <a href="<?php foreach(str_get_html($element)->find('.inst') as $subElement){echo $subElement->plaintext;}?>" target="_blank" ><img src="<?= get_template_directory_uri() . '/build/img/socials/instagram_negative.svg'?>"  width="20" height="20" /></a> -->
                                <a href="<?php foreach(str_get_html($element)->find('.telegram') as $subElement){echo $subElement->plaintext;}?>" target="_blank" ><img src="<?= get_template_directory_uri() . '/build/img/socials/tg_negative.svg' ?>"  width="20" height="20" /></a>
                                <!-- <a href="<?php foreach(str_get_html($element)->find('.viber') as $subElement){echo $subElement->plaintext;}?>" target="_blank" ><img src="<?= get_template_directory_uri() . '/build/img/socials/viber_negative.svg' ?>"  width="20" height="20" /></a> -->
                                <!-- <a href="<?php foreach(str_get_html($element)->find('.whatsapp') as $subElement){echo $subElement->plaintext;}?>" target="_blank" ><img src="<?= get_template_directory_uri() . '/build/img/socials/wa_negative.svg' ?>"  width="20" height="20" /></a> -->
                                <a href="<?php foreach(str_get_html($element)->find('.vk') as $subElement){echo $subElement->plaintext;}?>" target="_blank" ><img src="<?= get_template_directory_uri() . '/build/img/socials/vk_negative-dark.svg' ?>"  width="20" height="20" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>