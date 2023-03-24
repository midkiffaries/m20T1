<?php // Custom PHP WordPress functions and settings

error_reporting(0);

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Define the start time for the page loading timer
define( 'PAGE_LOAD_START', microtime(TRUE) );

/////////////////////////////
// Includes and Plugins
/////////////////////////////

// Breadcrumb trail plugin
include_once 'assets/plugins/breadcrumbs.php';

/////////////////////////////
// Constants and Settings
/////////////////////////////

// Get the version of m20T1 from style.css
define( 'THEME_VERSION', wp_get_theme()->get('Version') );
// Default fallback featured image URI
define( 'BLANK_IMAGE', get_template_directory_uri() . '/assets/images/featured-blank.svg' );
// Default social media sharing image URI
//define( 'SOCIAL_IMAGE', get_template_directory_uri() . '/assets/images/social-share.jpg' ); // Default Image
define( 'SOCIAL_IMAGE', home_url() . '/wp-content/uploads/2022/08/social-share.jpg' ); // Custom Image
// Inline separator that appears in the post/page metadata
define( 'POST_SEPARATOR', '–' );
// Read more text excerpt ending
define( 'MORE_TEXT', '[...]' );
// Maximum excerpt length
define( 'EXCERPT_LENGTH', 90 ); // Number of words
// Shorten length of content
define( 'SHORT_TEXT_LENGTH', 60 ); // Number of words
// SEO text excerpt length
define( 'SEO_TEXT_LENGTH', 165 ); // Number of characters
// Define the title of an additional post type
define( 'ADDITIONAL_POST_TYPE', 'Portfolio' );
// Image on the search page when no results are present
define( 'SEARCH_ERROR_IMAGE', '<svg clip-rule="evenodd" height="454" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" width="526" xmlns="http://www.w3.org/2000/svg"><path d="m48.6 338c-1 8.5 2.7 16.7 3.5 25 1.5 10.7 4.4 21.6 1.3 32.3a66.9 66.9 0 0 1 -10.8 22.3c-3.6 8.7 4.8 17.8 13.4 18.4 12.1 0 25.6 2.3 36.5-4.8 5.4-4 10.6-10 9-17.1-1-13-1-26.2-1-39.2-1.2-5.4-.4-14-8-14.3-15-2.9-31-8.7-40-19.8-1.2-1-2.4-2.3-4-2.8zm157.4 79c2.2-4.3 15.8-21.2 8.5-22-18.8-13.8-8.7-26.4-38-24.3-.4 3 .5 6.1.5 9.2.4 3.3.4 7-1.8 9.8-2.7 4.4-6.7 8-8.4 12.9-.5 3.5-.9 7.9 2 10.5a37.6 37.6 0 0 0 37.2 4z" fill="#502d16"/><path d="m159.1 369.3c-24.7-5.2-33.2-21.6-10.8-34 1-24 62 0 54.7-44.5-3.4-23-39.8-53.4-40.3-54-5.4 2-32.3 9.6-23.7-1.6 5.6-12.9-1.7-30.4-16.3-32.8-10.9-3.8-19.3 8-29.8 5.5-26.7-9.4-42.8 1.3-49.7-1-10.1-8.2-26-8.3-33.9 3.2-8.2 9.6-2.2 22.5.2 33-4 7.7-5.8 16.2-8.3 24.5-2 15-2.6 32.4 8 44.5a65.6 65.6 0 0 0 34.8 21.4c5.8 6.2 14.7 17.3 22.8 21.3 10.6 8.5 23.3 1.8 33.3 10.9 10.6 15.9 7.2 35.8 5.7 53.7-6.4 6-14.4 15-10.6 24.6 8.4 11 24.3 10 36.4 7.7 9.3-2.4 24.2-5.1 25.3-16.5 0-16-.8-31.9.7-47.8.2-6-.6-12.3 1.4-18.1z" fill="#784421"/><path d="m291.3 384.5c-3.1 3.8 0 9.1-2 13.5-2.5 14-16.2 30.6-9.8 42.3 4 6 11.3 8 17.8 10 12 2.9 24.5 1.5 36.6 0 7.5-.8 15.4-3.9 19.5-10.6 1.8-3.3.4-7.2.9-10.8-.3-9.5-6-16.4-8.4-24.8-1.4-3.4 2.3-10.1-2.8-11-18.9 6-37.7-7-51.8-8.6z" fill="#803300"/><path d="m212.8 102.3c33.4-18.1 84.2-84.2 95.2-95.5 11-11.2 14.3-6.6 20.7-.3 6.5 6.2 44.9 73.5 88 95.6l-40 22.8c8.7 17 46.6 22.2 68.8 40.2-3.4 25.1-33 28.3-35 42.2 10.5 8.4 51.2 28 76.9 42l-50 35.3c-4.2 14.5 24.7 24 78.2 41.1 4 23.2-39.8 32.1-72.5 44l-32.5 28.5-45.8-14-44.8 11.8-31.8-10-64.4 7.8-23.7-28.3c-27.8-10.9-61.7-8.5-78.8-34 25.4-18.5 65.4-17.5 71.1-42-3.8-17.6-40.1-12.7-41.3-48 26.3-12 80.5-25.3 77.9-35l-39.6-28.5c18.3-18.9 67.6-39.8 77.5-52.5-18.1-7.7-51.5-4.3-54-23.2z" fill="#00b513"/><path d="m49.6 240.5c7.7 0-4.1 11.8-8.4 12.9-2.2.5-19.8 4.6-11.2-2.3 2.5-2 7.9-1.3 11-3.6 2.6-2 5.5-7 8.6-7zm50 1.2c-7.7 0 4 11.8 8.4 12.9 2.1.5 19.8 4.6 11.2-2.3-2.5-2-8-1.3-11-3.6-2.7-2-5.6-7-8.6-7z" fill="#482f13" stroke="#482f13" stroke-width=".3"/><path d="m227.8 395.8c-8.7 0-9.4-4.5-12.3 5.1-1.3 3.4-4.8 5.2-6.8 8-2.5 4-4.6 8.9-3.4 13.6a20 20 0 0 0 10.8 10 37 37 0 0 0 18.5 2c4.6-.2 9.4.4 13.8-1.3 4.6-1.5 9.6-3.3 12.8-7.2 1.7-2.9.7-6.4 1-9.5-.4-5-1.7-21.1-3.4-23.2a149 149 0 0 1 -31 2.5z" fill="#784421"/><path d="m151.3 241c-8.9 20.1 12.2 40.8 31.5 41.9 14 1 7.7 12.1 3.5 18.7 3.4 20.5 31 15 45.3 10.8 14-.5 28-20.6 39.8-13.6-.1 16 5 29.2 16.3 40.7 7.8 15-10.3 24.6-21 31a78.7 78.7 0 0 1 -49.4 8.2c-20.4-10.5-2.3-33 9.3-42.9 7-4.3 11.4-25.3-1.2-13.3-10 13-21 27.2-39.1 27.6a85.5 85.5 0 0 1 -55.2-12.7c-5.7-12.2-17.6-4.4-11.2 6 7.2 19.3 30.5 28 49.2 29.3 18.6 3.8 20.4-1.3 31.1 14 13.5 15.5 40.9 13 58.8 8.5 14.9-6.2 30.4-13.7 44-1a62 62 0 0 0 50.2-1.5c16-8.5 29 6.1 44.7 6.8 12.8 1.7 33.7 2.6 38-12.2.2-19.6 18.3-17.4 32-15.8 21.8-1 45.5-9.3 57.1-28.8 4.7-16.7-13.7-27-19.8-5.7-17 12.7-40.5 11.8-60 6.4-6.8-5.3-33.6-12.7-22.9 3.7 12.4 15 5.7 41.6-16.5 38.3-21.8-1-38.4-19.8-46.3-38.5-6-10.3-20.8-5.3-9 5.2 12.3 19.8-12 31.8-28.8 28.6-13.7.6-32.3-9.5-27-25.5 6.4-18.1 30.4-10.3 42-22.6 14.7-7.9 22.7-33.6 42.4-25.2a111.1 111.1 0 0 0 46.5 11.2c15.3.3 30.5-2.7 44.9-8-9.2-7.4-41.5-12.4-30.4-26.9 18-2 40.7.9 51.2-17.6 8-12.1-3-25.3-13-12a52.4 52.4 0 0 1 -63.6-9.6c-10-7-14 4.6-3.2 7.5 14 5.6 34 27.8 11.8 37-20.6 13.6-41.2-7.6-60.7-4.3-13.3 8.7-21.5 28.8-40.3 26.4-18-1.7-30.7-19.3-30.9-36.6-4-19.6-16.8.5-25.4 5.2-13.3 9.3-28 19-44.5 20-18.2-2.7-12.3-27.4-.1-34.1-15-.8-30.5 3.9-44.9-2.9-10.2-3.8-23.4-9.8-25.2-21.7z" fill="#028d2c"/><path d="m445.4 165.1c-.8 11.7-13.7 16.3-22.4 21.3-19.8 8.7-42 9.6-63.4 8.9-10.7-2.2-24.1-14.3-33.7-3.3-5.1 8.2-13.4 14.4-23.5 12.4-13.1-.6-23.7-9.4-32.1-18.7a24.3 24.3 0 0 0 -29.3-5.7 110 110 0 0 1 -42 1.7c-5.6-2.3-12.6-8.3-11.4 2 1.4 12.5 15.2 18.5 26.4 18.9 6-.3 18.6-.4 12 8.4-4.9 5.4-19 7.8-21.2 10.8 14.7-1.4 10 14.4 1.8 21.6-5.5 10.2 12.6 9 16 2.5 13.4-9.2 30.2-18.2 46.7-11.8 10.6 5.3 22.7 12 35 7.2 13.4-4.5 24.8-13.7 38.5-17.6a71.3 71.3 0 0 1 35.6 1.4c15.9 4 34 1.4 47.2-8.6-4.7-1.8-21-9.4-10.2-14.1 11-2 24.4-3.8 30.2-14.9 2.4-6.5 4.7-16.4-.3-22.3zm-232.6-62.8c-10.2 36.6 56.9 14 48 28.6-2.5 4.3-11.6 5.6-13 9.3 11.6 2.1 25.7 4.2 36.7-1 4.7-4.8 13.5-9.8 16.2-.4 6.5 9.2 16 15.9 27 18.1 9 2.3 17.3 3.7 24.7-3 7.8-5.7 11-12 16.8-6.6 7.7 2.8 20.8-2 22.1-9-3.9-4.7-12.1-6.4-14.7-13.4 15-1.2 39.3 2.6 44.4-13.3 2.6-9.5-8.8-13.4-14.1-6.5-16.1 3.1-31.7 6-48 2.4-5-.8-20.7-8.1-14.9 2.9 5 8 6.4 18 5.8 27.3-.9 12.1-16.9 9.2-24.5 5.5-11-4.1-18.9-13.8-25.5-23.1-5.3-7.6-8.5-16.5-12.8-24.6-21.1 6.6-42.9 16.7-65 12.9-4.4 0-7-2.3-9.2-6.1z" fill="#028d2c"/><path d="m72.6 265.3a27 27 0 0 0 -22.3 12.5c-3.3 5.1-6.3 11-6 17.2.3 3.2.2 6.4.7 9.6 1.6 6.7 8 11.1 14.3 13.2 4.9 1.4 10 1.2 15 1.4 8.1 0 17-1.6 22.6-7.9 5.4-5.7 6-14.4 3.9-21.6a38 38 0 0 0 -17.5-22.7 22.8 22.8 0 0 0 -10.7-1.7z" fill="#eb9d57"/><path d="m316.9 246.7c-2.2.4-3.3 2.7-3.2 4.7 2.5 11.4 4.3 25.6 8.5 35.3 1.4 5.7 7.7 9.4 10.2 4.6 2-9-4.3-36.5-7.9-42.4-2.5-3.2-4.6-3-7.6-2.2z" fill="#028d2c"/><path d="m68.1 275c-2.5.7-6 .7-7.5 4.3-5.4 13.4 8.1 18.7 18.2 16.2 7-1.7 9.8-13.2 5-18-3.8-3.7-11.8-3.8-15.8-2.5z" fill="#353331"/><path d="m368 238.1c-6.6 2.9-2.3 8.3 0 11.8 7.3 8.6 11.8 18.3 20 24.5 5.4 2.8 9.5-3.6 6.8-7.3-5-8-12.9-14-17.4-22.3-2.6-4-4.8-7-9.4-6.7zm-112.4 72.5c-7 3-7.1 13.8-10.4 19.6l-4 7c-2 4 0 9.7 5 9.7 4.4 0 5.4-5.6 7-8.1a59.6 59.6 0 0 0 9-25.6c0-2.4-5.7-3-6.6-2.6zm56.6-238c-1.8 5 2.3 19.5 3.6 24.7 1 3.6 5.5 11 10 7.6 3.7-3 2-9.6 1-13.6-1.4-5.4-1-18.4-5.7-21.6-4.2-1.6-8.1.7-9 2.9zm56.8 82.4c-7 1.1-.7 9.2 2.4 12.2 5.8 5.5 16 11 23.7 11 8.1-4.1-2-12.3-6.3-14.4-8.2-4-9.8-10.5-19.8-8.8zm7 164.5c-6.3.8-3.8 7.7-1.2 11.2 4 5.3 8.6 10.4 13 15.4 2.2 3.2 4.4 3.7 7.8 3.6 3.8 0 3.5-6.3 2.1-8.6-3.2-5.3-16.1-22.3-21.6-21.6zm-194.4-6.8c-5.1-1.4-8.9 5.4-13 8.9-2.5 2-5.5 3.4-8.2 5.2-5 3.4-7.7 11.5 1 11.5 4.8 0 6.8-3.4 10.5-5.8 7-4.3 22.6-16.2 9.7-19.8zm160.8-250c-4.2.5-5.8 6.3-3.6 10.1 3.2 5.7 10.7 16.7 17.7 16.7 4.6 0 4.8-5.6 3.4-8.8-.8-1.9-4-4.4-5.2-6.3-2.5-4.2-6.4-12.5-12.3-11.7zm-87.1 180a54 54 0 0 0 -8 11.7c-1 3-1.7 7.8.4 9.7 10.6 1.5 21.1-19.6 17.5-24.3-4-3-7.3.2-9.9 3zm46.7-78.3c-7.8.9-7.7 27.1 3.7 26.3 4.3-.3 4.2-8 4.4-10.7.6-7 .5-16.7-8-15.6z" fill="#028d2c"/><path d="m28 212c-3 .5-9 3-9.7 6.6 0 .7.3 1.4 0 2 0 .3-1.2 1-1.3 1.6-.1 2 1.3 13 5 12 1.6-.4 3.5-3.4 4.4-4.4l5.8-6c2-2 4.9-3.5 6.5-5.7 2.8-4-9.2-6.2-10.7-6z" fill="#d38d5f"/><path d="m278.6 146.6c-4 1-6.9 4-9.7 6.5-2.5 2.9-7.3 4.4-7 8.1-1 4.2.7 6.5 5.2 6.5 7.6 1.6 26-22.7 11.5-21z" fill="#028d2c"/><path d="m114.8 212.6c-2 .1-6.9 1.6-7.6 3.9-.8 2.8 5.1 5.7 6.8 7.3l6 5.7c1.3 1.3 3 5 5.2 5 3.3 0 3.8-12.8 3.2-14a13.6 13.6 0 0 0 -13.6-8z" fill="#d38d5f"/><path d="m98.6 254.6c-1 0-2.2.8-3 1.3-4 2-4 6.6-4 10.4 0 6.4 7 7.8 11.7 7.8.3 0 .6 0 .8-.2 7.8-6.7 4.2-19.3-5.5-19.3zm-52.4.4c-11.6 1.2-12.2 19.4 1 19.4 8.7 0 9.2-15.5 2.7-18.8a6.8 6.8 0 0 0 -3.7-.5z" fill="#1b1a18"/><path d="m289.2 61.1c-5.7 1-12.4 10-15 15.4-1.3 4 .2 8.4 5.1 7.5 4-.7 12.3-10.5 14.6-14.3 2.6-4.2-.5-9.4-4.7-8.6z" fill="#028d2c"/><path d="m31.7 290.3c0-5.6-1-10-2.9-15.1-1-3-7.3-20.3-9.3-20.6-5.6-1-15 26.7-14.2 32.4.9 5.6 13.1 10.7 17.3 8.5-2.4-2.5-1.7-5.2-1.7-9l.5-5.7c1.7-14.2 10.3 7.5 5.3 12.9 1.3 0 4-3.2 4.7-3.9z" fill="#29b0f2" stroke="#29b0f2"/><path d="m5 286.5c2.6 8.1 13 9.2 19.5 9.2 1.6 0 6-5 7-5.9 1.8 4-5.5 11.6-8.4 12.4-10.6 2.8-18-4.7-18-15.7z" fill="#2897e3" stroke="#2897e3"/><path d="m22.6 295.5c-3.3-.6-1.7-5.2-1.7-9l.5-5.7c2-15.5 13.7 16.8 1.2 14.7z" fill="#7bd1f9" stroke="#7bd1f9"/></svg>' );
// Image on the 404 error page
define( 'PAGE_404_IMAGE', '<svg role="image" class="logo-404" height="230" viewBox="0 0 114 50" width="428" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-label="404"><linearGradient id="a" gradientUnits="userSpaceOnUse" x1="104.6" x2="104.2" y1="33.1" y2="65"><stop offset="0" stop-color="#2a7fff"/><stop offset="1" stop-color="#2a7fff" stop-opacity="0.5"/></linearGradient><radialGradient id="b" cx="105.2" cy="59.6" gradientTransform="matrix(1.14621 -.0033 .00017 .0606 -16 56.5)" gradientUnits="userSpaceOnUse" r="57.3"><stop offset="0" stop-color="#ccc"/><stop offset="0.3" stop-color="#eee"/><stop offset="1" stop-color="#fff" stop-opacity="0"/></radialGradient><g transform="translate(-48 -14)"><ellipse cx="104.5" cy="59.8" fill="url(#b)" rx="56.6" ry="3.5"/><path d="m86.2 51.5h-4.5v8h-11v-8h-16.1v-8l17-25h10.2v24.8h4.5zm-15.4-8.2c0-3.6-.1-7.2.2-10.8-2.2 3.7-4.4 7-7 10.8zm47.7-68.1c0 5.3-.4 11-3.4 15.6-2.4 3.7-7 5.4-11.3 5.3-4.2.1-8.7-1.6-11-5.2a29 29 0 0 1 -3.8-16.7c.2-5.2.7-10.6 3.7-15 2.5-3.8 7.3-5.3 11.8-5 4.2 0 8.4 2 10.6 5.7 2.9 4.5 3.4 10 3.4 15.3zm-18.5 0c.1 3.4 0 6.9 1.1 10.1.5 1.7 2.8 2.7 4.3 1.5 1.7-1.6 1.7-4.3 2-6.5.2-4.6.4-9.3-.5-13.9-.3-1.6-1.4-3.7-3.4-3.4-2.1.2-2.8 2.6-3 4.4-.4 2.6-.5 5.2-.5 7.8zm53.2 76.3h-4.5v8h-10.9v-8h-16.3v-8l17-25h10.2v24.8h4.5zm-15.4-8.2c0-3.6 0-7.2.3-10.8l-7 10.8z" stroke="white" stroke-width="0.4"/><path id="Bear404" d="m112.6 17.8c9.3 3.8 14.9 11 15.4 20.3 0 12-10.7 21.7-23.9 21.7-13 0-23.7-9.7-23.7-21.7.2-9.4 7.8-17.4 15.3-20.3a25 25 0 0 1 16.9 0zm-8.4 20c-3 0-5.4 1.4-5.4 3.3 0 1.8 2.4 3.2 5.4 3.2s5.4-1.4 5.4-3.2c0-1.9-2.4-3.3-5.4-3.3zm6.7-8.4a2.8 2.8 0 1 0 0 5.6 2.8 2.8 0 0 0 0-5.6zm-13.3 0a2.8 2.8 0 1 0 0 5.6 2.8 2.8 0 0 0 0-5.6zm-8.6-15.2c2.4-.1 4.4 1.1 6 2.7-5.7 2-10.2 6.1-13 11.3-1.3-1.3-1.3-3.4-1.5-5 0-5 3.8-9 8.5-9zm30.7 0c-2.4-.1-4.3 1.1-6 2.7a24 24 0 0 1 13 11.3c1.3-1.4 1.4-3.4 1.5-5 0-5-3.8-9.1-8.5-9.1z" fill="url(#a)"/></g></svg><style>#Bear404 {transform-origin: 90% 95%;animation: BearRock 2s ease-in-out 0s alternate infinite;}@keyframes BearRock {0% { transform: rotate(-20deg) }100% { transform: rotate(20deg) }}</style>' );
// Message on the 404 error page
define( 'PAGE_404_CONTENT', "<p>Whoops... Well that page is gone.</p>
<p>But real talk, the page must have been removed, renamed or didn't exist in the first place. 🤔</p>" );


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

    // Setting Custom Fields
    add_post_meta( 'slug', 'Widgets_Slug', 'singlepage', true );
    //delete_post_meta_by_key( 'custom_field_name' ); // Delete custom field
});

