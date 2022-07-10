<?php /* Template Name: Landing Page */ ?>
<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-landing-page <?php echo 'page-' . strtolower(preg_replace('/\s+/', '-', get_the_title())); ?>" id="main-content" role="main">
    <div class="page-content width-max">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?> 

        <article <?php post_class(); ?> id="<?php printf($post->post_name); ?>" name="<?php printf($post->post_name); ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
            <div>
                <h1 class="page-title hidden" itemprop="title"><?php the_title(); ?></h1>
                <div class="the-content">
                    <?php the_content("<p>Read the rest of this page &raquo;</p>"); ?>
                </div>
            </div>
        </article>

    <?php endwhile; endif; ?>

    </div>

    <aside id="frontpage-widgets" class="page-sidebar frontpage-widgets">
        <?php dynamic_sidebar( 'frontpage' ); // Frontpage widgets ?>

        <div class="widget child-page-widget">
            <?php get_child_pages(get_the_ID(), true); // Display the children of this page ?>
        </div>
    </aside>

    <p class="page-last-updated hidden"><?php printf( __( 'Updated <time itemprop="dateModified">%s</time>', 'textdomain' ), get_the_modified_date() ); ?></p>
</main>

<?php  get_footer(); ?>