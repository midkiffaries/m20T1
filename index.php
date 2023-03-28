<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-blog-posts" id="main-content" role="main">
    <div class="page-content width-side">

    <section class="blog-page-title">
        <?php echo GetPageTitle('page_for_posts'); // Get blog page title <h1> and <p> ?>
    </section>

    <?php if (have_posts()) : // If posts exist ?>

    <article class="blog-roll" itemscope itemtype="http://schema.org/NewsArticle">

    <?php while (have_posts()) : the_post(); // List all the posts ?>
        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <div class="post-container">
                <a href="<?php the_permalink(); ?>" rel="bookmark" class="entry-thumbnail" style="<?php echo FeaturedImageURL(get_the_ID(), 'medium', true); ?>">
                    <?php if (is_sticky( get_the_ID() )) : // If sticky/featured post ?><div class="entry-sticky">Featured Article</div><?php endif; ?>
                </a>
                <header class="entry-header">
                    <div class="entry-date"><time datetime="<?=get_the_date('c'); ?>" itemprop="datePublished"><?php the_date(); ?></time></div>
                    <h2 class="entry-title" id="<?=$post->post_name; ?>" itemprop="name"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    <div class="entry-metadata">
                        <span class="entry-author">Written By <a href="<?=get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
                        <span class="entry-read-time"><?=post_separator(); ?> <?=reading_time(); ?></span>
                        <span class="entry-comments"><?=post_separator(); ?> <a href="<?php the_permalink(); ?>#Comments" rel="bookmark"><?php comments_number('No Comments', 'One Comment', '% Comments');?></a></span>
                    </div>
                </header>
                <div class="the-content content-excerpt" itemprop="description">
                    <p><?=shorten_the_content($post->post_content); ?></p>
                </div>
                <footer class="entry-footer"></footer>
            </div>
        </div>
    <?php endwhile; ?>

    </article>

    <section class="blog-pagination" aria-label="Blog Pagination">
        <div class="pagination-container">
            <nav class="blog-post-nav">
                <?php blog_post_pagination('Posts'); // Blog posts navigation ?>
            </nav>
        </div>
    </section>

    <?php else : // No page exists ?>

    <article class="blog-roll" itemscope itemtype="http://schema.org/NewsArticle">
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