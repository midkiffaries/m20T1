<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-blog-posts width-side" id="main-content" itemscope itemtype="https://schema.org/Article" itemprop="mainEntity">
    
    <div class="page-content">

    <section class="blog-page-title" itemprop="name headline">
        <?=GetPageTitle(get_option('page_for_posts')); // Get blog page title and content ?>
    </section>

    <?php if (have_posts()) : // If posts exist ?>

    <section class="blog-container" role="feed">

    <?php while (have_posts()) : the_post(); // List all the posts ?>
        <article <?php post_class(); ?> id="post-<?php the_ID(); ?>" itemscope itemtype="https://schema.org/NewsArticle">
            <div class="post-container">
                <div class="post-container-image">
                    <a href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url" class="entry-thumbnail" style="<?=FeaturedImageURL(get_the_ID(), 'large', true);?>">
                        <?php if (is_sticky( get_the_ID() )) : // If sticky/featured post ?><div class="entry-sticky" aria-label="Featured Article" title="Featured Article">✮</div><?php endif; ?>
                    </a>
                </div>
                <div class="post-container-content">
                    <header class="entry-header">
                        <div class="entry-date"><time datetime="<?=get_the_date('c');?>" itemprop="datePublished"><?php the_date(); ?></time></div>
                        <h2 class="entry-title" id="<?=$post->post_name;?>" itemprop="name"><a href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a></h2>
                        <div class="entry-metadata">
                            <span class="entry-author">Written By <a href="<?=get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
                            <span class="entry-read-time"><?=post_separator();?> <?=reading_time();?></span>
                            <span class="entry-comments" itemprop="commentCount"><?=post_separator();?> <a href="<?php the_permalink(); ?>#Comments" rel="bookmark"><?php comments_number('No Comments', 'One Comment', '% Comments');?></a></span>
                        </div>
                    </header>
                    <div class="the-content content-excerpt" itemprop="text articleBody">
                        <p><?=shorten_the_content($post->post_content);?></p>
                    </div>
                    <footer class="entry-footer"></footer>
                </div>
            </div>
        </article>
    <?php endwhile; ?>

    </section>

    <section class="blog-pagination" aria-label="Blog Pagination">
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

    <aside id="sidebar-blog" class="page-sidebar blogroll-widgets">
        <div class="accordion" role="tablist" aria-label="Accordion">
            <button role="tab">Additional Information</button>
            <section role="tabpanel">
                <?php dynamic_sidebar( 'primary' ); // Primary Sidebar ?>
            </section>
        </div>
    </aside>

</main>

<?php get_footer(); ?>