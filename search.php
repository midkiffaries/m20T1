<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-search" id="main-content" role="main">
    <div class="page-content width-side">

    <?php if (have_posts() && get_search_query()) : // Search results ?>

    <section class="search-page-form" id="search-page">
        <div>
            <h1 class="page-title" itemprop="name">Your search netted <b><?php printf(SearchCount($s)); ?></b> result(s)</h1>
            <?php get_search_form('search'); // Search form ?>
        </div>
    </section>

    <article class="search-results" itemscope itemtype="http://schema.org/NewsArticle">

    <?php while (have_posts()) : the_post(); // List posts and pages ?>

        <div class="post-<?php the_ID(); ?> post type-post status-publish format-standard hentry" id="post-<?php the_ID(); ?>">
            <div class="post-container">
                <header class="entry-header">
                    <h2 class="entry-title" id="<?php echo $post->post_name; ?>" itemprop="name"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    <div class="entry-info">
                        <span class="entry-type"><?php echo get_post_type(); ?></span>
                        <span class="entry-date"><time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php the_date(); ?></time></span>
                        <span class="entry-author"><?php echo post_separator(); ?> By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
                    </div>
                </header>
                <div class="the-content content-excerpt" itemprop="description">
                    <img class="entry-square-thumbnail" src="<?php echo FeaturedImageURL(get_the_ID(), 'thumbnail', false); ?>" alt="">
                    <p><?php echo shorten_the_content($post->post_content); ?></p>
                    <p class="entry-readmore"><a href="<?php the_permalink(); ?>" rel="bookmark">Continue reading...</a></p>
                </div>
                <footer class="entry-footer hidden">
                </footer>
            </div>
        </div>
    <?php endwhile; ?>

    </article>

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
            <h1 class="page-title" itemprop="title">Your search netted <?php printf(SearchCount($s)); ?> result(s)</h1>
            <?php get_search_form('search'); // Search form ?>
        </div>
    </section>

    <article class="search-results" itemscope itemtype="http://schema.org/NewsArticle">
        <div class="the-content aligncenter">
            <p>The search query of <strong><?php echo esc_attr(get_search_query()); ?></strong> came up empty.</p>
            <p>If it will make you feel better, this probably happens to Google too.</p>
            <div class="page-search-image">
                <?php echo SEARCH_ERROR_IMAGE; ?>
            </div>
        </div>
    </article>

    <?php endif; ?>

    </div>

    <aside id="sidebar-search" class="page-sidebar sidebar-search">
        <?php dynamic_sidebar( 'tertiary' ); // Tertiary sidebar ?>
    </aside>

</main>

<?php get_footer(); ?>