// Enable styles and scripts
add_action('wp_enqueue_scripts', function(){    
    // Add Javascript to the bottom of the page body
    wp_enqueue_script( 'js-scripts', get_template_directory_uri() . "/assets/scripts/scripts.js", array(), THEME_VERSION, true );

    // Add stylesheets to the HEAD metadata
    wp_enqueue_style( 'tedilize-style', get_template_directory_uri() . "/assets/css/tedilize.css", array(), '2.0', 'all' );
    wp_enqueue_style( 'layout-style', get_template_directory_uri() . "/assets/css/layout.css", array(), THEME_VERSION, 'all' );
    wp_enqueue_style( 'base-style', get_stylesheet_uri(), array(), THEME_VERSION, 'all' );

    // Remove post comments
    wp_dequeue_script( 'comment-reply' );

    // Remove WordPress block library
    //wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    //wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
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

    // Add another post type to the editor
    register_post_type( ADDITIONAL_POST_TYPE, array(
        'labels' => array(
            'name'                  => _x( ADDITIONAL_POST_TYPE, 'Post type general name' ),
            'singular_name'         => _x( ADDITIONAL_POST_TYPE, 'Post type singular name' ),
            'menu_name'             => _x( ADDITIONAL_POST_TYPE, 'Admin Menu text' ),
            'name_admin_bar'        => _x( ADDITIONAL_POST_TYPE, 'Add New on Toolbar' ),
            'add_new'               => __( 'Add New' ),
            'add_new_item'          => __( 'Add New '.ADDITIONAL_POST_TYPE ),
            'new_item'              => __( 'New '.ADDITIONAL_POST_TYPE ),
            'edit_item'             => __( 'Edit '.ADDITIONAL_POST_TYPE ),
            'view_item'             => __( 'View '.ADDITIONAL_POST_TYPE ),
            'all_items'             => __( 'All '.ADDITIONAL_POST_TYPE.'s' ),
            'search_items'          => __( 'Search '.ADDITIONAL_POST_TYPE ),
            'parent_item_colon'     => __( 'Parent '.ADDITIONAL_POST_TYPE.':' ),
            'not_found'             => __( 'No '.ADDITIONAL_POST_TYPE.'s found.' ),
            'not_found_in_trash'    => __( 'No '.ADDITIONAL_POST_TYPE.'s found in Trash.' ),
            'featured_image'        => _x( 'Featured Image', '' ),
            'set_featured_image'    => _x( 'Set cover image', '' ),
            'remove_featured_image' => _x( 'Remove cover image', '' ),
            'use_featured_image'    => _x( 'Use as cover image', '' ),
            'archives'              => _x( ADDITIONAL_POST_TYPE.' archives', '' ),
            'insert_into_item'      => _x( 'Insert into '.ADDITIONAL_POST_TYPE,'' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this '.ADDITIONAL_POST_TYPE, '' ),
            'filter_items_list'     => _x( 'Filter '.ADDITIONAL_POST_TYPE.' list', '' ),
            'items_list_navigation' => _x( ADDITIONAL_POST_TYPE.' list navigation', '' ),
            'items_list'            => _x( ADDITIONAL_POST_TYPE.' list', '' ),
        ),
        'description'        => 'Additional post type (works, products, etc.)',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => sanitize_title(ADDITIONAL_POST_TYPE) ),
        'capability_type'    => 'post',
        'exclude_from_search'=> false,
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-book',
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'trackbacks', 'revisions', 'custom-fields' ),
        'taxonomies'         => array( 'category' ),
        'show_in_rest'       => true
    ));
});

