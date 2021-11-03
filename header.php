<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" >
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,viewport-fit=cover">
<link rel="profile" href="http://gmpg.org/xfn/11">
<!--title><?php bloginfo('name'); wp_title('–', true, 'left'); ?></title-->
<meta name="title" content="<?php bloginfo('name'); wp_title('-', true, 'left'); ?>">
<meta name="author" content="Ted Balmer | MarchTwenty.com">
<meta name="robots" content="index,follow">
<meta name="googlebot" content="index,follow">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php bloginfo('rss2_url'); ?>">
<base href="<?php echo home_url(); ?>/" id="SiteURI">
<link rel="stylesheet" href="<?php echo get_template_directory_uri() . "/assets/css/tedilize.css"; ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri() . "/assets/css/layout.css"; ?>">
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
<meta name="description" content="<?php echo SEO_Excerpt($post->ID); ?>">
<?php // Favicon ?>
<link rel="icon" type="image/png" sizes="32x32" href="<?php printf("%s/icons/favicon-32x32.png", home_url()); ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php printf("%s/icons/favicon-16x16.png", home_url()); ?>">
<?php // Apple ?>
<meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?>">
<meta name="format-detection" content="telephone=no">
<link rel="apple-touch-icon" sizes="180x180" href="<?php printf("%s/icons/apple-touch-icon.png", home_url()); ?>">
<?php // Google ?>
<meta name="application-name" content="<?php bloginfo('name'); ?>">
<link rel="manifest" href="<?php printf("%s/manifest.json", home_url()); ?>">
<link rel="icon" type="image/png" href="<?php printf("%s/icons/android-chrome-512x512.png", home_url()); ?>" sizes="512x512">
<link rel="icon" type="image/png" href="<?php printf("%s/icons/android-chrome-192x192.png", home_url()); ?>" sizes="192x192">
<?php // Facebook ?>
<meta property="og:locale" content="en_US">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php the_permalink(); ?>">
<meta property="og:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
<meta property="og:image" content="<?php echo SEO_Image($post->ID); ?>">
<meta property="og:description" content="<?php echo SEO_Excerpt($post->ID); ?>">
<?php // Twitter ?>
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?php the_permalink(); ?>">
<meta property="twitter:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
<meta property="twitter:image" content="<?php echo SEO_Image($post->ID); ?>">
<meta property="twitter:description" content="<?php echo SEO_Excerpt($post->ID); ?>">
<?php wp_head(); // WordPress generated meta data ?>

</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<?php wp_body_open(); ?>

<header class="page-header" role="banner" id="top">
    <div class="header-menubar">
        <div class="header-title">
            <h1 class="header-logo" itemprop="title">
                <a href="<?php echo home_url(); ?>" rel="bookmark">
                    <img class="logo-image" src="<?php echo get_template_directory_uri(); ?>/assets/logos/logo-img.svg" alt="Logo">
                    <img class="logo-text" src="<?php echo get_template_directory_uri(); ?>/assets/logos/logo-text.svg" alt="<?php bloginfo('name'); ?>" aria-label="<?php bloginfo('name'); ?>">
                </a>
            </h1>
        </div>
        <button class="menu-button" id="btnMenu" aria-label="Open Menu" data-menu-id="MainMenu"></button>
        <div class="header-content">
            <div id="MainMenu" class="pull-menu-left menubar">
                <div class="header-navigation" role="navigation">
                    <?php menu_nav_list('Primary Navigation', 'header-navigation'); ?>
                </div>
                <div class="header-secondary-navigation" role="navigation">
                    <?php menu_nav_list('Secondary Navigation', 'header-navigation'); ?>
                </div>
                <div class="header-menu">
                    <button class="menu-email square-button" aria-label="Contact me" onclick="HtmlModal('email', ContactModal)"></button>
                    <button class="menu-search square-button" aria-label="Search this site" onclick="HtmlModal('search', SearchModal)"></button>
                    <button class="light-switch square-button" aria-label="Dark mode switch"></button>
                </div>
            </div>
        </div>
    </div>

<?php if ( is_front_page()) : // Front-page header ?>
    <div class="header-homepage"></div>

<?php elseif ( is_attachment() ) : // Attachment page header ?>
    <div class="header-homepage"></div>

<?php elseif ( is_page() ) : // Basic Page header ?>
<?php if (get_the_post_thumbnail()) $featureImage = ' style="background-image:url(' . get_template_directory_uri() . '/assets/images/grain-light.png),url(' . get_the_post_thumbnail_url(get_the_ID(),'full') . ')"'; ?>
    <div class="header-single-page bg-parallax" data-rate="12"<?php echo $featureImage; ?>>
        <?php //the_post_thumbnail( 'full', ['class' => 'image-hero element-parallax', 'data-rate' => '12'] ); ?>
    </div>

<?php else : // Blog Pages and Posts header ?>
    <div class="header-blog bg-parallax" data-rate="12"></div>

<?php endif; ?>

</header>
