<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-simple <?php echo 'page-' . strtolower(preg_replace('/\s+/', '-', get_the_title())); ?>" id="main-content" role="main">
    <div class="page-content width-full">

    <?php if (have_posts()) : while (have_posts()) : the_post(); // Get the post ?>

        <article <?php post_class(); ?> id="<?php printf($post->post_name); ?>" name="<?php printf($post->post_name); ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
            <div class="post-container">
                <h1 class="page-title" itemprop="title"><?php the_title(); ?></h1>
                <p class="policy-last-updated"><?php printf( __( 'Updated <time itemprop="dateModified">%s</time>', 'textdomain' ), get_the_modified_date() ); ?></p>
                <div class="the-content">
                    <?php the_content("<p>Continue Reading &raquo;</p>"); ?>
                
                </div>
            </div>
        </article>

    <?php endwhile; endif; ?>

        <aside id="privacy-policy-widgets" class="page-sidebar privacypolicy-widgets width-full" role="complementary">
            <?php dynamic_sidebar( 'privacypolicy' ); // Privacy policy widgets ?>

            <div class="widget child-page-widget">
                <?php get_child_pages(get_the_ID(), false); // Display the children of this page ?>
            </div>
        </aside>

    </div>
</main>

<?php get_footer(); ?>