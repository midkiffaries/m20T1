<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php // Background embellishments ?>
<div class="body-top-background"></div>
<div class="body-bottom-background"></div>

<footer class="page-footer">
    <div id="footer-widgets" class="footer-widgets">
        <?php dynamic_sidebar( 'footer' ); // Footer Widgets ?>

        <div class="footer-load-time">Page loaded in <span id="PageLoadTime"></span>s</div>
    </div>

    <div class="footer-notice">
        <hr class="footer-rule">
        <div class="footer-copyright">Copyright &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</div>
        <div class="footer-footnote">
            <a href="https://github.com/midkiffaries/m20T1" class="wp-theme-title"><?php echo wp_get_theme()->get('Name'); ?> Theme</a> | 
            <a href="<?php echo esc_url(home_url()); ?>/privacy-policy/" rel="license">Privacy Policy</a>
        </div>
    </div>
</footer>

<?php wp_footer(); // Wordpress generated data and scripts ?>

</body>
</html>