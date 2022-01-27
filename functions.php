<?php
/////////////////////////////
// PHP WordPress Functions
/////////////////////////////

//error_reporting(0);
error_reporting(E_ALL);

/////////////////////////////
// Includes
/////////////////////////////

// Breadcrumb trail plugin
include 'assets/plugins/breadcrumbs.php';

/////////////////////////////
// Generic Functions
/////////////////////////////

// Sanitize user input for security
function cleanUserInput($input) {
    return htmlspecialchars(strip_tags($input));
}

// Converts a number in to roman numerals for fun
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

// Swaps certain special characters with words for SEO purposes
function SEO_CharSwap($string) {
    $string = preg_replace('/\%/', 'percent', $string); 
    $string = preg_replace('/\&/', 'and', $string); 
    return $string;
}

// Get the excerpt from either the content or the user defined excerpt  
function SEO_Excerpt($id) {
    // Set the total character length
    $length = 170;
    // Check if post has a user defined excerpt
    if (has_excerpt($id) && !is_attachment()) {
        $description = trim(substr(get_the_excerpt($id), 0, $length));
    } else {
        // Get page description from content excerpt
        if (is_single() || is_page()) { // If single blog post
            $excerpt = html_entity_decode(wp_strip_all_tags(get_the_excerpt($id), true));
            $description = trim(substr($excerpt, 0, $length)) . "...";
        } else { // All other pages use site slogan
            $description = get_bloginfo('description');
        }
        // Check for attachment page
        if (is_attachment()) {
            $excerpt = html_entity_decode(wp_strip_all_tags(get_the_content($id), true));
            $description = trim(substr($excerpt, 0, $length));
        }
    }
    return $description;
}

// Get the featured image use fallback in none defined
function SEO_Image($id) {
    // Get page featured image
    if (get_the_post_thumbnail()) { // Use page's featured image
        $featuredImage = get_the_post_thumbnail_url($id, 'large');
    } else { // Use default image
        $featuredImage = home_url() . "/icons/social-share.jpg";
    }
    return $featuredImage;
}

// Get the number of times this keyword comes up in search queries
function SearchCount($query) {
    $count = 0;
    $search = new WP_Query("s=$query & showposts=-1");
    if($search->have_posts()) : while($search->have_posts()) : $search->the_post();	
        $count++;
    endwhile; endif;
    return $count;
}

// Enlarge blog post text for short blog posts
function ResizeFontClass($content) {
    if (strlen(wp_strip_all_tags($content)) < 430) {
        return 'entry-largefont'; // Larger font size
    } else {
        return 'entry-defaultfont'; // Default font size
    }
}

// Get WordPress page content for select special pages (ie: index.php)
function GetPageContent($id) {
    $page_for_posts_id = get_option( $id );
    $page_for_posts_obj = get_post( $page_for_posts_id );
    return apply_filters( 'the_content', $page_for_posts_obj->post_content );
}


/////////////////////////////
// WordPress Functions
/////////////////////////////

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

// Additional meta data for the header
function m20T1_metadata() {
?>
    <meta name="description" content="<?php echo SEO_Excerpt($post->ID); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php printf("%s/icons/favicon-32x32.png", home_url()); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php printf("%s/icons/favicon-16x16.png", home_url()); ?>">
    <meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?>">
    <meta name="format-detection" content="telephone=no">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php printf("%s/icons/apple-touch-icon.png", home_url()); ?>">
    <meta name="application-name" content="<?php bloginfo('name'); ?>">
    <link rel="manifest" href="<?php printf("%s/manifest.json", home_url()); ?>">
    <link rel="icon" type="image/png" href="<?php printf("%s/icons/android-chrome-512x512.png", home_url()); ?>" sizes="512x512">
    <link rel="icon" type="image/png" href="<?php printf("%s/icons/android-chrome-192x192.png", home_url()); ?>" sizes="192x192">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php the_permalink(); ?>">
    <meta property="og:title" content="<?php SEO_CharSwap(wp_title('|', true, 'right')); bloginfo('name'); ?>">
    <meta property="og:image" content="<?php echo SEO_Image($post->ID); ?>">
    <meta property="og:description" content="<?php echo SEO_Excerpt($post->ID); ?>">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php the_permalink(); ?>">
    <meta property="twitter:title" content="<?php SEO_CharSwap(wp_title('|', true, 'right')); bloginfo('name'); ?>">
    <meta property="twitter:image" content="<?php echo SEO_Image($post->ID); ?>">
    <meta property="twitter:description" content="<?php echo SEO_Excerpt($post->ID); ?>">
<?php
}

// Blog post user comment styling for each comment
function custom_comment_style($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
        <div class="comment-content" role="comment">
			<header class="comment-header">
                <?php //echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?>
                <span class="comment-author" rel="author"><?php printf(__('%s'), get_comment_author()); ?></span>
                <span class="comment-metadata"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>" rel="bookmark" aria-label="Get the link to this comment">#</a> <time class="comment-date" itemprop="datePublished"><?php printf(__('%1$s'), get_comment_date('F j, Y ~ h:ma')); ?></time></span>
                <span class="comment-reply"><?php get_comment_reply_link( __( 'Reply', 'textdomain' ), ' ', ' ' ); ?></span> 
			</header>
            <?php if ($comment->comment_approved == '0') : ?>
            <div class="comment-moderation"><?php _e('Your comment is awaiting moderation.'); ?></div>
            <?php endif; ?>
            <div class="comment-text"><?php comment_text(); ?></div>
            <div class="comment-edit"><?php edit_comment_link( __( 'Edit Comment', 'textdomain' ), ' ', ' ' ); ?></div>
        </div>
    </li>
<?php
}

