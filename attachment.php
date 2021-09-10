<?php get_header(); ?>

<main class="page-main page-image" role="main">
    <div class="page-content width-full">

<?php breadcrumb_trail(); ?>

<?php while ( have_posts() ) : the_post(); ?>
<article <?php post_class(); ?> id="<?php echo $post->post_name; ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
    <div class="post-container">
        <h2 class="image-title" itemprop="title"><?php the_title(); ?></h2>
        <figure class="wp-block-image">
            <?php echo wp_get_attachment_image(get_the_ID(), 'large', 0 ); ?>
            <figcaption class="image-description"><?php echo wp_kses_post( wp_get_attachment_caption() ); ?></figcaption>
        </figure>
        <p><a href="<?php echo wp_get_attachment_url(get_the_ID()); ?>">Link to the original image</a></p>
        <p class="image-info">
            <span class="image-date" itemprop="datePublished">Uploaded on <time datetime="<?php printf(get_the_date('c')); ?>" itemprop="datePublished"><?php the_date(); ?></time></span>
            <span class="image-author" itemprop="author" rel="author">by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
        </p>
    </div>
</article>
<?php endwhile; ?>

<section class="blog-pagination">
    <div class="pagination-container">
        <nav class="image-nav">
            <?php next_image_link(array(48, 48), '&#x276E; Next Image'); ?>
            <?php previous_image_link(array(48, 48), 'Previous Image &#x276F;'); ?>
        </nav>
    </div>
</section>

    </div>
</main>

<?php get_footer(); ?>