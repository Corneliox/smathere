<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Retina_Blog
 */

get_header();
?>
<section class="error-404 not-found">
    <div class="page-content">
        <h2><i class="icon-exclamation icons"></i> <?php esc_html_e('404 page not found', 'retina-blog'); ?></h2>
        <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try going back to Homepage or a search?', 'retina-blog'); ?></p>
        <?php get_search_form(); ?>
    </div><!-- .page-content -->
</section><!-- .error-404 -->
<?php
get_footer();
