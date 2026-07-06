<?php
/**
 * Template Name: Blogs
 */
get_header();

$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$blog_query = new WP_Query(array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 9,
    'paged'          => $paged,
));
?>
<style>
    footer {
        margin-top: 0px;
    }


        footer {
    width: 100%;
    max-width: 1100px;
    text-align: center;
    z-index: 100;
    position: fixed;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
    padding-top: 20px;
    margin-top: 30px;
    transition: opacity 0.5s ease;
    margin-top: -100px;
    position: fixed;
    /* margin-left: auto; */
    /* margin-right: auto; */
    margin: auto;
    margin-top: -100px;
    margin-left: 15%;}
   @media (max-width: 768px) {
        #app-container{
            min-height: 80vh;
        }

        footer {
    width: 100%;
    max-width: 1100px;
    text-align: center;
    z-index: 100;
    position: fixed;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
    padding-top: 20px;
    margin-top: 30px;
    transition: opacity 0.5s ease;
    margin-top: -100px;
    position: fixed;
    /* margin-left: auto; */
    /* margin-right: auto; */
    margin: auto;
    margin-top: 0;
    margin-left: unset;
}
    }

</style>
<video class="bg-video-layer bg-video-dim" src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/homeland_bg_video.mp4'); ?>" autoplay loop muted playsinline webkit-playsinline></video>

<div id="app-container" style="gap: 40px; padding-top: 140px;">
    <div class="text-block" style="max-width: 800px;">
        <h1 class="section-title">Architectural Perspectives!</h1>
        <div class="divider-logo">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/homeland-logo-icon.png'); ?>" alt="" style="height:25px;">
        </div>
    </div>

    <div class="blog-grid" style="max-width: 1200px;">
        <?php if ($blog_query->have_posts()): ?>
            <?php while ($blog_query->have_posts()): $blog_query->the_post(); ?>
                <a href="<?php the_permalink(); ?>" style="text-decoration: none; color: inherit; display: block;">
                    <div class="blog-card">
                        <div>
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php the_title_attribute(); ?>" class="blog-card-thumbnail">
                            <?php else: ?>
                                <div class="blog-card-thumbnail flex-fallback">Image Under Optimization</div>
                            <?php endif; ?>

                            <div class="blog-meta"><?php echo esc_html(get_the_category()[0]->name ?? 'Update'); ?> • <?php echo get_the_date('F Y'); ?></div>
                            <h3 class="blog-heading"><?php the_title(); ?></h3>
                            <p class="blog-excerpt"><?php echo esc_html(get_the_excerpt()); ?></p>
                        </div>
                        <div class="read-more">Read Article <span>&rarr;</span></div>
                    </div>
                </a>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no-blog">No articles found in the workspace archive.</p>
        <?php endif; ?>
    </div>

    <?php if ($blog_query->max_num_pages > 1): ?>
        <div class="pagination-container">
            <?php
            echo paginate_links(array(
                'total'     => $blog_query->max_num_pages,
                'current'   => $paged,
                'prev_text' => '&larr; Prev',
                'next_text' => 'Next &rarr;',
                'type'      => 'list',
                'add_args'  => false,
            ));
            ?>
        </div>
    <?php endif; ?>
</div>

<?php
wp_reset_postdata();
get_footer();
?>
