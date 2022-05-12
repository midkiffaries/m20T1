<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-blogpost" id="main-content" role="main">
    <div class="page-content width-full">

    <?php if (have_posts()) : while (have_posts()) : the_post(); // Single post ?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
        <div class="post-container">
            <header class="single-entry-header">
                <div class="single-entry-category"><?php the_category(' '); ?></div>
                <h2 class="single-entry-title" id="<?php echo $post->post_name; ?>" itemprop="title"><?php the_title(); ?></h2>
                <div class="single-entry-metadata">
                    <span class="single-entry-avatar"><?php printf(get_avatar(get_the_author_meta('ID'), 24)); ?></span>
                    <span class="single-entry-author">By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span> <span class="entry-separator"><?php echo POST_SEPARATOR; ?></span>
                    <span class="single-entry-date"><time class="icon-written" datetime="<?php printf(get_the_date('c')); ?>" itemprop="datePublished"><?php the_date(); ?></time></span> <span class="entry-separator"><?php echo POST_SEPARATOR; ?></span>
                    <span class="single-entry-last-updated"><?php if (get_the_modified_date('Y-m-d') != get_the_date('Y-m-d')) printf( __( 'Updated: <time itemprop="dateModified">%s</time>', 'textdomain' ), get_the_modified_date() ); ?></span>
                    <span class="single-entry-comments hidden"><a href="#Comments"><?php comments_number('No comments', 'One comment', '% comments'); ?></a></span>
                </div>
            </header>
            <div class="single-entry-content <?php echo ResizeFontClass($post->post_content); ?>">
                <?php the_content("<p>Continue Reading &raquo;</p>"); ?>
            </div>
            <footer class="single-entry-footer">
                <div class="entry-tags"><?php the_tags('<ul><li rel="tag">', '</li><li rel="tag">', '</li></ul>'); ?></div>
                <div class="entry-share"><?php blog_post_share(); ?></div>
            </footer>
        </div>
    </article>

    <section class="blog-pagination" aria-label="Blog Pagination">
        <div class="pagination-container">
            <nav class="single-blog-post-nav">
                <div class="left"><?php next_post_link('%link', '<span>Next</span>%title'); // Left ?></div>
                <div class="right"><?php previous_post_link('%link', '<span>Previous</span>%title'); // Right ?></div>
            </nav>
        </div>
    </section>

    <aside id="singlepost-widgets" class="page-sidebar singlepost-widgets clearfix">
        <section class="widget widget_block single-author-bio" aria-label="Article Author">
            <h3 class="author-bio-name" itemprop="author">About the Author</h3>
            <div class="author-avatar">
                <figure class="alignleft" aria-label="Authors Avatar">
                    <?php printf(get_avatar(get_the_author_meta('ID'), 64)); ?>
                </figure>
            </div>
            <p class="author-bio-about"><?php printf(get_the_author_meta( 'user_description' )); ?> <a href="<?php printf("%s/author/%s", home_url(), get_the_author_meta( 'user_nicename' )); ?>" rel="author">See more posts from <?php echo get_the_author_meta( 'nickname' ); ?> &#x276F;</a></p>
        </section>

        <section class="widget widget_block widget-singlepost" aria-label="Page Widgets">
            <?php dynamic_sidebar( 'singlepost' ); // Single Blog Post Sidebar ?>
        </section>
    </aside>

    <section class="single-post-comments" aria-label="Article Comments">
        <?php comments_template(); // Display the comments for this post ?>
    </section>

    <?php endwhile; else : // If post doesn't exist ?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
        <div class="post-container">
            <h2 class="single-entry-title" itemprop="title">Not Found</h2>
            <p>Sorry, no posts matched your criteria. Try and search for it?</p>
            <?php get_search_form('post'); // Search Form ?>
        </div>
    </article>

    <?php endif; ?>

    </div>

</main>

<?php get_footer(); ?>