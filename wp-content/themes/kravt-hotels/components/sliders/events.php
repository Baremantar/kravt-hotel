<?php $currentData = $data['section-1'][0]?>

<section class="container container-spacing">
    <div class="kravt_events_container">
        <div class="kravt_events_title">
            <?php $getHeader($currentData) ?>
            <div>
                <div class="kravt_events_links">
                    <?php foreach (str_get_html($currentData)->find('.wp-block-custom-slider-item a') as $i => $element) {
                        if ($i == 0){
                            $element->setAttribute('class','kravt_events_link-active event-link-handle');
                        } else {
                            $element->setAttribute('class','kravt_events_link event-link-handle');
                        }
                        echo $element->outertext();
                    }; ?>

                </div>
                <a class="kravt_events_link-more" href="<?php foreach (str_get_html($currentData)->find('.wp-block-custom-slider-item a') as $i => $element) {
                        if ($i == 0){
                        echo $element->href;
                    }
                    }; ?>"> Подробнее </a>
            </div>
        </div>
        <div class="kravt_events-img">
            <?php foreach (str_get_html($currentData)->find('.wp-block-custom-slider-item') as $i => $element) {
                if ($i == 0) {?>
                    <img src="<?php foreach ($element->find('img') as $img){echo $img->src;}?>" class="event-current-img" id="event-current-img-<?= $i?>" onclick="window.location.href='<?php foreach ($element->find('a') as $a){echo $a->href;}?>'"/>
                <?php } else {?>
                    <img src="<?php foreach ($element->find('img') as $img){echo $img->src;}?>" class="event-current-img" id="event-current-img-<?= $i?>" onclick="window.location.href='<?php foreach ($element->find('a') as $a){echo $a->href;}?>'" style="display:none" />
                <?php }
            }; ?>
        </div>
        <div class="_link-more-mobile">
            <a class="kravt_events_link-more" href="<?php foreach (str_get_html($currentData)->find('.wp-block-custom-slider-item a') as $i => $element) {
                        if ($i == 0){
                        echo $element->href;
                    }
                    }; ?>"> Подробнее </a>
            <img src="<?= get_template_directory_uri() . '/build/img/icons/external-right.svg' ?>" />
        </div>
    </div>
</section>