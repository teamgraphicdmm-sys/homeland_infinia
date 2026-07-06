<?php
/**
 * Front page — Home ("Coming Soon" hero + virtual tour CTA)
 */
get_header();
?>
<video class="bg-video-layer" src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/homeland_bg_video.mp4'); ?>" autoplay loop muted playsinline webkit-playsinline></video>

<div id="app-container">
    <!-- <div class="content-block"> -->
        <div class="text-block">
            <h1>Coming soon!</h1>
            <span class="badge2">Newest Story of Chandigarh</span>
            <div class="divider-logo">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/homeland-logo-icon.png'); ?>" alt="" style="height:25px;">
            </div>
            <p class="description">
                Where <strong style="color: #ffffff; margin: 0px 4px;">New Chandigarh</strong> meets its finest address.<br>
                <strong style="color: #ffffff; margin: 0px 4px;">Homeland Group's</strong> flagship ultra-luxury residence, Mullanpur.
            </p>
        </div>

        <div class="button-block">
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('tour'))); ?>" class="tour-btn" id="tour-btn">
                Click Here for a Virtual Tour
                <span class="arrow">&rarr;</span>
            </a>
        </div>
        <!-- </div>     -->
</div>

<?php get_footer(); ?>
