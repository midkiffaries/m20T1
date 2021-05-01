<aside id="sidebar-primary" class="sidebar" >
    <?php if ( is_active_sidebar( 'primary' ) ) : ?>
        <?php dynamic_sidebar( 'primary' ); ?>
    <?php else : ?>
        <!-- Time to add some widgets! -->
    <?php endif; ?>
</aside>