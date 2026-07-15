<?php
/**
 * Front page — Home ("Coming Soon" hero + virtual tour CTA)
 */
get_header();
?>
<style>

    h1, .section-title {
    font-family: "Aboreto", system-ui;
    font-size: 65px;
    font-weight: 400;
    letter-spacing: 4px;
    line-height: 1.1;
    text-transform: uppercase;
       background: linear-gradient(135deg, #ffffff 40%, #fffcfc 100%);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}
.small-title {
    font-family: "Aboreto", system-ui;
    font-weight: 500;
    color: #ffffff;
    display: block;
    font-size: clamp(16px, 2.5vw, 25px);
    margin-bottom: -1%; 
    margin-left: -45%;
}
@media (max-width: 992px) {
    .small-title {
            margin-bottom: -3%; 
         margin-left:0% !important;
    }
}
@media (max-width: 768px) {
       .small-title {
        margin-bottom: -4%; 
    } 
}
</style>
<video class="bg-video-layer" src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/homeland_bg_video.mp4'); ?>" autoplay loop muted playsinline webkit-playsinline></video>

<div id="app-container">
    <!-- <div class="content-block"> -->
        <div class="text-block">
            <span class="small-title">To be</span>
            <h1>unveiled</h1>
            <span class="badge2">Newest Story of Chandigarh</span>
            <div class="divider-logo">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/homeland-logo-icon.png'); ?>" alt="" style="height:25px;">
            </div>
            <p class="description">
                Where <strong style="color: #ffffff; margin: 0px 4px;">New Chandigarh</strong> meets its finest address.<br>
                <strong style="color: #ffffff; margin: 0px 4px;">Homeland Group's</strong> flagship ultra-luxury residence, New Chandigarh.
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
