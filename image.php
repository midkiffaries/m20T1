<?php get_header(); ?>

<?php breadcrumb_trail(); ?>

<?php while ( have_posts() ) : the_post(); ?>
<article <?php post_class(); ?>>
    <div>
        <h2><?php the_title(); ?></h2>
        <a href="<?php echo wp_get_attachment_url(get_the_ID()); ?>" title="Tap to view full size"><?php echo wp_get_attachment_image(get_the_ID(), 'large', 0 ); ?></a>
        <p class="image-description"><?php the_content(); ?></p>
        <p class="image-author">Uploaded by <?php the_author(); ?></p>
    </div>
</article>
<?php endwhile; ?>  

<?php get_footer(); ?>