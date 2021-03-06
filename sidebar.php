<?php /* Template Name: Default template w/ Sidebar */ ?>
<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-simple <?php echo 'page-' . strtolower(preg_replace('/\s+/', '-', get_the_title())); ?>" id="main-content" role="main">
    <div class="page-content width-side">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article <?php post_class(); ?> id="<?php printf($post->post_name); ?>" name="<?php printf($post->post_name); ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
            <div class="post-container">
                <h1 class="page-title" itemprop="title"><?php the_title(); ?></h1>
                <div class="the-content">
                    <?php the_content("<p>Continue Reading &raquo;</p>"); ?>
                </div>
            </div>
        </article>

    <?php endwhile; endif; ?>

        <p class="page-last-updated hidden"><?php printf( __( 'Updated <time itemprop="dateModified">%s</time>', 'textdomain' ), get_the_modified_date() ); ?></p>
    </div>

    <aside id="pagesidebar-widgets" class="page-sidebar pagesidebar-widgets" role="complementary">
        <?php dynamic_sidebar( 'singlepagesidebar' ); // Page Sidebar ?>

        <div class="widget child-page-widget">
            <?php get_child_pages(get_the_ID(), false); // Display the children of this page ?>
        </div>
    </aside>
</main>

<?php get_footer(); ?>