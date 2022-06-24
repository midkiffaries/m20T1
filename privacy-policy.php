<?php /* Template Name: Privacy Policy Page */ ?>
<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-simple page-privacy-policy" id="main-content" role="main">
    <div class="page-content width-full">

    <?php if (have_posts()) : while (have_posts()) : the_post(); // Get the post ?>

        <article <?php post_class(); ?> id="<?php printf($post->post_name); ?>" name="<?php printf($post->post_name); ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
            <div class="post-container">
                <h2 class="page-title" itemprop="title"><?php the_title(); ?></h2>
                <p class="policy-last-updated"><?php printf( __( 'Updated <time itemprop="dateModified">%s</time>', 'textdomain' ), get_the_modified_date() ); ?></p>
                <div class="the-content">
                    <?php the_content("<p>Continue Reading &raquo;</p>"); ?>
                
                </div>
            </div>
        </article>

    <?php endwhile; endif; ?>

        <aside id="privacy-policy-widgets" class="privacy-policy-sidebar privacy-policy-widgets">
            <?php dynamic_sidebar( 'privacypolicy' ); // Page Sidebar ?>

            <div class="widget child-page-widget">
                <?php get_child_pages(get_the_ID(), false); // Display the children of this page ?>
            </div>
        </aside>

    </div>
</main>

<?php get_footer(); ?>