<?php get_header(); ?>

<main class="page-landing page-<?php preg_replace('/\s+/', '-', the_title()); ?>" id="main-content" role="main">
    <div class="page-content width-max">

    <?php breadcrumb_trail(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article <?php post_class(); ?> id="<?php printf($post->post_name); ?>" name="<?php printf($post->post_name); ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
            <div class="post-container">
                <h2 class="page-title" itemprop="title"><?php the_title(); ?></h2>
                <div class="the-content">
                    <?php the_content("<p>Read the rest of this section &raquo;</p>"); ?>
                
                </div>
                <p class="page-last-updated hidden"><?php printf( __( 'Page last modified: <time itemprop="dateModified">%s</time>', 'textdomain' ), get_the_modified_date() ); ?></p>
            </div>
        </article>

    <?php endwhile; endif; ?>

        <aside id="page-widgets" class="page-sidebar page-widgets">
            <?php dynamic_sidebar( 'other' ); ?>

            <?php get_child_pages(get_the_ID(), true); // Display the children of this page ?>
        </aside>

    </div>
</main>

<?php get_footer(); ?>