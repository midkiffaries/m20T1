<?php

/////////////////////////////
// PHP WordPress Functions
/////////////////////////////

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

//error_reporting(E_ALL);

/////////////////////////////
// Includes
/////////////////////////////

// Breadcrumb trail plugin
include 'assets/plugins/breadcrumbs.php';

/////////////////////////////
// Constants and Settings
/////////////////////////////

// Default fallback featured image URI -- 
define('BLANK_IMAGE', get_template_directory_uri() . '/assets/images/featured-blank.svg');
// Default social media sharing image URI
define('SOCIAL_IMAGE', get_template_directory_uri() . '/assets/images/social-share.jpg');
//define('SOCIAL_IMAGE', home_url() . '/wp-content/uploads/2022/social-share.jpg');
// Inline separator in the blog post metadata
define('POST_SEPARATOR', '&nbsp;|&nbsp;');
// Read more text ending
define('MORE_TEXT', '[...]');
// Max excerpt length
define('EXCERPT_LENGTH', 90); // Number of Words
// Shorten length of content
define('SHORT_TEXT_LENGTH', 350); // Number of characters
// SEO text excerpt length
define('SEO_TEXT_LENGTH', 165); // Number of characters


/////////////////////////////
// WordPress Settings
/////////////////////////////

// Enable WordPress features and register menus
add_action( 'after_setup_theme', function(){
    // Additional Theme Support
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-line-height' );
    add_theme_support( 'custom-spacing' );
    add_theme_support( 'featured-content' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'align-wide' );
    //add_theme_support( 'wp-block-styles' );

    // Set featured image size
    the_post_thumbnail( 'medium' );

    // Add excerpt support to pages
    add_post_type_support( 'page', 'excerpt' );

    // Custom WordPress editor styling
    add_theme_support( 'editor-styles' );
    add_editor_style( 'editor-style.css' );

    // Custom background and header support
    add_theme_support( 'custom-header', array( 'default-color' => 'fefefe', 'default-image' => '', 'width' => 300, 'height' => 60, 'flex-height' => true, 'flex-width' => true, 'default-text-color' => '', 'header-text' => true, 'uploads' => true, ) );
    add_theme_support( 'custom-background', array( 'default-image' => '', 'default-preset' => 'default', 'default-size' => 'cover', 'default-repeat' => 'repeat', 'default-attachment' => 'scroll', ) );

    // Custom Logo Support
    add_theme_support( 'custom-logo', array( 'height' => 96, 'width' => 628, 'flex-height' => true, 'flex-width' => true, 'header-text' => array( 'site-title', 'site-description' ), ) );
    
    // Add HTML5 Support
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
    
    // Set the different post formats that the author can select
    add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery', 'video', 'audio', 'link', 'quote', 'status' ) );
    
    // Set the Navigation Widgets
    register_nav_menu( 'primary', __( 'Primary Navigation', 'm20T1' ) );
    register_nav_menu( 'secondary', __( 'Secondary Navigation', 'm20T1' ) );
    register_nav_menu( 'tertiary', __( 'Tertiary Navigation', 'm20T1' ) );

    // Setting Custom Fields
    add_post_meta( 'slug', 'Widgets Slug', 'singlepage', true );
    //delete_post_meta_by_key( 'custom_field_name' ); // Delete custom field
});

// Enable styles and scripts
add_action('wp_enqueue_scripts', function(){
    // Get version from style.css
    $version = wp_get_theme()->get('Version');
    
    // Add Javascript to the bottom of the page body
    wp_enqueue_script( 'js-scripts', get_template_directory_uri() . "/assets/scripts/scripts.js", array(), $version, true );

    // Add stylesheets to the HEAD metadata
    wp_enqueue_style( 'tedilize-style', get_template_directory_uri() . "/assets/css/tedilize.css", array(), '2.0', 'all' );
    wp_enqueue_style( 'layout-style', get_template_directory_uri() . "/assets/css/layout.css", array(), $version, 'all' );
    wp_enqueue_style( 'base-style', get_stylesheet_uri(), array(), $version, 'all' );

    // Remove post comments
    wp_dequeue_script( 'comment-reply' );

    // Remove WordPress block library
    //wp_dequeue_style( 'wp-block-library' );
    //wp_dequeue_style( 'wp-block-library-theme' );
    //wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
});

