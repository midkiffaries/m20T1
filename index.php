<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-blog-posts" id="main-content" role="main">
    <div class="page-content width-side">

    <section class="blog-page-title" itemprop="name headline">
        <?=GetPageTitle('page_for_posts'); // Get blog page title ?>
    </section>

    <?php if (have_posts()) : // If posts exist ?>

    <section class="blog-roll">

    <?php while (have_posts()) : the_post(); // List all the posts ?>
        <article <?php post_class(); ?> id="post-<?php the_ID(); ?>" itemscope itemtype="https://schema.org/NewsArticle">
            <div class="post-container">
                <a href="<?php the_permalink(); ?>" rel="bookmark" class="entry-thumbnail" style="<?php echo FeaturedImageURL(get_the_ID(), 'medium', true); ?>">
                    <?php if (is_sticky( get_the_ID() )) : // If sticky/featured post ?><div class="entry-sticky">Featured Article</div><?php endif; ?>
                </a>
                <header class="entry-header">
                    <div class="entry-date"><time datetime="<?=get_the_date('c'); ?>" itemprop="datePublished"><?php the_date(); ?></time></div>
                    <h2 class="entry-title" id="<?=$post->post_name; ?>" itemprop="name"><a href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a></h2>
                    <div class="entry-metadata">
                        <span class="entry-author">Written By <a href="<?=get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
                        <span class="entry-read-time" itemprop="duration"><?=post_separator(); ?> <?=reading_time(); ?></span>
                        <span class="entry-comments" itemprop="commentcount"><?=post_separator(); ?> <a href="<?php the_permalink(); ?>#Comments" rel="bookmark"><?php comments_number('No Comments', 'One Comment', '% Comments');?></a></span>
                    </div>
                </header>
                <div class="the-content content-excerpt" itemprop="text articleBody">
                    <p><?=shorten_the_content($post->post_content); ?></p>
                </div>
                <footer class="entry-footer"></footer>
            </div>
        </article>
    <?php endwhile; ?>

    </section>

    <section class="blog-pagination" aria-label="Blog Pagination" itemprop="pagination">
        <div class="pagination-container">
            <nav class="blog-post-nav">
                <?php blog_post_pagination('Posts'); // Blog posts navigation ?>
            </nav>
        </div>
    </section>

    <?php else : // No page exists ?>

    <article class="blog-roll" itemscope itemtype="https://schema.org/NewsArticle">
        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <h2 class="entry-title" itemprop="name">Not Found</h2>
            <p itemprop="text">Sorry, but you are looking for something that isn't here for some reason.</p>
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