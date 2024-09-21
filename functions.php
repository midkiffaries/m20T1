<?php // Custom PHP WordPress functions and settings

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Visual error reporting
error_reporting(0);

/////////////////////////////
// Includes and Plugins
/////////////////////////////

// Define the start time for the page loading timer
define( 'PAGE_LOAD_START', microtime(TRUE) );

// Breadcrumb trail plugin
include_once 'assets/plugins/breadcrumbs.php';

/////////////////////////////
// Initial Settings
/////////////////////////////

// Inline separator that appears in the post/page metadata
define( 'POST_SEPARATOR', '–' );
// Read more excerpt at the text ending
define( 'MORE_TEXT', '[...]' );
// SEO text excerpt length default
define( 'SEO_TEXT_LENGTH', 165 ); // Number of characters
// Default: Maximum excerpt length default
define( 'EXCERPT_LENGTH', 90 ); // Number of words
// Default: Shorten length of the content for the blog posts listings
define( 'SHORT_TEXT_LENGTH', 60 ); // Number of words

// Set the additional post types with a new line for each type
define( 'ADDITIONAL_POST_TYPE', [ 
    /* [ 'Title (singular)', 'dashicons-portfolio (https://developer.wordpress.org/resource/dashicons/)', 'Subtitle' ], */
    [ 'Portfolio', 'dashicons-portfolio', 'The work I have done professionally' ],
    // Note: Rename or create 'archive-portfolio.php' and 'single-portfolio.php' if changing the default post type slug
]);

// Register Custom Block Styles for the Editor
// https://developer.wordpress.org/news/2024/06/21/styling-sections-nested-elements-and-more-with-block-style-variations-in-wordpress-6-6/
add_action( 'init', function(){
    // Separator: Fancy
    register_block_style( 'core/separator', [
        'name'  => 'hr-fancy',
        'label' => __( 'Fancy', 'm20t1' ),
        'is_default' => false
    ]);
    // List: Checkmarks
    register_block_style( 'core/list', [
        'name'  => 'list-checkmarks',
        'label' => __( 'Checkmarks', 'm20t1' ),
        'is_default' => false,
        'inline_style' => '.is-style-list-checkmarks li {
            padding-inline: 0.5ch;
            margin-inline-end: 1ch;
        }'
    ]);
    // List: No bullets
    register_block_style( 'core/list', [
        'name'  => 'list-plain',
        'label' => __( 'No Bullets', 'm20t1' ),
        'is_default' => false
    ]);
    // Paragraph: Subtitle
    register_block_style( 'core/paragraph', [
        'name'  => 'text-subtitle',
        'label' => __( 'Subtitle', 'm20t1' ),
        'is_default' => false
    ]);
    // Paragraph: Light text shadow
    register_block_style( 'core/paragraph', [
        'name'  => 'text-shadow-soft',
        'label' => __( 'Soft Shadow', 'm20t1' ),
        'is_default' => false
    ]);
    // Paragraph: Hard text shadow
    register_block_style( 'core/paragraph', [
        'name'  => 'text-shadow-hard',
        'label' => __( 'Hard Shadow', 'm20t1' ),
        'is_default' => false
    ]);
    // Heading: Embelishment
    register_block_style( 'core/heading', [
        'name'  => 'header-embelish',
        'label' => __( 'Embelishment', 'm20t1' ),
        'is_default' => false,
        'inline_style' => '.is-style-header-embelish::before {
            display: block;
            position: absolute;
            width: 80px;
            height: 80px;
            background-color: var(--wp--preset--color--primary);
            content: " ";
            z-index: 0;
            opacity: 0.4;
            margin: -20px 0 0 -15px;
        }'
    ]);
    // Heading: Soft text shadow
    register_block_style( 'core/heading', [
        'name'  => 'header-shadow-soft',
        'label' => __( 'Soft Shadow', 'm20t1' ),
        'is_default' => false
    ]);
    // Heading: Hard text shadow
    register_block_style( 'core/heading', [
        'name'  => 'header-shadow-hard',
        'label' => __( 'Hard Shadow', 'm20t1' ),
        'is_default' => false
    ]);
    // Heading: Underline
    register_block_style( 'core/heading', [
        'name'  => 'header-underline',
        'label' => __( 'Underline', 'm20t1' ),
        'is_default' => false
    ]);
    // Heading: Text Fill
    register_block_style( 'core/heading', [
        'name'  => 'header-text-fill',
        'label' => __( 'Text-Fill', 'm20t1' ),
        'is_default' => false
    ]);
    // Embed: Youtube Frame style
    register_block_style( 'core/embed', [
        'name'  => 'embed-youtube',
        'label' => __( 'Frame', 'm20t1' ),
        'is_default' => false,
        'inline_style' => '.is-style-embed-youtube iframe,
        .is-style-embed-youtube video,
        .is-style-embed-youtube img {
            border: 3px solid #f00;
            box-shadow: 0 2px 1px #0002, 0 4px 2px #0002, 0 8px 4px #0002, 0 16px 8px #0002;
        }'
    ]);
    // Embed: Youtube Thumbnail style
    register_block_style( 'core/embed', [
        'name'  => 'embed-thumbnail',
        'label' => __( 'Thumbnail', 'm20t1' ),
        'is_default' => false,
        'inline_style' => '.is-style-embed-thumbnail {
            height: 170px !important;
            width: auto !important;
            aspect-ratio: 21 / 9;
            margin-bottom: 15px;
        }
        .is-style-embed-thumbnail iframe,
        .is-style-embed-thumbnail video,
        .is-style-embed-thumbnail img {
            border: 3px solid #f00;
            box-shadow: 0 2px 1px #0002, 0 4px 2px #0002, 0 8px 4px #0002, 0 12px 8px #0002;
        }'
    ]);
    // Video Embed: Shadow style
    register_block_style( 'core/video', [
        'name'  => 'video-shadow',
        'label' => __( 'Shadow', 'm20t1' ),
        'is_default' => false,
        'inline_style' => '.is-style-video-shadow video,
        .is-style-video-shadow img {
            box-shadow: 0 2px 1px #0002, 0 4px 2px #0002, 0 8px 4px #0002, 0 16px 8px #0002;
            border-radius: 8px;
        }'
    ]);
    // Video Embed: Glow style
    register_block_style( 'core/video', [
        'name'  => 'video-glow',
        'label' => __( 'White Glow', 'm20t1' ),
        'is_default' => false,
        'inline_style' => '.is-style-video-glow video,
        .is-style-video-glow img {
            box-shadow: 0 0 8px 0 #fff6;
            border-radius: 3px;
        }'
    ]);
    // Image: Fancy style
    register_block_style( 'core/image', [
        'name'  => 'img-fancy',
        'label' => __( 'Framed', 'm20t1' ),
        'is_default' => false,
        'inline_style' => '.is-style-img-fancy img {
            box-shadow: 7px 7px 0 0 #888f, -8px -8px 0 0 var(--wp--preset--color--primary);
            border: 1px solid #fff;
            border-radius: 1px;
        }
        .is-style-img-fancy a[href] img:hover {
            box-shadow: 12px 12px 0 0 #888c, -12px -12px 0 0 var(--wp--preset--color--primary);
        }'
    ]);
    // Image: Hand-Drawn
    register_block_style( 'core/image', [
        'name'  => 'img-hand-drawn',
        'label' => __( 'Hand Drawn', 'm20t1' ),
        'is_default' => false,
        'inline_style' => '.wp-block-image.is-style-img-hand-drawn img {
            border: 2px solid currentColor;
            overflow: hidden;
            box-shadow: 0 4px 10px 0 #0004;
            border-radius: 255px 15px 225px 15px/15px 225px 15px 255px !important;
            transform: rotate(3deg);
        }'
    ]);
    // Image: Old photo style
    register_block_style( 'core/image', [
        'name'  => 'img-polaroid',
        'label' => __( 'Polaroid', 'm20t1' ),
        'is_default' => false,
        'inline_style' => '.is-style-img-polaroid img {
            filter: sepia(40%) blur(0.01em) saturate(0.8) contrast(1.4) brightness(1.04) !important;
        }'
    ]);
    // Image: Filter Alpha Shadow Style
    register_block_style( 'core/image', [
        'name'  => 'img-filter-shadow',
        'label' => __( 'Alpha Shadow', 'm20t1' ),
        'is_default' => false,
        'inline_style' => '.is-style-img-filter-shadow img {
            filter: drop-shadow(1px 1px 3px #000a);
        }'
    ]);
    // Image: Book landscape
    register_block_style( 'core/image', [
        'name'  => 'img-book',
        'label' => __( 'Book Lndscpe', 'm20t1' ),
        'is_default' => false,
        'inline_style' => '.is-style-img-book {
            --book-width: 250px;
            --book-height: 200px;
            position: relative;
            transform: perspective(75em) rotateY(-30deg);
            height: var(--book-height);
            width: var(--book-width);
            transition: all 0.5s ease-in-out;
            margin: 1em 0.5em;
        }
        .is-style-img-book:hover {
            transform: perspective(75em) rotateY(0deg);
            filter: brightness(1.08);
            box-shadow: 0 6px 10px -1px #0002;
        }
        .is-style-img-book img {
            width: var(--book-width);
            height: var(--book-height);
            border-radius: 6px;
            box-shadow: 3px 0 3px 0 #0008;
            transition: all 0.5s ease;
            object-fit: cover;
        }
        .is-style-img-book:hover img {
            border-radius: 4px;
        }
        .is-style-img-book::after {
            content: " ";
            display: block;
            position: absolute;
            top: 12px;
            left: 1px;
            width: calc(var(--book-width) + 12px);
            height: calc(var(--book-height) - 26px);
            background-color: #eee;
            z-index: -1;
            border-radius: 1px;
            box-shadow: 1px 0 1px 1px #ccc, 1px 0 1px 2px #fff, 1px 0 1px 3px #bbb, 1px 0 1px 4px #fff, 1px 0 1px 5px #aaa, 1px 1px 0 8px #555, 1px 5px 5px 9px #0001;
            transform: perspective(100em) rotateY(-25deg);
            transition: all 0.5s ease;
        }
        .is-style-img-book:hover::after {
            transform: perspective(75em) rotateY(0deg);
            width: calc(var(--book-width) - 10%);
            box-shadow: none;
            left: 8px;
        }'
    ]);
    // Image: Book portrait
    register_block_style( 'core/image', [
        'name'  => 'img-book-portrait',
        'label' => __( 'Book Portrait', 'm20t1' ),
        'is_default' => false,
        'inline_style' => '.is-style-img-book-portrait {
            --book-width: 200px;
            --book-height: 250px;
            position: relative;
            transform: perspective(75em) rotateY(-30deg);
            height: var(--book-height);
            width: var(--book-width);
            filter: brightness(0.95);
            transition: all 0.5s ease-in-out;
            margin: 1em 0.5em;
        }
        .is-style-img-book-portrait:hover {
            transform: perspective(75em) rotateY(0deg);
            filter: brightness(1.09);
            box-shadow: 0 6px 10px -1px #0005;
        }
        .is-style-img-book-portrait img {
            width: var(--book-width);
            height: var(--book-height);
            border-radius: 6px;
            box-shadow: 3px 0 3px 0 #0007;
            transition: all 0.5s ease;
            object-fit: cover;
        }
        .is-style-img-book-portrait:hover img {
            border-radius: 4px;
        }
        .is-style-img-book-portrait::after {
            content: " ";
            display: block;
            position: absolute;
            top: 12px;
            left: 1px;
            width: calc(var(--book-width) + 12px);
            height: calc(var(--book-height) - 26px);
            background-color: #eee;
            z-index: -1;
            border-radius: 1px;
            box-shadow: 1px 0 1px 1px #ccc, 1px 0 1px 2px #fff, 1px 0 1px 3px #bbb, 1px 0 1px 4px #fff, 1px 0 1px 5px #aaa, 1px 1px 0 8px #555, 1px 5px 5px 9px #0001;
            transform: perspective(100em) rotateY(-25deg);
            transition: all 0.5s ease;
        }
        .is-style-img-book-portrait:hover::after {
            transform: perspective(75em) rotateY(0deg);
            width: calc(var(--book-width) - 10%);
            box-shadow: none;
            left: 8px;
        }'
    ]);
    // Button: 3D Raised Style
    register_block_style( 'core/button', [
        'name'  => 'button-3d',
        'label' => __( 'Raised', 'm20t1' ),
        'is_default' => false,
        'inline_style' => '.is-style-button-3d a, .is-style-button-3d div {
            box-shadow: 0 2px 4px #0007, 0 7px 13px -3px #0006, inset 0 -3px 0 #0004;
            border-radius: 5px;
            text-shadow: 1px 1px 2px #0007;
        }
        .is-style-button-3d a:hover {
            text-decoration: none !important;
        }
        .is-style-button-3d a:active {
            box-shadow: inset 2px 3px 7px -1px #0008;    
        }'
    ]);
    // Button: w/ Arrow Style
    register_block_style( 'core/button', [
        'name'  => 'button-arrow',
        'label' => __( 'w/ Arrow', 'm20t1' ),
        'is_default' => false,
        'inline_style' => '.is-style-button-arrow a::after {
            font-family: "icomoon" !important;
            content: "\e90e";
            font-size: 1.7rem;
            vertical-align: -4px;
            padding-left: 1px;
        }
        .is-style-button-arrow div::after { /* For the Editor */
            font-family: "dashicons" !important;
            vertical-align: -4px;
            padding-left: 1px;
            content: "\f345";
        }'
    ]);
    // Button: Hard Shadow Style
    register_block_style( 'core/button', [
        'name'  => 'button-border',
        'label' => __( 'Hard Border', 'm20t1' ),
        'is_default' => false,
        'inline_style' => '.is-style-button-border a, .is-style-button-border div {
            border: 4px solid #000;
            box-shadow: 0 4px 0 0 #000;
            border-radius: 1.2rem;
        }'
    ]);
    // Gallery: Theme style
    register_block_style( 'core/gallery', [
        'name'  => 'gallery-1',
        'label' => __( 'Heavy Border', 'm20t1' ),
        'is_default' => false,
        'inline_style' => '.is-style-gallery-1 .wp-block-image {
            margin-bottom: 1.2em !important;
        }
        .is-style-gallery-1 .wp-block-image img {
            border: 4px solid var(--wp--preset--color--primary-dark);
        }
        .is-style-gallery-1 .wp-block-image a img:hover {
            border: 4px solid var(--wp--preset--color--primary);
            box-shadow: 5px 5px 0 0 #888;
        }
        .is-style-gallery-1 .wp-block-image a img:active {
            box-shadow: none;
        }
        .is-style-gallery-1 figcaption {
            background: none !important;
            color: #666 !important;
            font-weight: 600;
            margin-bottom: -1.7rem !important;
        }'
    ]);
    // Gallery: Drop Shadow style
    register_block_style( 'core/gallery', [
        'name'  => 'gallery-2',
        'label' => __( 'Drop Shadow', 'm20t1' ),
        'is_default' => false,
        'inline_style' => '.is-style-gallery-2 .wp-block-image {
            margin-bottom: 1em !important;
        }
        .is-style-gallery-2 .wp-block-image img {
            box-shadow: 0 3px 8px -2px #000c;
            border-radius: 3px;
        }
        .is-style-gallery-2 .wp-block-image a img:hover {
            box-shadow: 0 8px 20px -1px #0008;
            transform: scale(1.05, 1.05) !important;
        }
        .is-style-gallery-2 .wp-block-image a img:active {
            box-shadow: 0 3px 6px -2px #0007;
        }
        .is-style-gallery-2 figcaption {
            background: none !important;
            color: #666 !important;
            font-weight: 600;
            margin-bottom: -2rem !important;
        }'
    ]);
    // Latest Posts: Theme style
    register_block_style( 'core/latest-posts', [
        'name'  => 'posts-theme',
        'label' => __( 'Theme', 'm20t1' ),
        'is_default' => false,
        'inline_style' => '.is-style-posts-theme {
            max-width: var(--wp--style--global--wide-size);
            margin: 0 auto;
            padding: 0 !important;
        }
        .is-style-posts-theme img {
            border-radius:8px;
        }
        .is-style-posts-theme img:hover {
            outline: 1px solid var(--wp--preset--color--primary);
        }
        .is-style-posts-theme time {
            color: #666;
        }
        .is-style-posts-theme .wp-block-latest-posts__post-title {
            display:block;
            line-height:1.2;
            height: 2.5em;
            font-weight: 600;
            overflow-y: hidden;
            text-decoration: none !important;
        }
        .is-style-posts-theme .wp-block-latest-posts__post-title:hover {
            text-decoration: underline !important;
            text-decoration-color: var(--wp--preset--color--primary) !important;
            color: var(--wp--preset--color--primary) !important;
        }
        .is-style-posts-theme .wp-block-latest-posts__post-excerpt {
            font-size: 1rem;
        }'
    ]);
    // Media & Text Block: Image full width style
    register_block_style( 'core/media-text', [
        'name'  => 'media-text-full',
        'label' => __( 'Full Image', 'm20t1' ),
        'is_default' => false,
        'inline_style' => '.is-style-media-text-full figure {
            width: 100%;
            object-fit: cover;
        }
        .is-style-media-text-full figure img {
            height: 20em;
            border-radius: 10px;
        }
        .is-style-media-text-full div {
            position: absolute;
            background: linear-gradient(90deg, #0001 0%, #0000 50%);
            top: 0;
            height: 100%;
            width: 100%;
            color: #fff;
            border-radius: 10px;
        }'
    ]);
    // Media & Text Block: Text overlap style
    register_block_style( 'core/media-text', [
        'name'  => 'media-text-overlap',
        'label' => __( 'Overlap', 'm20t1' ),
        'is_default' => false,
        'inline_style' => '.is-style-media-text-overlap {
            transform: translateX(-20px);
        }
        .is-style-media-text-overlap figure {
            margin-right: 130px;
        }
        .is-style-media-text-overlap figure img {
            border-radius: 14px;
        }
        .is-style-media-text-overlap div {
            background-color: #eee3;
            -webkit-backdrop-filter: blur(5px);
            backdrop-filter: blur(5px);
            border: 1px solid #ddd7;
            border-radius: 14px;
            height: 92%;
            transform: translateX(-40px);
        }
        .is-style-media-text-overlap.has-media-on-the-right div {
            transform: translateX(40px);
        }'
    ]);
});

