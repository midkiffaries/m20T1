<?php include 'config.php'; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,viewport-fit=cover">
<link rel="profile" href="http://gmpg.org/xfn/11">
<title><?php bloginfo('name'); wp_title('|', true, 'left'); ?></title>
<meta name="title" content="<?php bloginfo('name'); wp_title('|', true, 'left'); ?>">
<meta name="description" content="<?php if (is_single()) {
        echo wp_strip_all_tags(get_the_excerpt(), true);
    } else {
        printf("%s - %s", bloginfo('description'), $config->Tagline);
    } ?>">
<meta name="author" content="Ted Balmer | MarchTwenty.com">
<meta name="rating" content="General">
<meta name="robots" content="index,follow">
<meta name="googlebot" content="index,follow">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php printf(SITE_ADDRESS); ?>/feed/">
<base href="<?php printf(SITE_ADDRESS); ?>/">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<?php // Stylesheets ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/tedilize.css">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" sizes="32x32" href="<?php printf("%s/icons/favicon-32x32.png", SITE_ADDRESS); ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php printf("%s/icons/favicon-16x16.png", SITE_ADDRESS); ?>">
<?php // Apple ?>
<meta name="apple-mobile-web-app-title" content="<?php printf($config->ShortTitle); ?>">
<meta name="format-detection" content="telephone=no">
<link rel="apple-touch-icon" sizes="180x180" href="<?php printf("%s/icons/apple-touch-icon.png", SITE_ADDRESS); ?>">
<link rel="mask-icon" href="<?php printf("%s/icons/safari-pinned-tab.svg", SITE_ADDRESS); ?>" color="<?php printf($config->BaseColor); ?>">
<?php // Google ?>
<meta name="application-name" content="<?php printf($config->ShortTitle); ?>">
<link rel="manifest" href="<?php printf("%s/manifest.json", SITE_ADDRESS); ?>">
<link rel="icon" type="image/png" href="<?php printf("%s/icons/android-chrome-512x512.png", SITE_ADDRESS); ?>" sizes="512x512">
<meta name="theme-color" content="<?php printf($config->BaseColor); ?>">
<?php // Microsoft ?>
<meta name="msapplication-config" content="<?php printf("%s/browserconfig.xml", SITE_ADDRESS); ?>">
<meta name="msapplication-TileImage" content="<?php printf("%s/icons/mstile-310x310.png", SITE_ADDRESS); ?>">
<?php // Facebook ?>
<meta property="og:type" content="website">
<meta property="og:url" content="<?php the_permalink(); ?>">
<meta property="og:title" content="<?php bloginfo('name'); wp_title('|', true, 'left'); ?>">
<meta property="og:image" content="<?php printf("%s/icons/m20-share.jpg", SITE_ADDRESS); ?>">
<meta property="og:description" content="<?php if (is_single()) {
        echo wp_strip_all_tags(get_the_excerpt(), true);
    } else {
        printf("%s - %s", bloginfo('description'), $config->Tagline);
    } ?>">
<?php // Twitter ?>
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?php the_permalink(); ?>">
<meta property="twitter:title" content="<?php bloginfo('name'); wp_title('|', true, 'left'); ?>">
<meta property="twitter:image" content="<?php printf("%s/icons/social-share.jpg", SITE_ADDRESS); ?>">
<meta property="twitter:description" content="<?php if (is_single()) {
        echo wp_strip_all_tags(get_the_excerpt(), true);
    } else {
        printf("%s - %s", bloginfo('description'), $config->Tagline);
    } ?>">
<?php // Global site tag gtag.js - Google Analytics ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-136801430-1"></script>
<script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","UA-136801430-1");</script>
<?php wp_head(); ?>
</head>