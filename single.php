<?php get_header(); ?>

<main class="page-main page-blogpost" role="main">
    <div class="page-content width-full">

<?php breadcrumb_trail(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
    <div class="post-container">
        <header class="single-entry-header">
            <div class="single-entry-category"><?php the_category(' '); ?></div>
            <div class="single-entry-date"><time datetime="<?php printf(get_the_date('c')); ?>" itemprop="datePublished"><?php the_date(); ?></time></div>
            <h2 class="single-entry-title" id="<?php echo $post->post_name; ?>" itemprop="title"><?php the_title(); ?></h2>
            <div class="single-entry-author">By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></div>
            <!--div class="single-entry-comments"><a href="#Comments"><?php comments_number('No comments', 'One comment', '% comments'); ?></a></div-->
        </header>
        <div class="single-entry-content <?php echo ResizeFontClass($post->post_content); ?>">
            <?php the_content('<p>Continue Reading &raquo;</p>'); ?>
        </div>
        <footer class="single-entry-footer">
            <div class="single-entry-last-updated"><?php if (get_the_modified_date('Y-m-d') != get_the_date('Y-m-d')) printf( __( 'Updated <time itemprop="dateModified">%s</time>', 'textdomain' ), get_the_modified_date() ); ?></div>
            <div class="entry-tags"><?php the_tags('<ul><li rel="tag">', '</li><li rel="tag">', '</li></ul>'); ?></div>
            <div class="entry-share"><?php blog_post_share(); ?></div>
        </footer>
    </div>
</article>

<section class="blog-pagination">
    <div class="pagination-container">
        <nav class="single-blog-post-nav">
            <div class="left"><?php next_post_link('%link', '<span>Next</span>%title'); ?></div>
            <div class="right"><?php previous_post_link('%link', '<span>Previous</span>%title'); ?></div>
        </nav>
    </div>
</section>

<aside id="singlepost-widgets" class="page-sidebar singlepost-widgets">
    <section class="widget widget_block single-author-bio" role="complementary">
        <h3 class="author-bio-name" itemprop="author">About the Author</h3>
        <div class="wp-block-image">
            <figure class="alignleft" aria-label="Authors Avatar">
                <?php printf(get_avatar(get_the_author_meta('ID'), 64)); ?>
            </figure>
        </div>
        <p class="author-bio-about"><?php printf(get_the_author_meta( 'user_description' )); ?> <a href="<?php printf("%s/author/%s", home_url(), get_the_author_meta( 'user_nicename' )); ?>" rel="author">See more posts from <?php echo get_the_author_meta( 'nickname' ); ?> &#x276F;</a></p>
    </section>
    <?php if (is_active_sidebar( 'singlepost' )) : ?>
    <?php dynamic_sidebar( 'singlepost' ); ?>
    <?php endif; ?>
</aside>

<?php comments_template(); ?>

<?php endwhile; else: ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
    <div class="post-container">
        <h2 class="single-entry-title" itemprop="title">Not Found</h2>
        <p>Sorry, no posts matched your criteria.</p>
        <?php get_search_form('post'); ?>
    </div>
</article>

<?php endif; ?>

    </div>

</main>

<?php get_footer(); ?>