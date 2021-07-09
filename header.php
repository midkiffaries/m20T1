<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" <?php language_attributes(); ?>>
<head>
<?php include 'metadata.php'; ?>

</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
<?php wp_body_open(); ?>

<header class="page-header" role="banner" id="top">
    <div class="header-menubar">
        <div class="header-title">
            <h1 class="header-logo" itemprop="title">
                <a href="/" rel="bookmark">
                    <img class="logo-image" src="<?php bloginfo('template_url'); ?>/assets/logos/logo-img.svg" alt="Logo">
                    <img class="logo-text" src="<?php bloginfo('template_url'); ?>/assets/logos/logo-text.svg" alt="<?php bloginfo('name'); ?>">
                </a>
            </h1>
        </div>
        <button class="menu-button" id="btnMenu" aria-label="Open Menu" data-menu-id="MainMenu"></button>
        <div class="header-content">
            <div id="MainMenu" class="pull-menu-left menubar">
                <div class="header-navigation" role="navigation">
                    <?php menu_nav_list('Primary Nav', 'header'); ?>
                </div>
                <div class="header-menu">
                    <button class="menu-email square-button" aria-label="Contact me" onclick="HtmlModal('email', ContactModal)"></button>
                    <button class="menu-search square-button" aria-label="Search this site" onclick="HtmlModal('search', SearchModal)"></button>
                    <button class="light-switch square-button" aria-label="Dark mode switch"></button>
                </div>
            </div>
        </div>
    </div>

<?php if ( is_front_page() ) : // Front Page ?>
    <div class="header-hero"></div>
<?php else : // All Other Pages ?>
    <div class="header-simple bg-parallax" data-rate="12"></div>
<?php endif; ?>

</header>
