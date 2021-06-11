<?php get_header(); ?>

<main class="page-main page-image">
    <div class="page-content width-full">

<?php include_once(ABSPATH . 'wp-admin/includes/plugin.php'); ?>
<?php if (is_plugin_active('breadcrumb-trail/breadcrumb-trail.php')) breadcrumb_trail(); ?>

<?php while ( have_posts() ) : the_post(); ?>
<article <?php post_class(); ?> id="<?php echo $post->post_name; ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
    <div>
        <h2 class="image-title" itemprop="title"><?php the_title(); ?></h2>
        <a href="<?php echo wp_get_attachment_url(get_the_ID()); ?>" title="Tap to view full size"><?php echo wp_get_attachment_image(get_the_ID(), 'large', 0 ); ?></a>
        <p class="image-description" role="contentinfo"><?php the_content(); ?></p>
        <p class="image-info">
            <span class="image-date" itemprop="datePublished">Uploaded on <time datetime="<?php printf(get_the_date('c')); ?>" itemprop="datePublished"><?php the_date(); ?></time></span>
            <span class="image-author" itemprop="author" rel="author">by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
        </p>
    </div>
</article>
<?php endwhile; ?>  

<section class="blog-pagination">
    <div>
        <nav class="wp-post-nav">
            <?php previous_image_link(array(48, 48), '&#x276E; Previous Image'); ?>
            <?php next_image_link(array(48, 48), 'Next Image &#x276F;'); ?>
        </nav>
    </div>
</section>

    </div>
</main>

<?php get_footer(); ?>