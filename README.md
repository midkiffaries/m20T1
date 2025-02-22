# m20T1 - WordPress Theme

[![Generic badge](https://img.shields.io/github/v/release/midkiffaries/m20T1?include_prereleases&style=for-the-badge)](https://github.com/midkiffaries/m20T1/releases/)
![GitHub](https://img.shields.io/github/license/midkiffaries/m20T1?color=blue&style=for-the-badge)

[![Generic badge](https://img.shields.io/badge/Language-php-blue.svg)](https://github.com/midkiffaries/m20T1/search?l=php)
[![Generic badge](https://img.shields.io/badge/Language-javascript-red.svg)](https://github.com/midkiffaries/m20T1/search?l=javascript)
[![GitHub last commit](https://img.shields.io/github/last-commit/midkiffaries/m20T1)](https://github.com/midkiffaries/m20T1/commits)
[![GitHub issues](https://img.shields.io/github/issues/midkiffaries/m20T1)](https://github.com/midkiffaries/m20T1/issues)
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/midkiffaries/m20T1)
[![CodeFactor](https://www.codefactor.io/repository/github/midkiffaries/m20t1/badge)](https://www.codefactor.io/repository/github/midkiffaries/m20t1)

<img src="https://github.com/midkiffaries/m20T1/assets/19917696/66c00a43-0a34-46d7-a25e-ef0491c50a52" alt="Screenshot" width="300" align="right" />

This is a light-weight, feature-rich <a href="https://wordpress.org/">WordPress</a> theme that I created from scratch, that I use on my own website. The intention of this theme is to be minimally reliant on 3rd party plugins while providing the same features that most popular plugins would provide. It does this by relying on the built-in WordPress automation and features. This theme is built to be easy to work with from a coding standpoint.

Link: <a href="https://www.marchtwenty.com/2023/08/how-this-website-was-made/">m20T1 theme screenshots and additional information</a>

## Features
<img src="https://github.com/midkiffaries/m20T1/assets/19917696/57ae6991-b599-44fd-96f1-bd456f2b1cc4" alt="Screenshot" width="300" align="right" />

- Compatible with WordPress 6.7+
- Theme requires PHP 8.0+
- Built with extensive technical SEO implementation and social media sharing in mind
- Schema.org structured micro data autonomously generated for each page
- Built in image lightbox, via nested <code>figure</code> <code>a</code> <code>img</code>
- Custom JavaScript modals for <i>alerts/confirmation</i> and <i>custom HTML content</i>
- Custom admin settings page to allow for the inclusion of additional metadata in the header, as well as content settings to the 404, search error page and post excerpt length: <b>Appearance -> Theme Settings</b>
- Widget support on on all pages including the site header and footer
- Unique <i>front-page.php</i>, <i>404.php</i> and <i>attachment.php (image)</i> pages
- Featured image support for use as the hero/header image on posts and pages with a fallback image
- Support for custom WordPress editor styling via <b>theme.json</b>
- Support for <b>dark mode</b> page styling via a built in switch
- Additional filtering options in the Media Library: category, author, SVG, GLB and fonts
- Basic filtering on the search results page
- Built in support for <b>additional post types</b>, default set as "Portfolio" (hardcoded in <i>functions.php</i>)
- Built in blog post read time in minutes and page load time.
- Enabled <b>SVG</b> support, <b>GLB</b> 3D models, <b>WOFF2</b> fonts and iCal/vCard file upload to the media library
- Support for global <i>@print</i> on all pages and posts
- Built in shortcode post list function: <code>[list-posts posts="5" post_type="portfolio" order="asc" orderby="title" thumbnail="1" excerpt="1" post_status="publish" category="" id="" class=""]</code>

## Todo List
<img src="https://github.com/midkiffaries/m20T1/assets/19917696/012a850d-dce2-46ab-adb8-c7aff033fe13" alt="Screenshot" width="300" align="right" />

- Seperating my personallized styling from style.css
- Fix page layout to allow for full width elements
- Improve the pagination
- Create a seperate panel in the editor for SEO and post statistics

## How to use this theme
This theme is not available on the official WordPress theme library. In order to use it on your own WordPress site, you first need to upload/FTP the folder <code>/m20T1-1.x.x-Live/</code> into <code>/wp-content/themes/</code>. From there the <b>m20T1</b> should automatically appear under "Appearance -> Themes" in your WordPress admin section. 

FYI, this theme is configured for my personal website. I did however keep the personalized features and styles limited to <code>theme.json</code> and <code>style.css</code> files. You will need to go into those files to make necessary adjustments to the visuals and other configuration changes.

## Disclaimer
This WordPress theme is just a personal pet project of mine, and I am happy to share the code, however, there really is no support for it other than any issues that I come across while working on it for my personal website.

## About Me
Follow these links to learn more about me and my work:
- <a href="https://www.linkedin.com/in/tedbalmer/">My LinkedIn Profile</a>
- <a href="https://www.marchtwenty.com/">My Personal Website</a>

<a href="https://github.com/midkiffaries/m20T1/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=midkiffaries/m20T1" alt="My Avatar" />
</a>