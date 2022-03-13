
<footer class="page-footer" role="contentinfo">
    <div id="footer-widgets" class="footer-widgets">
        <?php dynamic_sidebar( 'footer' ); // Footer Widgets ?>
    </div>

    <div class="footer-slogan"><?php bloginfo('description'); // Blog Slogan ?></div>

    <div class="footer-notice">
        <hr class="footer-rule">
        <div class="footer-copyright">Copyright &copy; <abbr title="<?php echo date('Y'); ?>" aria-label="<?php echo date('Y'); ?>"><?php echo numberToRoman(date('Y')); ?></abbr> <?php bloginfo('name'); ?>. All rights reserved.</div>
        <div class="footer-footnote"><a href="https://github.com/midkiffaries/m20T1" class="wp-theme-title icon-bear"><?php echo wp_get_theme()->get('Name'); ?> Theme</a> | <a href="<?php echo esc_url(home_url()); ?>/privacy-policy/" rel="license">Privacy Policy</a></div>
    </div>
</footer>

<?php wp_footer(); // WordPress generated meta data and scripts ?>

</body>
</html>