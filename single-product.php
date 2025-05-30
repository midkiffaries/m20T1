<?php /* Template Name: Product Page */ ?>
<?php defined( 'ABSPATH' ) || exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-product width-full <?=get_page_class();?>" id="main-content" itemscope itemtype="https://schema.org/<?=custom_page_article(get_the_ID());?>" itemprop="mainEntity">
    
    <div class="page-content">

    <?php if (have_posts()) : while (have_posts()) : the_post(); // Single Post ?>

        <article <?php post_class(); ?> id="<?=$post->post_name;?>" name="<?=$post->post_name;?>" itemscope itemtype="https://schema.org/Product">
            <div class="post-container">
                <div class="product-title" itemprop="articleSection"><a href="<?=home_url() . "/" . get_post_type() . "/";?>">Shop</a></div>
                <h1 class="page-title" itemprop="name headline"><?php the_title(); ?></h1>
                <div class="the-content" itemprop="text articleBody description">
                    <?php the_content("<p>Continue Reading &raquo;</p>"); ?>
                    
                </div>
            </div>
        </article>

        <div class="page-last-updated">
            <time datetime="<?=get_the_date('c');?>" itemprop="datePublished"><?php the_date(); ?></time>
            <?=display_last_updated();?>
        </div>

        <aside id="page-widgets" class="page-sidebar product-widgets width-full">
            <?php dynamic_sidebar( selectSidebarCustomField(get_the_ID(), 'singlepage') ); // Select from 'Widgets_Slug' custom field ?>
        </aside>

        <?php endwhile; endif; ?>

    </div>
    
</main>

<?php get_footer(); ?>