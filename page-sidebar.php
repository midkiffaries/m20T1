<?php /* Template Name: Page w/ Sidebar */ ?>
<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-simple <?=get_page_class(); ?>" id="main-content" itemscope itemtype="https://schema.org/Article" itemprop="mainEntity">
    <div class="page-content width-side">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article <?php post_class(); ?> id="<?=$post->post_name; ?>" itemscope itemtype="https://schema.org/NewsArticle">
            <div class="post-container">
                <h1 class="page-title" itemprop="name headline"><?php the_title(); ?></h1>
                <div class="the-content" itemprop="text articleBody">
                    <?php the_content("<p>Continue Reading &raquo;</p>"); ?>
                    <?=custom_page_css(get_the_ID()); ?>
                </div>
            </div>
        </article>

    <?php endwhile; endif; ?>
    
        <aside id="pagesidebar-widgets" class="page-sidebar pagesidebar-widgets">
            <?php dynamic_sidebar( selectSidebarCustomField(get_the_ID(), 'singlepagesidebar') ); // Select from 'Widgets Slug' custom field ?>

            <div class="widget child-page-widget">
                <?php get_child_pages(get_the_ID(), false); // Display the children of this page ?>
            </div>
        </aside>

        <div class="page-last-updated hidden">
            <?php display_last_updated(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>