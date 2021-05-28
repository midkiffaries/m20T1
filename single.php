<?php get_header(); ?>

<main class="page-main width-side">
    <div class="page-content">

<?php include_once(ABSPATH . 'wp-admin/includes/plugin.php'); ?>
<?php if (is_plugin_active('breadcrumb-trail/breadcrumb-trail.php')) breadcrumb_trail(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
    <div>
        <header class="entry-header">
            <div class="entry-catagory">Filed under <?php the_category(' '); ?></div>
            <h2 class="entry-title" itemprop="title"><?php the_title(); ?></h2>
            <div class="entry-date"><a href="<?php echo get_month_link(get_the_date('Y'), get_the_date('m')); ?>"><time datetime="<?php printf(get_the_date('c')); ?>" itemprop="datePublished"><?php the_date(); ?></time></a></div>
            <div class="entry-author">By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></div>
            <div class="entry-comments"><?php comments_number('no comments', 'one comment', '% comments'); ?></div>
        </header>
        <div class="entry-content">
            <?php the_content("<p>Continue Reading &raquo;</p>"); ?>

            <p class="entry-last-updated"><?php if (get_the_modified_date('Y-m-d') != get_the_date('Y-m-d')) printf( __( 'Post Updated On: <time itemprop="dateModified">%s</time>', 'textdomain' ), get_the_modified_date() ); ?></p>
        </div>     
        <footer class="entry-footer">
            <div class="entry-tags"><?php the_tags('<ul><li rel="tag">', '</li><li rel="tag">', '</li></ul>'); ?></div>
            <div class="entry-share"><?php blog_post_share(); ?></div>
        </footer>
    </div>
</article>

<section class="blog-pagination">
    <div>
        <div class="wp-post-nav">
            <?php previous_post_link('&#x276E; %link'); ?> 
            <?php next_post_link('%link &#x276F;'); ?>
        </div>
    </div>
</section>

<section class="post-comments">
    <div>
<?php comments_template(); ?>
    </div>
</section>

<?php endwhile; else: ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
    <div>
        <p>Sorry, no posts matched your criteria.</p>
    </div>
</article>

<?php endif; ?>

    </div>
</main>

<?php get_sidebar('secondary'); ?>

<?php get_footer(); ?>