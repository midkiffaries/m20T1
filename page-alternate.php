<?php get_header(); ?>

<main class="page-landing page-<?php preg_replace('/\s+/', '-', the_title()); ?>" id="main-content" role="main">
    <div class="page-content width-max">

    <?php breadcrumb_trail(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article <?php post_class(); ?> id="<?php printf($post->post_name); ?>" name="<?php printf($post->post_name); ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
            <div class="post-container">
                <h2 class="page-title" itemprop="title"><?php the_title(); ?></h2>
                <div class="the-content">
                    <?php the_content("<p>Read the rest of this section &raquo;</p>"); ?>
                
                </div>
                <p class="page-last-updated hidden"><?php printf( __( 'Page last modified: <time itemprop="dateModified">%s</time>', 'textdomain' ), get_the_modified_date() ); ?></p>
            </div>
        </article>

    <?php endwhile; endif; ?>

    <?php foreach ($page_children as $child) { // Display all the child pages to this one ?>
        <div class="child-card" id="child-card-<?php echo $child->ID; ?>">
            <h3 class="child-card__title"><?php echo $child->post_title; ?></h3>
            <p class="child-card__image"><?php echo get_the_post_thumbnail($child->ID, 'medium'); ?></p>
            <p class="child-card__text"><?php echo $child->post_excerpt; ?></p>
            <p class="child-card__link"><a href="<?php echo get_permalink($child->ID); ?>" rel="nofollow">Read More</a></p>
        </div>
    <?php } ?>

    </div>
</main>

<?php get_footer(); ?>