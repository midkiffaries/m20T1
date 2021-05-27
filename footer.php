
<footer class="page-footer">
    <?php menu_nav_list('Primary Nav', 'footer'); ?>
    
    <?php menu_nav_list('Social Links', 'footer'); ?>
    
    <p class="copyright" rel="license">Copyright &copy; <abbr title="<?php echo date('Y'); ?>" aria-label="<?php echo date('Y'); ?>"><?php echo numberToRoman(date('Y')); ?></abbr> <?php bloginfo('name'); ?></p>
    <p class="footnote" rel="author">Site designed and developed by <a href="https://www.marchtwenty.com/" class="icon-bear">Ted Balmer</a>.</p>
</footer>

<?php wp_footer(); ?>

<script src="<?php bloginfo('template_url'); ?>/assets/scripts/scripts.js"></script>
<script src="<?php bloginfo('template_url'); ?>/assets/scripts/modals.js"></script>

</body>
</html>