<?php get_header(); ?>

<?php //breadcrumb_trail(); ?>

<?php
// Display multiple pages
$args = array(
    'post_type' => 'page',
    // PAGES:  Books - Web - Designs - Animation - Phtotos - About
    //'post__in'  => array( 47, 36, 38, 42, 44, 40, 1757), // localhost
    'post__in'  => array( 1483, 36, 38, 42, 44, 40, 1757 ), // Live site
    'orderby'   => 'menu_order',
    'order'     => 'ASC'
);

query_posts($args);

while (have_posts()) : the_post();
?>

<!-- <?php echo $post->post_name; ?> page section -->
<article id="<?php echo $post->post_name; ?>" name="<?php echo $post->post_name; ?>" <?php post_class(); ?>>
    <div class="section-title">
        <h2 id="H2-<?php echo $post->post_name; ?>"><?php the_title(); ?></h2>
    </div>
    <div>
<?php the_content("<p>Read the rest of this section &raquo;</p>"); ?>
        
    </div>
</article>

<?php 
endwhile;
?>

<?php get_footer(); ?>