// Pagination on the index/archive/search pages
function blog_post_pagination($type) {
    previous_posts_link('&#x276E; Previous ' . get_option('posts_per_page') . ' ' . $type, 0);
    next_posts_link('Next ' . get_option('posts_per_page') . ' ' . $type . ' &#x276F;', 0);
}

// List social sharing links on each blog post
function blog_post_share() {
?>
<ul class="post-social-share">
    <li><a href="https://twitter.com/share?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>" class="icon-twitter twitter-share" aria-label="Twitter" target="_blank">Tweet</a></li>
    <li><a href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="icon-facebook facebook-share" aria-label="Facebook" target="_blank">Share</a></li>
</ul>
<?php
}

// Display page title and excerpt from child pages of current page
function get_child_pages($id, $thumbnail) {
    $page_children = get_pages(array(
        'sort_order'     => 'ASC',
        'sort_column'    => 'menu_order, post_title',
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'exclude'        => 0,
        'child_of'       => $id,
    ));

    foreach ($page_children as $child) { // Display all the child pages to this one ?>
        <div class="child-card" id="child-card-<?php echo $child->ID; ?>">
            <a class="child-card__link" href="<?php echo get_permalink($child->ID); ?>" rel="nofollow">
                <p class="child-card__title"><?php echo $child->post_title; ?></p>
                <?php if ($thumbnail) : ?>
                <p class="child-card__image"><?php echo get_the_post_thumbnail($child->ID, 'medium'); ?></p>
                <?php endif; ?>
                <p class="child-card__text"><?php echo $child->post_excerpt; ?></p>
            </a>
        </div>
    <?php }
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
add_action( 'widgets_init', function(){
    // Primary Sidebar on the right side of the page
    register_sidebar(array(
        'id'            => 'primary',
        'name'          => __( 'Primary Sidebar', 'm20T1' ),
        'description'   => __( 'Sidebar widgets on the full blog page.' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    // Secondary Sidebar on the right side of the page
    register_sidebar(array(
        'id'            => 'secondary',
        'name'          => __( 'Secondary Sidebar', 'm20T1' ),
        'description'   => __( 'Archives page sidebar widgets.' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    // Front page Widgets - bottom of the content
    register_sidebar(array(
        'id'            => 'frontpage',
        'name'          => __( 'Front Page Widgets', 'm20T1' ),
        'description'   => __( 'Widgets on the bottom of the front page.' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    // Single Post Widgets - bottom of the content
    register_sidebar(array(
        'id'            => 'singlepost',
        'name'          => __( 'Single Post Sidebar', 'm20T1' ),
        'description'   => __( 'Widgets below a single blog post.' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    // Page Footer Widgets - bottom of the page
    register_sidebar(array(
        'id'            => 'footer',
        'name'          => __( 'Footer Widgets', 'm20T1' ),
        'description'   => __( 'The page footer widgets.' ),
        'before_widget' => '<nav id="%1$s" class="widget %2$s">',
        'after_widget'  => '</nav>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    // Page Header Widgets - bottom of the page
    register_sidebar(array(
        'id'            => 'header',
        'name'          => __( 'Header Widgets', 'm20T1' ),
        'description'   => __( 'The page header widgets.' ),
        'before_widget' => '<nav id="%1$s" class="widget %2$s">',
        'after_widget'  => '</nav>',
        'before_title'  => '<p class="widget-title">',
        'after_title'   => '</p>',
    ));
});

// Register the theme and menus/navigation 
add_action( 'after_setup_theme', function() {
    // Additional Theme Support
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-line-height' );
    add_theme_support( 'custom-spacing' );
    add_theme_support( 'featured-content' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'customize-selective-refresh-widgets' );
    
    // HTML5 Support
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
    add_theme_support( 'post-formats', array('aside', 'image', 'gallery', 'video', 'audio', 'link', 'quote', 'status') );
    
    // Navigation Widgets
    register_nav_menu( 'primary', __( 'Primary Navigation', 'm20T1' ) );
    register_nav_menu( 'secondary', __( 'Secondary Navigation', 'm20T1' ) );
});

// Add elements to WordPress
add_action('wp_enqueue_scripts', function(){
    $version = wp_get_theme()->get('Version');
    
    // Add Javascript to the bottom of the page body
    wp_enqueue_script( 'base-script', get_template_directory_uri() . "/assets/scripts/scripts.js", array(), $version, true );
    wp_enqueue_script( 'modals-script', get_template_directory_uri() . "/assets/scripts/modals.js", array(), $version, true );
    
    // Add stylesheets to the HEAD metadata
    wp_enqueue_style( 'tedilize-style', get_template_directory_uri() . "/assets/css/tedilize.css", array(), '2.0', 'all' );
    wp_enqueue_style( 'layout-style', get_template_directory_uri() . "/assets/css/layout.css", array(), $version, 'all' );
    wp_enqueue_style( 'base-style', get_stylesheet_uri(), array(), $version, 'all' );

    // Remove comments
    wp_dequeue_script( 'comment-reply' );

    // Remove WordPress block library
    //wp_dequeue_style( 'wp-block-library' );
    //wp_dequeue_style( 'wp-block-library-theme' );
    //wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
});

// Set the excerpt length
add_filter('excerpt_length', function(){
    return 120; // Word length
});

// Add a 'Continue Reading' link to excerpts
add_filter('excerpt_more', function(){
    return '... <a href="' . get_permalink(get_the_ID()) . '" class="entry-read-more">Continue Reading</a>';
});

// Remove embed function
add_action( 'wp_footer', function(){
    wp_dequeue_script( 'wp-embed' );
});

// Remove WordPress emojis
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Remove RSS feed links
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );

// Insert into 'wp-config.php' after $table_prefix
//define('WP_POST_REVISIONS', 10); // Put a limit on storing post/page revisions

?>