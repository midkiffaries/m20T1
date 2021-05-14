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
        <h2>Your search netted <?php printf($search_count); ?> result(s)</h2>
<?php my_search_form('main'); ?>
        <hr>
    </div>
</article>

<?php while (have_posts()) : the_post(); ?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <div>
        <header class="entry-header">
            <div class="entry-type"><?php echo get_post_type(); ?></div>
            <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
            <div class="entry-date"><a href="<?php echo get_month_link(get_the_date('Y'), get_the_date('m')); ?>"><time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php the_date(); ?></time></a></div>
            <div class="entry-author">by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="author"><?php the_author(); ?></a></div>
        </header>
        <div class="entry-content">
            <?php the_excerpt(); ?>
            <p class="entry-last-updated"><?php printf( __( 'Last modified: <time>%s</time>', 'textdomain' ), get_the_modified_date() ); ?></p>
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
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <div>
        <h2>Your search query came up empty 🙁 </h2>
        <p>If it will make you feel better, this probably happens to Google too.</p>
        <p><i>Wanna, take another shot?</i></p>

<?php my_search_form('main'); ?>
    </div>
</article>
<?php endif; ?>

<?php get_footer(); ?>