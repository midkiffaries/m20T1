<hr>

<?php
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly.');
if ( post_password_required() ) {
?>
	<p>This post is password protected. Enter the password to view comments.</p>
<?php return; } ?>

<?php if (have_comments()) : // If have comments ?>

<section class="comment-list" role="comments" id="Comments">
    <div>
        <h3 class="comments-title"><?php comments_number('No Comments', 'One Comment', '% Comments');?></h3>
        <ol class="wp-post-comments">
<?php wp_list_comments('type=comment&reply_text=&login_text=&callback=my_comment_style'); ?>
        </ol>
    </div>
</section>

<section class="comment-pagination">
    <div>
        <nav class="wp-post-nav">
            <?php previous_comments_link('&#x276E; Older Comments', 0); ?> 
            <?php next_comments_link('Newer Comments &#x276F;', 0); ?>
        </nav>
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
    <h3><?php comment_form_title( 'Write a Comment', 'Post a reply to %s' ); ?></h3>

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>" class="login-link">logged in</a> to post a comment.</p>
<?php else : ?>

    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="CommentForm" name="commentform" autocomplete="on">

<?php if (is_user_logged_in()) : ?>

		<p>You are logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a> | <a href="<?php echo wp_logout_url(get_permalink()); ?>" class="logout-link">Log out</a></p>
		<input type="hidden" name="author" id="author" value="<?php echo $user_identity; ?>">
        <input type="hidden" name="email" id="email" value="<?php printf("%s@%s", $user_identity, $_SERVER['HTTP_HOST']); ?>">   

<?php else : ?>

		<p><label for="author">Name <?php if ($req) echo "<span class='required' title='Required'>★</span>"; ?></label><input type="text" name="author" id="author" class="comment-name" maxlength="70" value="<?php echo esc_attr($comment_author); ?>" placeholder="your name" <?php if ($req) echo "aria-required='true'"; ?> autocorrect="off" autocomplete="name" required></p>
		<p><label for="email">Email <?php if ($req) echo "<span class='required' title='Required'>★</span>"; ?></label><input type="email" name="email" id="email" class="comment-email" maxlength="50" value="<?php echo esc_attr($comment_author_email); ?>" placeholder="name@example.com" <?php if ($req) echo "aria-required='true'"; ?> autocapitalize="none" autocorrect="off" autocomplete="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required></p>
		<p><label for="url">Website</label><input type="url" name="url" id="url" class="comment-url" maxlength="50" value="<?php echo esc_attr($comment_author_url); ?>" placeholder="https://www.example.com/" autocapitalize="none" autocorrect="off" autocomplete="url"></p>

<?php endif; ?>
		<p><label for="comment">Comment <?php if ($req) echo "<span class='required' title='Required'>★</span>"; ?></label><textarea name="comment" id="comment" class="comment-textarea" placeholder="Your comment..." required></textarea></p>
		<p><input type="submit" id="submit-comment" class="comment-submit" value="Post Comment"> <?php cancel_comment_reply_link('Cancel Reply'); ?><?php comment_id_fields(); ?></p>

<?php do_action('comment_form', $post->ID); ?>

    </form>
</section>
<?php endif; ?>
<?php endif; ?>