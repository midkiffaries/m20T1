<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php $pageKind = esc_attr("portfolio"); ?>
<?php get_header(); ?>

<?php 

function limit_posts_per_home_page() 
{
    $first_page_limit = 1;
    $limit = get_option('posts_per_page');

    set_query_var('posts_per_archive_page', $limit);
    set_query_var('posts_per_page', $limit);
}
add_filter('pre_get_posts', 'limit_posts_per_home_page');

?>

<main class="page-main width-full archive-<?=$pageKind;?> " id="main-content" itemscope itemtype="https://schema.org/Article" itemprop="mainEntity">
    
    <div class="page-content">
    
    <?php if (have_posts()) : // Has post items ?>
        <?php $postType = get_post_type_object(get_post_type()); ?>

    <?php if ($pageKind) : // If post type exists ?>
        <section class="porfolio-page-title" itemprop="name headline">
            <?=GetPageTitle(get_page_by_path(rawurlencode(strtolower($pageKind)))); // Get page title and content ?>
        </section>
    <?php else : // Use default page settings ?>
        <section class="<?=$pageKind;?>-header" id="<?=$pageKind;?>-page">
            <div class="<?=$pageKind;?>-header-container">
                <h1 class="page-title" itemprop="name headline"><?=esc_html($postType->labels->singular_name);?></h1>
                <div class="subtitle" itemprop="about"><?=esc_html($postType->description);?></div>
            </div>
        </section>
    <?php endif; ?>

    <section class="post-container" role="feed" itemscope itemtype="https://www.schema.org/CreativeWork">

    <?php while (have_posts()) : the_post(); // Display pages ?>
        <article <?php post_class(); ?> id="post-<?=the_ID(); ?>">
            <div class="<?=$pageKind;?>-container">
                <a href="<?=esc_url(the_permalink()); ?>" rel="bookmark" itemprop="url" class="<?=$pageKind;?>-thumbnail" style="<?=FeaturedImageURL(get_the_ID(), 'medium', true);?>">
                    <div class="<?=$pageKind;?>-sticky"><?php if(is_sticky( get_the_ID() )) : // If sticky post item ?>Featured Item<?php endif; ?>&nbsp;</div>
                    <div class="<?=$pageKind;?>-info">
                        <h2 class="<?=$pageKind;?>-title" id="<?=$post->post_name;?>" itemprop="name"><?=the_title();?></h2>
                        <div class="<?=$pageKind;?>-author">By <?php the_author(); ?></div>
                    </div>
                </a>
            </div>
        </article>
    <?php endwhile; ?>

    </section>

    <section class="blog-pagination" aria-label="Portfolio Pagination">
        <div class="pagination-container">
            <nav class="blog-post-nav">
                <?=blog_post_pagination(esc_html($postType->labels->name)); // Portfolio navigation links ?>
            </nav>
        </div>
    </section>

    <?php else : // If no results ?>

    <article class="<?=$pageKind;?>-page">
        <div <?php post_class();?>>
            <h1 class="page-title"><?=esc_html($postType->labels->singular_name);?> is empty</h1>
            <p class="subtitle">This doesn't seem to exist...</p>
            <div class="the-content">
                <p>Would you like to try a search to find what you are looking for?</p>
                <?php get_search_form('archive'); // Search Form ?>
            </div>
        </div>
    </article>

    <?php endif; ?>

    </div>
    
    <aside id="sidebar-<?=$pageKind;?>" class="page-sidebar <?=$pageKind;?>-widgets width-full clearfix">
        <?php dynamic_sidebar( 'quaternary' ); // Quaternary Sidebar ?>
    </aside>

</main>

<?php get_footer(); ?>