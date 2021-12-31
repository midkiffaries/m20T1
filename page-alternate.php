<?php get_header(); ?>

<main class="page-landing page-<?php preg_replace('/\s+/', '-', the_title()); ?>" id="main-content" role="main">
    <div class="page-content width-full">

<?php breadcrumb_trail(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article <?php post_class(); ?> id="<?php printf($post->post_name); ?>" name="<?php printf($post->post_name); ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
    <div class="post-container">
        <h2 class="page-title" id="<?php echo $post->post_name; ?>"><?php the_title(); ?></h2>
<?php the_content("<p>Read the rest of this section &raquo;</p>"); ?>
        
        <p class="page-last-updated hidden"><?php printf( __( 'Page last modified: <time itemprop="dateModified">%s</time>', 'textdomain' ), get_the_modified_date() ); ?></p>
    </div>
</article>

<?php endwhile; endif; ?>

<?php foreach ($page_children as $child) { // Display child pages ?>
    <h3><?php echo $child->post_title; ?></h3>
    <p><?php echo $child->post_excerpt; ?></p>
    <p><?php echo get_the_post_thumbnail($child->ID, 'medium'); ?></p>
    <p><a href="<?php echo get_permalink($child->ID); ?>" rel="nofollow">Read More</a></p>
<?php } ?>

    </div>
</main>

<?php  get_footer(); ?>