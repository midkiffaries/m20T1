<?php get_header(); ?>

<main class="page-main page-blog-posts" id="main-content" role="main">
    <div class="page-content width-side">

    <?php breadcrumb_trail(); // Show breadcrumb trail ?>

    <section class="blog-page-title" aria-label="Blog Info">
        <div class="blog-page-text hidden">
            <?php echo GetPageContent('page_for_posts'); // Get blog page content ?>
        </div>
    </section>

    <?php if (have_posts()) : // If posts exist ?>

    <article class="blog-roll" role="article" itemscope itemtype="http://schema.org/NewsArticle">

        <?php while (have_posts()) : the_post(); // List all the posts ?>

        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <div class="post-container">
                <header class="entry-header">
                    <?php if(is_sticky( get_the_ID() )) echo '<div class="entry-sticky">Featured Article</div>'; ?>
                    <h2 class="entry-title" id="<?php echo $post->post_name; ?>"><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    <div class="entry-metadata">
                        <span class="entry-author">By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
                        <span class="entry-date icon-written"><time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php the_date(); ?></time> <span class="entry-last-updated hidden"><?php if (get_the_modified_date('Y-m-d') != get_the_date('Y-m-d')) printf( __( '(Updated <time>%s</time>)', 'textdomain' ), get_the_modified_date() ); ?></span></span>
                        <span class="entry-comments"><a href="<?php esc_url(the_permalink()); ?>#Comments" rel="bookmark" class="icon-comment"><?php comments_number('No Comments', 'One Comment', '% Comments');?></a></span>
                    </div>
                </header>
                <div class="entry-content <?php echo ResizeFontClass($post->post_content); ?>">
                    <div class="wp-block-image">
                        <figure class="alignright is-resized"><?php the_post_thumbnail( 'thumbnail' ); ?></figure>
                    </div>
                    <p><?php echo shorten_the_content($post->post_content); ?></p>
                </div>
                <footer class="entry-footer hidden">
                    <div class="entry-tags"><?php the_tags('<ul><li rel="tag">', '</li><li rel="tag">', '</li></ul>'); ?></div>
                    <div class="entry-share"><?php blog_post_share(); ?></div>
                </footer>
            </div>
        </div>

        <?php endwhile; ?>

    </article>

    <section class="blog-pagination" aria-label="Blog Pagination">
        <div class="pagination-container">
            <nav class="blog-post-nav">
                <?php blog_post_pagination('Posts'); // Blog posts navigation ?>
            </nav>
        </div>
    </section>

    <?php else : // No page exists ?>

    <article class="blog-page" role="article" itemscope itemtype="http://schema.org/NewsArticle">
        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <h2 class="entry-title">Not Found</h2>
            <p>Sorry, but you are looking for something that isn't here for some reason.</p>
            <?php my_search_form('Main'); // Search Form ?>

        </div>
    </article>

    <?php endif; ?>

    </div>

    <aside id="sidebar-blog" class="page-sidebar sidebar-blog">
        <?php dynamic_sidebar( 'primary' ); ?>
    </aside>

</main>

<?php get_footer(); ?>