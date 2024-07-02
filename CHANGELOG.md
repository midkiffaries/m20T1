# Changes to m20T1 WordPress Theme

### 1.7.8 Live (July 20, 2024)

* Support for Wordpress 6.6.0.
* Added SEO Keyphrase and count to the Advanced Options panel.
* Removal of some of font and color values from tedilize.css.
* Improvements and additions to theme.json in the way of shadows and removal of them from the stylesheets.
* Bug fixes and code cleanup.

### 1.7.7 Live (June 18, 2024)

* Support for Wordpress 6.5.4.
* Removal of some unnecessary -webkit- and -moz- prefixes from stylesheets.
* Bug fixes and code cleanup.

### 1.7.6 Live (June 1, 2024)

* Rewrote parallaxing background feature for the page header and overrides WordPress's ".has-parallax" call.
* Adjustments to the header hero HTML.
* Improvements to entering code into text boxes.
* Removed more personal branding.
* Bug fixes and improvements.

### 1.7.5 Live (May 17, 2024)

* Media library: Added filtering for SVG, WOFF2 and GLB files as well as by author and category.
* Bug fixes and QoL improvements.

### 1.7.4 Live (May 12, 2024)

* Shortcode implementation for listing all post types: 
[list-posts posts="5" post_type="portfolio" order="asc" orderby="title" thumbnail="1" excerpt="1" category="" id="" class=""]
* JavaScript clean up.
* Bug fixes and QoL improvements.

### 1.7.3 Live (May 7, 2024)

* Added image previews in the Theme Settings page.
* Removal of some of my personal branding.
* Overall optimizations, bug fixes and adjustments.

### 1.7.2 Live (May 1, 2024)

* The main body layout has been switched to CSS grid.
* Videos can be used in the header/hero image slot.
* Adjustments and bug fixes.

### 1.7.1 Live (April 12, 2024)

* Bug fixes with the CSS.
* Adjustments and additions to the schema presentation.

### 1.7.0 Live (March 30, 2024)

* Added a new Advanced Options meta box to the post/page editor to edit the post's specific CSS. This replaces the Custom Fields option.
* Added basic Schema.org page type selector to the Advanced Options meta box and to the Theme Settings page.
* Changed the additional post type mechanism to make it easier to make more than one post type - still hard coded.
* Increased the JPEG image compression when the media library creates images.
* Changed the Twitter icon to the X thing.
* Added options to sort search results.
* Menu item descriptions are available.
* Support for WordPress 6.5.
* Bug fixes and code cleanup.

### 1.6.5 Live (December 2, 2023)

* More code clean up and tweaks.
* Adjustments to attachment.php.
* (WiP) Initial basic WooCommerce support.

### 1.6.4 Live (November 8, 2023)

* Support for WordPress 6.4.
* Support for (.GLB files) WebGL models and (.TTF & .WOFF2) fonts in the media library.
* Lots of little tweaks and more bug fixes.

### 1.6.3 Live (October 27, 2023)

* Bug fixes and more code adjustments.

### 1.6.2 Live (September 9, 2023)

* Forgot that I had the contact form shortcode hard-coded in so I made a new entry in the m20T1 settings page.

### 1.6.1 Live (September 8, 2023)

* Bug fixes and code clean up.
* Admin page adjustments.
* Now requires PHP 8.0+ 

### 1.6.0 Live (September 6, 2023)

* Inclusion of an additional settings page that contains user created global metadata for the header and footer, excerpt length control, custom 404 page text and image, and other important default image settings. This moves some of the variable settings out of the top of functions.php.
* A few bug fixes.

### 1.5.0 Live (August 30, 2023)

* Accordion mechanism added to the sidebar on pages where it sits to the right of the main content.
* Proper styling of the child pages block.
* Addition of a new panel to the dashboard that provides notes on the theme.
* More CSS and PHP adjustments.
* Removal of a few more unnecessary files.

### 1.4.7 Live (August 22, 2023)

* More adjustments to the SVG presentation on the front and back ends.
* Even more CSS adjustments throughout.

### 1.4.6 Live (August 19, 2023)

* A couple of quick fixes.

### 1.4.5 Live (August 18, 2023)

* Small CSS bug fixes. 
* Adjustments to the PHP. 
* JavaScript fixes and enhancements to the lightbox script.

### 1.4.4 Live (August 14, 2023)

* Compatible with WordPress 6.3.
* Minor CSS Adjustments.
* New custom Footnote block styling.

### 1.4.3 Live (August 3, 2023)

* Inclusion of a basic page view counter.
* Improvements to the column spacing in the editor.
* CSS optimizations and clean up.

