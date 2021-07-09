<?php get_header(); ?>

<main class="page-main page-blog">
    <div class="page-content width-side">

<?php include_once(ABSPATH . 'wp-admin/includes/plugin.php'); ?>
<?php if (is_plugin_active('breadcrumb-trail/breadcrumb-trail.php')) breadcrumb_trail(); ?>

<section class="blog-page-title">
    <h2 class="page-title" itemprop="title">Blog</h2>
</section>

<?php if (have_posts()) : ?>

<article class="blog-page" itemscope itemtype="http://schema.org/NewsArticle">

<?php while (have_posts()) : the_post(); ?>

    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>" role="article">
        <div class="post-container">
            <header class="entry-header">
                <div class="entry-category"><?php the_category(' '); ?></div>
                <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                <div class="entry-info">
                    <!--span class="entry-author">By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></!--span-->
                    <span class="entry-date"><time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php the_date(); ?></time> <span class="entry-last-updated"><?php if (get_the_modified_date('Y-m-d') != get_the_date('Y-m-d')) printf( __( '(Updated: <time>%s</time>)', 'textdomain' ), get_the_modified_date() ); ?></span></span>
                </div>
            </header>
            <?php // Enlarge font in entry is short
            $largerFont = 'entry-defaultfont'; 
            if (strlen(wp_strip_all_tags($post->post_content)) < 430) $largerFont = 'entry-largefont'; 
            ?>
            <div class="entry-content <?php echo $largerFont; ?>">
                <?php the_content('<p>Continue Reading &raquo;</p>'); ?>
            </div>
            <div class="entry-overflow"></div>
            <footer class="entry-footer">
                <div class="entry-tags"><?php the_tags('<ul><li rel="tag">', '</li><li rel="tag">', '</li></ul>'); ?></div>
                <div class="entry-share"><?php blog_post_share(); ?></div>
            </footer>
        </div>
    </div>

<?php endwhile; ?>

</article>

<section class="blog-pagination">
    <div class="pagination-container">
        <nav class="blog-post-nav">
            <?php previous_posts_link('&#x276E; Newer Entries', 0); ?>
            <?php next_posts_link('Older Entries &#x276F;', 0); ?>
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