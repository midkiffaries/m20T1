<aside id="sidebar-post" class="page-sidebar sidebar-post" role="sidebar">
    <?php if (is_active_sidebar( 'secondary' )) : ?>
        <?php dynamic_sidebar( 'secondary' ); ?>
    <?php else : ?>
        <!-- Time to add some widgets! -->
    <?php endif; ?>
</aside>