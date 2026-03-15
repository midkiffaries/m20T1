<?php defined( 'ABSPATH' ) || exit; // Exit if accessed directly ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?=language_attributes();?> id="top-of-site">
<head>
<?=m20t1_head();?>
<?=wp_head();?>
</head>

<body <?=body_class(); // Add classes to the body tag ?> itemscope itemtype="https://schema.org/<?=custom_page_scheme(get_the_ID());?>">

<!-- <div class="apple-header-bg" style="background-color:var(--wp--preset--color--primary-dark);width:100%;height:6px;position:fixed;"></div> -->

<?=wp_body_open(); // WordPress body includes ?>

<div class="body-container">
    <header class="page-header">
        <a href="#main-content" class="nav-skip">Skip to main content</a>
        <div class="header-menubar">
            <div class="header-title">
                <p class="header-logo" itemprop="name headline">
                    <a href="<?=home_url();?>" rel="home" itemprop="url"><?=get_custom_logo();?></a>
                </p>
                <div class="header-breadcrumbs"><?php echo do_blocks( '<!-- wp:breadcrumbs {"separator": "' . BREADCRUMB_SEPARATOR . '", "showCurrentItem":true} /-->' );?></div>
            </div>
            <button class="menu-button" id="btnMenu" aria-label="Open Menu" data-menu-id="MainMenu"></button>
            <div class="header-content">
                <div id="MainMenu" class="pull-menu-left menubar">
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

    <div class="body-top-background"><?php // Background embellishments ?></div>
    <?php if (is_page() || is_single()) : ?>
    <div class="hero-reflection" style="<?=FeaturedImageURL(get_the_ID(), 'full', 1);?>"></div>
    <?php endif; ?>