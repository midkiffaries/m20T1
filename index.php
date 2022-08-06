<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-blog-posts" id="main-content" role="main">
    <div class="page-content width-side">

    <section class="blog-page-title">
        <?php echo GetPageTitle('page_for_posts'); // Get blog page title ?>
    </section>

    <?php if (have_posts()) : // If posts exist ?>

    <article class="blog-roll" role="article" itemscope itemtype="http://schema.org/NewsArticle">

    <?php while (have_posts()) : the_post(); // List all the posts ?>
        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <div class="post-container">
                <div class="entry-thumbnail" style="<?php echo FeaturedImageURL(get_the_ID(), 'large', true); ?>">
                    <div class="entry-sticky"><?php if(is_sticky( get_the_ID() )) : // If sticky post ?>Featured Article<?php endif; ?>&nbsp;</div>
                </div>
                <header class="entry-header">
                    <div class="entry-date"><time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php the_date(); ?></time></div>
                    <h2 class="entry-title" id="<?php echo $post->post_name; ?>"><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    <div class="entry-metadata">
                        <span class="entry-author">Written By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
                        <span class="entry-read-time"><span class="entry-separator"><?php echo POST_SEPARATOR; ?></span> <?php echo reading_time(); ?></span>
                        <span class="entry-comments"><span class="entry-separator"><?php echo POST_SEPARATOR; ?></span> <a href="<?php esc_url(the_permalink()); ?>#Comments" rel="bookmark" class="icon-comment"><?php comments_number('No Comments', 'One Comment', '% Comments');?></a></span>
                    </div>
                </header>
                <div class="the-content">
                    <p><?php echo shorten_the_content($post->post_content); ?></p>
                </div>
                <footer class="entry-footer hidden">
                    <div class="entry-tags"><?php //blog_post_tags(); ?></div>
                    <div class="entry-share"><?php //blog_post_share(); ?></div>
                </footer>
            </div>
        </div>
    <?php endwhile; ?>

    </article>

    <section class="blog-pagination" aria-label="Blog Pagination">
        <div class="pagination-container">
            <nav class="blog-post-nav" role="navigation">
                <?php blog_post_pagination('Posts'); // Blog posts navigation ?>
            </nav>
        </div>
    </section>

    <?php else : // No page exists ?>

    <article class="blog-roll" role="article" itemscope itemtype="http://schema.org/NewsArticle">
        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <h2 class="entry-title">Not Found</h2>
            <p>Sorry, but you are looking for something that isn't here for some reason.</p>
            <?php my_search_form('Main'); // Search Form ?>
        </div>
    </article>

    <?php endif; ?>

    </div>

    <aside id="sidebar-blog" class="page-sidebar blogroll-widgets" role="complementary">
        <?php dynamic_sidebar( 'primary' ); ?>
    </aside>

</main>

<?php get_footer(); ?>