<?php // Global Contact Form ?>
<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<div class="email-block" aria-label="Contact Form">
	<h3>Send me a message</h3>
	<?=apply_shortcodes(wp_strip_all_tags(get_option('contact_shortcode')));?>
	
</div>