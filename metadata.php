<?php include 'config.php'; ?>
<?php
// Get page description excerpt
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
<meta name="author" content="Ted Balmer | MarchTwenty.com">
<meta name="description" content="<?php echo $description; ?>">
<meta name="rating" content="General">
<meta name="robots" content="index,follow">
<meta name="googlebot" content="index,follow">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php bloginfo('rss2_url'); ?>">
<base href="<?php echo home_url(); ?>/">
<?php // Google Fonts ?>
<link rel="preconnect" href="https://fonts.googleapis.com/" crossorigin>
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link rel="dns-prefetch" href="https://fonts.gstatic.com/">
<?php printf($config->GoogleFonts); ?>
<?php // Stylesheets ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri() . "/assets/css/tedilize.css"; ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri() . "/assets/css/layout.css"; ?>">
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
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
<?php // Global site tag gtag.js - Google Analytics ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-136801430-1"></script>
<script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","UA-136801430-1");</script>