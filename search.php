<?php get_header(); ?>

<?php breadcrumb_trail(); ?>

<?php
// Get the number of time this keyword comes up in search queries
$search_count = 0;
$search = new WP_Query("s=$s & showposts=-1");
if($search->have_posts()) : while($search->have_posts()) : $search->the_post();	
    $search_count++;
endwhile; endif;
?>

<?php if (have_posts() && get_search_query()) : ?>

<article <?php post_class(); ?>>
    <div>
        <h3>Your search netted <?php echo $search_count; ?> result(s)</h3>
<?php my_search_form('Main'); ?>
        <hr>
    </div>
</article>

<?php while (have_posts()) : the_post(); ?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <div>
        <header class="entry-header">
            <div class="entry-type"><?php echo get_post_type(); ?></div>
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            <div class="entry-date"><a href="<?php echo get_month_link('', '', ''); ?>"><time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php the_date($BlogPostTimeStamp, '',''); ?></time></a> <span class="entry-author">by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author"><?php the_author(); ?></a></span></div>
        </header>
        <div class="entry-content">
            <?php the_excerpt(); ?>
        </div>
    </div>
</article>
<?php endwhile; ?>

<section class="blog-pagination">
    <div>
<?php blog_list_nav(); ?>
    </div>
</section>

<?php else : ?>
<article class="search-page">
    <div>
        <h2>Your search query came up empty 🙁 </h2>
        <p>If it will make you feel better, this probably happens to Google too.</p>
        <p><em>Wanna, take another shot?</em></p>

<?php my_search_form('Main'); ?>
    </div>
</article>
<?php endif; ?>

<?php get_footer(); ?>