<?php get_header(); ?>

<main class="page-main page-search" role="main">
    <div class="page-content width-side">

<?php breadcrumb_trail(); ?>

<?php
// Get the number of time this keyword comes up in search queries
$search_count = 0;
$search = new WP_Query("s=$s & showposts=-1");
if($search->have_posts()) : while($search->have_posts()) : $search->the_post();	
    $search_count++;
endwhile; endif;
?>

<?php if (have_posts() && get_search_query()) : ?>

<section class="search-banner">
    <div>
        <h2 class="page-title" itemprop="title">Your search netted <?php printf($search_count); ?> result(s)</h2>
        <?php get_search_form(); ?>
        <hr>
    </div>
</section>

<article class="search-page" role="article" itemscope itemtype="http://schema.org/NewsArticle">

<?php while (have_posts()) : the_post(); ?>
    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <div class="post-container">
            <header class="entry-header">
                <div class="entry-type"><b><?php echo get_post_type(); ?></b> - <small><?php the_permalink(); ?></small></div>
                <h3 class="entry-title" itemprop="title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                <div class="entry-info">
                    <span class="entry-author">By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
                    <span class="entry-date">on <a href="<?php echo get_month_link(get_the_date('Y'), get_the_date('m')); ?>"><time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php the_date(); ?></time></a> <span class="entry-last-updated"><?php if (get_the_modified_date('Y-m-d') != get_the_date('Y-m-d')) printf( __( '(Updated: <time>%s</time>)', 'textdomain' ), get_the_modified_date() ); ?></span></span>
                </div>
            </header>
            <div class="entry-content entry-defaultfont">
                <div class="wp-block-image"><figure class="alignright is-resized"><?php the_post_thumbnail( 'thumbnail' ); ?></figure></div>
                <?php the_excerpt(); ?>
            </div>
            <footer></footer>
        </div>
    </div>
<?php endwhile; ?>

</article>

<section class="blog-pagination">
    <div class="pagination-container">
        <nav class="blog-post-nav">
            <?php blogPostPagination('Results'); ?>
        </nav>
    </div>
</section>

<?php else : ?>
<article class="search-page" role="article" itemscope itemtype="http://schema.org/NewsArticle">
    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <h2 class="page-title" itemprop="title">Query Not Found</h2>
        <p>The search query of “<strong><?php echo cleanUserInput(get_search_query()); ?></strong>” came up empty.</p>
        <p>If it will make you feel better, this probably happens to Google too.</p>
        <p><b>Care to take another shot?</b></p>
        <?php get_search_form(); ?>
    </div>
</article>
<?php endif; ?>

    </div>

    <?php get_sidebar('primary'); ?>

</main>

<?php get_footer(); ?>