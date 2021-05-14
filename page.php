<?php get_header(); ?>

<?php breadcrumb_trail(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article <?php post_class(); ?> id="<?php printf($post->post_name); ?>" name="<?php printf($post->post_name); ?>">
    <div>
        <h2><?php the_title(); ?></h2>
<?php the_content("<p>Read the rest of this section &raquo;</p>"); ?>
        
        <p class="page-last-updated"><?php printf( __( 'Last modified: <time>%s</time>', 'textdomain' ), get_the_modified_date() ); ?></p>
    </div>
</article>

<?php endwhile; endif; ?>

<?php get_sidebar('footer'); ?>

<?php  get_footer(); ?>