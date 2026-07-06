<?php
/**
 * Single blog post
 */
get_header();
?>
<style>

.bg-video-dim{
    filter: brightness(0.2);
}

</style>
<?php while (have_posts()): the_post(); ?>
<video class="bg-video-layer bg-video-dim" src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/homeland_bg_video.mp4'); ?>" autoplay loop muted playsinline webkit-playsinline></video>
<main class="single-blog-main">
    <a href="<?php echo  esc_url(home_url('/blog/')); ?>" class="back-to-grid">&larr; Back to Publications</a>
    <article>
        <div class="article-meta">
            <?php echo esc_html(get_the_category()[0]->name ?? 'Update'); ?> • <?php echo get_the_date('F d, Y'); ?>
        </div>
        <h1 class="article-title"><?php the_title(); ?></h1>

        <?php if (has_post_thumbnail()): ?>
            <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title_attribute(); ?>" class="article-banner">
        <?php endif; ?>

        <div class="article-divider"></div>
        <div class="article-body-content"><?php the_content(); ?></div>
    </article>
</main>
<?php endwhile; ?>

<?php get_footer(); ?>