### 1.4.2 Live (July 26, 2023)

* The addition of a Custom Field ("Page_CSS") for embedding page-specific CSS into a page or post.
* Removal of marchtwenty.com page specific CSS from style.css.
* Added more custom CSS to the editor-style stylesheet to better balance things.
* More code cleanup that I missed.

### 1.4.1 Live (July 17, 2023)

* Inclusion of more metadata in the header.
* Some minor bug and formating fixes throughout.

### 1.4 Live (July 10, 2023)

* More enhancements to the custom post type code and features.
* Added a Last Login column to the Users page and to the author archives page.
* Adjustments to the overall CSS.

### 1.3.14 Live (June 14, 2023)

* Proper inclusion of SVG image support, which included the removal of the srcset for SVG images.

### 1.3.13 Live (June 12, 2023)

* Fixes to the @media print formatting and other CSS trickery.

### 1.3.12 Live (June 9, 2023)

* Adjustments and additions to the user profile section.
* Bug fixes.

### 1.3.11 Live (June 4, 2023)

* More code cleanup and Portfolio post type related enhancements.

### 1.3.10 Live (May 28, 2023)

* Improvements to the additional post types. You can now assign a WordPress Page of the same title to be the root page.
* Bug fixes.

### 1.3.9 Live (May 25, 2023)

* More House cleaning!
### 1.3.8 Live (May 18, 2023)

* House cleaning.

### 1.3.7 Live (May 10, 2023)

* A lot of minor adjustments and fixes to... everything.

### 1.3.6 Live (May 4, 2023)

* More improvements to the schema.org microdata and accessibility enhancements. The embedded schema data can almost replace plugins at this point. 
* May the fourth be with you...

### 1.3.5 Live (May 2, 2023)

* Improvements to the schema microdata and other tweaks.

### 1.3.4 Live (April 30, 2023)

* Adjustments to the social sharing in the header metadata.
* Adjustment and additions to the microdata in the HTML.

### 1.3.3 Live (April 29, 2023)

* Minor bug fixes and inclusion of vCard and iCalendar media library upload support.

### 1.3.2 Live (April 16, 2023)

* Adjustments to the additional post type content (Portfolio) and added a unique page to display those post types.

### 1.3.1 Live (April 5, 2023)

* Bug fixes and minor accessibility enhancements.

### 1.3.0 Live (March 28, 2023)

* Included a few more features, such as: Page load timer in the footer and hero image caption and link.
* More code clean up and bug fixes.

### 1.2.1 Live (Febuary 16, 2023)

* Fixed/removed code causing issues with PHP 8.x. Fixed a number of other small bugs.

### 1.2.0 Live (Febuary 15, 2023)

* Added SEO Excerpt and Image Thumbnail columns to the Posts and Pages sections.

### 1.1.0 Live (January 11, 2023)

* Made a lot of adjustments to the code since launching the live site.

### 1.0.0 Live (November 14, 2022)

* This is the live release that is now being used on my personal website. As such I consider this theme largely complete.
* Code clean up.

### 1.0 Beta 1 (August 10, 2022)

* Implemented more WordPress features.
* More code clean up.

### 1.0 Alpha 9 (July 28, 2022)

* Re-implemented the contact form and changed how the contact and search forms are stored and retrieved.
* Eliminating unnecessary assets and cleaning up code.

### 1.0 Alpha 8 (July 19, 2022)

* Even more clean up, readjustments and tidying up. 
* Eliminating unnecessary assets and enabling other assets.
* Close to moving to Beta.

### 1.0 Alpha 7 (May 4, 2022)

* More clean up, readjustments and tidying up.

### 1.0 Alpha 6 (February 11, 2022)

* More clean up and readjustments.
### 1.0 Alpha 5 (January 28, 2022)

* Even more optimizations and code clean up.
* Changes to the theme.json and functions.php.
* Child pages will auto list at the bottom of page.php and page-*.php
* Ready for WordPress 5.9.
### 1.0 Alpha 4 (January 9, 2022)

* More optimizations and code clean up. Removal of a number of unnecessary assets.

### 1.0 Alpha 3 (November 21, 2021)

* Added CHANGELOG.md file.
* Added "Skip to main content" link in the header.
* More optimizations and code clean up. This is pretty close to being wrapped up.

### 1.0 Alpha 2 (November 6, 2021)

* This is the second Alpha version of m20T1 WordPress theme. This update contain refinements and improvements to the code and presentation. It also removes my unnecessary personal configuration files.

### 1.0 Alpha 1 (October 11, 2021)

* This is the first Alpha version of m20T1 WordPress theme. Everything should be in place and working, but some elements need some refinement and debugging.