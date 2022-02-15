<?php get_header(); ?>

<main class="page-main page-index" id="main-content" role="main">
    <div class="page-content width-full">

    <?php breadcrumb_trail(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article <?php post_class(); ?> id="<?php printf($post->post_name); ?>" name="<?php printf($post->post_name); ?>" role="article" itemscope itemtype="http://schema.org/NewsArticle">
            <div class="post-container">
                <h2 class="page-title" itemprop="title"><?php the_title(); ?></h2>
                <div class="the-content">
                    <?php the_content("<p>Continue Reading &raquo;</p>"); ?>
                
                </div>
            </div>
        </article>

    <?php endwhile; else : ?>

        <article class="blog-page" role="article" itemscope itemtype="http://schema.org/NewsArticle">
            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                <h2 class="entry-title">Not Found</h2>
                <p>Sorry, but you are looking for something that isn't here for some reason.</p>
                <?php my_search_form('Main'); ?>

            </div>
        </article>

    <?php endif; ?>

        <aside id="page-widgets" class="page-sidebar page-widgets">
            <?php dynamic_sidebar( 'singlepost' ); ?>

            <?php get_child_pages(get_the_ID(), false); // Display the children of this page ?>
        </aside>

    </div>
</main>

<?php get_footer(); ?>