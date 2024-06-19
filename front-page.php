<?php /* Template Name: Landing Page */ ?>
<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main-wide width-max page-landing-page <?=get_page_class(); ?>" id="main-content" itemscope itemtype="https://schema.org/<?=custom_page_article(get_the_ID());?>" itemprop="mainEntity">
    
    <div class="page-content">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?> 

        <article <?php post_class(); ?> id="<?=$post->post_name;?>">
            <div>
                <h1 class="page-title hidden" itemprop="name headline" aria-hidden="true"><?php the_title(); ?></h1>
                <div class="the-content" itemprop="text articleBody description" id="TheContent">
                    <?php the_content("<p>Read the rest of this page &raquo;</p>"); ?>

                    <?=custom_page_css(get_the_ID()); ?>
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

    <div class="page-last-updated hidden">
        <time datetime="<?=get_the_date('c'); ?>" itemprop="datePublished"><?php the_date(); ?></time>
        <?php display_last_updated() ?>
    </div>

</main>

<?php get_footer(); ?>