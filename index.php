<?php get_header(); ?>

<?php breadcrumb_trail(); ?>

<section class="blog-page-title">
    <h2>Ramblings...</h2>
</section>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/NewsArticle">
    <div>
        <header class="entry-header">
            <div class="entry-catagory">Filed under <?php the_category(' '); ?></div>
            <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
            <div class="entry-date"><a href="<?php echo get_month_link(get_the_date('Y'), get_the_date('m')); ?>"><time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php the_date(); ?></time></a></div>
            <div class="entry-author">by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author"><?php the_author(); ?></a></div>
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
        <?php blog_list_nav(); ?>
    </div>
</section>

<?php else : ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/NewsArticle">
    <div>
        <h2>Not Found</h2>
        <p>Sorry, but you are looking for something that isn't here for some reason.</p>
<?php my_search_form('Main'); ?>

    </div>
</article>

<?php endif; ?>

<?php get_sidebar('primary'); ?>

<?php get_footer(); ?>