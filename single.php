<?php defined( 'ABSPATH' ) || exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<main class="page-main page-blogpost width-full <?=get_page_class();?>" id="main-content" itemscope itemtype="https://schema.org/<?=custom_page_article(get_the_ID());?>" itemprop="mainEntity">
    
    <div class="page-content">

    <?php if (have_posts()) : while (have_posts()) : the_post(); // Single post ?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <div class="post-container">
            <header class="single-entry-header">
                <?php if (is_sticky( get_the_ID() )) : // If sticky/featured post ?><div class="single-entry-sticky">Featured</div><?php endif; ?>
                <div class="single-entry-category" itemprop="articleSection"><?php the_category(' – '); ?></div>
                <h1 class="single-entry-title" id="<?=$post->post_name;?>" itemprop="name headline"><?php the_title(); ?></h1>
                <div class="single-entry-metadata">
                    <span class="single-entry-date"><time datetime="<?=get_the_date('c'); ?>" itemprop="datePublished"><?php the_date(); ?></time></span> 
                    <span class="single-entry-author"><?=post_separator();?> Written By <a href="<?=get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) );?>" itemprop="author" rel="author" id="TheAuthor"><?php the_author(); ?></a></span>
                    <span class="single-entry-read-time"><?=post_separator();?> <?=reading_time();?></span>
                </div>
            </header>
            <div class="the-content single-entry-content" itemprop="text articleBody description" id="TheContent">
                <?php the_content("<p>Continue Reading &raquo;</p>"); ?>
                
                <?=custom_page_css(get_the_ID());?>
            </div>
            <div class="entry-last-updated">
                <?=display_last_updated();?>
            </div>
            <footer class="single-entry-footer">
                <div class="entry-tags"><?php blog_post_tags(); ?></div>
                <div class="entry-share"><?php blog_post_share(); ?></div>
            </footer>
        </div>
    </article>

    <section class="blog-pagination" aria-label="Blog Pagination">
        <div class="pagination-container">
            <nav class="single-blog-post-nav" role="navigation">
                <div class="left"><?php next_post_link('%link', '<span>Next</span>%title'); // Left ?></div>
                <div class="right"><?php previous_post_link('%link', '<span>Previous</span>%title'); // Right ?></div>
            </nav>
        </div>
    </section>

    <aside id="singlepost-widgets" class="page-sidebar singlepost-widgets width-full clearfix">
        <section class="widget widget_block single-author-bio" aria-label="Article Author Bio" itemscope itemtype="https://schema.org/Person">
            <h2 class="author-bio-title">About the Author</h2>
            <div class="author-bio-container">
                <div class="author-bio-avatar">
                    <figure aria-label="Authors Avatar" itemprop="image">
                        <?=get_avatar(get_the_author_meta('ID'), 64); ?>
                    </figure>
                </div>
                <div class="author-bio-content">
                    <h3 class="author-bio-name" itemprop="name" ><a href="<?php printf("%s/author/%s", home_url(), get_the_author_meta( 'user_nicename' )); ?>" rel="author" aria-label="See more posts by this author." itemprop="url"><?=get_the_author_meta( 'display_name' ); ?></a> <small itemprop="jobTitle"><?=(get_the_author_meta( 'jobtitle' )) ? wp_strip_all_tags(get_the_author_meta( 'jobtitle' )) : user_level(get_the_author_meta( 'user_level' )); ?></small></h3>
                    <p class="author-bio-about" itemprop="description"><?=shorten_the_content(get_the_author_meta( 'user_description' ));?></p>
                </div>
            </div>
        </section>

        <section class="widget widget_block" aria-label="Page Widgets">
            <?php $categories = get_the_category(); // Get the posts categories ?>
            <?php foreach($categories as $category) : // Display posts of the same Categories as the main post ?>
                <div id="block-22A" class="widget widget_block">
                    <h2 class="wp-block-heading has-primary-dark-color has-text-color">Posts in <a href="<?=esc_url(home_url() . "/category/" . $category->slug);?>"><?=$category->name;?></a></h2>
                </div>
                <div id="block-22B" class="widget widget_block widget_recent_entries">
                    <?=do_blocks('<!-- wp:latest-posts {"postsToShow":3,"displayPostContent":true,"excerptLength":35,"displayPostDate":true,"postLayout":"grid","displayFeaturedImage":true,"addLinkToFeaturedImage":true,"featuredImageSizeSlug":"thumbnail","featuredImageSizeWidth":64,"featuredImageAlign":"left","categories":"'.$category->term_id.'","className":"wp-block-latest-posts__list is-grid columns-3 has-dates is-style-posts-theme wp-block-latest-posts"} /-->');?>
                </div>
            <?php endforeach; ?>

            <?php dynamic_sidebar( selectSidebarCustomField(get_the_ID(), 'singlepost') ); // Display  ?>
        </section>
    </aside>

    <section class="single-post-comments" aria-label="Article Comments">
        <?php comments_template(); // Display the comments for this post ?>
    </section>

    <?php endwhile; endif; ?>

    </div>

</main>

<?php get_footer(); ?>