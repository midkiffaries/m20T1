<?php get_header(); ?>

<main class="page-main page-home">
    <div class="page-content width-full">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article <?php post_class(); ?> id="<?php printf($post->post_name); ?>" name="<?php printf($post->post_name); ?>">
    <div>
<?php the_content("<p>Read the rest of this section &raquo;</p>"); ?>
        
        <p class="homepage-last-updated"><?php printf( __( 'Page last modified: <time itemprop="dateModified">%s</time>', 'textdomain' ), get_the_modified_date() ); ?></p>
    </div>
</article>

<?php endwhile; endif; ?>

    </div>

    <?php get_sidebar('footer'); ?>

</main>

<?php  get_footer(); ?>