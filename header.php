<?php include 'metadata.php'; ?>


<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<header class="page-header">
    <div class="header-title">
        <h1 class="header-logo" itemprop="title">
            <a href="/" rel="bookmark">
                <img class="logo-image" src="<?php bloginfo('template_url'); ?>/assets/images/logo/logo-img.svg" alt="Logo">
                <img class="logo-text" src="<?php bloginfo('template_url'); ?>/assets/images/logo/logo-text.svg" alt="<?php bloginfo('name'); ?>">
            </a>
        </h1>
    </div>

    <div class="header-content">
        <div class="header-navigation">
            <button class="menu-button" id="btnMenu" aria-label="Open Menu" data-menu-id="MainMenu"></button>
            <div class="pull-menu-top" id="MainMenu" role="navigation">
                <?php menu_nav_list('Primary Nav', 'header'); ?>
            </div>
        </div>
        <div class="header-menu">
            <button class="menu-email-button" aria-label="Email me" onclick="HtmlModal('email', ContactModal)"></button>
            <button class="menu-search-button" aria-label="Search this site" onclick="HtmlModal('search', SearchModal)"></button>
            <button class="light-switch" aria-label="Dark mode switch"></button>
        </div>
    </div>

<?php if ( is_front_page() ) : // Front Page ?>
    <div class="header-homepage hero-head bg-parallax" data-rate="12">
        <p class="header-slogan" itemprop="subtitle"><?php bloginfo('description'); ?></p>
    </div>
<?php else : // All Other Pages ?>
    <div class="header-page basic-head"></div>
<?php endif; ?>

</header>
