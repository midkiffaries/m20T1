<?php // Custom PHP WordPress functions and settings

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Visual error reporting
error_reporting(0);

// Define the start time for the page loading timer
define( 'PAGE_LOAD_START', microtime(TRUE) );

/////////////////////////////
// Includes and Plugins
/////////////////////////////

// Breadcrumb trail plugin
include_once 'assets/plugins/breadcrumbs.php';

/////////////////////////////
// Initial Settings
/////////////////////////////

// Inline separator that appears in the post/page metadata
define( 'POST_SEPARATOR', '–' );
// Read more excerpt at the text ending
define( 'MORE_TEXT', '[...]' );
// Maximum excerpt length default
define( 'EXCERPT_LENGTH', 90 ); // Number of words
// Shorten length of the content default - Post listing
define( 'SHORT_TEXT_LENGTH', 60 ); // Number of words
// SEO text excerpt length default
define( 'SEO_TEXT_LENGTH', 165 ); // Number of characters

// Title of the additional post type
define( 'ADDITIONAL_POST_TYPE', 'Portfolio' );
// Additional post type default description/subtitle
define( 'ADDITIONAL_POST_TYPE_SUBTITLE', 'The work I have done professionally' );
// Additional post type page ID and URI slug
define( 'ADDITIONAL_POST_TYPE_PAGE_ID', get_page_by_path(rawurlencode(strtolower(ADDITIONAL_POST_TYPE))) );


/////////////////////////////
// WordPress Settings
/////////////////////////////

// Get the version of m20T1 from style.css
define( 'THEME_VERSION', wp_get_theme()->get('Version') );

// Decactivate xml-rpc WordPress feature for security reasons
//add_filter( 'xmlrpc_enabled', '__return_false' );
//add_filter( 'load_configurator_on_page', '__return_true' );

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
    add_theme_support( 'wp-block-styles' );

    // Set featured image size
    the_post_thumbnail( 'medium' );

    // Additional image sizes
    add_image_size( 'thumbnail-large', 300, 300, true ); // 300x300 Cropped

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
    //add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery', 'video', 'audio', 'link', 'quote', 'status' ) );
    
    // Set the Navigation Widgets
    register_nav_menu( 'primary', __( 'Primary Navigation', 'm20T1' ) );
    register_nav_menu( 'secondary', __( 'Secondary Navigation', 'm20T1' ) );
    register_nav_menu( 'tertiary', __( 'Tertiary Navigation', 'm20T1' ) );

    // Setting a Custom Field for the widgets slug
    if (empty(get_post_meta( get_the_ID(), 'Widgets_Slug', true ))) {
        add_post_meta( get_the_ID(), 'Widgets_Slug', '', true );
	}

    // Setting a Custom Field for the page CSS style
    if (empty(get_post_meta( get_the_ID(), 'Page_CSS', true ))) {
        add_post_meta( get_the_ID(), 'Page_CSS', '', true );
    }
});

// Enable styles and scripts
add_action( 'wp_enqueue_scripts', function(){    
    // Add Javascript to the bottom of the page body
    wp_enqueue_script( 'js-scripts', get_template_directory_uri() . "/assets/scripts/scripts.js", array(), THEME_VERSION, true );

    // Add stylesheets to the HEAD metadata
    wp_enqueue_style( 'tedilize-style', get_template_directory_uri() . "/assets/css/tedilize.css", array(), '2.0', 'all' );
    wp_enqueue_style( 'layout-style', get_template_directory_uri() . "/assets/css/layout.css", array(), THEME_VERSION, 'all' );
    wp_enqueue_style( 'base-style', get_stylesheet_uri(), array(), THEME_VERSION, 'all' );
    //wp_enqueue_style( 'dashicons' ); // Dashicons [class="dashicons dashicons-google"] 

    // Remove post comments reply
    wp_dequeue_script( 'comment-reply' );

    // Remove WordPress block library CSS
    wp_dequeue_style( 'wp-block-library-theme' );
    //wp_dequeue_style( 'wp-block-library' );
    //wp_dequeue_style( 'wc-block-style' ); // WooCommerce block
});

