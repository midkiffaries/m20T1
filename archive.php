<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>
<?php $curauth = $wp_query->get_queried_object(); // Get Author Info ?>

<main class="page-main page-archive" id="main-content" role="main">
    <div class="page-content width-side">
    
    <?php if (have_posts()) : // Has posts ?>
    
    <section class="archive-header" id="archive-page">
        <div class="archive-header-container">
            <h1 class="page-title" itemprop="name">
                <?php $post = $posts[0]; ?>
                <?php /* Category archive */ if (is_category()) : ?><?php single_cat_title(); ?>
                <?php /* Tag archive */ elseif (is_tag()) : ?><b>#</b><?php single_tag_title(); ?>
                <?php /* Daily archive */ elseif (is_day()) : ?><?php the_time('F j, Y'); ?>
                <?php /* Monthly archive */ elseif (is_month()) : ?><?php the_time('F Y'); ?>
                <?php /* Yearly archive */ elseif (is_year()) : ?><?php the_time('Y'); ?>
                <?php /* Author archive */ elseif (is_author()) : ?><?php printf($curauth->display_name); ?>
                <?php /* Paged archive */ elseif (isset($_GET['paged']) && !empty($_GET['paged'])) : ?>Blog Archives
            <?php endif; ?></h1>
            <div class="subtitle">
                <?php /* Category archive */ if (is_category()) printf(strip_tags(category_description())) || printf("All the posts under this category"); ?>
                <?php /* Tag archive */ if (is_tag()) printf(strip_tags(tag_description())) || printf("All the posts that have this tag"); ?>
                <?php /* Daily archive */ if (is_day()) printf("Posts from this date"); ?>
                <?php /* Monthly archive */ if (is_month()) printf("Posts from this month"); ?>
                <?php /* Yearly archive */ if (is_year()) printf("Posts from this year"); ?>
                <?php /* Author archive */ if (is_author()) printf("All the posts written by this author"); ?>
            </div>
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
            <p class="author-bio-about"><?php printf($curauth->description); ?></p>
            <p class="author-bio-contact">
                <?php if ($curauth->linkedin) : ?><a href="<?php esc_url(printf($curauth->linkedin)); ?>" rel="author">LinkedIn</a> | <?php endif; ?>
                <?php if ($curauth->twitter) : ?><a href="<?php esc_url(printf($curauth->twitter)); ?>" rel="author">Twitter</a> | <?php endif; ?>
                <?php if ($curauth->facebook) : ?><a href="<?php esc_url(printf($curauth->facebook)); ?>" rel="author">Facebook</a> | <?php endif; ?>
                <?php if ($curauth->instagram) : ?><a href="<?php esc_url(printf($curauth->instagram)); ?>" rel="author">Instagram</a> | <?php endif; ?>
                <?php if ($curauth->user_url) : ?><a href="<?php esc_url(printf($curauth->user_url)); ?>" rel="author">Website</a><?php endif; ?>
            </p>
        </div>
    </section>
    <?php endif; ?>

    <article class="archive-page" role="article" itemscope itemtype="http://schema.org/NewsArticle">

    <?php while (have_posts()) : the_post(); // Display blog posts ?>
    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <div class="post-container">
                <a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" class="entry-thumbnail" style="<?php echo FeaturedImageURL(get_the_ID(), 'medium', true); ?>">
                    <div class="entry-sticky"><?php if(is_sticky( get_the_ID() )) : // If sticky post ?>Featured Article<?php endif; ?>&nbsp;</div>
                </a>
                <header class="entry-header">
                    <div class="entry-date"><time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php the_date(); ?></time></div>
                    <h2 class="entry-title" id="<?php echo $post->post_name; ?>" itemprop="name"><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    <div class="entry-metadata">
                        <span class="entry-author">Written By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
                        <span class="entry-read-time"><?php echo post_separator(); ?> <?php echo reading_time(); ?></span>
                        <span class="entry-comments"><?php echo post_separator(); ?> <a href="<?php esc_url(the_permalink()); ?>#Comments" rel="bookmark"><?php comments_number('No Comments', 'One Comment', '% Comments');?></a></span>
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
            <h1 class="entry-title">
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
            </h1>
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