// Add Category and Tag support to pages
add_action( 'init', function(){
    register_taxonomy_for_object_type('category', 'page');
    //register_taxonomy_for_object_type('post_tag', 'page');
});

// Append to the page head tag
add_action( 'wp_head', function(){
?>
<meta name="title" content="<?php bloginfo('name'); ?>">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<meta name="author" content="Ted Balmer | MarchTwenty.com">
<base href="<?php echo esc_url(home_url()); ?>/" id="SiteURI">
<meta name="application-name" content="<?php bloginfo('name'); ?>">
<meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?>">
<meta name="description" content="<?php echo SEO_Excerpt($post->ID); ?>">
<meta name="format-detection" content="telephone=no">
<link rel="icon" href="<?php esc_url(printf("%s/favicon.ico", home_url())); ?>" sizes="any">
<link rel="icon" href="<?php esc_url(printf("%s/favicon.svg", home_url())); ?>" type="image/svg+xml">
<link rel="apple-touch-icon" href="<?php esc_url(printf("%s/icons/apple-touch-icon.png", home_url())); ?>">
<link rel="manifest" href="<?php esc_url(printf("%s/site.webmanifest", home_url())); ?>">
<meta property="og:locale" content="<?php echo get_bloginfo('language'); ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php esc_url(the_permalink()); ?>">
<meta property="og:title" content="<?php SEO_CharSwap(wp_title('|', true, 'right')); bloginfo('name'); ?>">
<meta property="og:image" content="<?php echo SEO_Image($post->ID); ?>">
<meta property="og:description" content="<?php echo SEO_Excerpt($post->ID); ?>">
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?php esc_url(the_permalink()); ?>">
<meta property="twitter:title" content="<?php SEO_CharSwap(wp_title('|', true, 'right')); bloginfo('name'); ?>">
<meta property="twitter:image" content="<?php echo SEO_Image($post->ID); ?>">
<meta property="twitter:description" content="<?php echo SEO_Excerpt($post->ID); ?>">
<?php
});

// Append to the top of the page body tag
//add_action( 'wp_body_open', function(){

//});

// Append to the bottom of the page body tag
add_action( 'wp_footer', function(){
?>
<template id="Search-Modal">
    <h3 class="search-title">Search</h3>
    <?php get_search_form('search-modal'); // Load searchform.php ?>
</template>

<template id="Contact-Modal">
    <?php get_template_part('contactform'); // Load contactform.php ?>
</template>
<?php
});

// Set the excerpt length
add_filter( 'excerpt_length', function(){
    return EXCERPT_LENGTH; // Number of Words
});

// Add a 'Continue Reading' link to excerpts
add_filter( 'excerpt_more', function(){
    return ' <span class="entry-read-more" aria-label="Read more in the post">' . MORE_TEXT . '</span>';
});

// Enable the use of shortcodes in text widgets.
add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );

// Remove WordPress Emojis
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Remove RSS feed links
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );


/////////////////////////////
// Sidebar and Widgets
/////////////////////////////

