<?php 
// Head meta data 
?>
<meta charset="<?php bloginfo('charset'); ?>">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,viewport-fit=cover">
<link rel="profile" href="http://gmpg.org/xfn/11">
<title><?php bloginfo('name'); wp_title('|', true, 'left'); ?></title>
<meta name="title" content="<?php bloginfo('name'); wp_title('|', true, 'left'); ?>">
<base href="<?php echo SITE_ADDRESS; ?>/">
<meta name="description" content="<?php if (is_single()) {
        single_post_title('', true); echo " - "; echo wp_strip_all_tags(get_the_excerpt(), true);
    } else {
        bloginfo('description'); echo " - "; echo TAGLINE_MORE;
    } ?>">
<meta name="author" content="Ted Balmer | MarchTwenty.com">
<meta name="generator" content="WordPress <?php echo get_bloginfo('version'); ?>">
<meta name="rating" content="General">
<meta name="robots" content="index,follow">
<meta name="googlebot" content="index,follow">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo SITE_ADDRESS; ?>/feed/">
<link rel="canonical" href="<?php echo SITE_ADDRESS . $_SERVER['REQUEST_URI']; ?>">
<link rel="dns-prefetch" href="//marchtwenty.com">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<!-- Stylesheets -->
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/tedilize.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600&display=swap">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo SITE_ADDRESS; ?>/icons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo SITE_ADDRESS; ?>/icons/favicon-16x16.png">
<!-- Apple -->
<meta name="apple-mobile-web-app-title" content="<?php echo SHORT_SITE_TITLE; ?>">
<meta name="format-detection" content="telephone=no">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo SITE_ADDRESS; ?>/icons/apple-touch-icon.png">
<link rel="mask-icon" href="<?php echo SITE_ADDRESS; ?>/icons/safari-pinned-tab.svg" color="<?php echo SITE_COLOR; ?>">
<!-- Google -->
<meta name="application-name" content="<?php echo SHORT_SITE_TITLE; ?>">
<link rel="manifest" href="<?php echo SITE_ADDRESS; ?>/manifest.json">
<link rel="icon" type="image/png" href="<?php echo SITE_ADDRESS; ?>/icons/android-chrome-512x512.png" sizes="512x512">
<meta name="theme-color" content="#ffffff">
<!-- Microsoft -->
<meta name="msapplication-config" content="<?php echo SITE_ADDRESS; ?>/browserconfig.xml">
<meta name="msapplication-TileColor" content="#296aa3">
<meta name="msapplication-TileImage" content="<?php echo SITE_ADDRESS; ?>/icons/mstile-310x310.png">
<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
<meta property="og:title" content="<?php bloginfo('name'); wp_title('|', true, 'left'); ?>">
<meta property="og:description" content="<?php bloginfo('description'); ?> <?php echo TAGLINE_MORE; ?>">
<meta property="og:image" content="<?php echo SITE_ADDRESS; ?>/icons/m20-share.jpg">
<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
<meta property="twitter:title" content="<?php bloginfo('name'); wp_title('|', true, 'left'); ?>">
<meta property="twitter:description" content="<?php bloginfo('description'); ?> <?php echo TAGLINE_MORE; ?>">
<meta property="twitter:image" content="<?php echo SITE_ADDRESS; ?>/icons/m20-share.jpg">
<!-- Global site tag gtag.js - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-136801430-1"></script>
<script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","UA-136801430-1");</script>
<!-- Wordpress Data -->
<?php //wp_head(); ?>
<link rel="stylesheet" id="wp-block-library-css" href="http://localhost:8888/WP-marchtwenty/wp-includes/css/dist/block-library/style.min.css" type="text/css" media="all">