// Enable or disable WordPress features on initialize
add_action( 'init', function(){

    // Add Category support to pages and attachments
    register_taxonomy_for_object_type( 'category', 'page' );
    register_taxonomy_for_object_type( 'category', 'attachment' );
    
    // Add Tag support to pages and attachments
    //register_taxonomy_for_object_type( 'post_tag', 'page' );
    //register_taxonomy_for_object_type( 'post_tag', 'attachment' );
    
    // Remove WordPress generated site Favicon and app icons in favor of my own metadata
    remove_action( 'wp_head', 'wp_site_icon', 99 );

    // Remove WordPress Emojis
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    //add_filter( 'wp_resource_hints', 'disable_emojis', 10, 2 );

    // Remove RSS feed links
    remove_action( 'wp_head', 'feed_links_extra', 3 );
    remove_action( 'wp_head', 'feed_links', 2 );

    // Remove version number from the generator for security
    remove_action( 'wp_head', 'wp_generator' );

    // Enable the use of shortcodes in text widgets.
    add_filter( 'widget_text', 'do_shortcode' );

    // Add a custom post type to the editor
    register_post_type( ADDITIONAL_POST_TYPE, array(
        'labels' => array(
            'name'                   => _x( ADDITIONAL_POST_TYPE.'s', '' ),
            'singular_name'          => _x( ADDITIONAL_POST_TYPE, '' ),
            'menu_name'              => _x( ADDITIONAL_POST_TYPE.'s', '' ),
            'name_admin_bar'         => _x( ADDITIONAL_POST_TYPE, '' ),
            'add_new'                => __( 'Add New' ),
            'add_new_item'           => __( 'Add New '.ADDITIONAL_POST_TYPE ),
            'new_item'               => __( 'New '.ADDITIONAL_POST_TYPE ),
            'edit_item'              => __( 'Edit '.ADDITIONAL_POST_TYPE ),
            'view_item'              => __( 'View '.ADDITIONAL_POST_TYPE ),
            'view_items'             => __( 'View '.ADDITIONAL_POST_TYPE.'s' ),
            'all_items'              => __( 'All '.ADDITIONAL_POST_TYPE.'s' ),
            'search_items'           => __( 'Search '.ADDITIONAL_POST_TYPE ),
            'parent_item_colon'      => __( 'Parent '.ADDITIONAL_POST_TYPE.':' ),
            'not_found'              => __( 'No '.ADDITIONAL_POST_TYPE.'s found.' ),
            'not_found_in_trash'     => __( 'No '.ADDITIONAL_POST_TYPE.'s found in Trash.' ),
            'featured_image'         => _x( 'Featured Image', '' ),
            'set_featured_image'     => _x( 'Set cover image', '' ),
            'remove_featured_image'  => _x( 'Remove cover image', '' ),
            'use_featured_image'     => _x( 'Use as cover image', '' ),
            'archives'               => _x( ADDITIONAL_POST_TYPE.' archives', '' ),
            'attributes'             => _x( ADDITIONAL_POST_TYPE.' attributes', '' ),
            'insert_into_item'       => _x( 'Insert into '.ADDITIONAL_POST_TYPE,'' ),
            'uploaded_to_this_item'  => _x( 'Uploaded to this '.ADDITIONAL_POST_TYPE, '' ),
            'filter_items_list'      => _x( 'Filter '.ADDITIONAL_POST_TYPE.' list', '' ),
            'items_list_navigation'  => _x( ADDITIONAL_POST_TYPE.' list navigation', '' ),
            'items_list'             => _x( ADDITIONAL_POST_TYPE.' list', '' ),
            'item_published'         => _x( ADDITIONAL_POST_TYPE.' published', '' ),
            'item_published_privately'=>_x( ADDITIONAL_POST_TYPE.' published privately', '' ),
            'item_updated'           => _x( ADDITIONAL_POST_TYPE.' updated', '' ),
            'item_reverted_to_draft' => _x( ADDITIONAL_POST_TYPE.' reverted to draft', '' ),
            'item_scheduled'         => _x( ADDITIONAL_POST_TYPE.' scheduled', '' ),
            'item_link'              => _x( ADDITIONAL_POST_TYPE.' link', '' ),
            'item_link_description'  => _x( 'A link to a '.ADDITIONAL_POST_TYPE, '' ),
            'uri_slug'               => _x( rawurlencode(strtolower(ADDITIONAL_POST_TYPE)), '' ),
        ),
        'description'        => ADDITIONAL_POST_TYPE_SUBTITLE,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_nav_menus'  => true,
        'show_in_menu'       => true,
        'show_in_admin_bar'  => true,
        'query_var'          => true,
        'rewrite' => array( 
            'slug' => rawurlencode(strtolower(ADDITIONAL_POST_TYPE)), 
        ),
        'capability_type'    => 'page',
        'exclude_from_search'=> false,
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-portfolio', // Alteratives: https://developer.wordpress.org/resource/dashicons/
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', 'page-attributes', 'custom-fields' ),
        'taxonomies'         => array( 'category' ), // category, post_tag
        'can_export'         => true,
        'map_meta_cap'       => true,
        'show_in_rest'       => true
    ));
});

// Add custom post type to the dashboard "At a Glance" card
add_action( 'dashboard_glance_items', function(){
    $post_types = get_post_types( array( '_builtin' => false ), 'objects' );
    foreach ( $post_types as $post_type ) {
        $num_posts = wp_count_posts( $post_type->name );
        $num = number_format_i18n( $num_posts->publish );
        $text = _n( $post_type->labels->singular_name, $post_type->labels->singular_name, $num_posts->publish );
        if ( current_user_can( 'edit_posts' ) && $text == ADDITIONAL_POST_TYPE ) {
            echo '<li class="'.$post_type->capability_type.'-count-X"><a href="edit.php?post_type=' . $post_type->name . '" class="cust-post"><span class="dashicons '.$post_type->menu_icon.'" style="padding-right:5px"></span>' . $num . ' ' . $text . 's</a><style>.cust-post:before{content:" " !important}</style></li>';
        }
    }
});

// Append HTML metadata to the page head tag
add_action( 'wp_head', function(){
?>
<meta name="title" content="<?=bloginfo('name'); ?>">
<meta name="generator" content="m20T1 WordPress Theme by Ted Balmer">
<meta name="author" content="<?=get_the_author_meta('display_name', get_post_field ('post_author', get_the_ID())); ?>">
<link rel="dns-prefetch" href="<?=esc_url(preg_replace("(^https?:)", '', home_url())); ?>">
<link rel="pingback" href="<?=bloginfo('pingback_url'); ?>">
<link rel="Siteuri" href="<?=home_url(); ?>/" id="SiteURI">
<meta name="application-name" content="<?=bloginfo('name'); SEO_CharSwap(wp_title('|', true, 'left')); ?>">
<meta name="apple-mobile-web-app-title" content="<?=bloginfo('name'); SEO_CharSwap(wp_title('|', true, 'left')); ?>">
<meta name="description" content="<?=SEO_Excerpt(get_the_id()); ?>">
<meta name="format-detection" content="telephone=no">
<link rel="icon" href="<?=esc_url(home_url() . "/favicon.ico"); ?>" sizes="any">
<link rel="icon" href="<?=esc_url(home_url() . "/favicon.svg"); ?>" type="image/svg+xml">
<link rel="apple-touch-icon" href="<?=esc_url(home_url() . "/apple-touch-icon.png"); ?>">
<link rel="manifest" href="<?=esc_url(home_url() . "/site.webmanifest"); ?>">
<meta property="og:locale" content="<?=get_bloginfo('language'); ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?=bloginfo('name'); ?>">
<meta property="og:url" content="<?=the_permalink(); ?>">
<meta property="og:title" content="<?=SEO_CharSwap(wp_title('|', true, 'right')); bloginfo('name'); ?>">
<meta property="og:description" content="<?=SEO_Excerpt(get_the_id()); ?>">
<meta property="og:image" content="<?=SEO_Image(get_the_id()); ?>">
<meta property="og:image:type" content="image/<?=get_file_extension(SEO_Image(get_the_id())); ?>">
<meta property="article:publisher" content="<?=get_the_author_meta('facebook', get_post_field ('post_author', get_the_ID())); ?>">
<meta property="article:published_time" content="<?=get_the_date('c'); ?>">
<meta property="article:modified_time" content="<?=get_the_modified_date('c'); ?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@<?=trim(parse_url(get_the_author_meta('twitter', get_post_field ('post_author', get_the_ID())), PHP_URL_PATH), '/'); ?>">
<meta name="twitter:url" content="<?=the_permalink(); ?>">
<meta name="twitter:title" content="<?=SEO_CharSwap(wp_title('|', true, 'right')); bloginfo('name'); ?>">
<meta name="twitter:description" content="<?=SEO_Excerpt(get_the_id()); ?>">
<meta name="twitter:image" content="<?=SEO_Image(get_the_id()); ?>">
<meta name="twitter:label1" content="Written by">
<meta name="twitter:data1" content="<?=get_the_author_meta('display_name', get_post_field ('post_author', get_the_ID())); ?>">
<meta name="twitter:label2" content="Est. reading time">
<meta name="twitter:data2" content="<?=reading_time(); ?>">
<?=allow_html_metadata(get_option('head_metadata')); // Post user metadata ?>
<?php schemaJSONData(); // Post Schema JSON ?>
<?php
});

