<?php get_header(); ?>

<main class="page-main page-simple page-<?php preg_replace('/\s+/', '-', the_title()); ?>" id="main-content" role="main">
    <div class="page-content width-full">

    <?php breadcrumb_trail(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article <?php post_class(); ?> id="<?php printf($post->post_name); ?>" name="<?php printf($post->post_name); ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
            <div class="post-container">
                <h2 class="page-title" id="<?php echo $post->post_name; ?>"><?php the_title(); ?></h2>
                <div class="the-content">
                    <?php the_content("<p>Read the rest of this section &raquo;</p>"); ?>
                
                </div>
            </div>
        </article>

    <?php endwhile; endif; ?>

        <aside id="page-widgets" class="page-sidebar page-widgets">
            <?php dynamic_sidebar( 'singlepost' ); ?>
        </aside>

        <p class="page-last-updated hidden"><?php printf( __( 'Updated <time itemprop="dateModified">%s</time>', 'textdomain' ), get_the_modified_date() ); ?></p>
    </div>
</main>

<?php get_footer(); ?>