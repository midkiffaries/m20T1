<?php /* Template Name: Portfolio Page */ ?>
<?php defined( 'ABSPATH' ) || exit; // Exit if accessed directly ?>
<?php $pageKind = "portfolio"; ?>
<?php get_header(); ?>

<main class="page-main width-full page-<?=$pageKind;?> <?=get_page_class();?>" id="main-content" itemscope itemtype="https://schema.org/<?=custom_page_article(get_the_ID());?>" itemprop="mainEntity">
    
    <div class="page-content">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article <?php post_class(); ?> id="<?=$post->post_name;?>" name="<?=$post->post_name; ?>" itemscope itemtype="https://schema.org/CreativeWork">
            <div class="post-container">
                <?php $postType = get_post_type_object(get_post_type()); ?>
                <div class="<?=$pageKind;?>-name" itemprop="articleSection"><a href="<?=home_url() . "/" . esc_html($postType->labels->uri_slug) . "/"; ?>"><?=get_post_type();?></a></div>
                <h1 class="page-title" itemprop="name headline"><?php the_title(); ?></h1>
                <div class="the-content" itemprop="text articleBody description" id="TheContent">
                    <?php the_content("<p>Continue Reading &raquo;</p>"); ?>

                </div>
            </div>
        </article>

        <div class="page-last-updated">
            <time datetime="<?=get_the_date('c');?>" itemprop="datePublished" class="hidden"><?php the_date(); ?></time>
            <?=display_last_updated();?>
        </div>

        <section class="blog-pagination <?=$pageKind;?>-pagination" aria-label="<?=$pageKind;?> Pagination">
            <div class="pagination-container">
                <nav class="single-blog-post-nav" role="navigation">
                    <div class="left"><?php next_post_link('%link', '<span>Next</span>%title'); // Left ?></div>
                    <div class="right"><?php previous_post_link('%link', '<span>Previous</span>%title'); // Right ?></div>
                </nav>
            </div>
        </section>

        <aside id="page-widgets" class="page-sidebar <?=$pageKind;?>-widgets width-full">
            <?php dynamic_sidebar( selectSidebarCustomField(get_the_ID(), 'singlepage') ); // Select from 'Widgets_Slug' custom field ?>
        
            <div class="widget child-page-widget">
                <?php //get_child_pages(get_the_ID(), false); // Display the children of this page ?>
            </div>
        </aside>

        <?php endwhile; endif; ?>

    </div>
    
</main>

<?php get_footer(); ?>