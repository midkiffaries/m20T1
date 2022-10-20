<?php /* Template Name: Page w/ Sidebar */ ?>
<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-simple <?php echo get_page_class(); ?>" id="main-content" role="main">
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

    <aside id="pagesidebar-widgets" class="page-sidebar pagesidebar-widgets">
        <?php dynamic_sidebar( selectSidebarCustomField(get_the_ID(), 'singlepagesidebar') ); // Select from 'Widgets Slug' custom field ?>

        <div class="widget child-page-widget">
            <?php get_child_pages(get_the_ID(), false); // Display the children of this page ?>
        </div>
    </aside>
</main>

<?php get_footer(); ?>