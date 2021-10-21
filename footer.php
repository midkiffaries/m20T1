
<footer class="page-footer" role="contentinfo">
    <div id="footer-widgets" class="footer-widgets">
        <?php if (is_active_sidebar( 'footer' )) : ?>
        <?php dynamic_sidebar( 'footer' ); ?>
        <?php endif; ?>
    </div>

    <div class="footer-slogan"><?php bloginfo('description'); ?></div>

    <div class="footer-notice">
        <p class="copyright">Copyright &copy; <abbr title="<?php echo date('Y'); ?>" aria-label="<?php echo date('Y'); ?>"><?php echo numberToRoman(date('Y')); ?></abbr> <?php bloginfo('name'); ?>. All rights reserved. <a href="<?php echo home_url(); ?>/privacy-policy/" rel="license">Privacy Policy</a></p>
        <p class="footnote"><a href="https://github.com/midkiffaries/m20T1" class="wp-theme-title"><?php echo wp_get_theme()->get('Name') . " " . wp_get_theme()->get('Version'); ?> theme</a> designed and developed by <a href="https://www.marchtwenty.com/" class="icon-bear">Ted Balmer</a>.</p>
    </div>
</footer>

<?php wp_footer(); ?>

<script src="<?php echo get_template_directory_uri(); ?>/assets/scripts/scripts.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/scripts/modals.js"></script>

</body>
</html>