<?php
/**
 * Generic page fallback
 */
get_header();
?>
<div style="padding: 160px 20px 80px; color: #fff; max-width: 900px; margin: 0 auto; z-index: 10; position: relative;">
    <?php while (have_posts()): the_post(); ?>
        <h1 style="font-family: 'Aboreto', system-ui; font-size: 2.5rem; margin-bottom: 24px;"><?php the_title(); ?></h1>
        <div class="page-content" style="line-height: 1.8; color: #d4d4d8;">
            <?php the_content(); ?>
        </div>
    <?php endwhile; ?>
</div>
<?php get_footer(); ?>
