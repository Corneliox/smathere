<?php
/**
 * The sidebar containing the main widget area
 * @package Green Agro Landscaping
 * @subpackage green_agro_landscaping
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Blog Sidebar', 'green-agro-landscaping' ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>