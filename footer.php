<!-- End page content -->
    </div>
</main>

<!-- Footer -->
<footer class="page-footer">

<?php menu_nav_list('primary', 'footer'); ?>
    
<?php menu_nav_list('social', 'footer'); ?>
        
    <p class="copyright" rel="license">Copyright &copy; <abbr title="<?php echo date('Y'); ?>" aria-label="<?php echo date('Y'); ?>"><?php echo numberToRoman(date('Y')); ?></abbr> <?php bloginfo('name'); ?></p>
    <p rel="author">Site designed and developed by Ted Balmer</p>
</footer>

<?php wp_footer(); ?>

<script src="<?php bloginfo('template_url'); ?>/assets/scripts/scripts.js"></script>

</body>
</html>