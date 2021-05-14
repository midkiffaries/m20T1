<?php
/////////////////////////////
// PHP Functions
/////////////////////////////

//error_reporting(0);
error_reporting(E_ALL);

/////////////////////////////
// Site Setup
/////////////////////////////

// Includes
include 'config.php';

// Define URLS
define('CURRENT_ADDRESS', $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); // Full uri
define('SITE_ADDRESS', "https://" . $_SERVER['HTTP_HOST']);  // Live Server

/////////////////////////////
// Global Functions
/////////////////////////////

// Sanitize user input
function cleanUserInput($input) {
    return htmlspecialchars(strip_tags($input));
}

// Converts a number into roman numerals
function numberToRoman($variable) {
	$n = intval($variable);
	$lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
	foreach ($lookup as $roman => $value) {
		$matches = intval($n / $value);
		$result .= str_repeat($roman, $matches);
		$n = $n % $value;
	}
	return $result;
}

// Swap out SVG for PNG images if the user agent is Internet Explorer (>=11)
/*
function detectIE() {
    if (strpos($_SERVER['HTTP_USER_AGENT'],'MSIE') || strpos($_SERVER['HTTP_USER_AGENT'],'Trident')) { // IE >= 11
        return 'png';
    } else { // All other browsers
        return 'svg';
    }
}
*/

/////////////////////////////
// WordPress Functions
/////////////////////////////

// Wordpress Filters
//automatic_feed_links();

// Add a More link to excerpts
add_filter( 'excerpt_more', 'new_excerpt_more' );

// Custom excerpt more
function new_excerpt_more() {
	return '... <br><a href="' . get_permalink( get_the_ID() ) . '" class="wp-read-more">Continue Reading</a>';
}

// Setup sidebar widgets
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => sprintf(__('Sidebar %d'), $i ),
		'id' => 'sidebar-$i',
		'description' => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}

// Blog post individual user comment styling
function my_comment_style($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
?>
	<li <?php comment_class(); ?> id="comment-li-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author">
                <?php echo get_avatar($comment, $size='48', $default='<path_to_url>'); ?><?php printf(__('%s'), get_comment_author_link()) ?> <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>" class="comment-meta"><span class="comment-date"><?php printf(__('%1$s'), get_comment_date('F j, Y')) ?></span></a> <span class="comment-reply" title="Reply to this comment"><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span> <span class="comment-edit"><?php edit_comment_link(__(' '),'  ','') ?></span>
			</div>
<?php if ($comment->comment_approved == '0') : ?>
        <div class="comment-moderation"><?php _e('Your comment is awaiting moderation.') ?></div>
<?php endif; ?>
<?php comment_text() ?>
	</div>
<?php
}

// Search Form
function my_search_form($id) {
?>
<section class="search-block search-<?php echo $id; ?>">
    <form method="get" role="search" action="<?php echo SITE_ADDRESS; ?>/">
        <input type="search" name="s" id="Search-<?php echo $id; ?>" value="<?php echo get_search_query(); ?>" placeholder="Search..." autocapitalize="none" autocorrect="off" accesskey="s" maxlength="255" pattern="[^'\x22]+" aria-label="Search" required><input type="submit" value="&nbsp;" aria-label="Submit Search">
    </form>
</section>
<?php
}

// List social sharing links for each blog post
function blog_post_share() {
?>
<ul>
    <li class="tw-share-button" role="link" ><a href="https://twitter.com/intent/tweet?text=<?php the_permalink(); ?>" class="icon-twitter twitter-share-button" title="Twitter" target="_blank">Tweet</a></li>
    <li class="fb-share-button" data-href="<?php the_permalink(); ?>" data-layout="button" data-size="large" role="link"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>;src=sdkpreparse" class="icon-facebook fb-xfbml-parse-ignore" title="Facebook" target="_blank">Share</a></li>
</ul>
<?php
}

// Blog posts navigation
function blog_list_nav() {
?>
<div class="wp-post-nav"><?php next_posts_link('&#x276E; Older Entries', 0) . previous_posts_link('Newer Entries &#x276F;', 0); ?></div>
<?php
}

// Settings to generate a Tag cloud
function tag_cloud() {
    $tagArgs = array(
        'smallest'                  => 1, 
        'largest'                   => 1,
        'unit'                      => 'em', 
        'number'                    => 20,  
        'format'                    => 'flat',
        'separator'                 => "\n",
        'orderby'                   => 'name', 
        'order'                     => 'ASC',
        'exclude'                   => null, 
        'include'                   => null, 
        'topic_count_text_callback' => default_topic_count_text,
        'link'                      => 'view', 
        'taxonomy'                  => 'post_tag', 
        'echo'                      => true,
        'child_of'                  => null,
    );
    wp_tag_cloud($tagArgs);
}

// Display the list of menu/navigation links
function menu_nav_list($menu, $id) {
    $menuStyle = array(
        //'theme_location'  => '',
        'menu'            => $menu,
        'container'       => 'nav',
        'container_class' => 'links-' . $id,
        //'container_id'    => '',
        'menu_class'      => 'menu',
        //'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul id="%1$s-' . $id . '">%3$s</ul>',
        'item_spacing'    => 'preserve',
        'depth'           => 0,
        'walker'          => ''
    );
    wp_nav_menu($menuStyle);
}

// Sidebar widget settings
add_action( 'widgets_init', 'my_register_sidebars' );
function my_register_sidebars() {
    /* Register the 'primary' sidebar. */
    register_sidebar(
        array(
            'id'            => 'primary',
            'name'          => __( 'Primary Sidebar' ),
            'description'   => __( 'The full blog sidebar.' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        )
    );
    /* Repeat register_sidebar() code for additional sidebars. */
    register_sidebar(
        array(
            'id'            => 'secondary',
            'name'          => __( 'Single Post Sidebar' ),
            'description'   => __( 'The single blog post sidebar.' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        )
    );
    /* Repeat register_sidebar() code for additional sidebars. */
    register_sidebar(
        array(
            'id'            => 'footer',
            'name'          => __( 'Footer Sidebar' ),
            'description'   => __( 'The page footer sidebar.' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        )
    );
}

?>