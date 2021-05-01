<aside id="sidebar-secondary" class="sidebar">
    <?php if ( is_active_sidebar( 'secondary' ) ) : ?>
        <?php dynamic_sidebar( 'secondary' ); ?>
    <?php else : ?>
        <!-- Time to add some widgets! -->
    <?php endif; ?>
</aside>