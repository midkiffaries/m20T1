<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-portfolio <?=get_page_class(); ?>" id="main-content" itemscope itemtype="https://schema.org/Article" itemprop="mainEntity">
    <div class="page-content width-full">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article <?php post_class(); ?> id="<?=$post->post_name; ?>" name="<?=$post->post_name; ?>" itemscope itemtype="https://schema.org/CreativeWork">
            <div class="post-container">
                <h1 class="page-title" itemprop="name headline"><?php the_title(); ?></h1>
                <div class="the-content" itemprop="text description">
                    <?php the_content("<p>Continue Reading &raquo;</p>"); ?>

                </div>
            </div>
        </article>

    <?php endwhile; endif; ?>

        <p class="page-last-updated"><?php printf( __( 'Updated <time itemprop="dateModified">%s</time>', 'textdomain' ), get_the_modified_date() ); ?></p>

        <aside id="page-widgets" class="page-sidebar portfolio-widgets width-full">
            <?php dynamic_sidebar( selectSidebarCustomField(get_the_ID(), 'singlepage') ); // Select from 'Widgets_Slug' custom field ?>
            
            <section class="widget widget_block" aria-label="Page Widgets">
                <?php dynamic_sidebar( selectSidebarCustomField(get_the_ID(), 'singlepost') ); // Select from 'Widgets_Slug' custom field ?>
            </section>
        </aside>

    </div>
</main>

<?php get_footer(); ?>