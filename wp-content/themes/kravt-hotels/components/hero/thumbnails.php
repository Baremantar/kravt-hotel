<style>
<?php $thumb=get_the_post_thumbnail_url();
echo '.kravt_hero_container {
    background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url("'. $thumb .'");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: 50% 100%;
}
'; ?>
</style>