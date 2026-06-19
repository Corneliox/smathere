<?php
/**
 * Template for displaying search forms in Green Agro Landscaping
 *
 * @package Green Agro Landscaping
 * @subpackage green_agro_landscaping
 */

?>

<?php $green_agro_landscaping_unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" id="<?php echo esc_attr( $green_agro_landscaping_unique_id ); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'green-agro-landscaping' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><?php echo esc_html_x( 'Search', 'submit button', 'green-agro-landscaping' ); ?></button>
</form>