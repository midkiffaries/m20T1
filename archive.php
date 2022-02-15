<?php get_header(); ?>

<main class="page-main page-archive" id="main-content" role="main">
    <div class="page-content width-side">

    <?php breadcrumb_trail(); ?>

    <?php $curauth = $wp_query->get_queried_object(); ?>

    <section class="archive-header" id="archive-page">
        <div class="archive-header-container">
            <h2 class="page-title" itemprop="title"><?php if (have_posts()) : ?>
    <?php $post = $posts[0]; ?>
    <?php /* category archive */ if (is_category()) { ?><?php single_cat_title(); ?> <span><?php printf(strip_tags(category_description())); ?></span>
    <?php /* tag archive */ } elseif( is_tag() ) { ?>Posts tagged <b><?php single_tag_title(); ?></b> <span><?php echo strip_tags(tag_description()); ?></span>
    <?php /* daily archive */ } elseif (is_day()) { ?>Posts from <b><?php the_time('F j, Y'); ?></b>
    <?php /* monthly archive */ } elseif (is_month()) { ?>Posts from <b><?php the_time('F Y'); ?></b>
    <?php /* yearly archive */ } elseif (is_year()) { ?>Posts from <b><?php the_time('Y'); ?></b>
    <?php /* author archive */ } elseif (is_author()) { ?>Posts by <b><?php printf($curauth->display_name); ?></b>
    <?php /* paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>Blog Archives
    <?php } ?></h2>
        </div>
    </section>

    <?php if (is_author()) : ?>

    <section class="author-bio <?php echo get_option( 'show_avatars' ) ? 'show-avatars' : ''; ?>" role="complementary">
        <div class="author-container">
            <div class="author-avatar">
                <figure class="alignleft" aria-label="Authors Avatar">
                    <?php printf(get_avatar(get_the_author_meta('ID'), 128)); ?>
                </figure>
            </div>
            <p class="author-bio-about"><?php printf($curauth->description); ?><br>
            🌎 <a href="<?php printf($curauth->user_url); ?>" rel="author"><?php printf($curauth->user_url); ?></a></p>
            <p class="author-bio-meta"><b><?php printf("%s Posts", number_format_i18n(get_the_author_posts())); ?></b></p>
        </div>
    </section>

    <?php endif; ?>

    <article class="archive-page" role="article" itemscope itemtype="http://schema.org/NewsArticle">

    <?php while (have_posts()) : the_post(); ?>
    
        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <div class="post-container">    
                <header class="entry-header">
                    <h3 class="entry-title" itemprop="title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                    <div class="entry-info">
                        <span class="entry-author">By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
                        <span class="entry-date">on <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php the_date(); ?></time> <span class="entry-last-updated"><?php if (get_the_modified_date('Y-m-d') != get_the_date('Y-m-d')) printf( __( '(Updated <time>%s</time>)', 'textdomain' ), get_the_modified_date() ); ?></span></span>
                    </div>
                </header>
                <div class="entry-content <?php echo ResizeFontClass($post->post_content); ?>">
                    <?php the_content("<p>Continue Reading &raquo;</p>"); ?>
                </div>
                <div class="entry-overflow"></div>
                <footer class="entry-footer">
                    <div class="entry-tags"><?php the_tags('<ul><li rel="tag">', '</li><li rel="tag">', '</li></ul>'); ?></div>
                    <div class="entry-share"><?php blog_post_share(); ?></div>
                </footer>
            </div>
        </div>

    <?php endwhile; ?>

    </article>

    <section class="blog-pagination">
        <div class="pagination-container">
            <nav class="blog-post-nav">
                <?php blog_post_pagination('Posts'); ?>
            </nav>
        </div>
    </section>

    <?php else : ?>

    <article class="archive-page" role="article" itemscope itemtype="http://schema.org/NewsArticle">
        <div <?php post_class(); ?>>
            <h3 class="entry-title">
            <?php 
            if ( is_category() ) { // If this is a category archive
                printf("There are no posts under the <b>%s</b> category.", single_cat_title('', false));
            } else if ( is_date() ) { // If this is a date archive
                printf("There are no posts with this date.");
            } else if ( is_author() ) { // If this is a category archive
                printf("There are no posts by <b>%s</b>.", $curauth->nickname);
            } else { // Other or no posts
                printf("No posts found.");
            }
            ?>
            </h3>
            <p>Would you like to try a search to find what you are looking for?</p>
            <?php get_search_form('archive'); ?>
        </div>
    </article>

    <?php endif; ?>

    </div>
    
    <aside id="sidebar-archive" class="page-sidebar sidebar-archive" role="sidebar">
        <?php dynamic_sidebar( 'secondary' ); ?>
    </aside>

</main>

<?php get_footer(); ?>