// Add additional features to block editor elements
add_filter( 'register_block_type_args', function( $args, $block_type ) {
    // Media & Text block
	if ( 'core/media-text' === $block_type ) {
		$args['supports']['filter']['duotone'] = true; // Add duotone filter
        $args['supports']['shadow'] = true; // Add drop shadow
	}
	return $args;
}, 10, 2 );


/////////////////////////////
// WordPress Setup
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

    // Custom background and header support
    add_theme_support( 'custom-header', [ 'default-color' => 'fefefe', 'default-image' => '', 'width' => 300, 'height' => 60, 'flex-height' => true, 'flex-width' => true, 'default-text-color' => '', 'header-text' => true, 'uploads' => true ] );
    add_theme_support( 'custom-background', [ 'default-image' => '', 'default-preset' => 'default', 'default-size' => 'cover', 'default-repeat' => 'repeat', 'default-attachment' => 'scroll' ] );

    // Custom Logo Support
    add_theme_support( 'custom-logo', [ 'flex-height' => true, 'flex-width' => true, 'header-text' => [ 'site-title', 'site-description' ], ] );
    
    // Add HTML5 Support
    add_theme_support( 'html5', [ 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ] );
    
    // Set the different post formats that the author can select
    //add_theme_support( 'post-formats', [ 'aside', 'image', 'gallery', 'video', 'audio', 'link', 'quote', 'status' ] );
    
    // Set the Navigation Widgets
    register_nav_menu( 'primary', __( 'Primary Navigation', 'm20T1' ) );
    register_nav_menu( 'secondary', __( 'Secondary Navigation', 'm20T1' ) );
    register_nav_menu( 'tertiary', __( 'Tertiary Navigation', 'm20T1' ) );
});

// Enable styles and scripts
add_action( 'wp_enqueue_scripts', function(){    
    // Add Javascript to the bottom of the page body
    wp_enqueue_script( 'js-scripts', get_template_directory_uri() . "/assets/scripts/scripts.js", [], THEME_VERSION, true );

    // Add stylesheets to the HEAD metadata
    wp_enqueue_style( 'tedilize-style', get_template_directory_uri() . "/assets/css/tedilize.css", [], '2.1', 'all' );
    wp_enqueue_style( 'layout-style', get_template_directory_uri() . "/assets/css/layout.css", [], THEME_VERSION, 'all' );
    wp_enqueue_style( 'base-style', get_stylesheet_uri(), [], THEME_VERSION, 'all' );

    // Remove post comments reply
    wp_dequeue_script( 'comment-reply' );

    // Remove WordPress block library CSS
    wp_dequeue_style( 'wc-block-style' ); // WooCommerce block
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_deregister_style( 'wp-block-library-theme' );
    //wp_dequeue_style( 'wp-block-library' );
    //wp_deregister_style( 'wp-block-library' );
});

