<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-error" id="main-content" itemscope itemtype="https://schema.org/Article" itemprop="mainEntity">
    <div class="page-content width-full">

    <article class="page-404 page type-page not-found status-publish" id="page-404" itemscope itemtype="https://schema.org/NewsArticle">
        <div class="page-404-container">
            <div class="page-404-image">
                <?=PAGE_404_IMAGE; // Error Image ?>
            </div>
            <h1 class="page-title" itemprop="name headline">Page Not Found</h1>
            <div class="content-404" itemprop="text articleBody">
                <?=PAGE_404_CONTENT; // Error Message ?>

                <?=get_search_form('error'); // Search Form ?>
                
            </div>
        </div>
    </article>

    </div>
</main>

<?php get_footer(); ?>