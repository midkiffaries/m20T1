<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,viewport-fit=cover">
<link rel="profile" href="http://gmpg.org/xfn/11">
<title><?php echo get_option('blogname'); ?> - Comments on <?php the_title(); ?></title>
<meta name="author" content="Ted Balmer | MarchTwenty.com">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/css/tedilize.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/style.css">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<h1><?php echo get_option('blogname'); ?></h1>

<?php
/* Don't remove these lines. */
add_filter('comment_text', 'popuplinks');
if ( have_posts() ) :
while ( have_posts() ) : the_post();
?>
    
<h2>Comments</h2>

<p class="comments-rss"><a href="<?php echo get_post_comments_feed_link($post->ID); ?>">RSS feed for comments on this post.</a></p>

<?php if ( pings_open() ) { ?>
<p>The URL to TrackBack this entry is: <i><?php trackback_url() ?></i></p>
<?php } ?>

<?php
// this line is WordPress' motor, do not delete it.
$commenter = wp_get_current_commenter();
extract($commenter);
$comments = get_approved_comments($id);
$post = get_post($id);
if ( post_password_required($post) ) {  // and it doesn't match the cookie
	echo(get_the_password_form());
} else { 
?>

<?php if ($comments) { ?>
<ol id="CommentList">
<?php foreach ($comments as $comment) { ?>
	<li id="comment-<?php comment_ID() ?>">
	<?php comment_text() ?>
	<p><cite><?php comment_type('Comment', 'Trackback', 'Pingback'); ?> by <?php comment_author_link() ?> &#8212; <?php comment_date() ?> @ <a href="#comment-<?php comment_ID() ?>"><?php comment_time() ?></a></cite></p>
	</li>

<?php } // end for each comment ?>
</ol>
<?php } else { // this is displayed if there are no comments so far ?>
<p>No comments yet.</p>
<?php } ?>

<?php if ( comments_open() ) { ?>
<h2>Leave a comment</h2>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<?php if ( $user_ID ) : ?>
	<p class="loggedin">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
<?php else : ?>
	<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" tabindex="1" placeholder="name <?php if ($req) echo "(required)"; ?>"></p>
    <p><input type="email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" tabindex="2" placeholder="email <?php if ($req) echo "(required)"; ?>"></p>
    <p><input type="url" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" tabindex="3" placeholder="website"></p>
<?php endif; ?>

	<p><textarea name="comment" id="comment" cols="70" rows="4" tabindex="4" placeholder="comment"><?php if ($req) echo "(required)"; ?></textarea></p>

	<p>
		<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>">
		<input type="hidden" name="redirect_to" value="<?php echo esc_attr($_SERVER["REQUEST_URI"]); ?>">
		<input name="submit" type="submit" tabindex="5" value="Post Comment">
	</p>
	<?php do_action('comment_form', $post->ID); ?>
</form>
<?php } else { // comments are closed ?>
<h3>Sorry, the comments for this topic are closed at this time.</h3>
<?php }
} // end password check
?>

<p class="comments-close"><a href="javascript:window.close()">Close this window</a></p>

<?php // if you delete this the sky will fall on your head
endwhile; //endwhile have_posts()
else: //have_posts()
?>
<p>Sorry, no posts matched your criteria.</p>
<?php endif; ?>
<!-- // this is just the end of the motor - don't touch that line either :) -->
<?php //} ?>

<p class="credit"><?php timer_stop(1); ?> </p>

<script>
document.onkeypress = function esc(e) {
	if (typeof(e) == "undefined") { e=event; }
	if (e.keyCode == 27) { self.close(); }
}
</script>
<script src="<?php bloginfo('template_url'); ?>/assets/scripts/scripts.js"></script>
<script src="<?php bloginfo('template_url'); ?>/assets/scripts/modals.js"></script>

</body>
</html>