// Settings for the Admin floating toolbar and editor
add_action( 'admin_head', function(){
?>
<style type="text/css">
.wp-admin .column-post_views {width:3em}
.wp-admin .column-thumbnail {width:7em}
.wp-admin .media-icon .attachment-60x60 {min-width:60px}
.wp-admin .thumbnail .details-image:is([src$='.svg'],[src$='.svgz']) {min-width:95%}
</style>
<?php
});

// Add a panel to the dashboard with theme info
add_action('wp_dashboard_setup', function(){
    wp_add_dashboard_widget('custom_dashboard_text', 'm20T1 Theme Guide', 'custom_dashboard_text');
    function custom_dashboard_text() {
    ?>
    <p>List of built-in CSS classes to use in the editor:</p>
    <ul>
        <li><code>.page-subtitle / .subtitle</code> - Defines subtitle</li>
        <li><code>.alignjustify</code> - Justifies text</li>
        <li><code>.has-alpha</code> - Removes borders and background</li>
        <li><code>.fancy-border</code> - Adds fancy border</li>
        <li><code>.add-drop-shadow</code> - Adds drop shadow</li>
    </ul>
    <?php
    }
});

// Append to the top of the page body tag
add_action( 'wp_body_open', function(){
    echo allow_html_metadata(get_option('body_top_html')); // Post user metadata
    set_page_views(); // Page view counter
});

// Append to the bottom of the page body tag
add_action( 'wp_footer', function(){
?>
<template id="Search-Modal">
    <h3 class="search-title" itemprop="name">Search <?=bloginfo('name'); ?></h3>
    <?=get_search_form('search-modal'); // Load searchform.php ?>
</template>

<template id="Contact-Modal">
    <?=get_template_part('contactform'); // Load contactform.php ?>
</template>

<script>document.getElementById('PageLoadTime').textContent=<?=round(((microtime(TRUE) - PAGE_LOAD_START) * 10), 3); // Generate the page load time ?>;</script>
<?php
echo allow_html_metadata(get_option('body_bottom_html')); // Post user metadata
});

// Set the excerpt length
add_filter( 'excerpt_length', function(){
    return get_option('excerpt_length') ? get_option('excerpt_length') : EXCERPT_LENGTH; // Number of Words
});

// Add a 'Continue Reading' link to excerpts
add_filter( 'excerpt_more', function(){
    return '<span class="entry-read-more" aria-label="Read more">'.MORE_TEXT.'</span>';
});

// Add custom message to login screen
add_filter( 'login_message', function(){
?>
<div style="text-align:center"><?=wp_get_attachment_image(get_theme_mod('custom_logo'), 'full', false, array('srcset' => '', 'style' => 'width:80%')); ?></div>
<?php
});

// Change the WordPress editor's footer text
add_filter( 'admin_footer_text', function(){
?>
<i><a href="https://www.wordpress.org/" target="_blank">WordPress</a> theme brought to you with 💙 by <a href="https://github.com/midkiffaries/m20T1" target="_blank">m20T1 <?=THEME_VERSION; ?></a>.</i>
<?php
});

// Add addition file types uploadable to the media library
add_filter( 'upload_mimes', function($mimes){
    $mimes['svg']   = 'image/svg+xml'; // SVG image
    $mimes['svgz']  = 'image/svg+xml'; // SVG image
    $mimes['html']  = 'text/html'; // HTML document
    $mimes['txt']   = 'text/plain'; // TXT document
    $mimes['vcard'] = 'text/vcard'; // vCard data
    $mimes['vcf']   = 'text/vcard'; // vCard data
    $mimes['ical']  = 'text/calendar'; // iCalendar data
    $mimes['ics']   = 'text/calendar'; // iCalendar data
    $mimes['webp']  = 'image/webp'; // WebP image
    $mimes['heic']  = 'image/heic'; // HEIC/HEIF image
    return $mimes;
});

// Set a text fallback to the custom image logo hook
add_filter( 'get_custom_logo', function(){
    if (has_custom_logo()) { // Use image logo
        return wp_get_attachment_image( get_theme_mod('custom_logo'), 'full', false, array('class' => 'custom-logo', 'srcset' => '', 'itemprop' => 'image', 'fetchpriority' => 'high') ) . '<span class="visual-hidden" itemprop="name headline">' . get_bloginfo('name') . '</span>';
    } else { // No logo, use site title
        return '<span itemprop="name headline">' . get_bloginfo('name') . '</span>';
    }
});

// Remove srcset from SVG images so SVG files in img tags will display correctly
function remove_svg_srcset( string $sizes, array $size, $image_src = null ) {
	$image_type = end(explode('.', $image_src));
	if ( $image_type === 'svg' || $image_type === 'svgz' ) {
		return null;
	} else {
        return $sizes;
    }
}
add_filter( 'wp_calculate_image_sizes', 'remove_svg_srcset', 10, 3 );


//////////////////////////////////////
// Additional columns for the editor
//////////////////////////////////////

// Add Featured Image column
function AddImageColumn( $columns ) {
    $columns['thumbnail'] = __('Image');
    return $columns;
}

// Add Featured Image column values
function AddImageValue( $column_name, $post_id ) {
	if ( $column_name == 'thumbnail' ) {
		$post_thumbnail_id = get_post_thumbnail_id( $post_id );
		if ( $post_thumbnail_id ) {
			$post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail' );
            echo '<img src="' . $post_thumbnail_img[0] . '" width="90" height="90" loading="lazy" decoding="async" itemprop="image" alt="" fetchpriority="low">';
		} else {
            echo __('—');
        }
	}
}

// Add Image Column to Posts
add_filter( 'manage_posts_columns', 'AddImageColumn' );
add_action( 'manage_posts_custom_column', 'AddImageValue', 10, 2 );

// Add Image Column to Pages
add_filter( 'manage_pages_columns', 'AddImageColumn' );
add_action( 'manage_pages_custom_column', 'AddImageValue', 10, 2 );

// Add SEO Excerpt column
function AddExcerptColumn( $columns ) {
    $columns['seo_excerpt'] = __('SEO Excerpt');
    return $columns;
}

