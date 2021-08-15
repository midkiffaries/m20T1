<?php get_header(); ?>

<main class="page-frontpage page-home" role="main">
    <div class="page-content width-full">

<?php //breadcrumb_trail(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article <?php post_class(); ?> id="<?php printf($post->post_name); ?>" name="<?php printf($post->post_name); ?>">
    <div>
        <h2 class="page-title"><?php the_title(); ?></h2>
<?php the_content("<p>Read the rest of this section &raquo;</p>"); ?>
        
        <!--p class="page-last-updated"><?php printf( __( 'Page last modified: <time itemprop="dateModified">%s</time>', 'textdomain' ), get_the_modified_date() ); ?></p-->
    </div>
</article>

<?php endwhile; endif; ?>

    </div>

    <div id="frontpage-widgets" class="page-sidebar frontpage-widgets">
        <?php if (is_active_sidebar( 'frontpage' )) : ?>
        <?php dynamic_sidebar( 'frontpage' ); ?>
        <?php endif; ?>
    </div>

</main>

<?php  get_footer(); ?>