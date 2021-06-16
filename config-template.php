<?php
// m20 Theme Config
$ThemeSettings = '{
    "ShortTitle":   "Short Website Name",
    "Email":        "contact@email.com",
    "BaseColor":    "#ffffff",
    "Tagline":      "Extended tag line...",
    "Instagram":    "accountName",
    "Twitter":      "accountName",
    "GoogleFonts":  "<link rel=\"stylesheet\" href=\" \">"
}';

$config = json_decode($ThemeSettings);

//$ThemeSettings = file_get_contents('config.json');
//$config = json_decode($ThemeSettings);

/*
WordPress plugins used in this theme:
Breadcrumb Trail - https://wordpress.org/plugins/breadcrumb-trail/
Quick Featured Images - https://wordpress.org/plugins/quick-featured-images/
XML Sitemaps - https://wordpress.org/plugins/google-sitemap-generator/
*/

?>