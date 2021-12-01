<?php get_header(); ?>

<main class="page-main page-blog" role="main">
    <div class="page-content width-side">

<?php breadcrumb_trail(); ?>

<section class="blog-page-title">
    <h2 class="page-title" itemprop="title">The Blog</h2>
    <div class="blog-page-text">
        <?php echo GetPageContent('page_for_posts'); // Get blog page content ?>
    </div>
</section>

<?php if (have_posts()) : ?>

<article class="blog-page" role="article" itemscope itemtype="http://schema.org/NewsArticle">

<?php while (have_posts()) : the_post(); ?>

    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <div class="post-container">
            <header class="entry-header">
                <div class="entry-category"><?php the_category(' '); ?></div>
                <h3 class="entry-title" id="<?php echo $post->post_name; ?>"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                <div class="entry-info">
                    <!--span class="entry-author">By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></!--span-->
                    <span class="entry-date"><time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php the_date(); ?></time> <span class="entry-last-updated"><?php if (get_the_modified_date('Y-m-d') != get_the_date('Y-m-d')) printf( __( '(Updated <time>%s</time>)', 'textdomain' ), get_the_modified_date() ); ?></span></span>
                </div>
            </header>
            <div class="entry-content <?php echo ResizeFontClass($post->post_content); ?>">
                <?php the_content('<p>Continue Reading &raquo;</p>'); ?>
            </div>
            <div class="entry-overflow"></div>
            <footer class="entry-footer">
                <div class="entry-tags"><?php the_tags('<ul><li rel="tag">', '</li><li rel="tag">', '</li></ul>'); ?></div>
                <div class="entry-share"><?php blog_post_share(); ?></div>
            </footer>
        </div>
    </div>

<?php endwhile; ?>

</article>

<section class="blog-pagination">
    <div class="pagination-container">
        <nav class="blog-post-nav">
            <?php blogPostPagination('Posts'); ?>
        </nav>
    </div>
</section>

<?php else : ?>

<article class="blog-page" role="article" itemscope itemtype="http://schema.org/NewsArticle">
    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <h2 class="entry-title">Not Found</h2>
        <p>Sorry, but you are looking for something that isn't here for some reason.</p>
<?php my_search_form('Main'); ?>

    </div>
</article>

<?php endif; ?>

    </div>

    <aside id="sidebar-blog" class="page-sidebar sidebar-blog" role="sidebar">
        <?php dynamic_sidebar( 'primary' ); ?>
    </aside>

</main>

<?php get_footer(); ?>