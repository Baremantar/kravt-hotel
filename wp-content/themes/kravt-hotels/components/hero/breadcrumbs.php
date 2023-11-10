<?php 
    $domains = array();
    $domains['main'] = 'http://'.get_site(1)->domain;
    $domains['current'] = array();
    $domains['current']['url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    
    switch (get_site()->blog_id) {
        case 2:
            $domains['current']['name'] = "Kravt Hotel Kazan Airport";
            break;
        case 3:
            $domains['current']['name'] = "Kravt Nevsky Hotel & SPA";
            break;
        case 4:
            $domains['current']['name'] = "Albora Boutique Hotel";
            break;
        case 5:
            $domains['current']['name'] = "Kravt Sadovaya Hotel";
            break;
    }

    $categories = ['rooms', 'offers', 'restaurants', 'events', 'services', 'advantages']

?>

<div class="kravt_dynamic_navigation _dynamic-white container">
    <a href="<?= $domains['main'] ?>">Kravt Hotels</a>
    <span>—</span>
    <?php if (get_site()->blog_id != 1) {?>
        <a href="<?= $domains['current']['url']?>"><?= $domains['current']['name']?></a>
        <span>—</span>
    <?php } ?>
    <?php if(is_page()) {?>
        <a href="javascript:void(0)"><?= the_title() ?></a>
    <?php } elseif(is_single()) {
        $pageTemplate = '';
        $pageTitle = '';
        $pageLink = '';
        for ($i=0; $i < count($categories); $i++) { 

            if(has_category($categories[$i])){ 
               $pageTemplate = get_category_by_slug($categories[$i])->slug;
               $pageTitle = get_category_by_slug($categories[$i])->name;
            }

            if ($pageTemplate != 'advantages') {
                if (get_site()->blog_id == 1) {
                    $pageTemplate = 'promotion';
                    $pageTitle = 'Спецпредложения';
                }
            }

            if ($pageTemplate == 'advantages') {
                $pageTemplate = $pageTemplate . '-item';
            }

            $pages_with_template_filename = get_pages( [
                    'meta_key' => '_wp_page_template',
                    'meta_value' => 'views/'.$pageTemplate.'.php'
                ] );

            foreach ($pages_with_template_filename as $key => $value) {
                $pageLink = get_post_permalink($value->ID);
            }

        }?>
        <?php
            if ($pageTemplate != 'advantages-item') {
        ?>
        <a href="<?= $pageLink ?>"><?= $pageTitle ?></a>
        <span>—</span>
        <?php
            }
        ?>
        <a class="kravt_dynamic_navigation-active" href="javascript:void(0)"><?= get_the_title() ?></a>
    <?php }?>
</div>