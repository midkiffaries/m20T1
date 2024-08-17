<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php if ( post_password_required() ) : // If comments are password protected ?>
<section class="comments-closed" role="comments" id="Comments">
    <div>
        <p>🛑 <i>These comments are password protected.</i></p>
    </div>
</section>
<?php return; endif; ?>

<?php if (have_comments()) : // If post has comments ?>

<section class="comment-list" role="comments" id="Comments" itemscope itemtype="https://schema.org/UserComments">
    <div class="comment-container">
        <h2 class="comments-title"><?php comments_number('No Comments', 'Comment', 'Comments'); ?> <small itemprop="commentCount"><?php comments_number('0', '1', '%'); ?></small></h2>
        <ol role="list" class="list-comments">
            <?php wp_list_comments('type=comment&avatar_size=64&login_text=&callback=custom_comment_style'); // List all the comments ?>
        </ol>
        <?php if (!comments_open()) : // If comments are closed ?>
            <div class="comments-closed">
                <p>🚫 <i>The comments are closed for this article.</i></p>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="comment-pagination" aria-label="Comment Pagination">
    <div class="pagination-container">
        <nav class="comments-nav">
            <?php next_comments_link('&#x276E; Next '.get_option('comments_per_page').' Comments', 0); // Left ?>
            <?php previous_comments_link('Previous '.get_option('comments_per_page').' Comments &#x276F;', 0); // Right ?> 
        </nav>
    </div>
</section>

<?php else : // This is displayed if there are no comments so far ?>

<?php if (comments_open()) : // If comments are open, but there are no comments ?>

<section class="comments-closed" role="comments" id="Comments">
    <div>
        <p>😃 <i>Be the first to comment on this article.</i></p>
    </div>
</section>

<?php else : // Comments are closed ?>

<section class="comments-closed" role="comments" id="Comments">
    <div>
        <p>🚫 <i>The comments are closed for this article.</i></p>
    </div>
</section>

<?php endif; ?>

<?php endif; ?>

<?php if (comments_open()) : // Comment entry form ?>
<section class="comment-form">
    <h3 class="comment-form-title" id="comment-form"><?php comment_form_title( 'Leave a Reply', 'Post a reply to %s' ); ?></h3>

    <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : // If user is not logged in ?>
    <p>You must be <a href="<?=wp_login_url( get_permalink() );?>" class="login-link">logged in</a> to post a comment.</p>
    <?php else : ?>

    <form action="<?=get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="CommentForm" name="commentform" autocomplete="on" role="form">

    <?php if (is_user_logged_in()) : // If user is logged in ?>
		<p>You are logged in as <a href="<?=get_option('siteurl');?>/wp-admin/profile.php"><?=$user_identity; ?></a> | <a href="<?=wp_logout_url(get_permalink()); ?>" class="logout-link">Log out</a></p>
		<input type="hidden" name="author" id="author" value="<?=$user_identity; ?>">
        <input type="hidden" name="email" id="email" value="<?php printf("%s@%s", $user_identity, $_SERVER['HTTP_HOST']); ?>">   
    <?php else : // If user is not logged in ?>
		<p><label for="author" <?php if ($req) echo "class=\"required\""; ?>>Name</label><input type="text" name="author" id="author" class="comment-name" maxlength="70" value="<?=esc_attr($comment_author); ?>" placeholder="Your Name" <?php if ($req) echo "aria-required=\"true\""; ?> autocorrect="off" autocomplete="name" required></p>
		<p><label for="email" <?php if ($req) echo "class=\"required\""; ?>>Email</label><input type="email" name="email" id="email" class="comment-email" maxlength="50" value="<?=esc_attr($comment_author_email); ?>" placeholder="name@example.com" <?php if ($req) echo "aria-required=\"true\""; ?> autocapitalize="none" autocorrect="off" autocomplete="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required></p>
		<p><label for="url">Website</label><input type="url" name="url" id="url" class="comment-url" maxlength="50" value="<?=esc_attr($comment_author_url);?>" placeholder="https://www.example.com" autocapitalize="none" autocorrect="off" autocomplete="url"></p>
    <?php endif; ?>
		<p><label for="comment" <?php if ($req) echo "class=\"required\""; ?>>Comment</label><textarea name="comment" id="comment" class="comment-textarea" placeholder="What do you have to say..." <?php if ($req) echo "aria-required=\"true\""; ?> required></textarea></p>
		<p><input type="submit" id="submit-comment" class="comment-submit" value="Post Comment"> <?php cancel_comment_reply_link('Cancel Reply'); ?><?php comment_id_fields(); ?></p>

        <?php do_action('comment_form', $post->ID); ?>

    </form>
    <?php endif; ?>
</section>

<?php endif; ?>