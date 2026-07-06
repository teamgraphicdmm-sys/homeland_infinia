<!DOCTYPE html>
<html lang="en" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">

    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php bloginfo('name'); ?>">
    <meta property="og:url" content="<?php echo esc_url(home_url('/')); ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- 
<div class="ambient-glow-1"></div>
<div class="ambient-glow-2"></div> -->

<header id="site-header">
    <a href="<?php echo esc_url(home_url('/')); ?>" id="homeland-logo" class="brand-logo-link">
        <img class="brand-logo-img"  src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/homeland-logo.png'); ?>" alt="Homeland Logo">
    </a>

    <div class="header-center">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-logo-link">
            <img class="brand-logo-img" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/infinia-logo.png'); ?>" alt="Homeland Infinia Logo">
        </a>
    </div>

    <button class="hamburger-btn" id="hamburgerBtn" aria-label="Toggle menu" aria-expanded="false">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
    </button>

    <div class="header-right" id="headerRight">
        <?php hi_default_menu_fallback(); ?>
    </div>
</header>