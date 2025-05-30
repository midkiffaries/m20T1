<?php defined( 'ABSPATH' ) || exit; // Exit if accessed directly ?>

    <div class="body-bottom-background"><?php // Background embellishment ?></div>

    <footer class="page-footer">
        <div id="footer-widgets" class="footer-widgets">
            <?php dynamic_sidebar( 'footer' ); // Footer Widgets ?>

            <div class="footer-load-time">Page loaded in <span id="PageLoadTime"></span>s</div>
        </div>

        <div class="footer-notice">
            <div class="footer-copyright" itemprop="copyrightNotice">&copy; <time datetime="<?=date('Y');?>" itemprop="copyrightYear"><?=date('Y'); ?></time> <?=bloginfo('name');?>. All rights reserved.</div>
            <div class="footer-footnote">
                <a href="https://github.com/midkiffaries/m20T1" class="wp-theme-title">m20T1 Theme</a> | 
                <a href="<?=esc_attr(esc_url(get_privacy_policy_url()));?>" rel="license" itemprop="license">Privacy Policy</a>
            </div>
        </div>
    </footer>

</div>

<?=custom_page_css(get_the_ID());?>

<?=wp_footer(); // WordPress generated data and scripts ?>

</body>
</html>