<?php get_header(); ?>

<main class="page-frontpage page-home" id="main-content" role="main">
    <div class="page-content width-max">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?> 

        <article <?php post_class(); ?> id="<?php printf($post->post_name); ?>" name="<?php printf($post->post_name); ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
            <div>
                <h2 class="page-title hidden" itemprop="title"><?php the_title(); ?></h2>
                <div class="the-content">
                    <?php the_content("<p>Read the rest of this section &raquo;</p>"); ?>
                
                </div>
            </div>
        </article>

    <?php endwhile; endif; ?>

    </div>

    <aside id="frontpage-widgets" class="page-sidebar frontpage-widgets">
        <?php dynamic_sidebar( 'frontpage' ); ?>
    </aside>

    <p class="page-last-updated hidden"><?php printf( __( 'Updated <time itemprop="dateModified">%s</time>', 'textdomain' ), get_the_modified_date() ); ?></p>
</main>

<?php  get_footer(); ?>