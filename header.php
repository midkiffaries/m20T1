<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" >
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
<?php wp_head(); // WordPress generated meta data and scripts ?>

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <meta name="author" content="Ted Balmer | MarchTwenty.com">
    <base href="<?php echo esc_url(home_url()); ?>/" id="SiteURI">
<?php m20T1_metadata(); // Include additional custom meta data ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<?php wp_body_open(); // WordPress body includes ?>

<header class="page-header" role="banner" id="top">
    <a href="#main-content" class="nav-skip">Skip to main content</a>
    <div class="header-menubar">
        <div class="header-title">
            <p class="header-logo" itemprop="title">
                <a href="<?php echo esc_url(home_url()); ?>" rel="bookmark"><?php m20T1_logo(); ?></a>
            </p>
            <div class="header-breadcrumbs"><?php if ( !is_front_page() ) breadcrumb_trail(); // Show breadcrumb trail ?></div>
        </div>
        <button class="menu-button" id="btnMenu" aria-label="Open Menu" data-menu-id="MainMenu"></button>
        <div class="header-content">
            <div id="MainMenu" class="pull-menu-left menubar">
                <div class="header-navigation" role="navigation">
                    <?php menu_nav_list('Primary Navigation', 'primary-navigation'); // Main Navigation ?>
                </div>
                <div class="header-secondary-navigation" role="navigation">
                    <?php menu_nav_list('Secondary Navigation', 'secondary-navigation'); // Secondary Navigation ?>
                </div>
                <div class="header-widgets">
                    <?php dynamic_sidebar( 'header' ); // Header Widgets ?>
                </div>
            </div>
        </div>
    </div>

    <?php HeaderFeaturedImage(get_the_ID()); // Display featured image in background ?>

</header>