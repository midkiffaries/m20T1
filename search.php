<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>


<main class="page-main page-search width-side" id="main-content" itemscope itemtype="https://schema.org/SearchResultsPage" itemprop="mainEntity">
    <div class="page-content" role="feed">

    <?php if (have_posts() && get_search_query()) : // Search results ?>

    <section class="search-page-form" id="search-page">
        <div>
            <h1 class="page-title" itemprop="name headline">Your search netted <b><?=SearchCount(esc_attr($s));?></b> result(s)</h1>
            <?php get_search_form('search'); // Search form ?>
            <search class="search-sorting" aria-label="Search Sorting">
                <form method="get" onchange="this.submit()">
                <input type="hidden" name="s" value="<?=esc_attr($_GET['s']);?>">
                    <label><b>SORT</b></label>
                    <select id="SortSearch" name="order">
                        <option value="desc">Newest</option>
                        <option value="asc">Oldest</option>
                    </select>
                    <script>document.getElementById('SortSearch').selectedIndex = <?=array_search(esc_attr($_GET['order']),['desc','asc']);?></script>
                    <select id="SortType" name="orderby">
                        <option value="date">Date</option>
                        <option value="title">Title</option>
                        <option value="type">Type</option>
                        <option value="author">Author</option>
                    </select>
                    <script>document.getElementById('SortType').selectedIndex = <?=array_search(esc_attr($_GET['orderby']),['date','title','type','author']);?></script>
                </form>
            </search>
        </div>
    </section>

    <section class="search-results" role="feed">

    <?php while (have_posts()) : the_post(); // List posts and pages ?>
        <article class="post-<?php the_ID(); ?> post type-post status-publish format-standard hentry" id="post-<?php the_ID(); ?>" itemscope itemtype="https://schema.org/NewsArticle">
            <div class="post-container">
                <header class="entry-header">
                    <h2 class="entry-title" id="<?=$post->post_name;?>" itemprop="name"><a href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a></h2>
                    <div class="entry-info">
                        <span class="entry-type" itemprop="articleSection"><?=get_post_type();?></span>
                        <span class="entry-date"><time datetime="<?=get_the_date('c');?>" itemprop="datePublished"><?=get_the_date();?></time></span>
                        <span class="entry-author"><?=post_separator();?> Written By <a href="<?=get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) );?>" itemprop="author" rel="author"><?php the_author(); ?></a></span>
                    </div>
                </header>
                <div class="the-content content-excerpt">
                    <img class="entry-square-thumbnail" src="<?=FeaturedImageURL(get_the_ID(), 'thumbnail', false);?>" alt="" itemprop="image" loading="lazy" decoding="async" fetchpriority="low">
                    <p itemprop="description articleBody"><?=shorten_the_content($post->post_content);?></p>
                    <p class="entry-readmore hidden"><a href="<?php the_permalink(); ?>" rel="bookmark">Continue reading...</a></p>
                </div>
                <footer class="entry-footer hidden">
                </footer>
            </div>
        </article>
    <?php endwhile; ?>

    </section>

    <section class="blog-pagination" aria-label="Search Pagination">
        <div class="pagination-container">
            <nav class="blog-post-nav">
                <?php blog_post_pagination('Results'); // Search results navigation ?>
            </nav>
        </div>
    </section>

    <?php else : // If no posts exist ?>

    <section class="search-page-form" id="search-page">
        <div>
            <h1 class="page-title" itemprop="name headline">Your search netted <strong><?=SearchCount(esc_attr($s));?></strong> result(s)</h1>
            <?php get_search_form('search'); // Search form ?>
        </div>
    </section>

    <article class="search-results" itemscope itemtype="http://schema.org/SearchResultsPage">
        <div class="the-content aligncenter" itemprop="text">
            <p>The search query of <strong><?=esc_attr(get_search_query());?></strong> came up empty.</p>
            <p>If it will make you feel better, this probably happens to Google too.</p>
            <div class="page-search-image">
                <?=get_option('search_image') ? '<img src="'.esc_url(get_option('search_image')).'" loading="lazy" decoding="async" itemprop="image" alt="" fetchpriority="low" style="max-width:500px">' : '<svg role="img" xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 136 136"><path d="M131.3 115.3 99.2 88c-3.3-3-6-5.8-8.8-5.6a50.8 50.8 0 1 0-39.6 19.2c12.6 0 23.3-3.7 32.1-11.3-.1 2.9 2.1 5.6 5 8.9l27.4 32c4.7 5.3 12.3 5.7 17 1s4.2-12.2-1-17zM50.8 84.7a33.9 33.9 0 1 1 0-67.8 33.9 33.9 0 0 1 0 67.8z"/><path d="m47 69.8-6.7-6.2L39 77.2l-3-15.7-10.4 8.1 10-10-12.8-7.2L37 54.6l1-21.7 3.5 22L52 49.6l-8 8.1L61 56.5l-18.5 4.8z"/></svg>';?>
                <p>Please <i>bear</i> with us.</p>
            </div>
        </div>
    </article>

    <?php endif; ?>

    </div>

    <aside id="sidebar-search" class="page-sidebar sidebar-search">
        <div class="accordion" role="tablist" aria-label="Accordion">
            <button role="tab">Additional Information</button>
            <section role="tabpanel">
                <?php dynamic_sidebar( 'tertiary' ); // Tertiary sidebar ?>
            </section>
        </div>
    </aside>

</main>

<?php get_footer(); ?>