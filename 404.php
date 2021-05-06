<?php get_header(); ?>

<?php breadcrumb_trail(); ?>

<article class="404-page page type-page status-publish" id="404-page">
    <div>
        <h2>404 Page Not Found</h2>
        <div class="wp-block-image">
            <figure class="alignright is-resized">
                <img loading="lazy" src="<?php bloginfo('template_url'); ?>/assets/images/other/404.svg" alt="404 Construction Cone" class="wp-404-image" />
                <figcaption>Oh, look a construction cone!</figcaption>
            </figure>
        </div>
        <p>It looks like this page is ghosting you... 👻</p>
        <p>Alteratively you could do a search of this site:</p>
<?php my_search_form('404'); ?>
        
    </div>
</article>

<?php get_footer(); ?>