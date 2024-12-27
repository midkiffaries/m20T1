<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>
<?php $curauth = $wp_query->get_queried_object(); // Get Author Info ?>
<?php GetPageTitle(get_page_by_path('blog')); // Work-around to add theme inline CSS ?>

<main class="page-main page-archive width-side" id="main-content" itemscope itemtype="https://schema.org/Article" itemprop="mainEntity">
    
    <div class="page-content">
    
    <?php if (have_posts()) : // Has posts ?>
    
    <section class="archive-header" id="archive-page">
        <div class="archive-header-container">
            <h1 class="page-title" itemprop="name headline">
                <?php $post = $posts[0]; ?>
                <?php /* Category */ if (is_category()) single_cat_title(); ?>
                <?php /* Tags */ if (is_tag()) printf("<b>#</b>") . single_tag_title(); ?>
                <?php /* Daily */ if (is_day()) the_time('F j, Y'); ?>
                <?php /* Monthly */ if (is_month()) the_time('F Y'); ?>
                <?php /* Yearly */ if (is_year()) the_time('Y'); ?>
                <?php /* Author */ if (is_author()) printf($curauth->display_name); ?>
                <?php /* Paged */ if (isset($_GET['paged']) && !empty($_GET['paged'])) printf("Blog Archives"); ?>
            </h1>
            <p class="is-style-text-subtitle is-style-text-subtitle--1 is-style-text-subtitle--2" itemprop="about">
                <?php /* Category */ if (is_category()) printf(strip_tags(category_description())) || printf("All the posts under this category"); ?>
                <?php /* Tags */ if (is_tag()) printf(strip_tags(tag_description())) || printf("All the posts that have this tag"); ?>
                <?php /* Daily */ if (is_day()) printf("Posts from this date"); ?>
                <?php /* Monthly */ if (is_month()) printf("Posts from this month"); ?>
                <?php /* Yearly */ if (is_year()) printf("Posts from this year"); ?>
                <?php /* Author */ if (is_author()) printf("Posts written by this user"); ?>
            </p>
        </div>
    </section>

    <?php if (is_author()) : // Display Author Page for when showing by author ?>
    <section class="archive-author-bio <?=get_option( 'show_avatars' ) ? 'show-avatars' : '';?>" itemscope itemtype="https://schema.org/Person">
        <div class="author-container">
            <div class="author-avatar">
                <figure aria-label="Authors Avatar" itemprop="image">
                    <?=get_avatar(get_the_author_meta('ID'), 128);?>
                </figure>
            </div>
            <div class="author-content">
                <p class="author-bio-meta"><span itemprop="jobTitle"><?=($curauth->jobtitle) ? wp_strip_all_tags($curauth->jobtitle) : user_level(get_the_author_meta( 'user_level' ));?></span> – <span itemprop="homeLocation"><?=(($curauth->city) ? wp_strip_all_tags($curauth->city) : 'Planet Earth');?></span> – <span><?=number_format_i18n(get_the_author_posts());?> Posts</span></p>
                <p class="author-bio-about" itemprop="description">
                    <?=nl2br($curauth->description);?>
                    <p class="author-bio-lastlogin"><?="Last seen " . users_last_login() . " ago";?></p>
                </p>
                <p class="author-bio-contact">
                    <?php if ($curauth->linkedin) : ?><a href="<?=esc_url($curauth->linkedin);?>" rel="author" itemprop="sameAs">LinkedIn</a> | <?php endif; ?>
                    <?php if ($curauth->twitter) : ?><a href="<?=esc_url($curauth->twitter);?>" rel="author" itemprop="sameAs">X/Twitter</a> | <?php endif; ?>
                    <?php if ($curauth->facebook) : ?><a href="<?=esc_url($curauth->facebook);?>" rel="author" itemprop="sameAs">Facebook</a> | <?php endif; ?>
                    <?php if ($curauth->pinterest) : ?><a href="<?=esc_url($curauth->pinterest);?>" rel="author" itemprop="sameAs">Pinterest</a> | <?php endif; ?>
                    <?php if ($curauth->user_url) : ?><a href="<?=esc_url($curauth->user_url);?>" rel="author" itemprop="url">Website</a><?php endif; ?>
                </p>
            </div>
        </div>
        <hr style="border-top:2px solid #0009">
    </section>
    <?php endif; ?>

    <section class="archive-container" role="feed">

    <?php while (have_posts()) : the_post(); // Display blog posts ?>
        <article <?php post_class(); ?> id="post-<?=the_ID();?>" itemscope itemtype="https://schema.org/NewsArticle">
            <div class="post-container">
                <div class="post-container-image">
                    <a href="<?=esc_url(the_permalink());?>" rel="bookmark" itemprop="url" class="entry-thumbnail" style="<?=FeaturedImageURL(get_the_ID(), 'large', true);?>">
                        <!--div class="entry-sticky" style="transform:rotate(-9deg) translateY(30px)"><?php if (is_sticky( get_the_ID() )) : // If sticky post ?>Featured Article<?php endif; ?>&nbsp;</div-->
                    </a>
                </div>
                <div class="post-container-content">
                    <header class="entry-header">
                        <div class="entry-date"><time datetime="<?=get_the_date('c');?>" itemprop="datePublished"><?=the_date();?></time></div>
                        <h2 class="entry-title" id="<?=$post->post_name;?>" itemprop="name"><a href="<?=esc_url(the_permalink());?>" rel="bookmark" itemprop="url"><?=the_title();?></a></h2>
                        <div class="entry-metadata">
                            <span class="entry-author">Written By <a href="<?=get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) );?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
                            <span class="entry-read-time"><?=post_separator();?> <?=reading_time();?></span>
                            <span class="entry-comments" itemprop="commentCount"><?=post_separator();?> <a href="<?=esc_url(the_permalink()); ?>#Comments" rel="bookmark"><?=comments_number('No Comments', 'One Comment', '% Comments');?></a></span>
                        </div>
                    </header>
                    <div class="the-content content-excerpt" itemprop="description articleBody">
                        <p><?=shorten_the_content($post->post_content); ?></p>
                    </div>
                    <footer class="entry-footer hidden">
                    </footer>
                </div>
            </div>
        </article>
    <?php endwhile; ?>

    </section>

    <section class="blog-pagination" aria-label="Archive Pagination">
        <div class="pagination-container">
            <nav class="blog-post-nav">
                <?=blog_post_pagination('Posts'); // Post navigation links?>
            </nav>
        </div>
    </section>

    <?php else : // If no results ?>

    <article class="archive-page" itemscope itemtype="https://schema.org/NewsArticle">
        <div <?php post_class(); ?>>
            <section class="archive-header" id="archive-page">
                <div class="archive-header-container">
                    <h1 class="page-title" itemprop="name">
                    <?php 
                    if ( is_category() ) { // By category
                        printf("%s Category Not Found", single_cat_title('', false));
                    } else if ( is_tag() ) { // By tag
                        printf("<b>#</b>%s Tag Not Found", single_tag_title());
                    } else if ( is_author() ) { // By author
                        printf("Posts by %s Not Found", $curauth->display_name);
                    } else { // No posts found
                        printf("No posts found");
                    }
                    ?>
                    </h1>
                    <p class="subtitle" itemprop="about">Posts with this topic do not seem to exist...</p>
                    <div class="the-content">
                        <p itemprop="text">Would you like to try a search to find what you are looking for?</p>
                        <?php get_search_form('archive'); // Search Form ?>
                    </div>
                </div>
            </section>
        </div>
    </article>

    <?php endif; ?>

    </div>
    
    <aside id="sidebar-archive" class="page-sidebar archive-widgets">
        <div class="accordion" role="tablist" aria-label="Accordion">
            <button role="tab">Additional Information</button>
            <section role="tabpanel">
                <?php dynamic_sidebar( 'secondary' ); // Secondary Sidebar ?>
            </section>
        </div>
    </aside>

</main>

<?php get_footer(); ?>