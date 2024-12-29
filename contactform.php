<?php // Global Contact Form ?>
<?php defined( 'ABSPATH' ) || exit; // Exit if accessed directly ?>
<div class="email-block" aria-label="Contact Form">
	
	<?php if (get_option('contact_shortcode')) : ?>
		<?=apply_shortcodes(wp_strip_all_tags(get_option('contact_shortcode')));?>
	<?php else : ?>
		<?php if (comments_open(get_option('page_on_front'))) : ?>
		<?=comment_form([
			'label_submit' => __( 'Send Message', 'm20t1' ),
			'title_reply' => __( '<h3>Send me a message</h3>', 'm20t1' ),
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Message', 'noun' ) . '<span class="required">*</span></label><textarea id="comment" name="comment" aria-required="true" placeholder="What would you like to tell me..." required></textarea></p>',
		], get_option('page_on_front') ); // ID of the site's homepage ?>
		<style>
			.email-block .comment-form {
				background: none;
				padding: 0;
			}
			.email-block .comment-form-url {
				display: none;
			}
			.email-block .required {
				color: #0000;
			}
		</style>
		<?php else : ?>
			<p>The contact form is <b>closed</b> on this page.</p>
		<?php endif; ?>
	<?php endif; ?>
	
</div>