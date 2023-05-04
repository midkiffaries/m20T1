<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> id="top-of-site">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); // WordPress generated meta data and scripts ?>
</head>

<body <?php body_class(); // Add classes to the body tag ?> itemscope itemtype="http://schema.org/WebPage">

<?php wp_body_open(); // WordPress body includes ?>

<header class="page-header">
    <a href="#main-content" class="nav-skip">Skip to main content</a>
    <div class="header-menubar">
        <div class="header-title">
            <p class="header-logo" itemprop="name headline">
                <a href="<?=home_url(); ?>" rel="home" itemprop="url"><span class="hidden" aria-hidden="true"><?=bloginfo('name'); ?></span><?=get_custom_logo(); ?></a>
            </p>
            <div class="header-breadcrumbs" itemprop="breadcrumb"><?php if ( !is_front_page() ) breadcrumb_trail(); // Show breadcrumb trail ?></div>
        </div>
        <button class="menu-button" id="btnMenu" aria-label="Open Menu" data-menu-id="MainMenu"></button>
        <div class="header-content">
            <div id="MainMenu" class="pull-menu-left menubar" itemscope itemtype="https://schema.org/SiteNavigationElement">
                <div class="header-navigation">
                    <?php menu_nav_list('Primary Navigation', 'primary-navigation'); // Main Navigation ?>
                </div>
                <div class="header-secondary-navigation">
                    <?php menu_nav_list('Secondary Navigation', 'secondary-navigation'); // Secondary Navigation ?>
                </div>
                <div class="header-widgets">
                    <?php dynamic_sidebar( 'header' ); // Header Widgets ?>
                </div>
            </div>
        </div>
    </div>

    <?php Header_Hero(get_the_ID()); // Display featured image in background ?>

</header>