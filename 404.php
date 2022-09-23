<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-error" id="main-content" role="main">
    <div class="page-content width-full">

    <article class="page-404 page type-page not-found status-publish" id="page-404" name="page-404" role="article" itemscope itemtype="http://schema.org/NewsArticle">
        <div class="page-404-container">
            <div class="page-404-image">
                <?php echo PAGE_404_IMAGE; ?>
            </div>
            <h1 class="page-title" itemprop="name">Page Not Found</h1>
            <div class="content-404" itemprop="description">                
                <?php echo PAGE_404_CONTENT; // Error Message ?>

                <?php get_search_form('error'); // Search Form ?>
                
            </div>
        </div>
    </article>

    </div>
</main>

<?php get_footer(); ?>