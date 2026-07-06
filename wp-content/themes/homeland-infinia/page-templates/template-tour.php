<?php
/**
 * Template Name: Virtual Tour
 * Full-screen 360 video tour, converted from the original tour.html
 */
?>
<!DOCTYPE html>
<html lang="en" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php the_title(); ?> | <?php bloginfo('name'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;600&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body, html { width: 100%; height: 100%; overflow: hidden; background-color: #0b0b0f; font-family: 'Plus Jakarta Sans', sans-serif; }

        .social-media { display: inline-flex; position: absolute; top: 40px; right: 20px; gap: 10px; z-index: 9; }
        .social-media a { height: 40px; width: 40px; border-radius: 50%; background: #273e56; display: flex; justify-content: center; align-items: center; }
        .social-media a img { height: 20px; }

        .video-container { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; }
        #video-tour { width: 100%; height: 100%; object-fit: cover; }

        .back-btn {
            position: absolute; top: 40px; left: 40px; z-index: 9999; padding: 14px 28px;
            background: rgba(11, 11, 15, 0.5); color: #ffffff; text-decoration: none; font-size: 0.85rem;
            font-weight: 600; letter-spacing: 1px; text-transform: uppercase; border-radius: 100px;
            border: 1px solid rgba(255, 255, 255, 0.1); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
            transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1); display: inline-flex; align-items: center; gap: 10px;
        }
        .back-btn:hover { background: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.3); transform: translateX(-4px); }

        footer.video-overlay-footer {
            position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); width: calc(100% - 80px);
            max-width: 1100px; z-index: 9999; background: rgba(11, 11, 15, 0.4); border: 1px solid rgba(255, 255, 255, 0.06);
            padding: 20px 30px; border-radius: 16px; backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); text-align: center;
        }
        .disclaimer-text { font-size: 0.7rem; color: rgba(255, 255, 255, 0.45); line-height: 1.6; font-weight: 300; letter-spacing: 0.2px; }

        #transition-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: #0b0b0f;
            z-index: 10000; pointer-events: none; animation: revealPage 1.1s cubic-bezier(0.25, 1, 0.5, 1) forwards;
        }
        @keyframes revealPage { 0% { opacity: 1; transform: scale(1.4); } 100% { opacity: 0; transform: scale(1); visibility: hidden; } }
    </style>
</head>
<body>
    <div class="social-media">
        <a href="https://wa.me/919988976767"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/whatsapp-icon.png'); ?>" alt="WhatsApp"></a>
        <a href="tel:+919988976767"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/call-icon.png'); ?>" alt="Call"></a>
    </div>

    <div id="transition-overlay"></div>

    <a href="<?php echo esc_url(home_url('/')); ?>" class="back-btn"><span>&larr;</span> Return Home</a>

    <div class="video-container">
        <video id="video-tour" src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/360video.mp4'); ?>" autoplay loop muted playsinline webkit-playsinline></video>
    </div>

    <footer class="video-overlay-footer">
        <p class="disclaimer-text">
            This website is intended solely for general informational purposes. The content, visuals, specifications, and representations displayed herein are subject to change without notice and do not constitute an offer, invitation to offer, booking, or sale of any property. The project information will be updated in accordance with applicable regulatory requirements, including RERA, where applicable.
        </p>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const video = document.getElementById("video-tour");
            function executeForcePlay() {
                video.play().catch(function () {
                    console.log("Autoplay restricted by browser. Awaiting interaction fallback.");
                });
            }
            if (video.readyState >= 2) {
                executeForcePlay();
            } else {
                video.addEventListener("loadedmetadata", executeForcePlay);
            }
            window.addEventListener("click", function () {
                if (video.paused) video.play();
            }, { once: true });
        });
    </script>

    <?php wp_footer(); ?>
</body>
</html>
