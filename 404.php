<?php get_header(); ?>

<main class="page-main">
    <div class="page-content width-full">

<?php include_once(ABSPATH . 'wp-admin/includes/plugin.php'); ?>
<?php if (is_plugin_active('breadcrumb-trail/breadcrumb-trail.php')) breadcrumb_trail(); ?>

<article class="404-page page type-page status-publish" id="page-404" name="page-404">
    <div class="wp-block-image">
        <div class="aligncenter is-resized">
            <img loading="lazy" src="<?php bloginfo('template_url'); ?>/assets/images/other/404.svg" alt="404" class="wp-404-image">
        </div>
        <h2 class="page-title">Page Not Found</h2>
        <div class="404-content">
            <p>Whoops. Well that page is gone.</p>
            <p>But real talk, the page must have been removed, renamed or didn't exist in the first place.</p>
            <?php my_search_form('404'); ?>
            
        </div>
    </div>
</article>

    </div>
</main>

<?php get_footer(); ?>