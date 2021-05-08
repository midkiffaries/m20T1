<?php
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
if ( post_password_required() ) {
?>
	<p>This post is password protected. Enter the password to view comments.</p>
<?php return; } ?>

<?php if (have_comments()) : // If have comments ?>

<section class="comment-list" role="comments">
    <div>
        <h2>Feedback <span><?php comments_number('No Comments', 'One Comment', '% Comments');?></span></h2>
        <div class="wp-post-nav"><?php previous_comments_link() . " " . next_comments_link(); ?></div>
        <ol>
<?php wp_list_comments('type=comment&reply_text=&login_text=&callback=my_comment_style'); ?>
        </ol>
    </div>
</section>

<section class="blog-pagination">
    <div>
        <div class="wp-post-nav"><?php previous_comments_link('Older Comments %link', 0) . next_comments_link('Newer Comments &#x276F;', 0); ?></div>
    </div>
</section>

<?php
else : // this is displayed if there are no comments so far
?>

<?php 
if (comments_open()) : // If comments are open, but there are no comments. 
?>

<?php
else : // comments are closed
?>
<section class="comments-closed">
    <div>
        <p>Comments are closed for this topic.</p>
    </div>
</section>
<?php endif; ?>
<?php endif; ?>

<?php if (comments_open()) : // Comment entry form ?>

<section class="comment-form">
    <h2><?php comment_form_title( 'Post a Comment', 'Post a reply to %s' ); ?></h2>

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="CommentForm" name="commentform" autocomplete="on">

<?php if (is_user_logged_in()) : ?>

		<p>You are logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a> | <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account" class="icon-logout">Log out</a></p>
		<input type="hidden" name="author" id="author" value="<?php echo $user_identity; ?>"><input type="hidden" name="email" id="email" value="xyz@xyz.com">   

<?php else : ?>

		<p><label for="author">Name</label><input type="text" name="author" id="author" maxlength="70" value="<?php echo esc_attr($comment_author); ?>" tabindex="6" placeholder="your name <?php if ($req) echo "(required)"; ?>" <?php if ($req) echo "aria-required='true'"; ?> autocorrect="off" autocomplete="name" required></p>
		<p><label for="email">Email</label><input type="email" name="email" id="email" maxlength="50" value="<?php echo esc_attr($comment_author_email); ?>" tabindex="7" placeholder="name@example.com <?php if ($req) echo "(required)"; ?>" <?php if ($req) echo "aria-required='true'"; ?> autocapitalize="none" autocorrect="off" autocomplete="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required></p>
		<p><label for="url">Website</label><input type="url" name="url" id="url" maxlength="50" value="http://<?php echo esc_attr($comment_author_url); ?>" tabindex="8" placeholder="https://www.example.com/" autocapitalize="none" autocorrect="off" autocomplete="url"></p>

<?php endif; ?>
		<p><label for="comment">Comment</label><textarea id="comment" name="comment" tabindex="9" placeholder="comment <?php if ($req) echo "(required)"; ?>" required></textarea></p>
		<p><input type="button" id="submit-comment" tabindex="10" value="Post Comment"> <?php cancel_comment_reply_link('Cancel Reply'); ?><?php comment_id_fields(); ?></p>

<?php do_action('comment_form', $post->ID); ?>

    </form>
</section>
<?php endif; ?>
<?php endif; ?>