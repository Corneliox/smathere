<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Green Agro Landscaping
 * @subpackage green_agro_landscaping
 */

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function green_agro_landscaping_categorized_blog() {
	$green_agro_landscaping_category_count = get_transient( 'green_agro_landscaping_categories' );

	if ( false === $green_agro_landscaping_category_count ) {
		// Create an array of all the categories that are attached to posts.
		$green_agro_landscaping_categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$green_agro_landscaping_category_count = count( $green_agro_landscaping_categories );

		set_transient( 'green_agro_landscaping_categories', $green_agro_landscaping_category_count );
	}

	// Allow viewing case of 0 or 1 categories in post preview.
	if ( is_preview() ) {
		return true;
	}

	return $green_agro_landscaping_category_count > 1;
}

if ( ! function_exists( 'green_agro_landscaping_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since Green Agro Landscaping
 */
function green_agro_landscaping_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

/**
 * Flush out the transients used in green_agro_landscaping_categorized_blog.
 */
function green_agro_landscaping_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'green_agro_landscaping_categories' );
}
add_action( 'edit_category', 'green_agro_landscaping_category_transient_flusher' );
add_action( 'save_post',     'green_agro_landscaping_category_transient_flusher' );