// Dashicons - Dashicons [class="dashicons dashicons-google"] 
add_action( 'wp_print_styles', function(){
    if (!is_admin_bar_showing() && !is_customize_preview()) {
        wp_dequeue_style( 'dashicons' );
        wp_deregister_style( 'dashicons' );
    }
}, 100);

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
    //remove_action( 'wp_head', 'feed_links', 2 );
    remove_action( 'wp_head', 'feed_links_extra', 3 );

    // Remove version number from the generator for security
    remove_action( 'wp_head', 'wp_generator' );

    // Enable the use of shortcodes in text widgets.
    add_filter( 'widget_text', 'do_shortcode' );

    // Cycle through the ADDITIONAL_POST_TYPE array
    foreach (ADDITIONAL_POST_TYPE as [$type, $icon, $subtitle]) {
        // Add a custom post type to the editor
        register_post_type( $type, [
            'labels' => [
                'name'                   => _x( "{$type}s", 'm20t1' ),
                'singular_name'          => _x( $type, 'm20t1' ),
                'menu_name'              => _x( "{$type}s", 'm20t1' ),
                'name_admin_bar'         => _x( $type, 'm20t1' ),
                'add_new'                => __( "Add New {$type}" ),
                'add_new_item'           => __( "Add New {$type}" ),
                'new_item'               => __( "New {$type}" ),
                'edit_item'              => __( "Edit {$type}" ),
                'view_item'              => __( "View {$type}" ),
                'view_items'             => __( "View {$type}s" ),
                'all_items'              => __( "All {$type}s" ),
                'search_items'           => __( "Search {$type}s" ),
                'parent_item_colon'      => __( "Parent {$type}:" ),
                'not_found'              => __( "No {$type}s found." ),
                'not_found_in_trash'     => __( "No {$type}s found in Trash." ),
                'featured_image'         => _x( "Featured Image", 'm20t1' ),
                'set_featured_image'     => _x( "Set cover image", 'm20t1' ),
                'remove_featured_image'  => _x( "Remove cover image", 'm20t1' ),
                'use_featured_image'     => _x( "Use as cover image", 'm20t1' ),
                'archives'               => _x( "{$type} archives", 'm20t1' ),
                'attributes'             => _x( "{$type} attributes", 'm20t1' ),
                'insert_into_item'       => _x( "Insert into {$type}",'m20t1' ),
                'uploaded_to_this_item'  => _x( "Uploaded to this {$type}", 'm20t1' ),
                'filter_items_list'      => _x( "Filter {$type} list", 'm20t1' ),
                'items_list_navigation'  => _x( "{$type} list navigation", 'm20t1' ),
                'items_list'             => _x( "{$type} list", 'm20t1' ),
                'item_published'         => _x( "{$type} published", 'm20t1' ),
                'item_published_privately'=>_x( "{$type} published privately", 'm20t1' ),
                'item_updated'           => _x( "{$type} updated", 'm20t1' ),
                'item_reverted_to_draft' => _x( "{$type} reverted to draft", 'm20t1' ),
                'item_scheduled'         => _x( "{$type} scheduled", 'm20t1' ),
                'item_link'              => _x( "{$type} link", 'm20t1' ),
                'item_link_description'  => _x( "A link to a {$type}", 'm20t1' ),
                'uri_slug'               => _x( rawurlencode(strtolower($type)), 'm20t1' ),
            ],
            'rewrite' => [ 
                'slug' => rawurlencode(strtolower($type))
            ],
            'menu_position'      => 20, // Below 'Pages'
            'description'        => $subtitle,
            'menu_icon'          => $icon,
            'full_path'          => get_page_by_path(rawurlencode(strtolower($type))),
            'supports'           => [ 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', 'page-attributes', 'custom-fields' ],
            'taxonomies'         => [ 'category' ], // category, post_tag
            'capability_type'    => 'page',
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_nav_menus'  => true,
            'show_in_menu'       => true,
            'show_in_admin_bar'  => true,
            'query_var'          => true,
            'exclude_from_search'=> false,
            'has_archive'        => true,
            'hierarchical'       => true,
            'can_export'         => true,
            'map_meta_cap'       => true,
            'show_in_rest'       => true
        ]);
    }
});

// Append HTML metadata to the page head tag
add_action( 'wp_head', function(){
?>
<meta name="title" content="<?=bloginfo('name');?>">
<meta name="generator" content="m20T1 WordPress Theme by Ted Balmer">
<meta name="author" content="<?=get_the_author_meta('display_name', get_post_field ('post_author', get_the_ID()));?>">
<link rel="canonical" href="<?=the_permalink();?>">
<link rel="dns-prefetch" href="<?=esc_url(preg_replace("(^https?:)", '', home_url()));?>">
<link rel="pingback" href="<?=bloginfo('pingback_url');?>">
<link rel="Siteuri" href="<?=home_url();?>/" id="SiteURI">
<meta name="application-name" content="<?=bloginfo('name');?>">
<meta name="apple-mobile-web-app-title" content="<?=bloginfo('name');?>">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="description" content="<?=SEO_Excerpt(get_the_id());?>">
<meta name="format-detection" content="telephone=no">
<link rel="icon" href="<?=esc_url(home_url() . "/favicon.ico");?>" sizes="any">
<link rel="icon" href="<?=esc_url(home_url() . "/favicon.svg");?>" type="image/svg+xml">
<link rel="apple-touch-icon" href="<?=esc_url(home_url() . "/apple-touch-icon.png");?>">
<link rel="manifest" href="<?=esc_url(home_url() . "/site.webmanifest");?>">
<meta property="og:locale" content="<?=get_bloginfo('language');?>">
<meta property="og:type" content="<?=(is_front_page()) ? "website" : "article";?>">
<meta property="og:site_name" content="<?=bloginfo('name');?>">
<meta property="og:url" content="<?=the_permalink();?>">
<meta property="og:title" content="<?=SEO_CharSwap(wp_title('|', true, 'right'));?><?=bloginfo('name');?>">
<meta property="og:description" content="<?=SEO_Excerpt(get_the_id());?>">
<meta property="og:image" content="<?=SEO_Image(get_the_id());?>">
<meta property="og:image:type" content="image/<?=get_file_extension(SEO_Image(get_the_id()));?>">
<meta property="article:publisher" content="<?=get_the_author_meta('facebook', get_post_field ('post_author', get_the_ID()));?>">
<meta property="article:published_time" content="<?=get_the_date('c');?>">
<meta property="article:modified_time" content="<?=get_the_modified_date('c');?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@<?=trim(parse_url(get_the_author_meta('twitter', get_post_field ('post_author', get_the_ID())), PHP_URL_PATH), '/');?>">
<meta name="twitter:url" content="<?=the_permalink();?>">
<meta name="twitter:title" content="<?=SEO_CharSwap(wp_title('|', true, 'right'));?><?=bloginfo('name');?>">
<meta name="twitter:description" content="<?=SEO_Excerpt(get_the_id());?>">
<meta name="twitter:image" content="<?=SEO_Image(get_the_id());?>">
<meta name="twitter:label1" content="Written by">
<meta name="twitter:data1" content="<?=get_the_author_meta('display_name', get_post_field ('post_author', get_the_ID()));?>">
<meta name="twitter:label2" content="Est. reading time">
<meta name="twitter:data2" content="<?=reading_time();?>">
<?php 
echo allow_html_metadata(get_option('head_metadata')); // Post user metadata
schemaJSONData(); // Post Schema JSON
});

// Append to the top of the page body tag
add_action( 'wp_body_open', function(){
    echo allow_html_tags(get_option('body_top_html')); // Post user HTML
    set_page_views(); // Page view counter
});

// Append to the bottom of the page body tag
add_action( 'wp_footer', function(){
?>
<template id="Search-Modal">
    <h3 class="search-title">Search <?=bloginfo('name');?></h3>
    <?=get_search_form(['search-modal']); // Load searchform.php ?>
    <div class="search-categories">
        <h4>Post Categories</h4>
        <?=wp_list_categories(['orderby' => 'name', 'show_count' => false, 'title_li' => '']); ?>
    </div>
    <style>.dialog-search .dialog-content{transform:none}</style>
</template>

<template id="Contact-Modal">
    <?=get_template_part('contactform'); // Load contactform.php ?>
</template>

<script>document.getElementById('PageLoadTime').textContent=<?=round(((microtime(TRUE) - PAGE_LOAD_START) * 10), 3); // Generate the page load time ?>;</script>

<?php
    echo allow_html_tags(get_option('body_bottom_html')); // Insert custom HTML from meta box
});

// Set the JPEG compression for images that are generated by WordPress (default 90)
add_filter( 'jpeg_quality', function(){
    return 78; // 1-100
});

// Set the excerpt word length
add_filter( 'excerpt_length', function(){
    return get_option('excerpt_length') ? get_option('excerpt_length') : EXCERPT_LENGTH;
});

// Add a 'Continue Reading' link to excerpts
add_filter( 'excerpt_more', function(){
    return '<span class="entry-read-more" aria-label="Read more">'.MORE_TEXT.'</span>';
});

// Add addition file types uploadable to the Media Library
add_filter( 'upload_mimes', function($mimes){
    $mimes['svg|svgz']   = 'image/svg+xml'; // SVG image
    $mimes['txt|md']     = 'text/plain'; // TXT document
    $mimes['vcard|vcf']  = 'text/vcard'; // vCard data
    $mimes['ics|ical']   = 'text/calendar'; // iCalendar data
    $mimes['woff|woff2'] = 'font/woff2|application/octet-stream|font/x-woff2'; // WOFF2 font
    $mimes['glb|gltf']   = 'model/gltf+json|model/gltf-binary'; // glTF WebGL model
    return $mimes;
}, 1, 1);

// Override file check for certain file types when uploading to the Media Library
add_filter( 'wp_check_filetype_and_ext', function($types, $file, $filename, $mimes){
    if ( false !== strpos( $filename, '.glb' ) ) {
        $types['ext']  = 'glb';
        $types['type'] = 'model/gltf-binary';
    }
    if ( false !== strpos( $filename, '.txt' ) ) {
        $types['ext']  = 'txt|md';
        $types['type'] = 'text/plain';
    }
    if ( false !== strpos( $filename, '.woff2' ) ) {
        $types['ext']  = 'woff2';
        $types['type'] = 'font/woff2|application/octet-stream|font/x-woff2';
    }
    return $types;
}, 10, 4);

// Set a text fallback to the custom image logo hook
add_filter( 'get_custom_logo', function(){
    if (has_custom_logo()) { // Use image logo
        return wp_get_attachment_image( get_theme_mod('custom_logo'), 'full', false, ['class' => 'custom-logo', 'srcset' => '', 'itemprop' => 'image', 'fetchpriority' => 'high', 'decoding' => 'async'] ) . '<span class="visual-hidden" itemprop="name headline">' . get_bloginfo('name') . '</span>';
    } else { // No logo, use site title
        return '<span itemprop="name headline">' . get_bloginfo('name') . '</span>';
    }
});

// Remove srcset from SVG images so SVG files in img tags will display correctly
add_filter( 'wp_calculate_image_sizes', function( string $sizes, array $size, $image_src = null ){
	$image_type = end(explode('.', $image_src));
	if ( $image_type === 'svg' || $image_type === 'svgz' ) {
		return null;
	} else {
        return $sizes;
    }
}, 10, 3 );


/////////////////////////////
// Sidebar and Widgets
/////////////////////////////

