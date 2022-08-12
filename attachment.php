<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-image <?php echo get_page_class(); ?>" id="main-content" role="main">
    <div class="page-content width-full">

    <?php while ( have_posts() ) : the_post(); // Display selected media ?>

        <article <?php post_class(); ?> id="<?php echo $post->post_name; ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
            <div class="post-container">
                <h1 class="image-title" itemprop="name"><?php the_title(); ?></h1>
                <div class="wp-block-image">
                    <div><a href="<?php echo wp_get_attachment_url(get_the_ID()); ?>" title="Enlarge image" aria-title="View the full image"><?php echo wp_get_attachment_image(get_the_ID(), 'large', 0); ?></a></div>
                    <div class="image-caption"><?php echo wp_kses_post( wp_get_attachment_caption() ); ?></div>
                </dic>
                <div class="the-content" itemprop="description">
                    <?php the_content("<p>Continue Reading &raquo;</p>"); ?>
                </div>
                <p class="image-info">
                    <span class="image-date" itemprop="uploadDate">Uploaded on <time datetime="<?php printf(get_the_date('c')); ?>" itemprop="datePublished"><?php the_date(); ?></time></span>
                    <span class="image-author">by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
                    <br>
                    <span class="image-category">Category: <?php the_category(' '); ?></span>
                    <span class="image-filesize"><?php echo post_separator(); ?> File size: <?php echo file_units(wp_filesize(wp_get_attachment_url(get_the_ID()))); ?></a></span>
                </p>
                <div class="image-share"><?php blog_post_share(); ?></div>
                <div class="image-download hidden"><a href="<?php echo wp_get_attachment_url(get_the_ID()); ?>">View the full media file</a></div>
            </div>
        </article>

    <?php endwhile; ?>

        <section class="blog-pagination" aria-label="Image Pagination">
            <div class="pagination-container">
                <nav class="image-nav" role="navigation">
                    <?php next_image_link(array(48, 48), '&#x276E; Next Image', 0); // Left ?>
                    <?php previous_image_link(array(48, 48), 'Previous Image &#x276F;', 0); // Right ?>
                </nav>
            </div>
        </section>

        <section class="image-copyright">
            <p><small><i>Media and images may be subject to copyright. <a href="https://www.copyright.gov/" rel="noopener noreferrer" target="_blank">Learn More</a></i></small></p>
        </section>

        <aside id="page-widgets" class="page-sidebar attachment-widgets width-full" role="complementary">
            <?php dynamic_sidebar( 'singlepage' ); // Page Sidebar ?>
        </aside>

    </div>
</main>

<?php get_footer(); ?>