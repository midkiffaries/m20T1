<?php get_header(); ?>

<?php breadcrumb_trail(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
    <div>
        <header class="entry-header">
            <div class="entry-catagory">Filed under <?php the_category(' '); ?></div>
            <h2 class="entry-title"><?php the_title(); ?></h2>
            <div class="entry-date"><a href="<?php echo get_month_link('', '', ''); ?>"><time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php the_date($BlogPostTimeStamp, '',''); ?></time></a> <span class="entry-author">by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author"><?php the_author(); ?></a></span></div>
            <!--div class="entry-comments"><?php comments_number('no comments', 'one comment', '% comments'); ?></div-->
        </header>
        <div class="entry-content">
            <?php the_content("<p>Continue Reading &raquo;</p>"); ?>
        </div>     
        <footer class="entry-footer">
            <div class="entry-tags"><?php the_tags('<ul><li rel="tag">', '</li><li>', '</li></ul>'); ?></div>
            <div class="entry-share"><?php blog_post_share(); ?></div>
        </footer>
    </div>
</article>

<section class="blog-pagination">
    <div>
        <div class="wp-post-nav"><?php previous_post_link('&#x276E; %link') . next_post_link('%link &#x276F;'); ?></div>
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

<?php get_sidebar('secondary'); ?>

<?php get_footer(); ?>