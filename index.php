<?php get_header(); ?>

<main class="page-main page-blog">
    <div class="page-content width-side">

<?php include_once(ABSPATH . 'wp-admin/includes/plugin.php'); ?>
<?php if (is_plugin_active('breadcrumb-trail/breadcrumb-trail.php')) breadcrumb_trail(); ?>

<section class="blog-page-title">
    <h2 class="page-title" itemprop="title">The Blog</h2>
</section>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/NewsArticle">
    <div>
        <header class="entry-header">
            <div class="entry-category"><?php the_category(' '); ?></div>
            <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
            <div class="entry-info">
                <span class="entry-author">By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
                <span class="entry-date">on <a href="<?php echo get_month_link(get_the_date('Y'), get_the_date('m')); ?>"><time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php the_date(); ?></time></a> <span class="entry-last-updated"><?php if (get_the_modified_date('Y-m-d') != get_the_date('Y-m-d')) printf( __( '(Updated: <time>%s</time>)', 'textdomain' ), get_the_modified_date() ); ?></span></span>
            </div>
        </header>
        <div class="entry-content">
            <?php the_content("<p>Continue Reading &raquo;</p>"); ?>
        </div>     
        <footer class="entry-footer">
            <div class="entry-tags"><?php the_tags('<ul><li rel="tag">', '</li><li rel="tag">', '</li></ul>'); ?></div>
            <div class="entry-share"><?php blog_post_share(); ?></div>
        </footer>
    </div>
</article>

<?php endwhile; ?>

<section class="blog-pagination">
    <div>
        <nav class="blog-post-nav">
            <?php next_posts_link('&#x276E; Older Entries', 0); ?>
            <?php previous_posts_link('Newer Entries &#x276F;', 0); ?>
        </nav>
    </div>
</section>

<?php else : ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/NewsArticle">
    <div>
        <h2 class="entry-title">Not Found</h2>
        <p>Sorry, but you are looking for something that isn't here for some reason.</p>
<?php my_search_form('Main'); ?>

    </div>
</article>

<?php endif; ?>

    </div>

    <?php get_sidebar('primary'); ?>

</main>

<?php get_footer(); ?>