// Register the sidebar widgets 
add_action( 'widgets_init', function(){
    // Primary Sidebar - Full blog page
    register_sidebar([
        'id'            => 'primary',
        'name'          => __( 'Blog Sidebar', 'm20T1' ),
        'description'   => __( 'Blog page sidebar widgets.' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
    // Secondary Sidebar - Archive Pages
    register_sidebar([
        'id'            => 'secondary',
        'name'          => __( 'Archive Sidebar', 'm20T1' ),
        'description'   => __( 'Archive pages sidebar widgets.' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
    // Tertiary Sidebar - Search Results
    register_sidebar([
        'id'            => 'tertiary',
        'name'          => __( 'Search Page Sidebar', 'm20T1' ),
        'description'   => __( 'Search results page sidebar widgets.' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
    // Single Post Widgets
    register_sidebar([
        'id'            => 'singlepost',
        'name'          => __( 'Single Post Widgets', 'm20T1' ),
        'description'   => __( 'Widgets below a single blog post.' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
    // Front page Widgets
    register_sidebar([
        'id'            => 'frontpage',
        'name'          => __( 'Front Page Widgets', 'm20T1' ),
        'description'   => __( 'Widgets on the bottom of the front page and landing pages.' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
    // Page Widgets
    register_sidebar([
        'id'            => 'singlepage',
        'name'          => __( 'Page Widgets', 'm20T1' ),
        'description'   => __( 'Widgets below the contents on a single web page and attachment pages.' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
    // Page Header Widgets
    register_sidebar([
        'id'            => 'header',
        'name'          => __( 'Header Widgets', 'm20T1' ),
        'description'   => __( 'The page header widgets.' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<p class="widget-title">',
        'after_title'   => '</p>',
    ]);
    // Page Footer Widgets
    register_sidebar([
        'id'            => 'footer',
        'name'          => __( 'Footer Widgets', 'm20T1' ),
        'description'   => __( 'The page footer widgets.' ),
        'before_widget' => '<nav id="%1$s" class="widget %2$s">',
        'after_widget'  => '</nav>',
        'before_title'  => '<p class="widget-title">',
        'after_title'   => '</p>',
    ]);
});

// Get 'Widgets_Slug' Custom Field which changes the sidebar selection
// SLUGS: primary, secondary, tertiary, quaternary, singlepost, frontpage, singlepage, singlepagesidebar, portfoliopage, header, footer
function selectSidebarCustomField( $id, $default ) {
    $key = get_post_meta( $id, 'Widgets_Slug', true );
    return empty($key) ? $default : sanitize_text_field($key);
}


/////////////////////////////
// Navigation
/////////////////////////////

// Display the menu/navigation links as a <ul> list
function menu_nav_list( $menu, $id ) {
    wp_nav_menu([
        'menu'                 => $menu,
        'container'            => 'nav',
        'container_class'      => 'nav-'.$id,
        'container_id'         => $id,
        'container_aria_label' => $menu,
        'menu_class'           => 'menu',
        'menu_id'              => '',
        'echo'                 => true,
        'fallback_cb'          => 'wp_page_menu',
        'before'               => '',
        'after'                => '',
        'link_before'          => '',
        'link_after'           => '',
        'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'item_spacing'         => 'preserve',
        'depth'                => 0,
        'walker'               => new Menu_With_Description,
        'theme_location'       => '',
    ]);
}

// Activate descriptions for each nav menu item
class Menu_With_Description extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';
        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';
        $item_output = $args->before;
        $item_output .= '<a '. $attributes .'>';
        $item_output .= ! empty( $item->menu_thumbnail ) ? ' <img src="' . esc_url(get_the_post_thumbnail_url(url_to_postid($item->url), 'thumbnail')) . '" class="menu-item-image" alt="" loading="lazy" decoding="async" fetchpriority="auto">' : '';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= ! empty( $item->description ) ? ' <span class="menu-item-sub">' . $item->description . '</span>' : '';
        $item_output .= '</a>';
        $item_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

// Add a Custom Field to each menu item
add_action( 'wp_nav_menu_item_custom_fields', function( $item_id, $item ) {
	$menu_img = get_post_meta( $item_id, 'menu_thumbnail', true );
	?>
	<p class="description" style="margin-bottom:10px">
        <label for="menu_thumbnail-<?=$item_id;?>"><?php _e( "Display Thumbnail", 'menu_thumbnail' ); ?></label> &nbsp;
        <input type="hidden" class="nav-menu-id" value="<?=$item_id;?>">    
        <input type="radio" id="menu_img_no-<?=$item_id;?>" name="menu_thumbnail[<?=$item_id;?>]" value="0">
        <label for="menu_img_no-<?=$item_id;?>">No</label> &nbsp;
        <input type="radio" id="menu_img_yes-<?=$item_id;?>" name="menu_thumbnail[<?=$item_id;?>]" value="1">
        <label for="menu_img_yes-<?=$item_id;?>">Yes</label>
    </p>
    <script>(parseInt(<?=$menu_img;?>)) ? document.getElementById('menu_img_yes-<?=$item_id;?>').checked = true : document.getElementById('menu_img_no-<?=$item_id;?>').checked = true;</script>
	<?php
}, 10, 2 );

// Update a Custom Field to each menu item
add_action( 'wp_update_nav_menu_item', function( $menu_id, $menu_item_db_id ) {
	if ( isset( $_POST['menu_thumbnail'][$menu_item_db_id]  ) ) {
		$sanitized_data = sanitize_text_field( $_POST['menu_thumbnail'][$menu_item_db_id] );
		update_post_meta( $menu_item_db_id, 'menu_thumbnail', $sanitized_data );
	} else {
		delete_post_meta( $menu_item_db_id, 'menu_thumbnail' );
	}
}, 10, 2 );


/////////////////////////////
// Child Pages Functions
/////////////////////////////

// Display page title and excerpt from child pages of current page
function get_child_pages( $id, $thumbnail ) {
    $page_children = get_pages([
        'sort_order'     => 'ASC',
        'sort_column'    => 'menu_order, post_title',
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'exclude'        => 0,
        'child_of'       => $id,
    ]);
    ?>

    <?php if ($page_children) : // Display section header ?>
        <h2 class="child-title">Related Pages</h2>
    <?php endif; ?>

    <div class="child-block">
        <?php foreach ($page_children as $child) : // Loop and display all the child cards ?>
            <div class="child-card" id="child-card-<?=$child->ID;?>">
                <a class="child-card__link" href="<?=esc_url(get_permalink($child->ID));?>" rel="nofollow">
                    <div class="child-card__image"><img src="<?=esc_url(get_the_post_thumbnail_url($child->ID, 'medium'));?>" loading="lazy" decoding="async" alt="" fetchpriority="low"></div>
                    <div class="child-card__title" role="caption"><?=$child->post_title;?></div>
                    <div class="child-card__text"><?=$child->post_excerpt;?></div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
}


/////////////////////////////
// Specialized Functions
/////////////////////////////

// Shortcode implementation for displaying additional post types in the editor -- https://www.smashingmagazine.com/2012/05/wordpress-shortcodes-complete-guide/
// [list-posts posts="5" post_type="portfolio" order="asc" orderby="title" thumbnail="1" excerpt="1" post_status="publish" category="" id="" class=""]
add_shortcode('list-posts', function( $atts, $content = null ){
    extract(shortcode_atts(['posts' => 1, 'post_type' => 'portfolio', 'order' => 'desc', 'orderby' => 'title', 'thumbnail' => 0, 'excerpt' => 0, 'post_status' => 'publish', 'category' => '', 'id' => '', 'class' => ''], $atts));
    query_posts(['orderby' => esc_html( $atts['orderby'] ), 'order' => esc_html( $atts['order'] ), 'post_type' => esc_html( $atts['post_type'] ), 'post_status' => esc_html( $atts['post_status'] ), 'category_name' => esc_html( $atts['category'] ), 'showposts' => $posts]);

    if (have_posts()) { 
        while (have_posts()) : the_post(); // List each item
            $return_string .= '<li class="block-list-posts_item"><div class="block-list-posts_image"><a href="'.get_permalink().'" aria-label="'.get_the_title().'">'.($atts['thumbnail'] ? get_the_post_thumbnail($post_id, 'medium') : '').'</a></div><a href="'.get_permalink().'" class="block-list-posts_title">'.get_the_title().'</a> <time datetime="'.get_the_date('c').'" class="block-list-posts_date">'.get_the_date().'</time><div class="block-list-posts_excerpt">'.($atts['excerpt'] ? get_the_excerpt() : '').'</div></li>';
        endwhile;
    }

    wp_reset_query();
    return "<ul class='block-list-posts ".esc_html( $atts['class'] )."'>".$return_string."</ul>";
});

// Get the number of posts/pages this keyword comes up in on search queries
function SearchCount( $query ) {
    $count = 0;
    if ($query == null) $query = '%XZT89%11321X$'; // Catch blank to show 0 results
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

// Allow only certain HTML tags in the <head> metadata for user generated content
function allow_html_metadata( $html ) {
    return strip_tags($html, '<meta><script><noscript><link><style><iframe>');
}

// Allow only certain HTML tags for user generated content
function allow_html_tags( $html ) {
    return strip_tags($html, '<style><script><noscript><iframe><div>');
}

// Allow only certain HTML tags for user generated content
function clean_html( $html ) {
    return strip_tags($html, '<b><strong><i><em><a><span><abbr>');
}


//////////////////////////////////
// Attachment/Image Page Functions
//////////////////////////////////

// Get the full file path on the server from the file's URI
function get_filepath( $fileurl ) {
    return realpath($_SERVER['DOCUMENT_ROOT'] . parse_url($fileurl, PHP_URL_PATH));
}

// Append the proper size units to a numerical file size 
function file_units( $filesize ) {
    $filesizeunits = [' Bytes', ' KB', ' MB', ' GB', ' TB'];
    return $filesize ? round($filesize/pow(1024, ($i = floor(log($filesize, 1024)))), 1) . $filesizeunits[$i] : 'N/A';
}

// Get the the image information and file size
function image_metadata( $filename ) {
    $filesize = file_units(wp_filesize(get_filepath($filename)));
    if (@is_array(getimagesize($filename))) {
        list($width, $height, $type, $attr) = getimagesize($filename);
        return "File: " . image_type_to_mime_type($type) . " – Dimensions: {$width}x{$height}px – Size: {$filesize}";
    } else {
        return "File: " . mime_content_type(get_filepath($filename)) . " – Size: {$filesize}";
    }
}


////////////////////////////////////
// SEO and Header Metadata Functions
////////////////////////////////////

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


///////////////////////////////////
// Featured and Hero/Header Images
///////////////////////////////////

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
    return empty($first_image) ? false : $first_image;
}

// Display the header/hero image from the featured image
function Header_Hero( $id ) {
    // Type of page
    if ( is_front_page() ) { // Front-page header (No header image)
        $className = "homepage";
        $hasFeaturedImage = false;
    } else if ( is_attachment() || is_404() ) { // Attachment and 404 page headers (No header image)
        $className = "noimage";
        $hasFeaturedImage = false;
    } else if ( is_page() ) { // Single Page header (Use featured image)
        $className = "single-page";
        $hasFeaturedImage = true;
    } else if ( is_single() ) { // Single blog post or single portfolio (Use featured image)
        $className = "single-post";
        $hasFeaturedImage = true;
    } else { // Blog Page, portfolios page, search page and archives header (No header image)
        $className = "noimage";
        $hasFeaturedImage = false;
    }

    // Get the featured image and image caption if exists or fallback to blank image
    if ($hasFeaturedImage && get_post_thumbnail_id($id)) {
        $featuredImage = FeaturedImageURL($id, 'full', 1);
        $featuredCap = wp_get_attachment_caption(get_post_thumbnail_id($id)) ? wp_get_attachment_caption(get_post_thumbnail_id($id)) : "View featured image";
        $attachmentTitle = '<a href="' . home_url() . '/?p=' . get_post_thumbnail_id($id) . '" itemprop="url">' . $featuredCap . '</a>';
    } else {
        $attachmentTitle = '';
    }

    // Check if hero video has a valid URL
    $videoUrl = get_post_meta( get_the_id(), 'Page_Video', true );
    if (filter_var($videoUrl, FILTER_VALIDATE_URL)) {
        $videoTag = '<video preload="auto" class="header-hero-video" autoplay muted loop playsinline><source src="'.$videoUrl.'" type="'.mime_content_type($videoUrl).'"></video>';
    } else {
        $videoTag = '';
    }

    // Header Hero HTML
    ?>
        <div class="header-hero-container header-<?=$className;?>">
            <?=$videoTag;?>
            <div class="header-hero-image hero-parallax" style="<?=$featuredImage;?>" role="img" aria-labelledby="header-hero-caption">
            <div class="header-hero-gradient"></div>
            <div class="header-hero-overlay"></div>
            <div class="header-hero-caption" id="header-hero-caption"><?=$attachmentTitle;?></div>
        </div>
    <?php
}


////////////////////////////////////////
// WordPress Front-end Global Functions
////////////////////////////////////////

// Check if client is a mobile device
function isMobileDevice() { 
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]); 
}

// Display the date of the last entry update
function display_last_updated() {
    ?><p><?php 
    if (get_the_modified_date('Y-m-d') > get_the_date('Y-m-d')) {
        printf( __( 'Updated: <time itemprop="dateModified">%s</time>', 'm20t1' ), get_the_modified_date() ); 
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
    $image_ext = ['jpg', 'jpeg', 'jp2', 'png', 'gif', 'webp', 'ico', 'heif', 'heic', 'avif'];
    $video_ext = ['mp3', 'ogg', 'mp4', 'm4v', 'm4a', 'mov', 'wmv', 'avi', 'webm', 'mpg', 'mpeg', 'ogv', '3gp', '3g2'];
    
    $fileExt = get_file_extension(wp_get_attachment_url($id));

    // Check if attachment matches the extension images array
    foreach ($image_ext as $ext) {
        if (strpos($fileExt, $ext) !== FALSE) {
            return '<a href="' . wp_get_attachment_url(get_the_ID()) . '" title="Enlarge image" aria-title="Enlarge image" itemprop="url">'. wp_get_attachment_image($id, 'large', 0, ['loading' => '', 'decoding' => 'async', 'itemprop' => 'image', 'fetchpriority' => 'high']) . '</a>';
        }
    }

    // Check if attachment matches the extension video array
    foreach ($video_ext as $ext) {
        if (strpos($fileExt, $ext) !== FALSE) {
            return '<video preload="auto" controls playsinline style="width:95%;box-shadow:0 1px 6px 0 #000c"><source src="' . wp_get_attachment_url(get_the_ID()) . '" type="' . mime_content_type(wp_get_attachment_url(get_the_ID())) . '"></video>';
        }
    }

    // Check if attachment is SVG file, GLB or other document
    if ($fileExt == 'svg' || $fileExt == 'svgz') { // SVG Images
        return '<img src="' . wp_get_attachment_url($id) . '" alt="' . wp_get_attachment_caption($id) . '" loading="lazy" decoding="async" class="attachment-svg" itemprop="image" fetchpriority="high">';
    } else if ($fileExt == 'glb') { // GLB Web3D model
        return '<script defer type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.5.0/model-viewer.min.js"></script><model-viewer id="Model3D" class="aligncenter" itemprop="image" style="height:380px;min-width:400px" src="' . wp_get_attachment_url($id) . '" alt="' . wp_get_attachment_caption($id) . '" ar poster="" shadow-intensity="0" exposure="1.1" shadow-softness="0" tone-mapping="commerce" camera-controls touch-action="pan-y"></model-viewer>';
    } else { // All other documents types
        return '<a href="' . wp_get_attachment_url(get_the_ID()) . '" title="Download document" aria-title="Download document" itemprop="url"><svg xmlns="http://www.w3.org/2000/svg" width="246" height="282"><g><path fill="#1e90ff" d="M234.4 63c-6-8.2-14.6-18-24-27.4-9.3-9.3-19-17.9-27.3-24C169 1.2 162.1 0 158.1 0H22C9.9 0 0 10 0 22v238a22 22 0 0 0 22 22h202a22 22 0 0 0 22-22V88.1c0-4-1.2-10.8-11.6-25zm-36.3-15A239.6 240.4 0 0 1 218 70.6h-42.3V28.1a239.4 240.2 0 0 1 22.4 20zm30.3 212c0 2.4-2 4.4-4.4 4.4H22c-2.4 0-4.4-2-4.4-4.4V22c0-2.3 2-4.4 4.4-4.4h136v61.7a8.8 8.8 0 0 0 8.8 8.8h61.5z"/><path fill="#add8e6" d="M184.5 229.2h-123a8.8 8.8 0 0 1 0-17.7h123a8.8 8.8 0 1 1 0 17.7zm0-35.3h-123a8.8 8.8 0 0 1 0-17.6h123a8.8 8.8 0 1 1 0 17.6zm0-35.3h-123a8.8 8.8 0 0 1 0-17.6h123a8.8 8.8 0 1 1 0 17.6z"/></g></svg></a>';
    }
}

// Blog post user comment HTML and formatting for each comment
function custom_comment_style( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
    // Visitor comment HTML
    ?>
	<li <?=comment_class();?> id="comment-<?=comment_ID() ?>" itemprop="comment" role="comment">
        <div class="comment-content">
			<header class="comment-header">
                <span class="comment-avatar hidden">
                    <figure class="alignleft" aria-label="Authors Avatar" itemprop="image">
                        <?=get_avatar( get_the_author_meta( 'ID' ), 48 );?>
                    </figure>
                </span>
                <span class="comment-author" rel="author" itemprop="author"><?php printf(__('%s'), get_comment_author()); ?></span>
                <span class="comment-metadata">
                    <a href="<?=esc_url(get_comment_link($comment->comment_ID)) ?>" rel="bookmark" itemprop="url" aria-label="Get the link to this comment">#</a> 
                    <time class="comment-date" itemprop="datePublished"><?php printf(__('%1$s'), get_comment_date('F j, Y ~ h:ma')); ?></time>
                </span>
                <span class="comment-reply"><?=get_comment_reply_link( __( 'Reply', 'm20t1' ), '', '' );?></span> 
			</header>
            <?php if ($comment->comment_approved == '0') : ?>
                <div class="comment-moderation"><?php _e('⚠️ Your comment is awaiting moderation.'); ?></div>
            <?php endif; ?>
            <div class="comment-text" itemprop="text"><?=comment_text();?></div>
            <div class="comment-edit"><?=edit_comment_link( __( 'Edit Comment', 'm20t1' ), '', '' );?></div>
        </div>
    </li>
    <?php
}

// Pagination on the index/archive/search pages
function blog_post_pagination( $type ) {
    previous_posts_link("<span class='icon-arrow-left'></span> Next " . get_option('posts_per_page') . " {$type}", 0); // << Left Side
    next_posts_link("Previous " . get_option('posts_per_page') . " {$type} <span class='icon-arrow-right'></span>", 0); // Right Side >>
}

// Show the blog post tags as a list
function blog_post_tags() {
    return the_tags('<ul><li rel="tag" itemprop="keywords">', '</li><li rel="tag" itemprop="keywords">', '</li></ul>');
}

// Create a unique body main page class for all pages "page-{slug}"
function get_page_class() {
    return 'page-' . preg_replace('/\s+/', '-', get_post_field( 'post_name', get_post() ));
}

// List social sharing links on each blog post
function blog_post_share() {
    $social_links = [ // Social media links
        'facebook'  => "https://www.facebook.com/sharer/sharer.php?u=" . esc_url(get_the_permalink()),
        'twitter'   => "https://x.com/intent/post?text=" . esc_url(get_the_permalink()),
        'linkedin'  => "https://www.linkedin.com/shareArticle?mini=true&url=" . esc_url(get_the_permalink()) . "&title=" . rawurlencode(get_the_title()) . "&summary=" . rawurlencode(get_the_excerpt()) . "&source=" . urlencode(get_bloginfo('name')),
        'pinterest' => "https://pinterest.com/pin/create/button/?url=" . esc_url(get_the_permalink()) . "&media=" . urlencode(SEO_Image(get_the_id())) . "&description=" . rawurlencode(get_the_excerpt()),
        'reddit'    => "https://www.reddit.com/submit?url=" . esc_url(get_the_permalink()),
        'email'     => "mailto:?subject=" . rawurlencode(get_the_title()) . "&body=" . rawurlencode(get_the_title()) . " | " . esc_url(get_the_permalink()),
    ];

    // Social sharing buttons HTML
    ?>
    <ul class="post-social-share" aria-label="Share on social media">
        <li class="hidden">Share on:</li>
        <li><span role="button" class="browser-share Can-Share" aria-label="Use the browsers sharing">Share</span></li>
        <li><a href="<?=$social_links['twitter'];?>" class="twitter-share" aria-label="X/Twitter" rel="noopener noreferrer" target="_blank"></a></li>
        <li><a href="<?=$social_links['facebook'];?>" class="facebook-share" aria-label="Facebook" rel="noopener noreferrer" target="_blank"></a></li>
        <li><a href="<?=$social_links['linkedin'];?>" class="linkedin-share" aria-label="LinkedIn" rel="noopener noreferrer" target="_blank"></a></li>
        <li><a href="<?=$social_links['pinterest'];?>" class="pinterest-share" aria-label="Pinterest" rel="noopener noreferrer" target="_blank"></a></li>
        <li><a href="<?=$social_links['reddit'];?>" class="reddit-share" aria-label="Reddit" rel="noopener noreferrer" target="_blank"></a></li>
        <!--li><a href="<?=$social_links['email'];?>" class="email-share" aria-label="Email this post" rel="noopener noreferrer" target="_blank"></a></li-->
    </ul>
    <script>
        if (navigator.canShare) { // Supports canShare
            document.querySelector(".Can-Share").onclick = () => {
                const data = {title:"<?=get_the_title();?>", text:"<?=get_the_excerpt();?>", url:"<?=esc_url(get_the_permalink());?>"};
                if (navigator.canShare(data)) navigator.share(data);
            }
        } else { // Does not support canShare
            document.getElementsByClassName("Can-Share")[0].style.display = "none";
        }
    </script>
    <?php
}


//////////////////////////////
// Schema.org Structured Data
//////////////////////////////

// Schema.org JSON structured microdata script for the navigation and WebSite data
function schemaJSONData() {
    foreach (explode(',', get_option('same_as_url')) as $sa) $sameAsArray .= "\"".trim($sa)."\",";
?>
<script type="application/ld+json" id="schema-graph">
[{"@context":"https://schema.org/","@type":"WebSite","@id":"<?=home_url();?>#website","headline":"<?=bloginfo('name');?>","name":"<?=bloginfo('name');?>","alternateName":"<?=addslashes(get_option('short_title'));?>","description":"<?=addslashes(get_bloginfo('description'));?>","publisher":{"@id": "<?=home_url();?>#<?=get_option('site_business');?>"},"potentialAction":[{"@type":"SearchAction","target":{"@type":"EntryPoint","urlTemplate":"<?=home_url();?>?s={search_term_string}"},"query-input":"required name=search_term_string"}],"inLanguage":"<?=get_bloginfo('language');?>","url":"<?=home_url();?>"},
{"@context":"https://schema.org/","@type":"<?=get_option('site_business');?>","@id":"<?=home_url();?>#<?=get_option('site_representation');?>","name":"<?=bloginfo('name');?>","url":"<?=home_url();?>","sameAs":[<?=rtrim($sameAsArray,",");?>],"contactPoint":{"@type":"ContactPoint","contactType":"<?=addslashes(get_option('phone_type'));?>","telephone":"<?=addslashes(get_option('contact_phone'));?>","url":"<?=home_url();?>/contact/"}},
{"@context":"https://schema.org/","@graph":[<?php schemaNavigation('primary');?>
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
		
		foreach ($menuItems as $MenuItem) : // Get each item in the menu ?>
            {"@context":"https://schema.org/","@type":"SiteNavigationElement","@id":"<?=esc_url(home_url());?>#Main Navigation","name":"<?=$MenuItem->title;?>","url":"<?=$MenuItem->url;?>"}, 
        <?php endforeach;
	}
}


/////////////////////////////////////////////////
// Admin: Dashboard and global admin settings
/////////////////////////////////////////////////

// Add custom message to login screen
add_filter( 'login_message', function(){
?>
<div style="text-align:center"><?=wp_get_attachment_image(get_theme_mod('custom_logo'), 'full', false, ['srcset' => '', 'style' => 'width:70%']);?></div>
<?php
});

// Change the WordPress editor's footer text
add_filter( 'admin_footer_text', function(){
?>
<i><a href="https://www.wordpress.org/" target="_blank">WordPress</a> theme brought to you with 💙 by <a href="https://github.com/midkiffaries/m20T1" target="_blank">m20T1 <?=THEME_VERSION;?></a>.</i>
<?php
});

// Add custom post type to the dashboard "At a Glance" card
add_action( 'dashboard_glance_items', function(){
    $post_types = get_post_types( [ '_builtin' => false ], 'objects' );
    foreach ( $post_types as $post_type ) {
        $num_posts = wp_count_posts( $post_type->name );
        $num = number_format_i18n( $num_posts->publish );
        $text = _n( $post_type->labels->singular_name, $post_type->labels->singular_name, $num_posts->publish );
        foreach (ADDITIONAL_POST_TYPE as [$type]) {
            if ( current_user_can( 'edit_posts' ) && $text == $type ) {
                echo '<li class="'.$post_type->capability_type.'-count-X"><a href="edit.php?post_type='.$post_type->name.'" class="cust-post"><span class="dashicons '.$post_type->menu_icon.'" style="padding-right:5px"></span>'.$num.' '.$text.'s</a><style>.cust-post:before{content:"" !important;margin-left:-5px}</style></li>';
            }
        }
    }
});

// Settings for the Admin floating toolbar and WordPress dashboard and editor
add_action( 'admin_head', function(){
?>
<style type="text/css">
.wp-admin .column-post_views {width:3em}
.wp-admin .column-thumbnail {width:7em}
.wp-admin .media-icon .attachment-60x60 {min-width:60px}
.wp-admin .thumbnail .details-image:is([src$='.svg'],[src$='.svgz']) {min-width:95%}
.wp-admin .user-url-wrap input.code {font-family:inherit}
.wp-admin .type-model img, .wp-admin .thumbnail-model img {display:none !important}
.wp-admin .type-model, .wp-admin .thumbnail-model {background: transparent url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="1024" height="1024"><path fill="gray" d="M494 96 67 280l428 183 432-183zm18 390v442l416-198V310zM64 730l417 198V486L64 310z"/></svg>') no-repeat 50% 40%;background-size:50%;}
</style>
<?php
});

// Add a panel to the dashboard with additional theme info
add_action('wp_dashboard_setup', function(){
    wp_add_dashboard_widget('custom_dashboard_text', 'm20T1 Theme Guide', 'custom_dashboard_text');
    function custom_dashboard_text() {
    ?>
    <p><a href="<?=esc_url(home_url() . "/wp-admin/themes.php?page=") . get_filepath(esc_url(home_url() . '/wp-content/themes/m20T1/functions.php'));?>">Additional Custom Theme Settings</a></p>
    <p>Editor Classes: <code>alignjustify</code>, <code>subtitle</code>, <code>hidden</code></p>
    <h3>List Posts & Pages Shortcode Sample</h3>
    <p><code style="display:block">[list-posts posts="5" post_type="portfolio" order="asc" orderby="title" thumbnail="1" excerpt="1" post_status="publish" category="" id="" class=""]</code></p>
    <?php
    }
});


/////////////////////////////////////////////////
// Admin: Additional columns for the post list
/////////////////////////////////////////////////

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
            echo '<img src="' . $post_thumbnail_img[0] . '" width="90" height="90" loading="lazy" decoding="async" itemprop="image" alt="" fetchpriority="auto">';
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
    return ($count < 1) ? 0 : $count;
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


/////////////////////////////////////////////////
// Admin: Media Library additions
/////////////////////////////////////////////////

// Add a filter by Category select list to the Media Library
add_action( 'restrict_manage_posts', function(){
    $scr = get_current_screen();
    if ( $scr->base !== 'upload' ) return;

    $category = filter_input(INPUT_GET, 'cat', FILTER_SANITIZE_STRING );
    $selected = (int)$category > 0 ? $category : '-1';
    $args = [
        'show_option_none' => 'All Categories',
        'name'             => 'cat',
        'selected'         => $category
    ];
    wp_dropdown_categories($args);
});

// Add a filter by Author select list to the Media Library
add_action( 'restrict_manage_posts', function(){
    $scr = get_current_screen();
    if ( $scr->base !== 'upload' ) return;

    $author = filter_input(INPUT_GET, 'author', FILTER_SANITIZE_STRING );
    $selected = (int)$author > 0 ? $author : '-1';
    $args = [
        'show_option_none' => 'All authors',
        'name'             => 'author',
        'selected'         => $selected
    ];
    wp_dropdown_users($args);
});

// Allow media filtering by author
add_action( 'pre_get_posts', function($query){
    if ( is_admin() && $query->is_main_query() ) {
        if (isset($_GET['author']) && $_GET['author'] == -1) {
            $query->set('author', '');
        }
    }
});

// Add additional filters for other media types
add_filter( 'post_mime_types', function($post_mime_types){
    $post_mime_types['font/woff2'] = [ __( 'Fonts' ), __( 'Manage Fonts' ), _n_noop( 'WOFF2 <span class="count">(%s)</span>', 'WOFF2s <span class="count">(%s)</span>' ) ];
    $post_mime_types['image/svg+xml'] = [ __( 'SVG Images' ), __( 'Manage SVG Images' ), _n_noop( 'SVG <span class="count">(%s)</span>', 'SVGs <span class="count">(%s)</span>' ) ];
    $post_mime_types['model/gltf-binary'] = [ __( '3D Models' ), __( 'Manage 3D Models' ), _n_noop( 'GLB <span class="count">(%s)</span>', 'GLBs <span class="count">(%s)</span>' ) ];
	return $post_mime_types;
});


/////////////////////////////////////////////////
// Admin: Add Additional values to user profiles
/////////////////////////////////////////////////

// Display the author's user level/role
function user_level( $level ) {
    return match (intval($level)) {
        2 => 'Author',
        7 => 'Editor',
        10 => 'Administrator',
        default => 'Contributor',
    };
}

// Add additional contact methods and information to user profiles
add_filter( 'user_contactmethods', function(){
    return [
        'jobtitle'  => 'Job Title',
        'linkedin'  => 'LinkedIn URL',
        'facebook'  => 'Facebook URL',
        'twitter'   => 'X/Twitter URL',
        'pinterest' => 'Pinterest URL',
        'city'      => 'City/State/Co',
    ];
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
                    <option value="happy" <?php selected( 'happy', get_the_author_meta( 'mental', $user->ID ) ); ?>>😄 Happy</option>
                    <option value="okay" <?php selected( 'okay', get_the_author_meta( 'mental', $user->ID ) ); ?>>🫤 Okay</option>
                    <option value="sad" <?php selected( 'sad', get_the_author_meta( 'mental', $user->ID ) ); ?>>🙁 Sad</option>
                    <option value="pizza" <?php selected( 'pizza', get_the_author_meta( 'mental', $user->ID ) ); ?>>🍕 Pizza</option>
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
add_filter( 'manage_users_custom_column', function($output, $column_id, $user_id){
	if ( $column_id == 'last_login' ) {
        $last_login = get_user_meta( $user_id, 'last_login', true );
		$output = $last_login ? '<time datetime="' . date('c', $last_login) . '" title="Last login ' . date('F j, Y, g:i a', $last_login) . '">' . human_time_diff($last_login) . '</time>' : 'No record';
	}
	return $output;
}, 10, 3 );

// Allow the Last Login columns to be sortable
add_filter( 'manage_users_sortable_columns', function($columns){
	return wp_parse_args( ['last_login' => 'last_login'], $columns );
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
    return empty($last_login) ? false : human_time_diff($last_login);
}


/////////////////////////////////////////////////
// Admin: Theme Additional Settings Page
/////////////////////////////////////////////////

// Create new menu under the Appearance section
add_action('admin_menu', function(){
	add_submenu_page('themes.php', 'm20T1 Additional Settings', 'Theme Settings', 'administrator', __FILE__, 'm20T1_settings_page' , 'dashicons-admin-generic', null );

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
        register_setting( 'm20t1-settings-group', 'site_business' );
        register_setting( 'm20t1-settings-group', 'short_title' );
        register_setting( 'm20t1-settings-group', 'contact_phone' );
        register_setting( 'm20t1-settings-group', 'phone_type' );
        register_setting( 'm20t1-settings-group', 'same_as_url' );
        register_setting( 'm20t1-settings-group', 'contact_shortcode' );
    });
});

// Additional settings page layout
function m20T1_settings_page() {
?>
<div class="wrap">
    <h1>m20T1 Theme Settings</h1>
    <p>Additional global settings this theme uses in lieu of plugins.</p>
    <form method="post" action="options.php" novalidate="novalidate">
        <?php settings_fields( 'm20t1-settings-group' ); ?>
        <?php do_settings_sections( 'm20t1-settings-group' ); ?>
        <h2>Schema Settings</h2>
        <p>Set the site's schema representation. Verify schema at <a href="https://validator.schema.org/#url=<?=esc_url(home_url());?>" target="_blank">Schema.org</a>.</p>
        <table class="form-table" role="presentation">
            <tr valign="top">
                <th scope="row"><label for="short_title">Short Site Title</label></th>
                <td><input type="text" name="short_title" id="short_title" placeholder="<?=bloginfo('name');?>" maxlength="18" value="<?=get_option('short_title');?>"> (max 18 characters)</td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="site_representation">Site Representation</label></th>
                <td><select id="site_representation" name="site_representation">
                <?php 
                $repArr = ['Person', 'Organization'];
                foreach ($repArr as $value) : ?>
                    <option value="<?=$value;?>"><?=$value;?></option>
                <?php endforeach; ?>
                </select>
                <script>document.getElementById('site_representation').selectedIndex = <?=array_search(get_option('site_representation'), $repArr);?>;</script>
                <select id="site_business" name="site_business">
                <?php 
                $businessArr = ['Consortium', 'Corporation', 'EducationalOrganization', 'School', 'GovernmentOrganization', 'LibrarySystem', 'MedicalOrganization', 'NewsMediaOrganization', 'NGO', 'PerformingGroup', 'SportsOrganization', 'WorkersUnion'];
                foreach ($businessArr as $value) : ?>
                    <option value="<?=$value;?>"><?=$value;?></option>
                <?php endforeach; ?>
                </select></td>
                <script>document.getElementById('site_business').selectedIndex = <?=array_search(get_option('site_business'), $businessArr);?>;</script>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="contact_phone">Contact Phone Number</label></th>
                <td><input type="tel" name="contact_phone" id="contact_phone" placeholder="1-555-555-0000" maxlength="15" inputmode="tel" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" value="<?=get_option('contact_phone');?>">
                <select id="phone_type" name="phone_type">
                <?php 
                $phoneArr = ['sales', 'customer support', 'technical support', 'billing support', 'emergency'];
                foreach ($phoneArr as $value) : ?>
                    <option value="<?=$value;?>"><?=ucwords($value);?></option>
                <?php endforeach; ?>
                </select></td>
                <script>document.getElementById('phone_type').selectedIndex = <?=array_search(get_option('phone_type'), $phoneArr);?>;</script>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="same_as_url">Social Profiles URLs</label> <br><small>Comma separated</small></th>
                <td><textarea name="same_as_url" id="same_as_url" placeholder="Comma separated URLs (eg. https://www.facebook/userProfile/)"><?=get_option('same_as_url');?></textarea></td>
            </tr>
        </table>
        <h2>Presentation Settings</h2>
        <p>Set the length of the excerpt text seen on the blog post list and the default length.</p>
        <table class="form-table" role="presentation">
            <tr valign="top">
                <th scope="row"><label for="alt_excerpt_length">Blog Posts Excerpt Length</label></th>
                <td><input type="number" name="alt_excerpt_length" id="alt_excerpt_length" placeholder="<?=SHORT_TEXT_LENGTH;?>" min="0" max="300" step="1" maxlength="3" inputmode="numeric" value="<?=get_option('alt_excerpt_length');?>"> words</td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="excerpt_length">Default Excerpt Length</label></th>
                <td><input type="number" name="excerpt_length" id="excerpt_length" placeholder="<?=EXCERPT_LENGTH;?>" min="0" max="300" step="1" maxlength="3" inputmode="numeric" value="<?=get_option('excerpt_length');?>"> words</td>
            </tr>
        </table>
        <h2>404 Error and Search Page</h2>
        <p>Set the image and the text of the 404 page and the 'No results' image on the search page.</p>
        <table class="form-table" role="presentation">
            <tr valign="top">
                <th scope="row"><label for="404_text">404 Error Page HTML</label></th>
                <td><textarea name="404_text" id="404_text" class="code" placeholder="That page must have been deleted or is otherwise inaccessable." rows="3" spellcheck="false" autocapitalize="none" autocorrect="off"><?=esc_attr(clean_html(get_option('404_text')));?></textarea><small>Allowed HTML tags: <b>&lt;b&gt; &lt;strong&gt; &lt;i&gt; &lt;em&gt; &lt;a&gt; &lt;span&gt; &lt;abbr&gt;</b></small></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="404_image">404 Error Page Image URL</label> <br><small>500x500px <i>Type: all</i></small></th>
                <td><input type="url" name="404_image" id="404_image" placeholder="<?=esc_url(home_url() . "/wp-content/uploads/filename.jpg");?>" spellcheck="false" autocapitalize="none" autocorrect="off" inputmode="url" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?=esc_attr(get_option('404_image'));?>"> <img src="<?=esc_attr(get_option('404_image'));?>" alt="" class="form-image" loading="lazy" decoding="async" fetchpriority="auto"></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="search_image">Search Page Image URL</label> <br><small>500x500px <i>Type: all</i></small></th>
                <td><input type="url" name="search_image" id="search_image" placeholder="<?=esc_url(home_url() . "/wp-content/uploads/filename.jpg");?>" spellcheck="false" autocapitalize="none" autocorrect="off" inputmode="url" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?=esc_attr(get_option('search_image'));?>"> <img src="<?=esc_attr(get_option('search_image'));?>" alt="" class="form-image" loading="lazy" decoding="async" fetchpriority="auto"></td>
            </tr>
        </table>
        <h2>Placeholder and Fallback Images</h2>
        <p>Set the fallback image for the social media sharing metadata and featured image. Preview the presentation at <a href="https://metatags.io/?url=<?=esc_url(home_url());?>" target="_blank">MetaTags.io</a>.</p>
        <table class="form-table" role="presentation">
            <tr valign="top">
                <th scope="row"><label for="social_image">Social Image Fallback URL</label> <br><small>1000x500px <i>Type: jpeg/png</i></small></th>
                <td><input type="url" name="social_image" id="social_image" placeholder="<?=esc_url(home_url() . "/wp-content/themes/m20t1/assets/images/social-share.jpg");?>" spellcheck="false" autocapitalize="none" autocorrect="off" inputmode="url" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?=esc_attr(get_option('social_image'));?>"> <img src="<?=get_option('social_image') ? esc_attr(get_option('social_image')) : esc_url(home_url() . "/wp-content/themes/m20t1/assets/images/social-share.jpg");?>" alt="" class="form-image" loading="lazy" decoding="async" fetchpriority="auto"></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="blank_image">Featured Image Fallback URL</label> <br><small>600x600px <i>Type: all</i></small></th>
                <td><input type="url" name="blank_image" id="blank_image" placeholder="<?=esc_url(home_url() . "/wp-content/themes/m20t1/assets/images/featured-blank.svg");?>" spellcheck="false" autocapitalize="none" autocorrect="off" inputmode="url" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?=esc_attr(get_option('blank_image'));?>"> <img src="<?=get_option('blank_image') ? esc_attr(get_option('blank_image')) : esc_url(home_url() . "/wp-content/themes/m20t1/assets/images/featured-blank.svg");?>" alt="" class="form-image" loading="lazy" decoding="async" fetchpriority="auto"></td>
            </tr>
        </table>
        <h2>Main Contact Form</h2>
        <p>Form shortcode generated from a 3rd-party plugin.</p>
        <table class="form-table" role="presentation">
            <tr valign="top">
                <th scope="row"><label for="contact_shortcode">Contact Form Shortcode</label></th>
                <td><textarea name="contact_shortcode" id="contact_shortcode" class="code" placeholder="[shortcode]" rows="2" wrap="soft" spellcheck="false" autocapitalize="none" autocorrect="off"><?=sanitize_text_field(get_option('contact_shortcode'));?></textarea> <small>Allowed HTML tags: <b>&lt;form&gt; &lt;input&gt; &lt;textarea&gt; &lt;button&gt; &lt;p&gt; &lt;label&gt;</b></small></td>
            </tr>
        </table>
        <h2>Additional Global Metadata and Scripts</h2>
        <p>For inserting 3rd-party analytics, external fonts and scripts, and other metadata into the site header and footer.</p>
        <table class="form-table" role="presentation">
            <tr valign="top">
                <th scope="row"><label for="head_metadata">Header <abbr>HTML</abbr></label> <br><small>These scripts will be placed inside the &lt;head&gt; tag.</small></th>
                <td><textarea name="head_metadata" id="head_metadata" class="code" placeholder="Enter HTML code..." rows="10" wrap="soft" spellcheck="false" autocapitalize="none" autocorrect="off"><?=esc_attr(allow_html_metadata(get_option('head_metadata')));?></textarea> <small>Allowed HTML tags: <b>&lt;meta&gt; &lt;script&gt; &lt;link&gt; &lt;style&gt; &lt;noscript&gt; &lt;iframe&gt;</b></small></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="body_top_html">Body <abbr>HTML</abbr></label> <br><small>These scripts will be placed below the opening of the &lt;body&gt; tag.</small></th>
                <td><textarea name="body_top_html" id="body_top_html" class="code" placeholder="Enter HTML code..." rows="10" wrap="soft" spellcheck="false" autocapitalize="none" autocorrect="off"><?=esc_attr(allow_html_tags(get_option('body_top_html')));?></textarea> <small>Allowed HTML tags: <b>&lt;div&gt; &lt;script&gt; &lt;style&gt; &lt;noscript&gt; &lt;iframe&gt;</b></small></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="body_bottom_html">Footer <abbr>HTML</abbr></label> <br><small>These scripts will be placed above the closing of the &lt;body&gt; tag.</small></th>
                <td><textarea name="body_bottom_html" id="body_bottom_html" class="code" placeholder="Enter HTML code..." rows="10" wrap="soft" spellcheck="false" autocapitalize="none" autocorrect="off"><?=esc_attr(allow_html_tags(get_option('body_bottom_html')));?></textarea> <small>Allowed HTML tags: <b>&lt;div&gt; &lt;script&gt; &lt;style&gt; &lt;noscript&gt; &lt;iframe&gt;</b></small></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
    <style type="text/css">
        .form-table [type='url'],
        .form-table textarea {
            width: 100%
        }
        .form-image {
            width: 200px;
            margin: 5px 5px 0;
            border-radius: 4px;
        }
    </style>
    <script>
    (() => {
        const inputNum = document.getElementsByTagName("input"), l = inputNum.length;
        for (let i = 0; i < l; i++) {
            const inputAttrib = inputNum[i].getAttribute("type");
            if (inputAttrib === "number" || inputAttrib === "tel") {
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
    })();

    (() => {
        const keymap = {
            "<": { value: "<>", pos: 1 },
            '"': { value: '""', pos: 1 },
            "[": { value: "[]", pos: 1 }
        };
        const textbox = document.getElementsByTagName("textarea"), l = textbox.length;
        for (let i = 0; i < l; i++) {
            textbox[i].addEventListener("keydown", function () {
                if (keymap[event.key]) {
                    event.preventDefault();
                    const pos = textbox[i].selectionStart;
                    textbox[i].value = textbox[i].value.slice(0, pos) + keymap[event.key].value + textbox[i].value.slice(textbox[i].selectionEnd);
                    textbox[i].selectionStart = textbox[i].selectionEnd = pos + keymap[event.key].pos;
                }
            });
        }
    })();
    </scrip>
</div>
<?php 
}


/////////////////////////////////////////////////
// Admin: Editor Advanced Options Meta Box
/////////////////////////////////////////////////

// Get 'Page_CSS' Custom Field which adds custom page styling
function custom_page_css( $id ) {
    $css = get_post_meta( $id, 'Page_CSS', true );
    $css = str_replace(['<','>'], ['%3C','%3E'], $css); // make HTML safe
    $css = preg_replace('/\s*([:;{}])\s*/', '$1', $css); // Remove Spaces
    $css = preg_replace('/;}/', '}', $css); // Remove new lines

    return empty($css) ? NULL : '<style type="text/css" id="Page-CSS" hidden>'.wp_strip_all_tags($css).'</style>';
}

// Get 'Page_Scheme' Custom Field for the page schema.org in the body tag
function custom_page_scheme( $id ) {
    $scheme = get_post_meta( $id, 'Page_Scheme', true );

    if (empty($scheme)) {
        if (is_archive() || is_search()) {
            return "CollectionPage"; // Archives
        } else {
            return "WebPage"; // Default page
        }
    } else {
        return $scheme;
    }
}

// Get 'Page_Article' Custom Field for the page schema.org in the main tag on single.php
function custom_page_article( $id ) {
    $scheme = get_post_meta( $id, 'Page_Article', true );
    return empty($scheme) ? "Article" : $scheme;
}

// Custom Meta Box for the post editor
if ( is_admin() ) {
	add_action( 'load-post.php', 'call_BuildMetaBox' );
	add_action( 'load-post-new.php', 'call_BuildMetaBox' );
}

function call_BuildMetaBox() {
	new BuildMetaBox();
}

// Build the meta box
class BuildMetaBox {

	public function __construct() {
		add_action( 'add_meta_boxes', [ $this, 'add_meta_box' ] );
		add_action( 'save_post', [ $this, 'save' ] );
	}

	public function add_meta_box( $post_type ) {

        // Post types that get the meta box -> attachment
		$post_types = [ 'post', 'page' ];

        // Add additional post types to the array
        foreach (ADDITIONAL_POST_TYPE as [$type]) {
            $post_types[] = _x( rawurlencode(strtolower($type)), '' );
        }

		if ( in_array( $post_type, $post_types ) ) {
			add_meta_box(
				'm20t1_meta_box',
				__( 'Advanced Options', 'm20t1' ), // meta box title
				[ $this, 'render_meta_box_content' ],
				$post_type,
				'advanced',
				'high'
			);
		}
	}

    // Saving the me logic
	public function save( $post_id ) {

		// Check if our nonce is set
		if ( ! isset( $_POST['m20t1_meta_box_nonce'] ) ) {
			return $post_id;
		}

		$nonce = $_POST['m20t1_meta_box_nonce'];

		// Verify that the nonce is valid
		if ( ! wp_verify_nonce( $nonce, 'm20t1_meta_box' ) ) {
			return $post_id;
		}

		// If this is an autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// Check the user's permissions
		if ( 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

		// Update the meta field
		update_post_meta( $post_id, 'Page_CSS', str_replace(['<','>'], ['%3C','%3E'], $_POST['m20t1_css_field']) );
        update_post_meta( $post_id, 'Page_Scheme', htmlspecialchars($_POST['m20t1_schema_field']) );
        update_post_meta( $post_id, 'Page_Article', htmlspecialchars($_POST['m20t1_article_field']) );
        update_post_meta( $post_id, 'Page_Video', esc_url(htmlspecialchars($_POST['m20t1_video_field'])) );
        update_post_meta( $post_id, 'Page_Subtitle', clean_html($_POST['m20t1_subtitle_field']) );
        update_post_meta( $post_id, 'Page_Keyphrase', clean_html($_POST['m20t1_keyphrase_field']) );
        //update_post_meta( $post_id, 'Widgets_Slug', clean_html($_POST['m20t1_widgets_field']) );
	}

	// Display the meta box in the post editor
	public function render_meta_box_content( $post ) {

		// Add an nonce field so we can check for it later
		wp_nonce_field( 'm20t1_meta_box', 'm20t1_meta_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database
        $pageViews = get_post_meta( $post->ID, 'post_views_count', true );
		$pageCSS = get_post_meta( $post->ID, 'Page_CSS', true );
        $pageScheme = get_post_meta( $post->ID, 'Page_Scheme', true );
        $pageArticle = get_post_meta( $post->ID, 'Page_Article', true );
        $pageVideo = get_post_meta( $post->ID, 'Page_Video', true );
        $pageSubtitle = get_post_meta( $post->ID, 'Page_Subtitle', true );
        $pageKeyphrase = get_post_meta( $post->ID, 'Page_Keyphrase', true );
        //$pageWidgets = get_post_meta( $post->ID, 'Widgets_Slug', true );

        $pageKeyphraseCount = $pageKeyphrase ? substr_count(strtolower(wp_strip_all_tags(get_the_content())), strtolower($pageKeyphrase)) : 0;
		
        // Generate the meta box HTML
		?>
		<div class="components-base-control__field"><label for="m20t1_css_field" class="components-base-control__label css-1v57ksj">
			<?php _e( 'Custom CSS Styling', 'm20t1' ); ?>
		</label></div>
		<textarea id="m20t1_css_field" name="m20t1_css_field" class="mceEditor code" spellcheck="false" autocapitalize="none" autocomplete="off" autocorrect="off" style="height:12em;width:100%;margin-bottom:8px" placeholder="Enter raw CSS styling  .red {color: #f00;}" ><?=$pageCSS;?></textarea>

        <div class="components-base-control__field"><label for="m20t1_subtitle_field" class="components-base-control__label css-1v57ksj">
			<?php _e( 'Page Subtitle', 'm20t1' ); ?>
		</label></div>
        <input type="text" id="m20t1_subtitle_field" name="m20t1_subtitle_field" spellcheck="true" autocomplete="off" autocorrect="on" placeholder="Subtitle (&lt;b&gt;, &lt;i&gt;, &lt;span&gt; allowed)" maxlength="255" style="width:100%;margin-bottom:8px" value="<?=$pageSubtitle;?>">

        <div class="components-base-control__field"><label for="m20t1_keyphrase_field" class="components-base-control__label css-1v57ksj">
			<?php _e( 'SEO Keyphrase', 'm20t1' ); ?>
            (Count: <b id="m20t1_keyphrase_count" title="Count should be 1 for every 100 words on the page."><?=$pageKeyphraseCount;?> of <?=ceil(str_word_count(wp_strip_all_tags(get_the_content())) / 120);?></b>)
		</label></div>
        <input type="text" id="m20t1_keyphrase_field" name="m20t1_keyphrase_field" spellcheck="true" autocomplete="off" autocorrect="on" placeholder="Short phrase that appears in the content" maxlength="255" style="width:100%;margin-bottom:8px" value="<?=$pageKeyphrase;?>">

        <div class="components-base-control__cols">        
            <div class="components-base-control__field"><label for="m20t1_schema_field" class="components-base-control__label css-1v57ksj">
                <?php _e( 'Page Type (Schema.org)', 'm20t1' ); ?>
            </label>
            <select id="m20t1_schema_field" name="m20t1_schema_field" style="margin-bottom:8px;display:block">
                <?php 
                $schemaArr = ['WebPage', 'ItemPage', 'AboutPage', 'ContactPage', 'ProfilePage', 'CollectionPage', 'FAQPage', 'QAPage', 'SearchResultsPage', 'CheckoutPage', 'MedicalWebPage'];
                foreach ($schemaArr as $value) : ?>
                    <option value="<?=$value;?>"><?=$value;?></option>
                <?php endforeach; ?>
            </select></div>
            <script>document.getElementById('m20t1_schema_field').selectedIndex = <?=array_search($pageScheme, $schemaArr);?>;</script>
        
            <div class="components-base-control__field"><label for="m20t1_article_field" class="components-base-control__label css-1v57ksj">
                <?php _e( 'Article Type (Schema.org)', 'm20t1' ); ?>
            </label>
            <select id="m20t1_article_field" name="m20t1_article_field" style="margin-bottom:8px;display:block">
                <?php 
                $articleArr = ['Article', 'BlogPosting', 'SocialMediaPosting', 'NewsArticle', 'AdvertiserContentArticle', 'SatiricalArticle', 'ScholarlyArticle', 'TechArticle', 'Report', 'None'];
                foreach ($articleArr as $value) : ?>
                    <option value="<?=$value;?>"><?=$value;?></option>
                <?php endforeach; ?>
            </select></div>
            <script>document.getElementById('m20t1_article_field').selectedIndex = <?=array_search($pageArticle, $articleArr);?>;</script>
        </div>
        
        <div class="components-base-control__field"><label for="m20t1_video_field" class="components-base-control__label css-1v57ksj">
			<?php _e( 'Featured Video Link', 'm20t1' ); ?>
		</label></div>
        <input type="url" id="m20t1_video_field" name="m20t1_video_field" spellcheck="false" autocapitalize="none" autocomplete="off" autocorrect="off" placeholder="<?=esc_url(home_url() . "/wp-content/uploads/FILENAME");?>" maxlength="128" inputmode="url" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" style="width:100%;margin-bottom:8px" value="<?=$pageVideo;?>">
        
        <div class="components-base-control__field"><label class="components-base-control__label css-1v57ksj"><b>Post Stats: </b>
			<?php _e( 'Views', 'm20t1' ); ?> <b><?=$pageViews;?></b> | 
            <?php _e( 'Excerpt Length', 'm20t1' ); ?> <b><?=strlen(get_the_excerpt());?></b> chars
		</label></div>
        <style>
        @media(min-width:700px) {
            .components-base-control__cols {
                display:grid;
                grid-template-columns:auto auto;
                gap:10px;
            }
        }
        textarea {
            tab-size: 4;
        }
        </style>
        <script>
        (() => {
            const inputNum = document.getElementById("m20t1_video_field");
            if (inputNum.getAttribute("type") === "url") {
                inputNum.onkeypress = function () {
                    return event.charCode >= 33 && event.charCode <= 122;
                }
            }
        })();

        (() => {
            const keymap = {
                "(": { value: "()", pos: 1 },
                "{": { value: "{}", pos: 1 }
            };
            const snipmap = {
                "3#": "### ",
                "4#": "#### ",
                "5#": "##### ",
                "6#": "###### "
            };
            const textbox = document.getElementById("m20t1_css_field");
            textbox.addEventListener("keydown", function () {
                if (keymap[event.key]) {
                    event.preventDefault();
                    const pos = textbox.selectionStart;
                    textbox.value = textbox.value.slice(0, pos) + keymap[event.key].value + textbox.value.slice(textbox.selectionEnd);
                    textbox.selectionStart = textbox.selectionEnd = pos + keymap[event.key].pos;
                }
                if (event.key === "Tab") {
                    const word = getWord(textbox.value, textbox.selectionStart);
                    if (word && snipmap[word]) {
                        event.preventDefault();
                        const pos = textbox.selectionStart;
                        textbox.value = textbox.value.slice(0, pos - word.length) + snipmap[word] + textbox.value.slice(textbox.selectionEnd);
                        textbox.selectionStart = textbox.selectionEnd = pos + (snipmap[word].length - 1);
                    } else {
                        event.preventDefault();
                        const pos = textbox.selectionStart;
                        textbox.value = textbox.value.slice(0, pos) + "	" + textbox.value.slice(textbox.selectionEnd);
                        textbox.selectionStart = textbox.selectionEnd = pos + 1;
                    }
                }
            });
        })();
        function getWord(text, caretPos) {
            let preText = text.substring(0, caretPos),
                split = preText.split(/\s/);
            return split[split.length - 1].trim();
        }
        </script>
        <?php
    }
}