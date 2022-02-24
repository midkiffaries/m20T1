<?php get_header(); ?>

<main class="page-main page-search" id="main-content" role="main">
    <div class="page-content width-side">

    <?php breadcrumb_trail(); // Show breadcrumb trail ?>

    <?php if (have_posts() && get_search_query()) : // Search results ?>

    <section class="search-page-form" id="search-page">
        <div>
            <h2 class="page-title" itemprop="title">Your search netted <?php printf(SearchCount($s)); ?> result(s)</h2>
            <?php get_search_form('search'); // Search form ?>
        </div>
    </section>

    <article class="search-results" role="article" itemscope itemtype="http://schema.org/NewsArticle">

    <?php while (have_posts()) : the_post(); // List posts ?>

        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <div class="post-container">
                <header class="entry-header">
                    <div class="entry-type"><b><?php echo get_post_type(); ?></b> - <small><?php the_permalink(); ?></small></div>
                    <h3 class="entry-title" id="<?php echo $post->post_name; ?>" itemprop="title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                    <div class="entry-info">
                        <span class="entry-author">By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
                        <span class="entry-date icon-written"><time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php the_date(); ?></time></span>
                    </div>
                </header>
                <div class="entry-content entry-defaultfont">
                    <div class="wp-block-image">
                        <figure class="alignright is-resized"><?php the_post_thumbnail( 'thumbnail' ); ?></figure>
                    </div>
                    <?php echo shorten_the_content($post->post_content); ?>
                </div>
                <footer></footer>
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

    <article class="search-page" role="article" itemscope itemtype="http://schema.org/NewsArticle">
        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <h2 class="page-title" itemprop="title">Query Not Found</h2>
            <p>The search query of “<strong><?php echo esc_attr(get_search_query()); ?></strong>” came up empty.</p>
            <p>If it will make you feel better, this probably happens to Google too.</p>
            <p><b>Care to take another shot?</b></p>
            <?php get_search_form('search'); // Search Form ?>
        </div>
    </article>

    <?php endif; ?>

    </div>

    <aside id="sidebar-search" class="page-sidebar sidebar-search" role="sidebar">
        <?php dynamic_sidebar( 'primary' ); // Primary sidebar ?>
    </aside>

</main>

<?php get_footer(); ?>