<aside id="sidebar-footer" class="page-sidebar sidebar-footer">
    <?php if ( is_active_sidebar( 'footer' ) ) : ?>
        <?php dynamic_sidebar( 'footer' ); ?>
    <?php else : ?>
        <!-- Time to add some widgets! -->
    <?php endif; ?>
</aside>