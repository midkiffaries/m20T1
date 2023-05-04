<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-blogpost <?=get_page_class(); ?>" id="main-content">
    <div class="page-content width-full">

    <?php if (have_posts()) : while (have_posts()) : the_post(); // Single post ?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>" itemscope itemtype="https://schema.org/NewsArticle">
        <div class="post-container">
            <header class="single-entry-header">
                <?php if (is_sticky( get_the_ID() )) : // If sticky/featured post ?><div class="single-entry-sticky">Featured Article</div><?php endif; ?>
                <div class="single-entry-category" itemprop="articleSection"><?php the_category(' '); ?></div>
                <h1 class="single-entry-title" id="<?=$post->post_name; ?>" itemprop="name headline"><?php the_title(); ?></h1>
                <div class="single-entry-metadata">
                    <span class="single-entry-date"><time datetime="<?=get_the_date('c'); ?>" itemprop="datePublished"><?php the_date(); ?></time></span> 
                    <span class="single-entry-author"><?=post_separator(); ?> Written By <a href="<?=get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
                    <span class="single-entry-read-time"><?=post_separator(); ?> <?=reading_time(); ?></span>
                </div>
            </header>
            <div class="the-content single-entry-content" itemprop="text articleBody">
                <?php the_content("<p>Continue Reading &raquo;</p>"); ?>
            </div>
            <div class="entry-last-updated">
                <p><?php if (get_the_modified_date('Y-m-d') != get_the_date('Y-m-d')) printf( __( 'Updated: <time itemprop="dateModified">%s</time>', 'textdomain' ), get_the_modified_date() ); ?></p>
            </div>
            <footer class="single-entry-footer">
                <div class="entry-tags"><?php blog_post_tags(); ?></div>
                <div class="entry-share"><?php blog_post_share(); ?></div>
            </footer>
        </div>
    </article>

    <section class="blog-pagination" aria-label="Blog Pagination">
        <div class="pagination-container">
            <nav class="single-blog-post-nav" role="navigation">
                <div class="left"><?php next_post_link('%link', '<span>Next</span>%title'); // Left ?></div>
                <div class="right"><?php previous_post_link('%link', '<span>Previous</span>%title'); // Right ?></div>
            </nav>
        </div>
    </section>

    <aside id="singlepost-widgets" class="page-sidebar singlepost-widgets width-full clearfix">
        <section class="widget widget_block single-author-bio" aria-label="Article Author Bio" itemscope itemtype="https://schema.org/Person">
            <h2 class="author-bio-title">About the Author</h2>
            <div class="author-avatar">
                <figure class="alignleft" aria-label="Authors Avatar" itemprop="image">
                    <?=get_avatar(get_the_author_meta('ID'), 64); ?>
                </figure>
            </div>
            <h3 class="author-bio-name" itemprop="name" ><a href="<?php printf("%s/author/%s", home_url(), get_the_author_meta( 'user_nicename' )); ?>" rel="author" aria-label="See more posts by this author." itemprop="url"><?=get_the_author_meta( 'display_name' ); ?></a></h3>
            <p class="author-bio-about" itemprop="description"><?=shorten_the_content(get_the_author_meta( 'user_description' )); ?></p>
        </section>

        <section class="widget widget_block" aria-label="Page Widgets">
            <?php dynamic_sidebar( selectSidebarCustomField(get_the_ID(), 'singlepost') ); // Select from 'Widgets_Slug' custom field ?>
        </section>
    </aside>

    <section class="single-post-comments" aria-label="Article Comments">
        <?php comments_template(); // Display the comments for this post ?>
    </section>

    <?php endwhile; else : // If post doesn't exist ?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>" itemscope itemtype="https://schema.org/NewsArticle">
        <div class="post-container">
            <h1 class="single-entry-title" itemprop="name headline">Not Found</h1>
            <p itemprop="text">Sorry, no posts matched your criteria. Try and search for it?</p>
            <?php get_search_form('post'); // Search Form ?>
        </div>
    </article>

    <?php endif; ?>

    </div>

</main>

<?php get_footer(); ?>