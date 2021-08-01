<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" >
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,viewport-fit=cover">
<link rel="profile" href="http://gmpg.org/xfn/11">
<title><?php bloginfo('name'); wp_title('|', true, 'left'); ?></title>
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
<?php metadata(); ?>
<?php wp_head(); ?>
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
                <!--div class="header-secondary-navigation" role="navigation">
                    <?php menu_nav_list('Secondary Navigation', 'header-navigation'); ?>
                </div-->
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
