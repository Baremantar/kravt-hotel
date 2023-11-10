<?php $currentData = $data['section'][2];
$slider = array();
foreach (str_get_html($currentData)->find('.wp-block-custom-slider-item-1') as $i => $element) {
        array_push($slider, $element->outertext());
    
}
?>


<section class="container container-spacing kravt_advantage">
    <div class="kravt_advantage_title">
        <?php $getHeader($currentData);
        $getDescription($currentData) ?>
    </div>
    <div class="kravt_advantage_items">
        <?php for ($b = 1; $b <= count($slider) / 2; $b++) { ?>
            <div class="kravt_advantage_box-container">
                <?php if ($b == 1) {
                    for ($i = 0; $i <= $b; $i++) { 
                        ?>
                        <div class="kravt_advantage_box">
                            <img src="<?php foreach (str_get_html($slider[$i])->find('img') as $element) {echo $element->src;}?>" height="320px" width="320px" alt="">
                            <?php  
                                foreach (str_get_html($slider[$i])->find('p') as $element) {echo $element->outertext();};
                                foreach (str_get_html($slider[$i])->find('span') as $element) {echo $element->outertext();}
                            ?>

                            <a href="<?php foreach (str_get_html($slider[$i])->find('a') as $element){echo $element->href;}?>"></a>
                        </div>
                    <?php }
                } else if ($b == 2) {
                    for ($i = (count($slider) / 2); $i <= (count($slider)) - 1; $i++) { ?>
                        <div class="kravt_advantage_box">
                        <img src="<?php foreach (str_get_html($slider[$i])->find('img') as $element) {echo $element->src;}?>" height="320px" width="320px" alt="">
                            <?php 
                                foreach (str_get_html($slider[$i])->find('p') as $element) {echo $element->outertext();};
                                foreach (str_get_html($slider[$i])->find('span') as $element) {echo $element->outertext();}
                            ?>

                            <a href="<?php foreach (str_get_html($slider[$i])->find('a') as $element){echo $element->href;}?>"></a>
                        </div>
                <?php }
                } ?>
            </div>
        <?php } ?>
    </div>
</section>