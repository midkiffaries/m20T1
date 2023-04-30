<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-image <?=get_page_class(); ?>" id="main-content" role="main">
    <div class="page-content width-full">

    <?php while ( have_posts() ) : the_post(); // Display selected media ?>

        <article <?php post_class(); ?> id="<?=$post->post_name; ?>" itemscope itemtype="https://schema.org/NewsArticle">
            <div class="post-container">
                <h1 class="page-title" itemprop="name"><?=the_title(); ?></h1>
                <div class="wp-block-image" role="figure">
                    <div class="image-attachment"><a href="<?=wp_get_attachment_url(get_the_ID()); ?>" title="View this image or document" aria-title="View this image or document" itemprop="image">
                        <?=attachment_page_image(get_the_ID()); ?>
                    </a></div>
                    <div class="image-caption" role="caption"><?=wp_kses_post( wp_get_attachment_caption() ); ?></div>
                </div>
                <div class="image-description" itemprop="text">
                    <?=the_content("<p>Continue Reading &raquo;</p>"); ?>
                </div>
                <p class="image-info" role="note">
                    <span class="image-date" itemprop="uploadDate">Uploaded on <time datetime="<?=get_the_date('c'); ?>" itemprop="datePublished"><?php the_date(); ?></time></span>
                    <span class="image-author">by <a href="<?=get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
                    <br>
                    <span class="image-category">Category: <b><?php the_category(' '); ?></b></span>
                    <br>
                    <span class="image-filesize" itemprop="size"><?=image_metadata(wp_get_attachment_url(get_the_ID())); ?></span>
                </p>
                <div class="image-share"><?=blog_post_share(); ?></div>
                <div class="image-links"><i>Related Post</i><br> <a href="<?=get_permalink( get_post_parent(get_the_ID()) ); ?>"><?php if (has_post_parent(get_the_ID())) echo get_the_title( get_post_parent(get_the_ID()) ); else echo "Not attached to any posts"; ?></a></div>
            </div>
        </article>

    <?php endwhile; ?>

        <section class="blog-pagination" aria-label="Image Pagination">
            <div class="pagination-container">
                <nav class="image-nav">
                    <?php next_image_link(array(48, 48), '&#x276E; Next Image', 0); // Left ?>
                    <?php previous_image_link(array(48, 48), 'Previous Image &#x276F;', 0); // Right ?>
                </nav>
            </div>
        </section>

        <section class="image-copyright" role="note">
            <p>Media and images may be subject to copyright. <a href="https://www.copyright.gov/" rel="noopener noreferrer" target="_blank">Learn More</a></p>
        </section>

        <aside id="page-widgets" class="page-sidebar attachment-widgets width-full" role="complementary">
            <?php dynamic_sidebar( 'singlepage' ); // Page Sidebar ?>
        </aside>

    </div>
</main>

<?php get_footer(); ?>