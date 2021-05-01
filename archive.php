<?php get_header(); ?>

<?php breadcrumb_trail(); ?>

<?php
global $wp_query;
$curauth = $wp_query->get_queried_object();
?>

<div class="wp-archive-header type-post">
    <div>
        <h2><?php if (have_posts()) : ?>
<?php $post = $posts[0]; ?>
<?php /* category archive */ if (is_category()) { ?><?php single_cat_title(); ?> <span><?php echo strip_tags(category_description()); ?></span>
<?php /* tag archive */ } elseif( is_tag() ) { ?>Posts tagged as <b><?php single_tag_title(); ?></b>
<?php /* daily archive */ } elseif (is_day()) { ?>Posts from <?php the_time('F jS, Y'); ?>
<?php /* monthly archive */ } elseif (is_month()) { ?>Posts from <?php the_time('F, Y'); ?>
<?php /* yearly archive */ } elseif (is_year()) { ?>Posts from <?php the_time('Y'); ?>
<?php /* author archive */ } elseif (is_author()) { ?>Posts made by <?php echo $curauth->first_name; ?>
<?php /* paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>Blog Archives
<?php } ?></h2>
    </div>
</div>

<?php if (is_author()) : ?>

<div class="wp-author-bio type-post" rel="author" role="contentinfo" aria-label="Authors Info">
    <div>
        <div class="alignleft"><?php echo get_avatar( get_the_author_meta( 'ID' ), 64 ); ?></div>
        <h3>About <?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?></h3>
        <p class="wp-author-bio-meta"><?php echo number_format_i18n( get_the_author_posts() ); ?> posts</p>
        <p class="wp-author-bio-about"><?php echo $curauth->description; ?><br>Site: <a href="<?php echo $curauth->user_url; ?>" target="_blank"><?php echo $curauth->user_url; ?></a></p>
    </div>
</div>

<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <div>    
        <header class="entry-header">
            <div class="entry-catagory">Filed under <?php the_category(' '); ?></div>
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

<div>
    <div>
<?php else :
if ( is_category() ) { // If this is a category archive
	printf("There are no posts under the <b>%s</b> category.", single_cat_title('',false));
} else if ( is_date() ) { // If this is a date archive
	echo("There are no posts with this date.");
} else if ( is_author() ) { // If this is a category archive
	$userdata = get_userdatabylogin(get_query_var('author_name'));
	printf("There are no posts by <b>%s</b>.", $userdata->display_name);
} else {
	echo("No posts found.");
}
get_search_form();
endif;
?>
    </div>
</div>

<?php get_footer(); ?>