// Add SEO Excerpt column values
function AddExcerptValue( $column_name, $post_id ) {
    if ( $column_name == 'seo_excerpt') {
        if ( $post_id ) {
            echo SEO_Excerpt($post_id);
        } else {
            echo __('—');
        }
    }
}

// Add SEO Excerpt Column to Posts
add_filter( 'manage_posts_columns', 'AddExcerptColumn' );
add_action( 'manage_posts_custom_column', 'AddExcerptValue', 10, 2 );

// Add SEO Excerpt Column to Pages
add_filter( 'manage_pages_columns', 'AddExcerptColumn' );
add_action( 'manage_pages_custom_column', 'AddExcerptValue', 10, 2 );

// Add a page view count column to the posts and pages sections
// Get the number of page views
function get_page_views() {
    $count = get_post_meta( get_the_ID(), 'post_views_count', true );
    if ($count < 1) {
        return 0;
    } else {
        return $count;
    }
}

// Set the page view counter
function set_page_views() {
    $key = 'post_views_count';
    $post_id = get_the_ID();
    $count = (int) get_post_meta( $post_id, $key, true );
    $count++;
    update_post_meta( $post_id, $key, $count );
}

// Add the page views column header
function add_column_header_views( $column ) {
    $column['post_views'] = 'Views';
    return $column;
}

// Add the page views column content
function add_column_views( $column ) {
    if ( $column === 'post_views') {
        echo get_page_views();
    }
}

// Add Views Column to Posts
add_filter( 'manage_posts_columns', 'add_column_header_views' );
add_action( 'manage_posts_custom_column', 'add_column_views' );

