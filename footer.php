
<footer class="page-footer" role="contentinfo">
    <div id="footer-widgets" class="footer-widgets">
        <?php if (is_active_sidebar( 'footer' )) : ?>
        <?php dynamic_sidebar( 'footer' ); ?>
        <?php endif; ?>
    </div>

    <div class="footer-slogan"><?php bloginfo('description'); ?></div>

    <div class="footer-notice">
        <p class="copyright" rel="license">Copyright &copy; <abbr title="<?php echo date('Y'); ?>" aria-label="<?php echo date('Y'); ?>"><?php echo numberToRoman(date('Y')); ?></abbr> <?php bloginfo('name'); ?></p>
        <p class="footnote" rel="author">Site designed and developed by <a href="https://www.marchtwenty.com/" class="icon-bear">Ted Balmer</a>.</p>
    </div>
</footer>

<?php wp_footer(); ?>

<script src="<?php echo get_template_directory_uri(); ?>/assets/scripts/scripts.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/scripts/modals.js"></script>

</body>
</html>