<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php include 'metadata.php'; ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<?php if ( is_front_page() ) : // Front Page ?>
<header class="page-header hero-header">
    <div class="hero-layer-1 bg-parallax" data-rate="12"></div>

<?php else : // All Other Pages ?>
<header class="page-header basic-header">
    <div class="hero-layer-1"></div>

<?php endif; ?>

    <div class="header-logo">
        <h1><a href="<?php echo SITE_ADDRESS . $_SERVER['REQUEST_URI']; ?>" rel="bookmark">
            <img src="<?php bloginfo('template_url'); ?>/assets/images/logo/logo-full.svg" alt="<?php bloginfo('name'); ?>"></a></h1>
        <p class="header-slogan"><?php bloginfo('description'); ?></p>
    </div>
    <div class="header-navigation">
        <button class="menu-button" id="btnMenu" aria-label="Open Menu"></button>
        <div class="header-menu" role="navigation" aria-label="Primary">
<?php menu_nav_list('Primary Nav', 'header'); ?>

            <button class="menu-email-button" aria-label="Email me" onclick="openDialog('email', ContactModal)"></button>
            <button class="menu-search-button" aria-label="Search this site" onclick="openDialog('search', SearchModal)"></button>
            <button class="light-switch" aria-label="Dark mode switch"></button>
        </div>
    </div>
</header>

<main class="page-main">
    <div class="page-content">
