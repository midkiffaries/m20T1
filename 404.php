<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-error width-full" id="main-content" itemscope itemtype="https://schema.org/Article" itemprop="mainEntity">
    <div class="page-content">

    <article class="page-404 page type-page not-found status-publish" id="page-404" itemscope itemtype="https://schema.org/NewsArticle">
        <div class="page-404-container">
            <div class="page-404-image">
                <?=get_option('404_image') ? '<img src="'.esc_url(get_option('404_image')).'" loading="lazy" decoding="async" itemprop="image" alt="404 Error" fetchpriority="auto" style="max-width:500px">' : '<svg role="img" aria-label="404" xmlns="http://www.w3.org/2000/svg" width="450" height="200" viewBox="0 0 97 39"><radialGradient id="a" cx="107.5" cy="26.2" r="48.2" gradientTransform="matrix(1 0 0 .4 0 16.3)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#fff7bf"/><stop offset="1" stop-color="#ffd205"/></radialGradient><path fill="#d4aa00" d="M17.8 31.5H0v-8L17.8 2.3h8.5V24h4.4v7.6h-4.4v6.6h-8.5zm0-7.6V13L8.4 24zm16-3.5q0-10 3.6-14t11-4q3.6 0 5.8.8 2.3.9 3.8 2.3 1.4 1.4 2.2 3 .9 1.5 1.4 3.5 1 4 1 8.2 0 9.6-3.3 14-3.2 4.5-11.2 4.5-4.4 0-7.1-1.4-2.8-1.4-4.5-4.2-1.3-2-2-5.3-.7-3.4-.7-7.4zm9.7 0q0 6.7 1.2 9.2Q45.9 32 48 32q1.5 0 2.6-1 1-1 1.6-3.3.5-2.3.5-7 0-7-1.2-9.5-1.2-2.4-3.5-2.4-2.5 0-3.5 2.5-1.1 2.4-1.1 9zm39.9 11.1H65.6v-8L83.4 2.3h8.5V24h4.4v7.6H92v6.6h-8.5zm0-7.6V13L74 24z"/><path fill="url(#a)" d="M77.1 37.2H59.3v-8L77.1 8h8.6v21.7H90v7.5h-4.4v6.6H77zm0-7.5V18.6l-9.4 11zm16-3.6q0-10 3.6-14t11-4q3.6 0 5.9.8 2.2.9 3.7 2.3 1.4 1.4 2.2 3 .9 1.5 1.4 3.6 1 3.9 1 8.2 0 9.5-3.3 14-3.2 4.4-11.1 4.4-4.5 0-7.2-1.4t-4.5-4q-1.3-2-2-5.4-.7-3.3-.7-7.4zm9.7 0q0 6.7 1.2 9.2 1.2 2.4 3.4 2.4 1.5 0 2.6-1t1.6-3.3q.5-2.3.5-7 0-7-1.2-9.4-1.1-2.5-3.5-2.5t-3.5 2.5q-1 2.5-1 9.1zm39.9 11.1h-17.8v-8L142.7 8h8.5v21.7h4.4v7.5h-4.4v6.6h-8.5zm0-7.5V18.6l-9.4 11z" transform="translate(-59.3 -8)"/></svg>';?>
            </div>
            <h1 class="page-title" itemprop="name headline">Page Not Found</h1>
            <div class="content-404" itemprop="text articleBody">
                <p><?=get_option('404_text') ? nl2br(clean_html(get_option('404_text'))) : "That page must have been deleted or is otherwise inaccessable."; // Error Message ?></p>
                
                <?=get_search_form('error'); // Search Form ?>
                
            </div>
        </div>
    </article>

    </div>
</main>

<?php get_footer(); ?>