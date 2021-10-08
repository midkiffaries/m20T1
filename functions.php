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
include 'config.php'; // Extra configuration
include 'assets/plugins/breadcrumbs.php'; // Breadcrumb trail plugin

/////////////////////////////
// Global Functions
/////////////////////////////

// Sanitize user input
function cleanUserInput($input) {
    return htmlspecialchars(strip_tags($input));
}

// Convert a string title into a slug
function titleSlug($title) {
    return cleanUserInput(preg_replace('/\s+/', '-', $title));
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


/////////////////////////////
// WordPress Functions
/////////////////////////////

function header_extended() {
    include 'header-extended.php';
}

// Add featured image to posts and pages
//add_theme_support( 'post-thumbnails' );
/*
the_post_thumbnail(); // Without parameter ->; Thumbnail
the_post_thumbnail( 'thumbnail' ); // Thumbnail (default 150px x 150px max)
the_post_thumbnail( 'medium' ); // Medium resolution (default 300px x 300px max)
the_post_thumbnail( 'medium_large' ); // Medium-large resolution (default 768px x no height limit max)
the_post_thumbnail( 'large' ); // Large resolution (default 1024px x 1024px max)
the_post_thumbnail( 'full' ); // Original image resolution (unmodified)
the_post_thumbnail( array( 100, 100 ) ); // Other resolutions (height, width)
*/

// Set the excerpt length
function custom_excerpt_length( $length ) {
    return 120; // Word length
}
add_filter('excerpt_length', 'custom_excerpt_length');

// Add a 'Continue Reading' link to excerpts
function custom_excerpt_more() {
	return '... <a href="' . get_permalink(get_the_ID()) . '" class="entry-read-more">Continue Reading</a>';
}
add_filter('excerpt_more', 'custom_excerpt_more');


// Blog post user comment styling for each comment
function custom_comment_style($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
        <div class="comment-content" role="comment">
			<header class="comment-header">
                <?php //echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
                <span class="comment-author" rel="author"><?php printf(__('%s'), get_comment_author()); ?></span>
                <span class="comment-metadata"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>" rel="bookmark" aria-label="Get link to this comment">#</a> <time class="comment-date" itemprop="datePublished"><?php printf(__('%1$s'), get_comment_date('F j, Y - h:ma')); ?></time></span>
                <span class="comment-reply"><?php get_comment_reply_link( __( 'Reply', 'textdomain' ), ' ', ' ' ); ?></span> 
			</header>
<?php if ($comment->comment_approved == '0') : ?>
        <div class="comment-moderation"><?php _e('Your comment is awaiting moderation.'); ?></div>
<?php endif; ?>
<?php comment_text(); ?>
            <p class="comment-edit"><?php edit_comment_link( __( 'Edit Comment', 'textdomain' ), ' ', ' ' ); ?></p>
        </div>
    </li>
<?php
}

// List social sharing links for each blog post
function blog_post_share() {
?>
<ul class="social-share">
    <li role="link"><a href="https://twitter.com/share?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>" class="icon-twitter twitter-share" aria-label="Twitter" target="_blank">Tweet</a></li>
    <li role="link"><a href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="icon-facebook facebook-share" aria-label="Facebook" target="_blank">Share</a></li>
</ul>
<?php
}

// Display the list of menu/navigation links
function menu_nav_list($menu, $id) {
    $menuStyle = array(
        'menu'            => $menu,
        'container'       => 'nav',
        'container_class' => $id,
        'container_id'    => $id,
        'menu_class'      => $id,
        'menu_id'         => $id,
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

// Register the sidebar widgets 
function custom_sidebars() {
    // Primary Sidebar on the right side of the page
    register_sidebar(
        array(
            'id'            => 'primary',
            'name'          => __( 'Primary Sidebar' ),
            'description'   => __( 'The full blog view sidebar.' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        )
    );
    // Secondary Sidebar on the right side of the page
    register_sidebar(
        array(
            'id'            => 'secondary',
            'name'          => __( 'Secondary Sidebar' ),
            'description'   => __( 'Other sidebar.' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        )
    );
    // Front page Widgets - bottom of the content
    register_sidebar(
        array(
            'id'            => 'frontpage',
            'name'          => __( 'Front Page Widgets' ),
            'description'   => __( 'The front page sidebar and widgets.' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
    // Single Post Widgets - bottom of the content
    register_sidebar(
        array(
            'id'            => 'singlepost',
            'name'          => __( 'Single Post Sidebar' ),
            'description'   => __( 'Single post sidebar.' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
    // Page Footer Widgets - bottom of the page
    register_sidebar(
        array(
            'id'            => 'footer',
            'name'          => __( 'Footer Widgets' ),
            'description'   => __( 'The page footer sidebar and widgets.' ),
            'before_widget' => '<nav id="%1$s" class="widget %2$s">',
            'after_widget'  => '</nav>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        )
    );
}
add_action( 'widgets_init', 'custom_sidebars' );

// Register the theme and menus/navigation 
function theme_setup() {
    // Add featured image to posts and pages
    add_theme_support( 'post-thumbnails' );

    // Theme Support
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'customize-selective-refresh-widgets' );
    
    // HTML5 Support
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
    add_theme_support( 'post-formats', array('aside','image','gallery','video','audio','link','quote','status') );
    
    // Widgets
    register_nav_menu( 'primary', __( 'Primary Navigation', 'm20T1' ) );
    register_nav_menu( 'secondary', __( 'Secondary Navigation', 'm20T1' ) );
}
add_action( 'after_setup_theme', 'theme_setup' );

?>