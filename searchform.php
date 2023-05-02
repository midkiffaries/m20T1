<?php // Global Search Form ?>
<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php $unique_id = wp_unique_id( 'search-form-' ); ?>
<div class="search-block" id="<?=esc_attr($unique_id); ?>" aria-label="Search Form">
    <form method="get" class="search-form" role="search" action="<?=esc_url( home_url( '/' ) ); ?>" itemscope itemtype="https://schema.org/SearchAction">
        <div class="search-container">
            <input type="search" class="search-input" name="s" id="<?=esc_attr($unique_id); ?>" value="<?=esc_attr(get_search_query()); ?>" placeholder="Search blog posts, pages, etc." autocapitalize="none" autocorrect="off" accesskey="s" maxlength="255" pattern="[^'\x22]+" aria-label="Search Input" itemprop="query" required><input type="submit" value="&nbsp;" class="search-submit" aria-label="Submit Search">
        </div>
    </form>
</div>