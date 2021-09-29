<?php
// Insert slogan in front_page title 
if (is_front_page()) { // Front Page
    $title_slogan = " | " . get_bloginfo('description');
} else { // All other pages
    $title_slogan = "";
}
// Get page description excerpt or site slogan
if (is_single() || is_page()) { // If single blog post
    $excerpt = html_entity_decode(wp_strip_all_tags(get_the_excerpt(), true));
    $description = substr($excerpt, 0, 250) . "...";
} else { // Else all other pages
    $description = get_bloginfo('description') . " " . $config->Tagline;
}
// Get page Featured image
if (get_the_post_thumbnail()) { // Use page's featured image
    $featuredImage = get_the_post_thumbnail_url($post->ID, 'large');
} else { // Use default image
    $featuredImage = get_template_directory_uri() . "/assets/images/social-share.jpg";
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" >
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,viewport-fit=cover">
<link rel="profile" href="http://gmpg.org/xfn/11">
<title><?php bloginfo('name'); wp_title('|', true, 'left'); echo $title_slogan; ?></title>
<meta name="title" content="<?php bloginfo('name'); wp_title('|', true, 'left'); ?>">
<meta name="author" content="Ted Balmer | MarchTwenty.com">
<meta name="rating" content="General">
<meta name="robots" content="index,follow">
<meta name="googlebot" content="index,follow">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php bloginfo('rss2_url'); ?>">
<base href="<?php echo home_url(); ?>/" id="SiteURI">
<link rel="stylesheet" href="<?php echo get_template_directory_uri() . "/assets/css/tedilize.css"; ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri() . "/assets/css/layout.css"; ?>">
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
<meta name="description" content="<?php echo $description; ?>">
<?php // Favicon ?>
<link rel="icon" type="image/png" sizes="32x32" href="<?php printf("%s/icons/favicon-32x32.png", home_url()); ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php printf("%s/icons/favicon-16x16.png", home_url()); ?>">
<?php // Apple ?>
<meta name="apple-mobile-web-app-title" content="<?php printf($config->ShortTitle); ?>">
<meta name="format-detection" content="telephone=no">
<link rel="apple-touch-icon" sizes="180x180" href="<?php printf("%s/icons/apple-touch-icon.png", home_url()); ?>">
<link rel="mask-icon" href="<?php printf("%s/icons/safari-pinned-tab.svg", home_url()); ?>" color="<?php printf($config->BaseColor); ?>">
<?php // Google ?>
<meta name="application-name" content="<?php printf($config->ShortTitle); ?>">
<link rel="manifest" href="<?php printf("%s/manifest.json", home_url()); ?>">
<link rel="icon" type="image/png" href="<?php printf("%s/icons/android-chrome-512x512.png", home_url()); ?>" sizes="512x512">
<link rel="icon" type="image/png" href="<?php printf("%s/icons/android-chrome-192x192.png", home_url()); ?>" sizes="192x192">
<meta name="theme-color" content="<?php printf($config->BaseColor); ?>">
<?php // Facebook ?>
<meta property="og:type" content="website">
<meta property="og:url" content="<?php the_permalink(); ?>">
<meta property="og:title" content="<?php bloginfo('name'); wp_title('|', true, 'left'); ?>">
<meta property="og:image" content="<?php echo $featuredImage; ?>">
<meta property="og:description" content="<?php echo $description; ?>">
<?php // Twitter ?>
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?php the_permalink(); ?>">
<meta property="twitter:title" content="<?php bloginfo('name'); wp_title('|', true, 'left'); ?>">
<meta property="twitter:image" content="<?php echo $featuredImage; ?>">
<meta property="twitter:description" content="<?php echo $description; ?>">
<?php wp_head(); ?>

<?php header_extended(); ?>

</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
<?php wp_body_open(); ?>

<header class="page-header" role="banner" id="top">
    <div class="header-menubar">
        <div class="header-title">
            <h1 class="header-logo" itemprop="title">
                <a href="<?php echo home_url(); ?>" rel="bookmark">
                    <img class="logo-image" src="<?php echo get_template_directory_uri(); ?>/assets/logos/logo-img.svg" alt="Logo">
                    <img class="logo-text" src="<?php echo get_template_directory_uri(); ?>/assets/logos/logo-text.svg" alt="<?php bloginfo('name'); ?>">
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

<?php if ( is_front_page() ) : // Front-page header ?>
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