// Append HTML metadata to the page head tag
add_action( 'wp_head', function(){
?>
<meta name="title" content="<?php bloginfo('name'); ?>">
<meta name="author" content="Ted Balmer | MarchTwenty.com">
<link rel="dns-prefetch" href="<?php echo esc_url(preg_replace("(^https?:)", '', home_url() )); ?>">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<link rel="Siteuri" href="<?php echo home_url(); ?>/" id="SiteURI">
<meta name="application-name" content="<?php bloginfo('name'); ?>">
<meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?>">
<meta name="description" content="<?php echo SEO_Excerpt(get_the_id()); ?>">
<meta name="format-detection" content="telephone=no">
<link rel="icon" href="<?php esc_url(printf("%s/favicon.ico", home_url())); ?>" sizes="any">
<link rel="icon" href="<?php esc_url(printf("%s/favicon.svg", home_url())); ?>" type="image/svg+xml">
<link rel="apple-touch-icon" href="<?php esc_url(printf("%s/icons/apple-touch-icon.png", home_url())); ?>">
<link rel="manifest" href="<?php esc_url(printf("%s/site.webmanifest", home_url())); ?>">
<meta property="og:locale" content="<?php echo get_bloginfo('language'); ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?php bloginfo('name'); ?>">
<meta property="og:url" content="<?php the_permalink(); ?>">
<meta property="og:title" content="<?php SEO_CharSwap(wp_title('|', true, 'right')); bloginfo('name'); ?>">
<meta property="og:description" content="<?php echo SEO_Excerpt(get_the_id()); ?>">
<meta property="og:image" content="<?php echo SEO_Image(get_the_id()); ?>">
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?php the_permalink(); ?>">
<meta property="twitter:title" content="<?php SEO_CharSwap(wp_title('|', true, 'right')); bloginfo('name'); ?>">
<meta property="twitter:description" content="<?php echo SEO_Excerpt(get_the_id()); ?>">
<meta property="twitter:image" content="<?php echo SEO_Image(get_the_id()); ?>">
<?php
    //addSchemaMetaData();
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

// Decactivate xml-rpc WordPress feature for security reasons
//add_filter( 'xmlrpc_enabled', '__return_false' );

// Add custom message to login screen
add_filter( 'login_message', function(){
    return '<h2 style="text-align:center">Welcome to m20T1</h2>';
});

// Set the excerpt length
add_filter( 'excerpt_length', function(){
    return EXCERPT_LENGTH; // Number of Words
});

// Add a 'Continue Reading' link to excerpts
add_filter( 'excerpt_more', function(){
    return ' <span class="entry-read-more" aria-label="Read more">' . MORE_TEXT . '</span>';
});

// Change the WordPress editor's footer text
add_filter( 'admin_footer_text', function(){
    return ' <i><a href="https://www.wordpress.org/" target="_blank">WordPress</a> theme brought to you with 💙 by <a href="https://github.com/midkiffaries/m20T1" target="_blank">m20T1 ' . THEME_VERSION . '</a>.</i>' ;
});

// Add additional contact methods to user profiles
add_filter( 'user_contactmethods', function(){
    return array(
        'linkedin' => 'LinkedIn',
        'twitter'  => 'Twitter',
        'facebook' => 'Facebook',
    );
});

// Alter the site custom logo
add_filter( 'get_custom_logo', function(){
    if (has_custom_logo()) {
        return wp_get_attachment_image( get_theme_mod('custom_logo'), 'full', false, array('class' => 'custom-logo', 'srcset' => '') );
    } else {
        return bloginfo('name');
    }
});

// Add addition file types to be uploaded to the media library
function add_custom_mime_types( $mimes ) {
    $mimes['svg']  = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    $mimes['html'] = 'text/html';
    $mimes['txt']  = 'text/plain';
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter( 'upload_mimes', 'add_custom_mime_types' );


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

// Get 'Widgets_Slug' Custom Field which changes the sidebar selection
// SLUGS: primary, secondary, tertiary, singlepost, frontpage, singlepage, singlepagesidebar, header, footer
function selectSidebarCustomField($id, $default) {
    $key = get_post_meta( $id, 'Widgets_Slug', true );
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
                <div class="child-card__image"><img src="<?php echo esc_url(FeaturedImageURL($child->ID, 'medium', 0)); ?>" loading="lazy" decoding="async" alt=""></div>
                <div class="child-card__title"><?php echo $child->post_title; ?></div>
                <div class="child-card__text"><?php echo $child->post_excerpt; ?></div>
            </a>
        </div>
    <?php }
}


/////////////////////////////
// Specialized Functions
/////////////////////////////

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

// Get WordPress page title and content for the blog list page (index.php)
function GetPageTitle($id) {
    $page_for_posts_obj = get_post( get_option( $id ));
    return apply_filters( 'the_content', $page_for_posts_obj->post_content );
}

// Shorten the_content in place of using the_excerpt for more control
function shorten_the_content($post) {
    $regex_figure = "/<figure[^>]*>([\s\S]*?)<\/figure[^>]*>/"; // Remove figure/figcaption
    $regex_url = "@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?).*$)@"; // Remove URLs
    $excerpt = preg_replace($regex_figure, ' ', html_entity_decode($post));
    $excerpt = preg_replace($regex_url, ' ', html_entity_decode(wp_strip_all_tags($excerpt, true)));
    return wp_trim_words($excerpt, SHORT_TEXT_LENGTH, ' <span class="entry-read-more">' . MORE_TEXT . '</span>');
}

// Separator that breaks up a post's metadata
function post_separator() {
    return '<span class="entry-separator">' . POST_SEPARATOR . '</span>';
}

// Append the proper size units to a file size 
function file_units($file) {
    $filesizeunits = array(' Bytes', ' KB', ' MB', ' GB', ' TB');
	if (file_exists($file)) {
        return round($file/pow(1024, ($i = floor(log($file, 1024)))), 2) . $filesizeunits[$i];
    } else {
        return 'N/A';
    }
}

// Get the the image information and file size
function image_metadata($filename) {
    $size = file_units(wp_filesize($filename));
    if (@is_array(getimagesize($filename))) {
        list($width, $height, $type, $attr) = getimagesize($filename);
        return "File: " . image_type_to_mime_type($type) . " – Dimensions: " . $width . "x" . $height . "px – Size: " . $size;
    } else {
        return "File: document – Size: " . $size;
    }
}


/////////////////////////////
// SEO and Header Functions
/////////////////////////////

// Swaps certain special characters with words for SEO purposes
function SEO_CharSwap($string) {
    $string = preg_replace('/\%/', 'percent', $string); 
    $string = preg_replace('/\&/', 'and', $string); 
    return trim($string);
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
function SEO_Image($id) {
    // Get page featured image
    if (has_post_thumbnail($id)) { // Use page's featured image
        $featuredImage = get_the_post_thumbnail_url($id, 'large');
    } else { // Use default image
        $featuredImage = SOCIAL_IMAGE;
    }
    return esc_url($featuredImage);
}


/////////////////////////////
// Featured Image Fallbacks
/////////////////////////////

// Get the post/page featured image url or use fallback if none available ($size = thumbnail, medium, medium_large, large, full)
function FeaturedImageURL($id, $size, $isBackground) {

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
            return BLANK_IMAGE;
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
function Header_Hero($id) {
    // Type of page
    if ( is_front_page() ) { // Front-page header (None)
        $className = "homepage";
        $hasFeaturedImage = false;
    } elseif ( is_attachment() || is_404() ) { // Attachment and 404 page headers (None)
        $className = "noimage";
        $hasFeaturedImage = false;
    } elseif ( is_page() ) { // Basic Page and privacy-policy header (Use Featured Image)
        $className = "single-page";
        $hasFeaturedImage = true;
    } elseif ( is_single() ) { // Single blog post (Use Featured Image)
        $className = "single-post";
        $hasFeaturedImage = true;
    } else { // Blog Page, search page and archives header (Use default Image)
        $className = "noimage";
        $hasFeaturedImage = false;
    }

    // Get the featured image and image caption if exists or fallback to blank image
    if ($hasFeaturedImage) {
        $featuredImage = FeaturedImageURL($id, 'full', 1);
        $attachmentTitle = '<a href="'. home_url() . '/?p='.get_post_thumbnail_id($id).'">' . wp_get_attachment_caption(get_post_thumbnail_id($id)) . '</a>';
    } else {
        $attachmentTitle = "";
    }

    ?>
        <div class="header-hero-image header-<?php echo $className; ?>" style="<?php echo $featuredImage; ?>" data-rate="10">
            <div class="header-hero-gradient"></div>
            <div class="header-hero-overlay"></div>
            <div class="header-hero-caption"><?php echo $attachmentTitle; ?></div>
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

// Get a blog post's reading time
function reading_time() {
    $wordcount = str_word_count(wp_strip_all_tags(get_the_content()));
    $time = ceil($wordcount / 200);
    return "{$time} min read";
}

// Get the file extension from a path
function get_file_extension($path) {
    $extension = wp_check_filetype($path);
    return $extension['ext'];
}

// Get proper attachment image or use a document placeholder 
function attachment_page_image($id) {
    $image_ext = array('jpg', 'jpeg', 'png', 'gif', 'webp', 'ico');
    $video_ext = array('mp3', 'ogg', 'mp4', 'm4v', 'mov', 'wmv', 'avi', 'webm', 'mpg', 'ogv', '3gp', '3g2');
    
    $fileExt = get_file_extension(wp_get_attachment_url($id));

    // Check if attachment matches the extension images array
    foreach ($image_ext as $ext) {
        if (strpos($fileExt, $ext) !== FALSE) {
            return wp_get_attachment_image($id, 'large', 0, array('loading' => '')); // Return attachment
        }
    }

    // Check if attachment matches the extension video array
    foreach ($video_ext as $ext) {
        if (strpos($fileExt, $ext) !== FALSE) {
            return '<svg xmlns="http://www.w3.org/2000/svg" width="512" height="512"><path d="m192 192 160 112-160 112V192z" fill="red"/><path d="M458.9 114.5c-11.1-15.1-26.6-32.8-43.6-49.8S380.6 32.2 365.5 21C339.7 2.1 327.2 0 320 0H72C50 0 32 18 32 40v432c0 22 18 40 40 40h368c22 0 40-18 40-40V160c0-7.2-2.2-19.7-21.1-45.5zm-66.2-27.2A436.4 436.4 0 0 1 429 128h-77V51a436 436 0 0 1 40.7 36.3zM448 472c0 4.3-3.7 8-8 8H72c-4.3 0-8-3.7-8-8V40c0-4.3 3.7-8 8-8h248v112a16 16 0 0 0 16 16h112v312z" fill="darkred"/></svg>'; // Return attachment
        }
    }

    // Check if attachment is SVG file or other document
    if ($fileExt == 'svg' || $fileExt == 'svgz') { // SVG Images
        return '<img src="' . wp_get_attachment_url($id) . '" alt="' . wp_get_attachment_caption($id) . '" loading="lazy" decoding="sync" class="attachment-svg">';
    } else { // All other documents types
        return '<svg id="GenericDoc" xmlns="http://www.w3.org/2000/svg" width="512" height="512"><path d="M458.9 114.5c-11.1-15.1-26.6-32.8-43.6-49.8S380.6 32.2 365.5 21C339.7 2.1 327.2 0 320 0H72C50 0 32 18 32 40v432c0 22 18 40 40 40h368c22 0 40-18 40-40V160c0-7.2-2.2-19.7-21.1-45.5zm-66.2-27.2A436.4 436.4 0 0 1 429 128h-77V51a436 436 0 0 1 40.7 36.3zM448 472c0 4.3-3.7 8-8 8H72c-4.3 0-8-3.7-8-8V40c0-4.3 3.7-8 8-8h248v112a16 16 0 0 0 16 16h112v312z" fill="dodgerblue"/><path d="M368 416H144a16 16 0 0 1 0-32h224a16 16 0 1 1 0 32zm0-64H144a16 16 0 0 1 0-32h224a16 16 0 1 1 0 32zm0-64H144a16 16 0 0 1 0-32h224a16 16 0 1 1 0 32z" fill="lightblue"/></svg>';
    }
}

// Blog post user comment HTML and formatting for each comment
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
    previous_posts_link("&#x276E; Previous " . get_option('posts_per_page') . " {$type}", 0); // << Left Side
    next_posts_link("Next " . get_option('posts_per_page') . " {$type} &#x276F;", 0); // Right Side >>
}

// Show the blog post tags as a list
function blog_post_tags() {
    return the_tags('<ul role="list"><li rel="tag">', '</li><li rel="tag">', '</li></ul>');
}

// Create a unique body main page class for all pages "page-{slug}"
function get_page_class() {
    return 'page-' . preg_replace('/\s+/', '-', get_post_field( 'post_name', get_post() ));
}

// List social sharing links on each blog post
function blog_post_share() {
    // Social media links
    $social_links = array(
        'facebook'  => "https://www.facebook.com/sharer/sharer.php?u=" . esc_url(get_the_permalink()),
        'twitter'   => "https://twitter.com/intent/tweet?text=" . esc_url(get_the_permalink()),
        'linkedin'  => "https://www.linkedin.com/shareArticle?mini=true&url=" . esc_url(get_the_permalink()) . "&title=" . urlencode(get_the_title()) . "&summary=" . urlencode(get_the_excerpt()) . "&source=" . urlencode(get_bloginfo('name')),
        'pinterest' => "https://pinterest.com/pin/create/button/?url=" . esc_url(get_the_permalink()) . "&media=" . urlencode(SEO_Image(get_the_id())) . "&description=" . urlencode(get_the_excerpt()),
        'reddit'    => "https://www.reddit.com/submit?url=" . esc_url(get_the_permalink()),
    );
?>
    <ul role="list" class="post-social-share" aria-label="Share on social media">
        <li><a href="<?php echo $social_links['twitter']; ?>" class="twitter-share" aria-label="Share on Twitter" rel="noopener noreferrer" target="_blank">Tweet</a></li>
        <li><a href="<?php echo $social_links['facebook']; ?>" class="facebook-share" aria-label="Share on Facebook" rel="noopener noreferrer" target="_blank">Share</a></li>
        <li><a href="<?php echo $social_links['linkedin']; ?>" class="linkedin-share" aria-label="Share on LinkedIn" rel="noopener noreferrer" target="_blank">Share</a></li>
        <li><a href="<?php echo $social_links['pinterest']; ?>" class="pinterest-share" aria-label="Share on Pinterest" rel="noopener noreferrer" target="_blank">Pin It</a></li>
        <li><a href="<?php echo $social_links['reddit']; ?>" class="reddit-share" aria-label="Share on Reddit" rel="noopener noreferrer" target="_blank">Share</a></li>
    </ul>
<?php
}


//////////////////////////////////////
// Additional Columns for the editor
//////////////////////////////////////

// Add Featured Image column
function AddImageColumn($columns) {
    $columns['thumbnail'] = __('Image');
    return $columns;
}

// Add Featured Image values
function AddImageValue($column_name, $post_id) {
	if ( $column_name == 'thumbnail' ) {
		$post_thumbnail_id = get_post_thumbnail_id( $post_id );
		if ( $post_thumbnail_id ) {
			$post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail' );
            echo '<img src="' . $post_thumbnail_img[0] . '" width="90" height="90" loading="lazy" decoding="sync" alt="">';
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
function AddExcerptColumn($columns) {
    $columns['seo_excerpt'] = __('SEO Excerpt');
    return $columns;
}

// Add SEO Excerpt values
function AddExcerptValue($column_name, $post_id) {
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


//////////////////////////////////////
// Schema meta data
//////////////////////////////////////

// Display schemea data under a script tag
function addSchemaMetaData() {
?>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "NewsArticle",
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "<?php the_permalink(); ?>"
    },
    "headline": "<?php SEO_CharSwap(wp_title(null, true, 'right')); ?>",
    "image": [
        "<?php echo SEO_Image(get_the_id()); ?>"
    ],
    "datePublished": "<?php printf(get_the_date('c')); ?>",
    "description": "<?php echo SEO_Excerpt(get_the_id()); ?>",
    "articleBody": "<?php echo SEO_Excerpt(get_the_id()); ?>",
    "articleSection": "<?php echo get_the_category()[0]->name; ?>",
    "keywords": "<?php echo get_the_tags()[0]->name; ?>",
    "name": "<?php SEO_CharSwap(wp_title(null, true, 'right')); ?>",
    "author": {
        "@type": "Person",
        "name": "<?php get_the_author_meta('id'); ?>"
    },
    "publisher": {
        "@type": "Organization",
        "name": "<?php bloginfo('name'); ?>",
        "logo": {
            "@type": "ImageObject",
            "url": "<?php echo wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full')[0]; ?>"
        }
    }
}
</script>
<?php
}