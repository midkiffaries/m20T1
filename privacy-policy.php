<?php get_header(); ?>

<main class="page-main page-privacy-policy page-<?php preg_replace('/\s+/', '-', the_title()); ?>">
    <div class="page-content width-full" role="main">

<?php breadcrumb_trail(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article <?php post_class(); ?> id="<?php printf($post->post_name); ?>" name="<?php printf($post->post_name); ?>" itemscope itemtype="http://schema.org/NewsArticle">
    <div class="post-container">
        <h2 class="page-title"><?php the_title(); ?></h2>
<?php the_content("<p>Read the rest of this section &raquo;</p>"); ?>
        
        <p class="page-last-updated"><?php printf( __( 'Page last modified: <time itemprop="dateModified">%s</time>', 'textdomain' ), get_the_modified_date() ); ?></p>
    </div>
</article>

<?php endwhile; endif; ?>

    </div>

</main>

<?php  get_footer(); ?>