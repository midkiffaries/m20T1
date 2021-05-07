<aside id="sidebar-singlepost" class="page-sidebar sidebar-singlepost">
    <?php if ( is_active_sidebar( 'secondary' ) ) : ?>
        <?php dynamic_sidebar( 'secondary' ); ?>
    <?php else : ?>
        <!-- Time to add some widgets! -->
    <?php endif; ?>
</aside>