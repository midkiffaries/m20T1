<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

    <div class="body-bottom-background"><?php // Background embellishments ?></div>

    <footer class="page-footer">
        <div id="footer-widgets" class="footer-widgets">
            <?php dynamic_sidebar( 'footer' ); // Footer Widgets ?>

            <div class="footer-load-time">Page loaded in <time id="PageLoadTime"></time>s</div>
        </div>

        <div class="footer-notice">
            <hr class="footer-rule">
            <div class="footer-copyright" itemprop="copyrightNotice">Copyright &copy; <time datetime="<?=date('Y');?>" itemprop="copyrightYear"><?=date('Y'); ?></time> <?=bloginfo('name');?>. All rights reserved.</div>
            <div class="footer-footnote">
                <a href="https://github.com/midkiffaries/m20T1" class="wp-theme-title"><?=wp_get_theme()->get('Name');?> Theme</a> | 
                <a href="<?=esc_url(home_url());?>/privacy-policy/" rel="license" itemprop="license">Privacy Policy</a>
            </div>
        </div>
    </footer>

</div>

<?php wp_footer(); // WordPress generated data and scripts ?>

</body>
</html>