// Add Views Column to Pages
add_filter( 'manage_pages_columns', 'add_column_header_views' );
add_action( 'manage_pages_custom_column', 'add_column_views' );


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
    // Quaternary Sidebar - right side of the content
    register_sidebar(array(
        'id'            => 'quaternary',
        'name'          => __( 'Quaternary Sidebar Widgets', 'm20T1' ),
        'description'   => __( 'Portfolio page sidebar.' ),
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
    // Portfolio Page Widgets - bottom of the content
    register_sidebar(array(
        'id'            => 'portfoliopage',
        'name'          => __( 'Portfolio Page Widgets', 'm20T1' ),
        'description'   => __( 'Widgets below the contents on a portfolio page.' ),
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

// Get 'Widgets_Slug' Custom Field which changes the sidebar selection
// SLUGS: primary, secondary, tertiary, quaternary, singlepost, frontpage, singlepage, singlepagesidebar, portfoliopage, header, footer
function selectSidebarCustomField( $id, $default ) {
    $key = get_post_meta( $id, 'Widgets_Slug', true );
    if (empty($key)) {
        return $default; // Default widgets
    } else {
        return wp_strip_all_tags($key);
    }
}


/////////////////////////////
// Navigation
/////////////////////////////

// Display the menu/navigation links as a <ul> list
function menu_nav_list( $menu, $id ) {
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
function get_child_pages( $id, $thumbnail ) {
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
    <?php endif; ?>

    <div class="child-block">
        <?php // Loop to create each card
        foreach ($page_children as $child) { // Display all the child pages ?>
            <div class="child-card" id="child-card-<?=$child->ID; ?>">
                <a class="child-card__link" href="<?=esc_url(get_permalink($child->ID)); ?>" rel="nofollow">
                    <div class="child-card__image"><img src="<?=esc_url(get_the_post_thumbnail_url($child->ID, 'medium')); ?>" loading="lazy" decoding="async" alt="" fetchpriority="low"></div>
                    <div class="child-card__title"><?=$child->post_title; ?></div>
                    <div class="child-card__text"><?=$child->post_excerpt; ?></div>
                </a>
            </div>
        <?php } ?>
    </div><?php
}


/////////////////////////////
// Specialized Functions
/////////////////////////////

// Get 'Page_CSS' Custom Field which adds custom page styling
function custom_page_css( $id ) {
    $css = get_post_meta( $id, 'Page_CSS', true );
    $css = str_replace(array('<','>'), array('%3C','%3E'), $css); // make HTML safe
    $css = preg_replace('/\s*([:;{}])\s*/', '$1', $css); // Remove Spaces
    $css = preg_replace('/;}/', '}', $css); // Remove new lines

    if (empty($css)) {
        return NULL;
    } else {
        return '<style type="text/css" id="Page-CSS" hidden>'.wp_strip_all_tags($css).'</style>';
    }
}

// Get the number of times this keyword comes up in search queries
function SearchCount( $query ) {
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

// Get WordPress page title and content for the blog list page (index.php)
function GetPageTitle( $id ) {
    $page_for_posts_obj = get_post( $id );
    return apply_filters( 'the_content', $page_for_posts_obj->post_content );
}

// Shorten the_content in place of using the_excerpt for more control
function shorten_the_content( $post ) {
    $regex_figure = "/<figure[^>]*>([\s\S]*?)<\/figure[^>]*>/"; // Remove figure/figcaption
    $regex_url = "@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?).*$)@"; // Remove URLs
    $excerpt = preg_replace($regex_figure, ' ', html_entity_decode($post));
    $excerpt = preg_replace($regex_url, ' ', html_entity_decode(wp_strip_all_tags($excerpt, true)));
    return wp_trim_words($excerpt, get_option('alt_excerpt_length') ? intval(get_option('alt_excerpt_length')) : SHORT_TEXT_LENGTH, ' <span class="entry-read-more">' . MORE_TEXT . '</span>');
}

// Separator that breaks up a post's metadata
function post_separator() {
    return '<span class="entry-separator">' . POST_SEPARATOR . '</span>';
}

// Append the proper size units to a numerical file size 
function file_units( $filesize ) {
    $filesizeunits = array(' Bytes', ' KB', ' MB', ' GB', ' TB');
	if ($filesize) {
        return round($filesize/pow(1024, ($i = floor(log($filesize, 1024)))), 1) . $filesizeunits[$i];
    } else {
        return 'N/A';
    }
}

// Get the the image information and file size
function image_metadata( $filename ) {
    $filesize = file_units(wp_filesize(get_filepath($filename)));
    if (@is_array(getimagesize($filename))) {
        list($width, $height, $type, $attr) = getimagesize($filename);
        return "File: " . image_type_to_mime_type($type) . " – Dimensions: " . $width . "x" . $height . "px – Size: " . $filesize;
    } else {
        return "File: document – Size: " . $filesize;
    }
}

// Get the full file path on the server from the file's URI
function get_filepath( $fileurl ) {
    return realpath($_SERVER['DOCUMENT_ROOT'] . parse_url($fileurl, PHP_URL_PATH));
}

// Allow only certain HTML tags in the metadata for user generated input
function allow_html_metadata($html) {
    return strip_tags($html, '<meta><script><link><style><noscript><iframe>');
}

// Allow only certain HTML tags for user generated input
function clean_html($html) {
    return strip_tags($html, '<b><strong><i><em><a><span><abbr>');
}


/////////////////////////////
// SEO and Header Functions
/////////////////////////////

// Swaps certain special characters with words for SEO purposes
function SEO_CharSwap( $string ) {
    $string = preg_replace('/\%/', 'percent', $string); 
    $string = preg_replace('/\&/', 'and', $string); 
    return trim($string);
}

// Get the excerpt from either the content or the user defined excerpt  
function SEO_Excerpt( $id ) {
    // Set the total character length
    $length = SEO_TEXT_LENGTH;
    // Check if post has a user defined excerpt
    if (has_excerpt($id) && !is_attachment()) {
        $description = trim(substr(get_the_excerpt($id), 0, $length));
    } else {
        // Get page description from the content
        if (is_single() || is_page() || is_admin()) { // If single blog post
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
function SEO_Image( $id ) {
    // Get page featured image
    if (is_attachment()) { // If attachment page, use attachment image
        $featuredImage = wp_get_attachment_url(get_the_ID());
    } else if (has_post_thumbnail($id)) { // Use page's featured image
        $featuredImage = get_the_post_thumbnail_url($id, 'large');
    } else { // Use default image
        $featuredImage = get_option('social_image') ? esc_url(get_option('social_image')) : get_template_directory_uri() . '/assets/images/social-share.jpg';
    }
    return esc_url($featuredImage);
}


/////////////////////////////
// Featured Image Fallbacks
/////////////////////////////

// Get the post/page featured image url or use fallback if none available ($size = thumbnail, medium, medium_large, large, full)
function FeaturedImageURL( $id, $size, $isBackground ) {

    if (has_post_thumbnail($id)) { // Use featured image url
        $image = get_the_post_thumbnail_url($id, $size);
    } else {
        if (GetFirstImage() && $size != 'full') { // Get first image in post
            $image = esc_url(GetFirstImage());
        } else {
            $image = false;
        }
    }

    // Check if background is being placed in a style attrib or in an image tag and return
    if ($isBackground && $image) {
        return "background-image:url({$image})";
    } else {
        if ($image) {
            return $image;
        } 
        if (!$isBackground) {
            return get_option('blank_image') ? esc_url(get_option('blank_image')) : get_template_directory_uri() . '/assets/images/featured-blank.svg';
        }
    }
}

// Get the first image seen on a post or page
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

// Display the header/hero image from the featured image
function Header_Hero( $id ) {
    // Type of page
    if ( is_front_page() ) { // Front-page header (No header image)
        $className = "homepage";
        $hasFeaturedImage = false;
    } elseif ( is_attachment() || is_404() ) { // Attachment and 404 page headers (No header image)
        $className = "noimage";
        $hasFeaturedImage = false;
    } elseif ( is_page() ) { // Single Page header (Use featured image)
        $className = "single-page";
        $hasFeaturedImage = true;
    } elseif ( is_single() ) { // Single blog post or portfolio item (Use featured image)
        $className = "single-post";
        $hasFeaturedImage = true;
    } else { // Blog Page, portfolio page, search page and archives header (No header image)
        $className = "noimage";
        $hasFeaturedImage = false;
    }

    // Get the featured image and image caption if exists or fallback to blank image
    if ($hasFeaturedImage) {
        $featuredImage = FeaturedImageURL($id, 'full', 1);
        $attachmentTitle = '<a href="'. home_url() . '/?p='.get_post_thumbnail_id($id).'" itemprop="url">' . wp_get_attachment_caption(get_post_thumbnail_id($id)) . '</a>';
    } else {
        $attachmentTitle = '';
    }

    // Header Hero HTML
    ?>
        <div class="header-hero-image header-<?=$className; ?>" style="<?=$featuredImage; ?>" role="img" aria-labelledby="header-hero-caption">
            <div class="header-hero-gradient"></div>
            <div class="header-hero-overlay"></div>
            <div class="header-hero-caption" id="header-hero-caption"><?=$attachmentTitle; ?></div>
        </div>
    <?php
}


//////////////////////////////////
// WordPress Blog Post Functions
//////////////////////////////////

// Display the date of the last entry update
function display_last_updated() {
    ?><p><?php 
    if (get_the_modified_date('Y-m-d') > get_the_date('Y-m-d')) {
        printf( __( 'Updated: <time itemprop="dateModified">%s</time>', 'textdomain' ), get_the_modified_date() ); 
    }
    ?></p><?php
}

// Get a blog post's reading time
function reading_time() {
    $wordcount = str_word_count(wp_strip_all_tags(get_the_content()));
    $time = ceil($wordcount / 200);
    return "{$time} min read";
}

// Get the file extension from a path
function get_file_extension( $path ) {
    $extension = wp_check_filetype($path);
    return $extension['ext'];
}

// Get proper attachment image or use a document placeholder
function attachment_page_image( $id ) {
    $image_ext = array('jpg', 'jpeg', 'png', 'gif', 'webp', 'heic', 'ico');
    $video_ext = array('mp3', 'ogg', 'mp4', 'm4v', 'mov', 'wmv', 'avi', 'webm', 'mpg', 'ogv', '3gp', '3g2');
    
    $fileExt = get_file_extension(wp_get_attachment_url($id));

    // Check if attachment matches the extension images array
    foreach ($image_ext as $ext) {
        if (strpos($fileExt, $ext) !== FALSE) {
            return wp_get_attachment_image($id, 'large', 0, array('loading' => '', 'itemprop' => 'image', 'fetchpriority' => 'high')); // Return attachment
        }
    }

    // Check if attachment matches the extension video array
    foreach ($video_ext as $ext) {
        if (strpos($fileExt, $ext) !== FALSE) {
            return '<svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" role="img"><path d="m192 192 160 112-160 112V192z" fill="red"/><path d="M458.9 114.5c-11.1-15.1-26.6-32.8-43.6-49.8S380.6 32.2 365.5 21C339.7 2.1 327.2 0 320 0H72C50 0 32 18 32 40v432c0 22 18 40 40 40h368c22 0 40-18 40-40V160c0-7.2-2.2-19.7-21.1-45.5zm-66.2-27.2A436.4 436.4 0 0 1 429 128h-77V51a436 436 0 0 1 40.7 36.3zM448 472c0 4.3-3.7 8-8 8H72c-4.3 0-8-3.7-8-8V40c0-4.3 3.7-8 8-8h248v112a16 16 0 0 0 16 16h112v312z" fill="darkred"/></svg>'; // Return attachment
        }
    }

    // Check if attachment is SVG file or other document
    if ($fileExt == 'svg' || $fileExt == 'svgz') { // SVG Images
        return '<img src="' . wp_get_attachment_url($id) . '" alt="' . wp_get_attachment_caption($id) . '" loading="lazy" decoding="async" class="attachment-svg" itemprop="image" fetchpriority="high">';
    } else { // All other documents types
        return '<svg id="GenericDoc" xmlns="http://www.w3.org/2000/svg" width="512" height="512" role="img"><path d="M458.9 114.5c-11.1-15.1-26.6-32.8-43.6-49.8S380.6 32.2 365.5 21C339.7 2.1 327.2 0 320 0H72C50 0 32 18 32 40v432c0 22 18 40 40 40h368c22 0 40-18 40-40V160c0-7.2-2.2-19.7-21.1-45.5zm-66.2-27.2A436.4 436.4 0 0 1 429 128h-77V51a436 436 0 0 1 40.7 36.3zM448 472c0 4.3-3.7 8-8 8H72c-4.3 0-8-3.7-8-8V40c0-4.3 3.7-8 8-8h248v112a16 16 0 0 0 16 16h112v312z" fill="dodgerblue"/><path d="M368 416H144a16 16 0 0 1 0-32h224a16 16 0 1 1 0 32zm0-64H144a16 16 0 0 1 0-32h224a16 16 0 1 1 0 32zm0-64H144a16 16 0 0 1 0-32h224a16 16 0 1 1 0 32z" fill="lightblue"/></svg>';
    }
}

// Blog post user comment HTML and formatting for each comment
function custom_comment_style( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

    // Visitor comment HTML
    ?>
	<li <?=comment_class(); ?> id="comment-<?=comment_ID() ?>" itemprop="comment" role="comment">
        <div class="comment-content">
			<header class="comment-header">
                <span class="comment-avatar hidden">
                    <figure class="alignleft" aria-label="Authors Avatar" itemprop="image">
                        <?=get_avatar( get_the_author_meta( 'ID' ), 48 ); ?>
                    </figure>
                </span>
                <span class="comment-author" rel="author" itemprop="author"><?php printf(__('%s'), get_comment_author()); ?></span>
                <span class="comment-metadata">
                    <a href="<?=esc_url(get_comment_link($comment->comment_ID)) ?>" rel="bookmark" itemprop="url" aria-label="Get the link to this comment">#</a> 
                    <time class="comment-date" itemprop="datePublished"><?php printf(__('%1$s'), get_comment_date('F j, Y ~ h:ma')); ?></time>
                </span>
                <span class="comment-reply"><?=get_comment_reply_link( __( 'Reply', 'textdomain' ), '', '' ); ?></span> 
			</header>
            <?php if ($comment->comment_approved == '0') : ?>
                <div class="comment-moderation"><?php _e('⚠️ Your comment is awaiting moderation.'); ?></div>
            <?php endif; ?>
            <div class="comment-text" itemprop="text"><?=comment_text(); ?></div>
            <div class="comment-edit"><?=edit_comment_link( __( 'Edit Comment', 'textdomain' ), '', '' ); ?></div>
        </div>
    </li>
    <?php
}

// Pagination on the index/archive/search pages
function blog_post_pagination( $type ) {
    previous_posts_link("&#x276E; Previous " . get_option('posts_per_page') . " {$type}", 0); // << Left Side
    next_posts_link("Next " . get_option('posts_per_page') . " {$type} &#x276F;", 0); // Right Side >>
}

// Show the blog post tags as a list
function blog_post_tags() {
    return the_tags('<ul role="list"><li rel="tag" itemprop="keywords">', '</li><li itemprop="keywords">', '</li></ul>');
}

// Create a unique body main page class for all pages "page-{slug}"
function get_page_class() {
    return 'page-' . preg_replace('/\s+/', '-', get_post_field( 'post_name', get_post() ));
}

// List social sharing links on each blog post
function blog_post_share() {
    $social_links = array( // Social media links
        'facebook'  => "https://www.facebook.com/sharer/sharer.php?u=" . esc_url(get_the_permalink()),
        'twitter'   => "https://twitter.com/intent/tweet?text=" . esc_url(get_the_permalink()),
        'linkedin'  => "https://www.linkedin.com/shareArticle?mini=true&url=" . esc_url(get_the_permalink()) . "&title=" . rawurlencode(get_the_title()) . "&summary=" . rawurlencode(get_the_excerpt()) . "&source=" . urlencode(get_bloginfo('name')),
        'pinterest' => "https://pinterest.com/pin/create/button/?url=" . esc_url(get_the_permalink()) . "&media=" . urlencode(SEO_Image(get_the_id())) . "&description=" . rawurlencode(get_the_excerpt()),
        'reddit'    => "https://www.reddit.com/submit?url=" . esc_url(get_the_permalink()),
        'email'     => "mailto:?subject=" . rawurlencode(get_the_title()) . "&body=" . rawurlencode(get_the_title()) . " | " . esc_url(get_the_permalink()),
    );

    // Social sharing buttons HTML
    ?>
    <ul role="list" class="post-social-share" aria-label="Share on social media">
        <li><a href="<?=$social_links['twitter']; ?>" class="twitter-share" aria-label="Share on Twitter" rel="noopener noreferrer" target="_blank">Tweet</a></li>
        <li><a href="<?=$social_links['facebook']; ?>" class="facebook-share" aria-label="Share on Facebook" rel="noopener noreferrer" target="_blank">Share</a></li>
        <li><a href="<?=$social_links['linkedin']; ?>" class="linkedin-share" aria-label="Share on LinkedIn" rel="noopener noreferrer" target="_blank">Share</a></li>
        <li><a href="<?=$social_links['pinterest']; ?>" class="pinterest-share" aria-label="Share on Pinterest" rel="noopener noreferrer" target="_blank">Pin It</a></li>
        <li><a href="<?=$social_links['reddit']; ?>" class="reddit-share" aria-label="Share on Reddit" rel="noopener noreferrer" target="_blank">Share</a></li>
        <li><a href="<?=$social_links['email']; ?>" class="email-share" aria-label="Email this post" rel="noopener noreferrer" target="_blank">Email</a></li>
    </ul>
    <?php
}


//////////////////////////////
// Schema.org Structured Data
//////////////////////////////

// Schema.org JSON structured microdata script for the navigation and WebSite data
function schemaJSONData() {
?>
<script type="application/ld+json">
[{"@context":"https://schema.org/","@type":"WebSite","@id":"<?=home_url(); ?>#website","headline":"<?=bloginfo('name'); ?>","name":"<?=bloginfo('name'); ?>","alternateName":"<?=addslashes(get_option('short_title')); ?>","description":"<?=addslashes(get_bloginfo('description')); ?>","url":"<?=home_url(); ?>"},
{"@context": "https://schema.org/","@graph": [<?php schemaNavigation('primary'); ?>
<?php schemaNavigation('secondary'); ?>
<?php schemaNavigation('tertiary'); ?>
{}]}];
</script>
<?php
}

// Schema.org JSON site navigation elements loop
function schemaNavigation( $menu_name ) {
	if (($menu_name) && ($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
		$menu = get_term($locations[$menu_name], 'nav_menu');
		$menuItems = wp_get_nav_menu_items($menu->term_id);
		
		foreach ($menuItems as $MenuItem) { // Get each item in the menu
            ?>{"@context": "https://schema.org/","@type": "SiteNavigationElement","@id": "<?=esc_url(home_url()); ?>#Main Navigation","name": "<?=$MenuItem->title; ?>","url": "<?=$MenuItem->url; ?>"}, <?php
		}
	} 
}


/////////////////////////////////////////////////
// Admin: Add Additional values to user profiles
/////////////////////////////////////////////////

// Display the author's user level/role
function user_level( $level ) {
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

// Add additional contact methods and information to user profiles
add_filter( 'user_contactmethods', function(){
    return array(
        'jobtitle' => 'Job Title',
        'linkedin' => 'LinkedIn URL',
        'facebook' => 'Facebook URL',
        'twitter'  => 'Twitter/X URL',
        'pinterest'=> 'Pinterest URL',
        'city'     => 'City/State/Co',
    );
});

// Add additional section to the user profiles
add_action( 'show_user_profile', 'show_extra_profile_fields' );
add_action( 'edit_user_profile', 'show_extra_profile_fields' );
function show_extra_profile_fields( $user ) { ?>
    <h3>Additional Information</h3>
    <p>Let the world know how you're feeling today.</p>
    <table class="form-table">
        <tr>
            <th><label for="mental">My Mental State</label></th>
            <td>
                <select name="mental" id="mental">
                    <option value="happy" <?php selected( 'happy', get_the_author_meta( 'mental', $user->ID ) ); ?>>Happy 😄</option>
                    <option value="okay" <?php selected( 'okay', get_the_author_meta( 'mental', $user->ID ) ); ?>>Okay 🫤</option>
                    <option value="sad" <?php selected( 'sad', get_the_author_meta( 'mental', $user->ID ) ); ?>>Sad 🙁</option>
                    <option value="pizza" <?php selected( 'pizza', get_the_author_meta( 'mental', $user->ID ) ); ?>>Pizza 🍕</option>
                </select>
            </td>
        </tr>
    </table>
<?php };

// Save additional information for users
add_action( 'personal_options_update', 'save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_profile_fields' );
function save_extra_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) return false;
    update_user_meta( $user_id, 'mental', $_POST['mental'] );
}

// Add a column for User's Last Login time
add_filter( 'manage_users_columns', function($columns){
	$columns['last_login'] = 'Last Login';
	return $columns;
});

// Record User's last login to custom metadata
add_action( 'wp_login', 'smartwp_capture_login_time', 10, 2 );
function smartwp_capture_login_time( $user_login, $user ) {
    update_user_meta( $user->ID, 'last_login', time() );
}

// Populate the Last Login column
add_filter( 'manage_users_custom_column', 'last_login_column', 10, 3 );
function last_login_column( $output, $column_id, $user_id ){
	if ( $column_id == 'last_login' ) {
        $last_login = get_user_meta( $user_id, 'last_login', true );
		$output = $last_login ? '<time datetime="' . date('c', $last_login) . '" title="Last login ' . date('F j, Y, g:i a', $last_login) . '">' . human_time_diff($last_login) . '</time>' : 'No record';
	}
	return $output;
}

// Allow the Last Login columns to be sortable
add_filter( 'manage_users_sortable_columns', function($columns){
	return wp_parse_args( array('last_login' => 'last_login'), $columns );
});

add_action( 'pre_get_users', function($query){
	if ( !is_admin() ) return $query;
	$screen = get_current_screen();
	if ( isset( $screen->base ) && $screen->base !== 'users' ) return $query;
	if ( isset( $_GET[ 'orderby' ] ) && $_GET[ 'orderby' ] == 'last_login' ) {
		$query->query_vars['meta_key'] = 'last_login';
		$query->query_vars['orderby'] = 'meta_value';
	}
    return $query;
});

// Display the User's last login time relative to the current time
function users_last_login() {
    $last_login = get_the_author_meta('last_login');
    if ( empty($last_login) ) {
        return false;
    } else {
        return human_time_diff($last_login);
    }
}


/////////////////////////////////////////////////
// Admin: Additional Setting Page
/////////////////////////////////////////////////

// Create new menu under the Appearance section
add_action('admin_menu', function(){
	add_submenu_page('options-general.php', 'm20T1 Additional Settings', 'm20T1 Settings', 'administrator', __FILE__, 'm20T1_settings_page' , 'dashicons-admin-generic', null );

    // Register settings
	add_action( 'admin_init', function(){
        register_setting( 'm20t1-settings-group', '404_image' );
        register_setting( 'm20t1-settings-group', '404_text' );
        register_setting( 'm20t1-settings-group', 'search_image' );
        register_setting( 'm20t1-settings-group', 'social_image' );
        register_setting( 'm20t1-settings-group', 'blank_image' );
        register_setting( 'm20t1-settings-group', 'head_metadata' );
        register_setting( 'm20t1-settings-group', 'body_top_html' );
        register_setting( 'm20t1-settings-group', 'body_bottom_html' );
        register_setting( 'm20t1-settings-group', 'alt_excerpt_length' );
        register_setting( 'm20t1-settings-group', 'excerpt_length' );
        register_setting( 'm20t1-settings-group', 'site_representation' );
        register_setting( 'm20t1-settings-group', 'short_title' );
    });
});

// Additional settings page layout
function m20T1_settings_page() {
?>
<div class="wrap">
    <h1>m20T1 Additional Theme Options</h1>
    <p>Additional settings for this theme.
    <form method="post" action="options.php" novalidate="novalidate">
        <?php settings_fields( 'm20t1-settings-group' ); ?>
        <?php do_settings_sections( 'm20t1-settings-group' ); ?>
        <h2>Customize the 404 Error Page</h2>
        <p>Allowed HTML tags: &lt;b&gt; &lt;strong&gt; &lt;i&gt; &lt;em&gt; &lt;a&gt; &lt;span&gt; &lt;abbr&gt;
        <table class="form-table" role="presentation">
            <tr valign="top">
                <th scope="row"><label for="404_text">404 Error Page HTML</label></th>
                <td><textarea name="404_text" id="404_text" class="code" placeholder="That page must have been deleted or is otherwise inaccessable." rows="3" spellcheck="false" autocapitalize="none" autocorrect="off"><?=esc_attr(clean_html(get_option('404_text'))); ?></textarea></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="404_image">404 Error Page Image (URL)</label></th>
                <td><input type="url" name="404_image" id="404_image" placeholder="<?=esc_url(home_url() . "/wp-content/uploads/FILENAME"); ?>" spellcheck="false" autocapitalize="none" autocorrect="off" inputmode="url" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?=esc_attr(get_option('404_image')); ?>"></td>
            </tr>
        </table>
        <h2>Set the Default & Fallback Images</h2>
        <table class="form-table" role="presentation">
            <tr valign="top">
                <th scope="row"><label for="search_image">Search Page Image (URL)</label></th>
                <td><input type="url" name="search_image" id="search_image" placeholder="<?=esc_url(home_url() . "/wp-content/uploads/FILENAME"); ?>" spellcheck="false" autocapitalize="none" autocorrect="off" inputmode="url" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?=esc_attr(get_option('search_image')); ?>"></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="social_image">Fallback Site Image (URL)</label></th>
                <td><input type="url" name="social_image" id="social_image" placeholder="<?=esc_url(home_url() . "/wp-content/uploads/FILENAME"); ?>" spellcheck="false" autocapitalize="none" autocorrect="off" inputmode="url" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?=esc_attr(get_option('social_image')); ?>"></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="blank_image">Fallback Featured Image (URL)</label></th>
                <td><input type="url" name="blank_image" id="blank_image" placeholder="<?=esc_url(home_url() . "/wp-content/uploads/FILENAME"); ?>" spellcheck="false" autocapitalize="none" autocorrect="off" inputmode="url" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?=esc_attr(get_option('blank_image')); ?>"></td>
            </tr>
        </table>
        <h2>Other Site Settings</h2>
        <p>Adjust the site representation, an abbreviated site title and the length of the excerpt text seen on the blog post list.</p>
        <table class="form-table" role="presentation">
            <tr valign="top">
                <th scope="row"><label for="short_title">Short Site Title</label></th>
                <td><input type="text" name="short_title" id="short_title" placeholder="<?=bloginfo('name'); ?>" maxlength="18" value="<?=get_option('short_title'); ?>"> (max 18 characters)</td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="site_representation">Site Representation</label></th>
                <td><select id="site_representation" name="site_representation" value="<?=get_option('site_representation'); ?>">
                    <option value="Person">Person</option>
                    <option value="Organization">Organization</option>
                </select></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="alt_excerpt_length">Blog Posts Excerpt Length</label></th>
                <td><input type="number" name="alt_excerpt_length" id="alt_excerpt_length" placeholder="<?=SHORT_TEXT_LENGTH; ?>" min="0" max="300" step="1" maxlength="3" inputmode="decimal" value="<?=get_option('alt_excerpt_length'); ?>"> words</td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="excerpt_length">Default Excerpt Length</label></th>
                <td><input type="number" name="excerpt_length" id="excerpt_length" placeholder="<?=EXCERPT_LENGTH; ?>" min="0" max="300" step="1" maxlength="3" inputmode="decimal" value="<?=get_option('excerpt_length'); ?>"> words</td>
            </tr>
        </table>
        <h2>Additional Metadata and <abbr>HTML</abbr> Code</h2>
        <p>For inserting Google Analytics, fonts, scripts and other metadata.</p>
        <p>Allowed HTML tags: &lt;meta&gt; &lt;script&gt; &lt;link&gt; &lt;style&gt; &lt;noscript&gt; &lt;iframe&gt;
        <table class="form-table" role="presentation">
            <tr valign="top">
                <th scope="row"><label for="head_metadata">Header <abbr>HTML</abbr></label></th>
                <td><textarea name="head_metadata" id="head_metadata" class="code" placeholder="Enter HTML code..." rows="10" wrap="soft" spellcheck="false" autocapitalize="none" autocorrect="off"><?=esc_attr(allow_html_metadata(get_option('head_metadata'))); ?></textarea> <small>These scripts will be placed inside the &lt;head&gt; tag.</small></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="body_top_html">Body <abbr>HTML</abbr></label></th>
                <td><textarea name="body_top_html" id="body_top_html" class="code" placeholder="Enter HTML code..." rows="10" wrap="soft" spellcheck="false" autocapitalize="none" autocorrect="off"><?=esc_attr(allow_html_metadata(get_option('body_top_html'))); ?></textarea> <small>These scripts will be placed below the opening of the &lt;body&gt; tag.</small></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="body_bottom_html">Footer <abbr>HTML</abbr></label></th>
                <td><textarea name="body_bottom_html" id="body_bottom_html" class="code" placeholder="Enter HTML code..." rows="10" wrap="soft" spellcheck="false" autocapitalize="none" autocorrect="off"><?=esc_attr(allow_html_metadata(get_option('body_bottom_html'))); ?></textarea> <small>These scripts will be placed above the closing of the &lt;body&gt; tag.</small></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
    <style type="text/css">
        .form-table [type='url'],
        .form-table textarea {
            width: 100%
        }
    </style>
    <script>
    (() => {
        const inputNum = document.getElementsByTagName("input"), l = inputNum.length;
        for (let i = 0; i < l; i++) {
            const inputAttrib = inputNum[i].getAttribute("type");
            if (inputAttrib === "number") {
                inputNum[i].onkeypress = function () {
                    return event.charCode >= 40 && event.charCode <= 57;
                }
            }
            if (inputAttrib === "url") {
                inputNum[i].onkeypress = function () {
                    return event.charCode >= 33 && event.charCode <= 122;
                }
            }
            inputNum[i].onkeyup = function () {
                if (this.value.length > this.maxLength && this.maxLength > 0) {
                    this.value = this.value.slice(0,this.maxLength);
                }
            }
        }
        for (let i, j = 0; i = document.getElementById('site_representation').options[j]; j++) {
            if (i.value == '<?=get_option('site_representation'); ?>') {
                document.getElementById('site_representation').selectedIndex = j;
                break;
            }
        }
    })();
    </script>
</div>
<?php 
}
