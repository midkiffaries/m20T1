<?php get_header(); ?>

<?php breadcrumb_trail(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- <?php echo $post->post_name; ?> Page -->
<article <?php post_class(); ?> id="<?php echo $post->post_name; ?>" name="<?php echo $post->post_name; ?>">
    <div>
        <h2><?php the_title(); ?></h2>
<?php the_content("<p>Read the rest of this section &raquo;</p>"); ?>
        
    </div>
</article>

<?php endwhile; endif; ?>

<?php  get_footer(); ?>