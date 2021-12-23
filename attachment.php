<?php get_header(); ?>

<main class="page-main page-image" id="main-content" role="main">
    <div class="page-content width-full">

<?php while ( have_posts() ) : the_post(); ?>
<article <?php post_class(); ?> id="<?php echo $post->post_name; ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
    <div class="post-container">
        <h2 class="image-title" id="<?php echo $post->post_name; ?>" itemprop="title"><?php the_title(); ?></h2>
        <figure class="wp-block-image">
            <?php echo wp_get_attachment_image(get_the_ID(), 'large', 0); ?>
            <figcaption class="image-caption"><?php echo wp_kses_post( wp_get_attachment_caption() ); ?></figcaption>
        </figure>
        <?php the_content("<p>Read the rest of this section &raquo;</p>"); ?>
        <p class="image-info">
            <span class="image-date">Uploaded on <time datetime="<?php printf(get_the_date('c')); ?>" itemprop="datePublished"><?php the_date(); ?></time></span>
            <span class="image-author">by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
        </p>
        <p class="image-download"><a href="<?php echo wp_get_attachment_url(get_the_ID()); ?>">View the full image</a></p>
    </div>
</article>
<?php endwhile; ?>

<section class="blog-pagination">
    <div class="pagination-container">
        <nav class="image-nav">
            <?php next_image_link(array(48, 48), '&#x276E; Next Image', 0); ?>
            <?php previous_image_link(array(48, 48), 'Previous Image &#x276F;', 0); ?>
        </nav>
    </div>
</section>

    </div>
</main>

<?php get_footer(); ?>