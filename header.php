<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" >
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <?php wp_head(); // WordPress generated meta data and scripts ?>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <base href="<?php echo esc_url(home_url()); ?>/" id="SiteURI">
    <meta name="author" content="Ted Balmer | MarchTwenty.com">
    <?php m20T1_metadata(); // Include additional meta data ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<?php wp_body_open(); // Wordpress body includes ?>

<header class="page-header" role="banner" id="top">
    <a href="#main-content" class="nav-skip">Skip to main content</a>
    <div class="header-menubar">
        <div class="header-title">
            <h1 class="header-logo" itemprop="title">
                <a href="<?php echo esc_url(home_url()); ?>" rel="bookmark"><?php m20T1_logo(); ?></a>
            </h1>
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

<?php if (get_the_post_thumbnail()) $featuredImage = ' style="background-image:url(' . get_template_directory_uri() . '/assets/images/grain-light.png),url(' . get_the_post_thumbnail_url(get_the_ID(),'full') . ')"'; // Set Header background image ?>

<?php if ( is_front_page()) : // Front-page header (None) ?>
    <div class="header-homepage">
        <h2 class="page-title hidden" itemprop="title"><?php the_title(); ?></h2>
    </div>

<?php elseif ( is_attachment() || is_404() ) : // Attachment and 404 page headers (None) ?>
    <div class="header-noimage"></div>

<?php elseif ( is_page() ) : // Basic Page and privacy-policy header (Use Featured Image) ?>
    <div class="header-single-page bg-parallax" data-rate="12"<?php echo $featuredImage; ?>>
        <!--h2 class="page-title" itemprop="title"><?php the_title(); ?></h2-->
    </div>

<?php elseif ( is_single() ) : // Single blog post (Use Featured Image) ?>
    <div class="header-single-post bg-parallax" data-rate="12"<?php echo $featuredImage; ?>></div>

<?php else : // Blog Page, search page and archives header (Use default Image) ?>
    <div class="header-blog bg-parallax" data-rate="12"></div>

<?php endif; ?>

</header>