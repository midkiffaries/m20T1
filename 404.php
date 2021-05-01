<?php get_header(); ?>

<?php breadcrumb_trail(); ?>

<article class="404-page type-page">
    <div>
        <img src="<?php bloginfo('template_url'); ?>/assets/images/other/construction.svg" alt="Construction Cone" class="alignright">
        <p><code><?php echo SITE_ADDRESS . $_SERVER['REQUEST_URI']; ?></code></p>
        <h3>Oh, Nooooos... that page doesn’t seem to exist.</h3>
        <p>Either the page you are looking for has been removed or renamed... or there’s something wrong with this site.</p>
        <p>You could try and do a search for what it is you are looking for:</p>
<?php my_search_form('404'); ?>
        
    </div>
</article>

<?php get_footer(); ?>