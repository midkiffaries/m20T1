<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>
<?php $postType = get_post_type_object(get_post_type()); ?>

<main class="page-main page-portfolio" id="main-content" itemscope itemtype="https://schema.org/Article" itemprop="mainEntity">
    <div class="page-content width-side">
    
    <?php if (have_posts()) : // Has portfolio items ?>
    
    <section class="portfolio-header" id="portfolio-page">
        <div class="portfolio-header-container">
            <h1 class="page-title" itemprop="name headline"><?=esc_html($postType->labels->singular_name); ?></h1>
            <div class="subtitle" itemprop="about"><?=esc_html($postType->description); ?></div>
        </div>
    </section>

    <article class="portfolio-page" itemscope itemtype="https://www.schema.org/CreativeWork">

    <?php while (have_posts()) : the_post(); // Display portfolio items ?>
    <div <?php post_class(); ?> id="post-<?=the_ID(); ?>">
            <div class="post-container">
                <a href="<?=esc_url(the_permalink()); ?>" rel="bookmark" class="portfolio-thumbnail" style="<?=FeaturedImageURL(get_the_ID(), 'medium', true); ?>">
                    <div class="portfolio-sticky"><?php if(is_sticky( get_the_ID() )) : // If sticky portfolio item ?>Featured Item<?php endif; ?>&nbsp;</div>
                </a>
                <header class="portfolio-header">
                    <div class="portfolio-date"><time datetime="<?=get_the_date('c'); ?>" itemprop="datePublished"><?=the_date(); ?></time></div>
                    <h2 class="portfolio-title" id="<?=$post->post_name; ?>" itemprop="name"><a href="<?=esc_url(the_permalink()); ?>" rel="bookmark" itemprop="url"><?=the_title(); ?></a></h2>
                    <div class="portfolio-metadata">
                        <span class="portfolio-author">By <a href="<?=get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
                    </div>
                </header>
                <div class="the-content content-excerpt" itemprop="text description ">
                    <p><?=shorten_the_content($post->post_content); ?></p>
                </div>
                <footer class="portfolio-footer hidden">
                </footer>
            </div>
        </div>
    <?php endwhile; ?>

    </article>

    <section class="blog-pagination" aria-label="Portfolio Pagination">
        <div class="pagination-container">
            <nav class="blog-post-nav">
                <?=blog_post_pagination(esc_html($postType->labels->singular_name)); // Portfolio navigation links ?>
            </nav>
        </div>
    </section>

    <?php else : // If no results ?>

    <article class="portfolio-page" itemscope itemtype="https://www.schema.org/CreativeWork">
        <div <?php post_class(); ?>>
            <h1 class="page-title" itemprop="name"><?=esc_html($postType->labels->singular_name); ?> is Empty</h1>
            <div class="subtitle">There seems to be nothing here.</div>
            <p itemprop="text">Would you like to try a search to find what you are looking for?</p>
            <?php get_search_form('archive'); // Search Form ?>
        </div>
    </article>

    <?php endif; ?>

    </div>
    
    <aside id="sidebar-portfolio" class="page-sidebar portfolio-widgets">
        <?php dynamic_sidebar( 'quaternary' ); // Quaternary Sidebar ?>
    </aside>

</main>

<?php get_footer(); ?>