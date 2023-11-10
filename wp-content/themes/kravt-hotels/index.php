<?php
get_header();?>

<main>
    <div class="kravt_dynamic_navigation _dynamic-white container negative">
        <a href="<?= get_blog_details( array( 'blog_id' => 1 ) )->home ?>">Kravt Hotels</a>
        <span>—</span>
        <span class="kravt_dynamic_navigation-active press_item_breadcrumb"><?php the_title() ?></span>
    </div>
    <?php if (get_site()->blog_id == 1) {?>
        <div class="container" style="width: 100%">
            <?php include(get_stylesheet_directory() . '/components/burger/default_burger.php'); ?>
        </div>
    <?php } else {?>
        <div class="kravt_mask_inner">
            <?php include(get_stylesheet_directory() . '/components/burger/custom_burger.php'); ?>
        </div>
    <?php } ?>
    <section class="container container-spacing default">
        <?php the_content(); ?>
    </section>

</main>

<?php get_footer();
// Silence is gold