// Register the sidebar widgets 
add_action( 'widgets_init', function(){
    // Primary Sidebar - right side of the content
    register_sidebar(array(
        'id'            => 'primary',
        'name'          => __( 'Primary Sidebar Widgets', 'm20T1' ),
        'description'   => __( 'Sidebar widgets on the full blog page.' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    // Secondary Sidebar - right side of the content
    register_sidebar(array(
        'id'            => 'secondary',
        'name'          => __( 'Secondary Sidebar Widgets', 'm20T1' ),
        'description'   => __( 'Archive pages sidebar widgets.' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    // Tertiary Sidebar - right side of the content
    register_sidebar(array(
        'id'            => 'tertiary',
        'name'          => __( 'Tertiary Sidebar Widgets', 'm20T1' ),
        'description'   => __( 'Search results page sidebar widgets.' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    // Single Post Widgets - bottom of the content
    register_sidebar(array(
        'id'            => 'singlepost',
        'name'          => __( 'Single Post Widgets', 'm20T1' ),
        'description'   => __( 'Widgets below a single blog post.' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    // Front page Widgets - bottom of the content
    register_sidebar(array(
        'id'            => 'frontpage',
        'name'          => __( 'Front Page Widgets', 'm20T1' ),
        'description'   => __( 'Widgets on the bottom of the front page or landing page.' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    // Page Widgets - bottom of the content
    register_sidebar(array(
        'id'            => 'singlepage',
        'name'          => __( 'Basic Page Widgets', 'm20T1' ),
        'description'   => __( 'Widgets below the contents on a single web page and attachment pages.' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    // Page w/ Sidebar Widgets - right side of the content
    register_sidebar(array(
        'id'            => 'singlepagesidebar',
        'name'          => __( 'Basic Page w/ Sidebar Widgets', 'm20T1' ),
        'description'   => __( 'Widgets on the sidebar on a single web page.' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    // Page Header Widgets
    register_sidebar(array(
        'id'            => 'header',
        'name'          => __( 'Header Widgets', 'm20T1' ),
        'description'   => __( 'The page header widgets.' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<p class="widget-title">',
        'after_title'   => '</p>',
    ));
    // Page Footer Widgets
    register_sidebar(array(
        'id'            => 'footer',
        'name'          => __( 'Footer Widgets', 'm20T1' ),
        'description'   => __( 'The page footer widgets.' ),
        'before_widget' => '<nav id="%1$s" class="widget %2$s">',
        'after_widget'  => '</nav>',
        'before_title'  => '<p class="widget-title">',
        'after_title'   => '</p>',
    ));
});

// Get 'Widgets Slug' Custom Field which changes the sidebar selection
function selectSidebarCustomField($id, $default) {
    $key = get_post_meta( $id, 'Widgets Slug', true );
    if (empty($key)) {
        return $default; // Default widgets
    } else {
        return $key;
    }
}

// Display the menu/navigation links as a <ul> list
function menu_nav_list($menu, $id) {
    wp_nav_menu(array(
        'menu'            => $menu,
        'container'       => 'nav',
        'container_class' => 'nav-'.$id,
        'container_id'    => $id,
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul role="list" aria-label="'.$menu.'">%3$s</ul>',
        'item_spacing'    => 'preserve',
        'depth'           => 0,
        'walker'          => ''
    ));
}


/////////////////////////////
// Child Pages Functions
/////////////////////////////

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

    // Display section header
    if ($page_children) : ?>
        <h2 class="child-title">Related Pages</h2>
    <?php endif;

    foreach ($page_children as $child) { // Display all the child pages to this one ?>
        <div class="child-card" id="child-card-<?php echo $child->ID; ?>">
            <a class="child-card__link" href="<?php echo esc_url(get_permalink($child->ID)); ?>" rel="nofollow">
                <div class="child-card__image"><img src="<?php echo esc_url(FeaturedImageURL($child->ID, 'medium', 0)); ?>" alt=""></div>
                <div class="child-card__title"><?php echo $child->post_title; ?></div>
                <div class="child-card__text"><?php echo $child->post_excerpt; ?></div>
            </a>
        </div>
    <?php }
}


/////////////////////////////
// Specialized Functions
/////////////////////////////

// Converts a number in to roman numerals... for fun
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

// Get the number of times this keyword comes up in search queries
function SearchCount($query) {
    $count = 0;
    $search = new WP_Query("s=$query & showposts=-1");
    if ($search->have_posts()) {
        while ($search->have_posts()) {
            $search->the_post();
            $count++;
        }
    }
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

// Get WordPress page title and content for the blog list page (index.php)
function GetPageTitle($id) {
    $page_for_posts_obj = get_post( get_option( $id ));
    return apply_filters( 'the_content', $page_for_posts_obj->post_content );
}

// Shorten the_content in place of using the_excerpt
function shorten_the_content($post) {
    $excerpt = html_entity_decode(wp_strip_all_tags($post, true));
    if (strlen($excerpt) > SHORT_TEXT_LENGTH) {
        return trim(substr($excerpt, 0, SHORT_TEXT_LENGTH)) . ' <span class="entry-read-more">' . MORE_TEXT . '</span>';
    } else {
        return $excerpt;
    }
}


/////////////////////////////
// SEO and Header Functions
/////////////////////////////

// Swaps certain special characters with words for SEO purposes
function SEO_CharSwap($string) {
    $string = preg_replace('/\%/', 'percent', $string); 
    $string = preg_replace('/\&/', 'and', $string); 
    return $string;
}

// Get the excerpt from either the content or the user defined excerpt  
function SEO_Excerpt($id) {
    // Set the total character length
    $length = SEO_TEXT_LENGTH;
    // Check if post has a user defined excerpt
    if (has_excerpt($id) && !is_attachment()) {
        $description = trim(substr(get_the_excerpt($id), 0, $length));
    } else {
        // Get page description from content excerpt
        if (is_single() || is_page()) { // If single blog post
            $excerpt = html_entity_decode(wp_strip_all_tags(get_the_excerpt($id), true));
            $description = trim(substr($excerpt, 0, $length)) . MORE_TEXT;
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

// Get the featured image use fallback in none defined (thumbnail, medium, medium_large, large, full)
function SEO_Image($id) {
    // Get page featured image
    if (has_post_thumbnail($id)) { // Use page's featured image
        $featuredImage = get_the_post_thumbnail_url($id, 'large');
    } else { // Use default image
        $featuredImage = SOCIAL_IMAGE;
    }
    return esc_url($featuredImage);
}

// Check if user selected a custom logo
function m20T1_logo() {
    if (has_custom_logo()) {
        the_custom_logo();
    } else {
        bloginfo('name');
    }
}


/////////////////////////////
// Featured Image Fallbacks
/////////////////////////////

// Get the post/page featured image url or use fallback if none available ($size = thumbnail, medium, medium_large, large, full)
function FeaturedImageURL($id, $size, $isBackground) {
    if (has_post_thumbnail($id)) { // Use featured image url
        $image = esc_url(get_the_post_thumbnail_url($id, $size));
    } else {
        if (GetFirstImage() && $size != 'full') { // Get first image in post
            $image = esc_url(GetFirstImage());
        } else {
            $image = false;
        }
    }

    // Check if background is being placed in a style attrib or in an image tag
    if ($isBackground && $image) {
        return "background-image:url(" . $image . ");";
    } else {
        if ($image) {
            return $image;
        } else {
            return BLANK_IMAGE;
        }
    }
}

// Get the first image from a post or page
function GetFirstImage() {
    global $post, $posts;
    $first_image = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $post->post_content, $matches);
    $first_image = $matches[1][0];
    if (empty($first_image)) {
        return false;
    } else {
        return $first_image;
    }
}

// Display the header image
function HeaderFeaturedImage($id) {
    // Type of page
    if ( is_front_page() ) { // Front-page header (None)
        $className = "homepage";
        $titleHidden = "hidden";
        $hasFeaturedImage = false;
    } elseif ( is_attachment() || is_404() ) { // Attachment and 404 page headers (None)
        $className = "noimage";
        $titleHidden = "hidden";
        $hasFeaturedImage = false;
    } elseif ( is_page() ) { // Basic Page and privacy-policy header (Use Featured Image)
        $className = "single-page";
        $titleHidden = "hidden";
        $hasFeaturedImage = true;
    } elseif ( is_single() ) { // Single blog post (Use Featured Image)
        $className = "single-post";
        $titleHidden = "hidden";
        $hasFeaturedImage = true;
    } else { // Blog Page, search page and archives header (Use default Image)
        $className = "noimage";
        $titleHidden = "hidden";
        $hasFeaturedImage = false;
    }

    // Get the featured image if exists or fallback to blank image
    if ($hasFeaturedImage) {
        $featuredImage = FeaturedImageURL($id, 'full', 1);
    }

    ?>
        <div class="header-hero-image header-<?php echo $className; ?>" style="<?php echo $featuredImage; ?>">
            <div class="header-hero-overlay">
                <h1 class="page-title <?php echo $titleHidden; ?>" itemprop="title"><?php the_title(); ?></h1>
            </div>
        </div>
    <?php
}


/////////////////////////////
// WordPress Functions
/////////////////////////////

// Display the author's user level/role
function user_level($level) {
    switch ($level) {
        case 10: 
            return "Administrator";
            break;
        case 7:
            return "Editor";
            break;
        case 2:
            return "Author";
            break;
        default:
            return "Contributor";
            break;
    }
}

// Blog post user comment styling for each comment
function custom_comment_style($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
        <div class="comment-content" role="comment">
			<header class="comment-header">
                <span class="comment-avatar hidden">
                    <figure class="alignleft" aria-label="Authors Avatar">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?>
                    </figure>
                </span>
                <span class="comment-author" rel="author"><?php printf(__('%s'), get_comment_author()); ?></span>
                <span class="comment-metadata"><a href="<?php echo esc_url(get_comment_link($comment->comment_ID)) ?>" rel="bookmark" aria-label="Get the link to this comment">#</a> <time class="comment-date" itemprop="datePublished"><?php printf(__('%1$s'), get_comment_date('F j, Y ~ h:ma')); ?></time></span>
                <span class="comment-reply"><?php get_comment_reply_link( __( 'Reply', 'textdomain' ), '', '' ); ?></span> 
			</header>
            <?php if ($comment->comment_approved == '0') : ?>
                <div class="comment-moderation"><?php _e('⚠️ Your comment is awaiting moderation.'); ?></div>
            <?php endif; ?>
            <div class="comment-text"><?php comment_text(); ?></div>
            <div class="comment-edit"><?php edit_comment_link( __( 'Edit Comment', 'textdomain' ), '', '' ); ?></div>
        </div>
    </li>
<?php
}

// Pagination on the index/archive/search pages
function blog_post_pagination($type) {
    previous_posts_link("&#x276E; Previous " . get_option('posts_per_page') . " " . $type, 0); // << Left Side
    next_posts_link("Next " . get_option('posts_per_page') . " " . $type . " &#x276F;", 0); // Right Side >>
}

// Show the blog post tags
function blog_post_tags() {
    return the_tags('<ul role="list"><li rel="tag">', '</li><li rel="tag">', '</li></ul>');
}

// List social sharing links on each blog post
function blog_post_share() {
    // Social media links
    $link_Facebook = "https://www.facebook.com/sharer/sharer.php?u=" . esc_url(get_the_permalink());
    $link_Twitter = "https://twitter.com/intent/tweet?text=" . esc_url(get_the_permalink());
    $link_LinkedIn = "https://www.linkedin.com/shareArticle?mini=true&url=" . esc_url(get_the_permalink()) . "&title=" . urlencode(get_the_title()) . "&summary=" . urlencode(get_the_excerpt()) . "&source=" . urlencode(get_bloginfo('name'));
    $link_Pinterest = "https://pinterest.com/pin/create/button/?url=" . esc_url(get_the_permalink()) . "&media=" . urlencode(get_the_title()) . "&description=" . urlencode(get_the_excerpt());
    $link_Reddit = "https://www.reddit.com/submit?url=" . esc_url(get_the_permalink());
?>
    <ul role="list" class="post-social-share" aria-label="Share on social media">
        <li><a href="<?php echo $link_Twitter; ?>" class="icon-twitter twitter-share" aria-label="Share on Twitter" rel="noopener noreferrer" target="_blank">Tweet</a></li>
        <li><a href="<?php echo $link_Facebook; ?>" class="icon-facebook facebook-share" aria-label="Share on Facebook" rel="noopener noreferrer" target="_blank">Share</a></li>
        <li><a href="<?php echo $link_LinkedIn; ?>" class="icon-linkedin linkedin-share" aria-label="Share on LinkedIn" rel="noopener noreferrer" target="_blank">Share</a></li>
        <li><a href="<?php echo $link_Pinterest; ?>" class="icon-pinterest pinterest-share" aria-label="Share on Pinterest" rel="noopener noreferrer" target="_blank">Pin</a></li>
        <li><a href="<?php echo $link_Reddit; ?>" class="icon-reddit reddit-share" aria-label="Share on Reddit" rel="noopener noreferrer" target="_blank">Share</a></li>
    </ul>
<?php
}