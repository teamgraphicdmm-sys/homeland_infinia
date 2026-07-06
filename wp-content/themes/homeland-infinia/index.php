<?php
/**
 * Fallback template (required by WordPress).
 * The Blogs template (page-templates/template-blogs.php) is the
 * intended blog listing; this only renders if nothing else matches.
 */
get_header();
?>
<div style="padding: 160px 20px 80px; color: #fff; max-width: 900px; margin: 0 auto; z-index: 10; position: relative;">
    <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
            <article style="margin-bottom: 40px;">
                <h2><a href="<?php the_permalink(); ?>" style="color:#fff; text-decoration:none;"><?php the_title(); ?></a></h2>
                <p style="color:#a1a1aa;"><?php echo esc_html(get_the_excerpt()); ?></p>
            </article>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No content found.</p>
    <?php endif; ?>
</div>
<?php get_footer(); ?>
