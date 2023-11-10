<?php
    get_header();
?>

<main>
    <?php if (get_site()->blog_id == 1) {?>
        <div class="container" style="width: 100%">
            <?php include(get_stylesheet_directory() . '/components/burger/default_burger.php'); ?>
        </div>
    <?php } else {?>
        <div class="kravt_mask_inner">
            <?php include(get_stylesheet_directory() . '/components/burger/custom_burger.php'); ?>
        </div>
    <?php } ?>
    <section class="container container-spacing error_404">
        <span>Ошибка 404</span>
        <h1>Страница не найдена</h1>
        <p>Возможно, вы найдёте информацию на главной странице Kravt Hotel</p>
        <?php echo '<pre>', print_r( get_post() , true), '</pre>';?>
        <button class="btn-default" onclick="window.location.href = window.location.origin">Перейти на главную страницу</button>
    </section>
</main>

<?php get_footer();
// Silence is gold