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
                <?php /* Category */ if (is_category()) single_cat_title(); ?>
                <?php /* Tags */ if (is_tag()) printf("<b>#</b>") . single_tag_title(); ?>
                <?php /* Daily */ if (is_day()) the_time('F j, Y'); ?>
                <?php /* Monthly */ if (is_month()) the_time('F Y'); ?>
                <?php /* Yearly */ if (is_year()) the_time('Y'); ?>
                <?php /* Author */ if (is_author()) printf($curauth->display_name); ?>
                <?php /* Paged */ if (isset($_GET['paged']) && !empty($_GET['paged'])) printf("Blog Archives"); ?>
            </h1>
            <div class="subtitle">
                <?php /* Category */ if (is_category()) printf(strip_tags(category_description())) || printf("All the posts under this category"); ?>
                <?php /* Tags */ if (is_tag()) printf(strip_tags(tag_description())) || printf("All the posts that have this tag"); ?>
                <?php /* Daily */ if (is_day()) printf("Posts from this date"); ?>
                <?php /* Monthly */ if (is_month()) printf("Posts from this month"); ?>
                <?php /* Yearly */ if (is_year()) printf("Posts from this year"); ?>
                <?php /* Author */ if (is_author()) printf("Posts written by this author"); ?>
            </div>
        </div>
    </section>

    <?php if (is_author()) : // Display Author Page for when showing by author ?>
    <section class="archive-author-bio <?=get_option( 'show_avatars' ) ? 'show-avatars' : ''; ?>">
        <div class="author-container">
            <div class="author-avatar">
                <figure class="alignleft">
                    <?=get_avatar(get_the_author_meta('ID'), 128); ?>
                </figure>
            </div>
            <p class="author-bio-meta"><b><?=user_level(get_the_author_meta( 'user_level' )); ?> – <?=number_format_i18n(get_the_author_posts()); ?> Posts</b></p>
            <p class="author-bio-about"><?=nl2br($curauth->description); ?></p>
            <p class="author-bio-contact">
                <?php if ($curauth->linkedin) : ?><a href="<?=esc_url($curauth->linkedin); ?>" rel="author">LinkedIn</a> | <?php endif; ?>
                <?php if ($curauth->twitter) : ?><a href="<?=esc_url($curauth->twitter); ?>" rel="author">Twitter</a> | <?php endif; ?>
                <?php if ($curauth->facebook) : ?><a href="<?=esc_url($curauth->facebook); ?>" rel="author">Facebook</a> | <?php endif; ?>
                <?php if ($curauth->instagram) : ?><a href="<?=esc_url($curauth->instagram); ?>" rel="author">Instagram</a> | <?php endif; ?>
                <?php if ($curauth->user_url) : ?><a href="<?=esc_url($curauth->user_url); ?>" rel="author">Website</a><?php endif; ?>
            </p>
        </div>
    </section>
    <?php endif; ?>

    <article class="archive-page" itemscope itemtype="https://schema.org/NewsArticle">

    <?php while (have_posts()) : the_post(); // Display blog posts ?>
    <div <?php post_class(); ?> id="post-<?=the_ID(); ?>">
            <div class="post-container">
                <a href="<?=esc_url(the_permalink()); ?>" rel="bookmark" class="entry-thumbnail" style="<?=FeaturedImageURL(get_the_ID(), 'medium', true); ?>">
                    <div class="entry-sticky"><?php if(is_sticky( get_the_ID() )) : // If sticky post ?>Featured Article<?php endif; ?>&nbsp;</div>
                </a>
                <header class="entry-header">
                    <div class="entry-date"><time datetime="<?=get_the_date('c'); ?>" itemprop="datePublished"><?=the_date(); ?></time></div>
                    <h2 class="entry-title" id="<?=$post->post_name; ?>" itemprop="name"><a href="<?=esc_url(the_permalink()); ?>" rel="bookmark"><?=the_title(); ?></a></h2>
                    <div class="entry-metadata">
                        <span class="entry-author">Written By <a href="<?=get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
                        <span class="entry-read-time"><?=post_separator(); ?> <?=reading_time(); ?></span>
                        <span class="entry-comments"><?=post_separator(); ?> <a href="<?=esc_url(the_permalink()); ?>#Comments" rel="bookmark"><?=comments_number('No Comments', 'One Comment', '% Comments');?></a></span>
                    </div>
                </header>
                <div class="the-content content-excerpt" itemprop="description">
                    <p><?=shorten_the_content($post->post_content); ?></p>
                </div>
                <footer class="entry-footer hidden">
                </footer>
            </div>
        </div>
    <?php endwhile; ?>

    </article>

    <section class="blog-pagination" aria-label="Archive Pagination">
        <div class="pagination-container">
            <nav class="blog-post-nav">
                <?=blog_post_pagination('Posts'); // Post navigation links ?>
            </nav>
        </div>
    </section>

    <?php else : // If no results ?>

    <article class="archive-page" itemscope itemtype="https://schema.org/NewsArticle">
        <div <?php post_class(); ?>>
            <h1 class="page-title">
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
    
    <aside id="sidebar-archive" class="page-sidebar archive-widgets">
        <?php dynamic_sidebar( 'secondary' ); // Secondary Sidebar ?>
    </aside>

</main>

<?php get_footer(); ?>