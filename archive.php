<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>
<?php $curauth = $wp_query->get_queried_object(); // Get Author Info ?>

<main class="page-main page-archive" id="main-content" role="main">
    <div class="page-content width-side">

    <section class="archive-header" id="archive-page">
        <div class="archive-header-container">
            <h1 class="page-title" itemprop="name"><?php if (have_posts()) : // Has posts ?>
    <?php $post = $posts[0]; ?>
    <?php /* Category archive */ if (is_category()) : ?><?php single_cat_title(); ?> <span class="subtitle"><?php printf(strip_tags(category_description())); ?></span>
    <?php /* Tag archive */ elseif (is_tag()) : ?>Posts tagged <b><?php single_tag_title(); ?></b> <span class="subtitle"><?php echo strip_tags(tag_description()); ?></span>
    <?php /* Daily archive */ elseif (is_day()) : ?>Posts from <b><?php the_time('F j, Y'); ?></b>
    <?php /* Monthly archive */ elseif (is_month()) : ?>Posts from <b><?php the_time('F Y'); ?></b>
    <?php /* Yearly archive */ elseif (is_year()) : ?>Posts from <b><?php the_time('Y'); ?></b>
    <?php /* Author archive */ elseif (is_author()) : ?>Posts by <b><?php printf($curauth->display_name); ?></b>
    <?php /* Paged archive */ elseif (isset($_GET['paged']) && !empty($_GET['paged'])) : ?>Blog Archives
    <?php endif; ?></h1>
        </div>
    </section>

    <?php if (is_author()) : // Display Author Page for when showing by author ?>
    <section class="archive-author-bio <?php echo get_option( 'show_avatars' ) ? 'show-avatars' : ''; ?>">
        <div class="author-container">
            <div class="author-avatar">
                <figure class="alignleft">
                    <?php printf(get_avatar(get_the_author_meta('ID'), 128)); ?>
                </figure>
            </div>
            <p class="author-bio-meta"><b><?php echo user_level(get_the_author_meta( 'user_level' )); ?> – <?php printf("%s Posts", number_format_i18n(get_the_author_posts())); ?></b></p>
            <p class="author-bio-about"><?php printf($curauth->description); ?><br><br>
            🌎 <a href="<?php esc_url(printf($curauth->user_url)); ?>" rel="author">Learn more about <?php printf($curauth->display_name); ?></a></p>
        </div>
    </section>
    <?php endif; ?>

    <article class="archive-page" role="article" itemscope itemtype="http://schema.org/NewsArticle">

    <?php while (have_posts()) : the_post(); // Display blog posts ?>
    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <div class="post-container">
                <div class="entry-thumbnail" style="<?php echo FeaturedImageURL(get_the_ID(), 'large', true); ?>">
                    <div class="entry-sticky"><?php if(is_sticky( get_the_ID() )) : // If sticky post ?>Featured Article<?php endif; ?>&nbsp;</div>
                </div>
                <header class="entry-header">
                    <div class="entry-date"><time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php the_date(); ?></time></div>
                    <h2 class="entry-title" id="<?php echo $post->post_name; ?>" itemprop="name"><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    <div class="entry-metadata">
                        <span class="entry-author">Written By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
                        <span class="entry-read-time"><?php echo post_separator(); ?> <?php echo reading_time(); ?></span>
                        <span class="entry-comments"><?php echo post_separator(); ?> <a href="<?php esc_url(the_permalink()); ?>#Comments" rel="bookmark" class="icon-comment"><?php comments_number('No Comments', 'One Comment', '% Comments');?></a></span>
                    </div>
                </header>
                <div class="the-content content-excerpt" itemprop="description">
                    <p><?php echo shorten_the_content($post->post_content); ?></p>
                </div>
                <footer class="entry-footer hidden">
                </footer>
            </div>
        </div>
    <?php endwhile; ?>

    </article>

    <section class="blog-pagination" aria-label="Archive Pagination">
        <div class="pagination-container">
            <nav class="blog-post-nav" role="navigation">
                <?php blog_post_pagination('Posts'); // Post navigation links ?>
            </nav>
        </div>
    </section>

    <?php else : // If no results ?>

    <article class="archive-page" role="article" itemscope itemtype="http://schema.org/NewsArticle">
        <div <?php post_class(); ?>>
            <h2 class="entry-title">
            <?php 
            if ( is_category() ) { // By category
                printf("There are no posts under the <b>%s</b> category.", single_cat_title('', false));
            } else if ( is_date() ) { // By date
                printf("There are no posts with this date.");
            } else if ( is_author() ) { // By Author
                printf("There are no posts by <b>%s</b>.", $curauth->nickname);
            } else { // No posts found
                printf("No posts found at all.");
            }
            ?>
            </h2>
            <p>Would you like to try a search to find what you are looking for?</p>
            <?php get_search_form('archive'); // Search Form ?>
        </div>
    </article>

    <?php endif; ?>

    </div>
    
    <aside id="sidebar-archive" class="page-sidebar archive-widgets" role="complementary">
        <?php dynamic_sidebar( 'secondary' ); // Secondary Sidebar ?>
    </aside>

</main>

<?php get_footer(); ?>