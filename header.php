<?php include 'metadata.php'; ?>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<?php if ( is_front_page() ) : // Front Page ?>
<header class="page-header hero-header">
    <div class="layer-1 bg-parallax" data-rate="12"></div>

<?php else : // All Other Pages ?>
<header class="page-header basic-header">
    <div class="basic-header-content"></div>

<?php endif; ?>

    <div class="header-content">
        <h1 class="header-logo"><a href="/" rel="bookmark">
            <img src="<?php bloginfo('template_url'); ?>/assets/images/logo/logo-img.svg" alt="Logo" class="logo-image"> <img src="<?php bloginfo('template_url'); ?>/assets/images/logo/logo-text.svg" alt="<?php bloginfo('name'); ?>" class="logo-text">
        </a></h1>
        <p class="header-slogan"><?php bloginfo('description'); ?></p>
    </div>
    <div class="header-navigation">
        <button class="menu-button" id="btnMenu" aria-label="Open Menu"></button>
        <div class="header-menu" role="navigation" aria-label="Primary">
<?php menu_nav_list('Primary Nav', 'header'); ?>

            <button class="menu-email-button" aria-label="Email me" onclick="HtmlModal('email', ContactModal)"></button>
            <button class="menu-search-button" aria-label="Search this site" onclick="HtmlModal('search', SearchModal)"></button>
            <button class="light-switch" aria-label="Dark mode switch"></button>
        </div>
    </div>
</header>

<main class="page-main">
    <div class="page-content">
