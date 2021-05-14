<?php get_header(); ?>

<?php
// Display multiple pages
$args = array(
    'post_type' => 'page',
    // PAGES:  Books - Web - Designs - Animation - Phtotos - About
    'post__in'  => array( 47, 36, 38, 42, 44, 40, 1757), // localhost
    //'post__in'  => array( 1483, 36, 38, 42, 44, 40, 1757 ), // Live site
    'orderby'   => 'menu_order',
    'order'     => 'ASC'
);
?>

<?php query_posts($args); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<!-- <?php echo $post->post_name; ?> page section -->
<article <?php post_class(); ?> id="<?php echo $post->post_name; ?>" name="<?php echo $post->post_name; ?>" >
    <header class="section-header" id="section-<?php echo $post->post_name; ?>">
        <h2><?php the_title(); ?></h2>
    </header>
    <div class="section-content">
<?php the_content("<p>Read the rest of this section &raquo;</p>"); ?>

    </div>
</article>

<?php endwhile; else: ?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <div>
        <p>Sorry, no posts matched your criteria.</p>
    </div>
</article>
<?php endif; ?>

<?php get_sidebar('footer'); ?>

<?php get_footer(); ?>