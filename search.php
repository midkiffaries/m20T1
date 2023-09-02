<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-search" id="main-content" itemscope itemtype="https://schema.org/Article" itemprop="mainEntity">
    <div class="page-content width-side" role="feed">

    <?php if (have_posts() && get_search_query()) : // Search results ?>

    <section class="search-page-form" id="search-page">
        <div>
            <h1 class="page-title" itemprop="name headline">Your search netted <b><?=SearchCount($s); ?></b> result(s)</h1>
            <?php get_search_form('search'); // Search form ?>
        </div>
    </section>

    <section class="search-results" itemscope itemtype="https://schema.org/SearchResultsPage">

    <?php while (have_posts()) : the_post(); // List posts and pages ?>
        <article class="post-<?php the_ID(); ?> post type-post status-publish format-standard hentry" id="post-<?php the_ID(); ?>" itemscope itemtype="https://schema.org/NewsArticle">
            <div class="post-container">
                <header class="entry-header">
                    <h2 class="entry-title" id="<?=$post->post_name; ?>" itemprop="name"><a href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a></h2>
                    <div class="entry-info">
                        <span class="entry-type" itemprop="articleSection"><?=get_post_type(); ?></span>
                        <span class="entry-date"><time datetime="<?=get_the_date('c'); ?>" itemprop="datePublished"><?=get_the_date(); ?></time></span>
                        <span class="entry-author"><?=post_separator(); ?> Written By <a href="<?=get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
                    </div>
                </header>
                <div class="the-content content-excerpt">
                    <img class="entry-square-thumbnail" src="<?=FeaturedImageURL(get_the_ID(), 'thumbnail', false); ?>" alt="" itemprop="image" loading="lazy" fetchpriority="low">
                    <p itemprop="description articleBody"><?=shorten_the_content($post->post_content); ?></p>
                    <p class="entry-readmore hidden"><a href="<?php the_permalink(); ?>" rel="bookmark">Continue reading...</a></p>
                </div>
                <footer class="entry-footer hidden">
                </footer>
            </div>
        </article>
    <?php endwhile; ?>

    </section>

    <section class="blog-pagination" aria-label="Search Pagination">
        <div class="pagination-container">
            <nav class="blog-post-nav">
                <?php blog_post_pagination('Results'); // Search results navigation ?>
            </nav>
        </div>
    </section>

    <?php else : // If no posts exist ?>

    <section class="search-page-form" id="search-page">
        <div>
            <h1 class="page-title" itemprop="name headline">Your search netted <strong><?=SearchCount($s); ?></strong> result(s)</h1>
            <?php get_search_form('search'); // Search form ?>
        </div>
    </section>

    <article class="search-results" itemscope itemtype="http://schema.org/SearchResultsPage">
        <div class="the-content aligncenter" itemprop="text">
            <p>The search query of <strong><?=esc_attr(get_search_query()); ?></strong> came up empty.</p>
            <p>If it will make you feel better, this probably happens to Google too.</p>
            <div class="page-search-image">
                <?=get_option('search_image') ? '<img src="'.get_option('search_image').'" loading="lazy" decoding="async" itemprop="image" alt="" fetchpriority="low" style="max-width:500px">' : '<svg clip-rule="evenodd" role="img" height="454" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" width="526" xmlns="http://www.w3.org/2000/svg"><path d="m48.6 338c-1 8.5 2.7 16.7 3.5 25 1.5 10.7 4.4 21.6 1.3 32.3a66.9 66.9 0 0 1 -10.8 22.3c-3.6 8.7 4.8 17.8 13.4 18.4 12.1 0 25.6 2.3 36.5-4.8 5.4-4 10.6-10 9-17.1-1-13-1-26.2-1-39.2-1.2-5.4-.4-14-8-14.3-15-2.9-31-8.7-40-19.8-1.2-1-2.4-2.3-4-2.8zm157.4 79c2.2-4.3 15.8-21.2 8.5-22-18.8-13.8-8.7-26.4-38-24.3-.4 3 .5 6.1.5 9.2.4 3.3.4 7-1.8 9.8-2.7 4.4-6.7 8-8.4 12.9-.5 3.5-.9 7.9 2 10.5a37.6 37.6 0 0 0 37.2 4z" fill="#502d16"/><path d="m159.1 369.3c-24.7-5.2-33.2-21.6-10.8-34 1-24 62 0 54.7-44.5-3.4-23-39.8-53.4-40.3-54-5.4 2-32.3 9.6-23.7-1.6 5.6-12.9-1.7-30.4-16.3-32.8-10.9-3.8-19.3 8-29.8 5.5-26.7-9.4-42.8 1.3-49.7-1-10.1-8.2-26-8.3-33.9 3.2-8.2 9.6-2.2 22.5.2 33-4 7.7-5.8 16.2-8.3 24.5-2 15-2.6 32.4 8 44.5a65.6 65.6 0 0 0 34.8 21.4c5.8 6.2 14.7 17.3 22.8 21.3 10.6 8.5 23.3 1.8 33.3 10.9 10.6 15.9 7.2 35.8 5.7 53.7-6.4 6-14.4 15-10.6 24.6 8.4 11 24.3 10 36.4 7.7 9.3-2.4 24.2-5.1 25.3-16.5 0-16-.8-31.9.7-47.8.2-6-.6-12.3 1.4-18.1z" fill="#784421"/><path d="m291.3 384.5c-3.1 3.8 0 9.1-2 13.5-2.5 14-16.2 30.6-9.8 42.3 4 6 11.3 8 17.8 10 12 2.9 24.5 1.5 36.6 0 7.5-.8 15.4-3.9 19.5-10.6 1.8-3.3.4-7.2.9-10.8-.3-9.5-6-16.4-8.4-24.8-1.4-3.4 2.3-10.1-2.8-11-18.9 6-37.7-7-51.8-8.6z" fill="#803300"/><path d="m212.8 102.3c33.4-18.1 84.2-84.2 95.2-95.5 11-11.2 14.3-6.6 20.7-.3 6.5 6.2 44.9 73.5 88 95.6l-40 22.8c8.7 17 46.6 22.2 68.8 40.2-3.4 25.1-33 28.3-35 42.2 10.5 8.4 51.2 28 76.9 42l-50 35.3c-4.2 14.5 24.7 24 78.2 41.1 4 23.2-39.8 32.1-72.5 44l-32.5 28.5-45.8-14-44.8 11.8-31.8-10-64.4 7.8-23.7-28.3c-27.8-10.9-61.7-8.5-78.8-34 25.4-18.5 65.4-17.5 71.1-42-3.8-17.6-40.1-12.7-41.3-48 26.3-12 80.5-25.3 77.9-35l-39.6-28.5c18.3-18.9 67.6-39.8 77.5-52.5-18.1-7.7-51.5-4.3-54-23.2z" fill="#00b513"/><path d="m49.6 240.5c7.7 0-4.1 11.8-8.4 12.9-2.2.5-19.8 4.6-11.2-2.3 2.5-2 7.9-1.3 11-3.6 2.6-2 5.5-7 8.6-7zm50 1.2c-7.7 0 4 11.8 8.4 12.9 2.1.5 19.8 4.6 11.2-2.3-2.5-2-8-1.3-11-3.6-2.7-2-5.6-7-8.6-7z" fill="#482f13" stroke="#482f13" stroke-width=".3"/><path d="m227.8 395.8c-8.7 0-9.4-4.5-12.3 5.1-1.3 3.4-4.8 5.2-6.8 8-2.5 4-4.6 8.9-3.4 13.6a20 20 0 0 0 10.8 10 37 37 0 0 0 18.5 2c4.6-.2 9.4.4 13.8-1.3 4.6-1.5 9.6-3.3 12.8-7.2 1.7-2.9.7-6.4 1-9.5-.4-5-1.7-21.1-3.4-23.2a149 149 0 0 1 -31 2.5z" fill="#784421"/><path d="m151.3 241c-8.9 20.1 12.2 40.8 31.5 41.9 14 1 7.7 12.1 3.5 18.7 3.4 20.5 31 15 45.3 10.8 14-.5 28-20.6 39.8-13.6-.1 16 5 29.2 16.3 40.7 7.8 15-10.3 24.6-21 31a78.7 78.7 0 0 1 -49.4 8.2c-20.4-10.5-2.3-33 9.3-42.9 7-4.3 11.4-25.3-1.2-13.3-10 13-21 27.2-39.1 27.6a85.5 85.5 0 0 1 -55.2-12.7c-5.7-12.2-17.6-4.4-11.2 6 7.2 19.3 30.5 28 49.2 29.3 18.6 3.8 20.4-1.3 31.1 14 13.5 15.5 40.9 13 58.8 8.5 14.9-6.2 30.4-13.7 44-1a62 62 0 0 0 50.2-1.5c16-8.5 29 6.1 44.7 6.8 12.8 1.7 33.7 2.6 38-12.2.2-19.6 18.3-17.4 32-15.8 21.8-1 45.5-9.3 57.1-28.8 4.7-16.7-13.7-27-19.8-5.7-17 12.7-40.5 11.8-60 6.4-6.8-5.3-33.6-12.7-22.9 3.7 12.4 15 5.7 41.6-16.5 38.3-21.8-1-38.4-19.8-46.3-38.5-6-10.3-20.8-5.3-9 5.2 12.3 19.8-12 31.8-28.8 28.6-13.7.6-32.3-9.5-27-25.5 6.4-18.1 30.4-10.3 42-22.6 14.7-7.9 22.7-33.6 42.4-25.2a111.1 111.1 0 0 0 46.5 11.2c15.3.3 30.5-2.7 44.9-8-9.2-7.4-41.5-12.4-30.4-26.9 18-2 40.7.9 51.2-17.6 8-12.1-3-25.3-13-12a52.4 52.4 0 0 1 -63.6-9.6c-10-7-14 4.6-3.2 7.5 14 5.6 34 27.8 11.8 37-20.6 13.6-41.2-7.6-60.7-4.3-13.3 8.7-21.5 28.8-40.3 26.4-18-1.7-30.7-19.3-30.9-36.6-4-19.6-16.8.5-25.4 5.2-13.3 9.3-28 19-44.5 20-18.2-2.7-12.3-27.4-.1-34.1-15-.8-30.5 3.9-44.9-2.9-10.2-3.8-23.4-9.8-25.2-21.7z" fill="#028d2c"/><path d="m445.4 165.1c-.8 11.7-13.7 16.3-22.4 21.3-19.8 8.7-42 9.6-63.4 8.9-10.7-2.2-24.1-14.3-33.7-3.3-5.1 8.2-13.4 14.4-23.5 12.4-13.1-.6-23.7-9.4-32.1-18.7a24.3 24.3 0 0 0 -29.3-5.7 110 110 0 0 1 -42 1.7c-5.6-2.3-12.6-8.3-11.4 2 1.4 12.5 15.2 18.5 26.4 18.9 6-.3 18.6-.4 12 8.4-4.9 5.4-19 7.8-21.2 10.8 14.7-1.4 10 14.4 1.8 21.6-5.5 10.2 12.6 9 16 2.5 13.4-9.2 30.2-18.2 46.7-11.8 10.6 5.3 22.7 12 35 7.2 13.4-4.5 24.8-13.7 38.5-17.6a71.3 71.3 0 0 1 35.6 1.4c15.9 4 34 1.4 47.2-8.6-4.7-1.8-21-9.4-10.2-14.1 11-2 24.4-3.8 30.2-14.9 2.4-6.5 4.7-16.4-.3-22.3zm-232.6-62.8c-10.2 36.6 56.9 14 48 28.6-2.5 4.3-11.6 5.6-13 9.3 11.6 2.1 25.7 4.2 36.7-1 4.7-4.8 13.5-9.8 16.2-.4 6.5 9.2 16 15.9 27 18.1 9 2.3 17.3 3.7 24.7-3 7.8-5.7 11-12 16.8-6.6 7.7 2.8 20.8-2 22.1-9-3.9-4.7-12.1-6.4-14.7-13.4 15-1.2 39.3 2.6 44.4-13.3 2.6-9.5-8.8-13.4-14.1-6.5-16.1 3.1-31.7 6-48 2.4-5-.8-20.7-8.1-14.9 2.9 5 8 6.4 18 5.8 27.3-.9 12.1-16.9 9.2-24.5 5.5-11-4.1-18.9-13.8-25.5-23.1-5.3-7.6-8.5-16.5-12.8-24.6-21.1 6.6-42.9 16.7-65 12.9-4.4 0-7-2.3-9.2-6.1z" fill="#028d2c"/><path d="m72.6 265.3a27 27 0 0 0 -22.3 12.5c-3.3 5.1-6.3 11-6 17.2.3 3.2.2 6.4.7 9.6 1.6 6.7 8 11.1 14.3 13.2 4.9 1.4 10 1.2 15 1.4 8.1 0 17-1.6 22.6-7.9 5.4-5.7 6-14.4 3.9-21.6a38 38 0 0 0 -17.5-22.7 22.8 22.8 0 0 0 -10.7-1.7z" fill="#eb9d57"/><path d="m316.9 246.7c-2.2.4-3.3 2.7-3.2 4.7 2.5 11.4 4.3 25.6 8.5 35.3 1.4 5.7 7.7 9.4 10.2 4.6 2-9-4.3-36.5-7.9-42.4-2.5-3.2-4.6-3-7.6-2.2z" fill="#028d2c"/><path d="m68.1 275c-2.5.7-6 .7-7.5 4.3-5.4 13.4 8.1 18.7 18.2 16.2 7-1.7 9.8-13.2 5-18-3.8-3.7-11.8-3.8-15.8-2.5z" fill="#353331"/><path d="m368 238.1c-6.6 2.9-2.3 8.3 0 11.8 7.3 8.6 11.8 18.3 20 24.5 5.4 2.8 9.5-3.6 6.8-7.3-5-8-12.9-14-17.4-22.3-2.6-4-4.8-7-9.4-6.7zm-112.4 72.5c-7 3-7.1 13.8-10.4 19.6l-4 7c-2 4 0 9.7 5 9.7 4.4 0 5.4-5.6 7-8.1a59.6 59.6 0 0 0 9-25.6c0-2.4-5.7-3-6.6-2.6zm56.6-238c-1.8 5 2.3 19.5 3.6 24.7 1 3.6 5.5 11 10 7.6 3.7-3 2-9.6 1-13.6-1.4-5.4-1-18.4-5.7-21.6-4.2-1.6-8.1.7-9 2.9zm56.8 82.4c-7 1.1-.7 9.2 2.4 12.2 5.8 5.5 16 11 23.7 11 8.1-4.1-2-12.3-6.3-14.4-8.2-4-9.8-10.5-19.8-8.8zm7 164.5c-6.3.8-3.8 7.7-1.2 11.2 4 5.3 8.6 10.4 13 15.4 2.2 3.2 4.4 3.7 7.8 3.6 3.8 0 3.5-6.3 2.1-8.6-3.2-5.3-16.1-22.3-21.6-21.6zm-194.4-6.8c-5.1-1.4-8.9 5.4-13 8.9-2.5 2-5.5 3.4-8.2 5.2-5 3.4-7.7 11.5 1 11.5 4.8 0 6.8-3.4 10.5-5.8 7-4.3 22.6-16.2 9.7-19.8zm160.8-250c-4.2.5-5.8 6.3-3.6 10.1 3.2 5.7 10.7 16.7 17.7 16.7 4.6 0 4.8-5.6 3.4-8.8-.8-1.9-4-4.4-5.2-6.3-2.5-4.2-6.4-12.5-12.3-11.7zm-87.1 180a54 54 0 0 0 -8 11.7c-1 3-1.7 7.8.4 9.7 10.6 1.5 21.1-19.6 17.5-24.3-4-3-7.3.2-9.9 3zm46.7-78.3c-7.8.9-7.7 27.1 3.7 26.3 4.3-.3 4.2-8 4.4-10.7.6-7 .5-16.7-8-15.6z" fill="#028d2c"/><path d="m28 212c-3 .5-9 3-9.7 6.6 0 .7.3 1.4 0 2 0 .3-1.2 1-1.3 1.6-.1 2 1.3 13 5 12 1.6-.4 3.5-3.4 4.4-4.4l5.8-6c2-2 4.9-3.5 6.5-5.7 2.8-4-9.2-6.2-10.7-6z" fill="#d38d5f"/><path d="m278.6 146.6c-4 1-6.9 4-9.7 6.5-2.5 2.9-7.3 4.4-7 8.1-1 4.2.7 6.5 5.2 6.5 7.6 1.6 26-22.7 11.5-21z" fill="#028d2c"/><path d="m114.8 212.6c-2 .1-6.9 1.6-7.6 3.9-.8 2.8 5.1 5.7 6.8 7.3l6 5.7c1.3 1.3 3 5 5.2 5 3.3 0 3.8-12.8 3.2-14a13.6 13.6 0 0 0 -13.6-8z" fill="#d38d5f"/><path d="m98.6 254.6c-1 0-2.2.8-3 1.3-4 2-4 6.6-4 10.4 0 6.4 7 7.8 11.7 7.8.3 0 .6 0 .8-.2 7.8-6.7 4.2-19.3-5.5-19.3zm-52.4.4c-11.6 1.2-12.2 19.4 1 19.4 8.7 0 9.2-15.5 2.7-18.8a6.8 6.8 0 0 0 -3.7-.5z" fill="#1b1a18"/><path d="m289.2 61.1c-5.7 1-12.4 10-15 15.4-1.3 4 .2 8.4 5.1 7.5 4-.7 12.3-10.5 14.6-14.3 2.6-4.2-.5-9.4-4.7-8.6z" fill="#028d2c"/><path d="m31.7 290.3c0-5.6-1-10-2.9-15.1-1-3-7.3-20.3-9.3-20.6-5.6-1-15 26.7-14.2 32.4.9 5.6 13.1 10.7 17.3 8.5-2.4-2.5-1.7-5.2-1.7-9l.5-5.7c1.7-14.2 10.3 7.5 5.3 12.9 1.3 0 4-3.2 4.7-3.9z" fill="#29b0f2" stroke="#29b0f2"/><path d="m5 286.5c2.6 8.1 13 9.2 19.5 9.2 1.6 0 6-5 7-5.9 1.8 4-5.5 11.6-8.4 12.4-10.6 2.8-18-4.7-18-15.7z" fill="#2897e3" stroke="#2897e3"/><path d="m22.6 295.5c-3.3-.6-1.7-5.2-1.7-9l.5-5.7c2-15.5 13.7 16.8 1.2 14.7z" fill="#7bd1f9" stroke="#7bd1f9"/></svg>'; ?>
            </div>
        </div>
    </article>

    <?php endif; ?>

    </div>

    <aside id="sidebar-search" class="page-sidebar sidebar-search">
        <div class="accordion" role="tablist" aria-label="Accordion">
            <button role="tab">Additional Information</button>
            <section role="tabpanel">
                <?php dynamic_sidebar( 'tertiary' ); // Tertiary sidebar ?>
            </section>
        </div>
    </aside>

</main>

<?php get_footer(); ?>