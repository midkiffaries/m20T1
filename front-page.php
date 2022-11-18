<?php /* Template Name: Custom Full Width */ ?>
<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main-wide page-landing-page <?php echo get_page_class(); ?>" id="main-content" role="main">
    <div class="page-content width-max">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?> 

        <article <?php post_class(); ?> id="<?php printf($post->post_name); ?>" name="<?php printf($post->post_name); ?>" itemscope itemtype="http://schema.org/NewsArticle">
            <div>
                <h1 class="page-title hidden" itemprop="name" aria-hidden="true"><?php the_title(); ?></h1>
                <div class="the-content" itemprop="description">
                    <?php the_content("<p>Read the rest of this page &raquo;</p>"); ?>

                </div>
            </div>
        </article>

    <?php endwhile; endif; ?>

    </div>

    <aside id="frontpage-widgets" class="page-sidebar frontpage-widgets width-full">
        <?php dynamic_sidebar( selectSidebarCustomField(get_the_ID(), 'frontpage') ); // Select from 'Widgets_Slug' custom field ?>

        <div class="widget child-page-widget">
            <?php get_child_pages(get_the_ID(), true); // Display the children of this page ?>
        </div>
    </aside>

    <p class="page-last-updated hidden"><?php printf( __( 'Updated <time itemprop="dateModified">%s</time>', 'textdomain' ), get_the_modified_date() ); ?></p>
</main>

<?php get_footer(); ?>