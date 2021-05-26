<?php get_header(); ?>

<?php include_once(ABSPATH . 'wp-admin/includes/plugin.php'); ?>
<?php if (is_plugin_active('breadcrumb-trail/breadcrumb-trail.php')) breadcrumb_trail(); ?>

<?php while ( have_posts() ) : the_post(); ?>
<article <?php post_class(); ?> id="<?php echo $post->post_name; ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
    <div>
        <h2 class="image-title" itemprop="title"><?php the_title(); ?></h2>
        <a href="<?php echo wp_get_attachment_url(get_the_ID()); ?>" title="Tap to view full size"><?php echo wp_get_attachment_image(get_the_ID(), 'large', 0 ); ?></a>
        <p class="image-description" role="contentinfo"><?php the_content(); ?></p>
        <p class="image-date" itemprop="datePublished">Uploaded on <time><?php the_date(); ?></time></p>
        <p class="image-author" itemprop="author" rel="author">Uploaded by <?php the_author(); ?></p>
    </div>
</article>
<?php endwhile; ?>  

<section class="image-pagination">
    <div>
        <ul class="wp-image-nav">
            <li><span>Previous Image</span> <?php previous_image_link('thumbnail'); ?></li>
            <li><?php next_image_link('thumbnail'); ?> <span>Next Image</span></li>
        </ul>
    </div>
</section>

<?php get_footer(); ?>