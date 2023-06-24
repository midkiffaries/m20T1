<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-portfolio <?=get_page_class(); ?>" id="main-content" itemscope itemtype="https://schema.org/Article" itemprop="mainEntity">
    <div class="page-content width-full">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article <?php post_class(); ?> id="<?=$post->post_name; ?>" name="<?=$post->post_name; ?>" itemscope itemtype="https://schema.org/CreativeWork">
            <div class="post-container">
                <div class="portfolio-name" itemprop="articleSection"><?=get_post_type(); ?></div>
                <h1 class="page-title" itemprop="name headline"><?php the_title(); ?></h1>
                <div class="the-content" itemprop="text description">
                    <?php the_content("<p>Continue Reading &raquo;</p>"); ?>

                </div>
            </div>
        </article>

    <?php endwhile; endif; ?>

        <aside id="page-widgets" class="page-sidebar portfolio-widgets width-full">
            <?php dynamic_sidebar( selectSidebarCustomField(get_the_ID(), 'portfoliopage') ); // Select from 'Widgets_Slug' custom field ?>
            
        </aside>

        <div class="page-last-updated">
            <?php display_last_updated() ?>
        </div>

    </div>
</main>

<?php get_footer(); ?>