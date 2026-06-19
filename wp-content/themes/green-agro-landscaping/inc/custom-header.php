<?php
/**
 * Custom header implementation
 *
 * @link https://codex.wordpress.org/Custom_Headers
 *
 * @package Green Agro Landscaping
 * @subpackage green_agro_landscaping
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses green_agro_landscaping_header_style()
 */
function green_agro_landscaping_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'green_agro_landscaping_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1600,
		'height'                 => 400,
		'wp-head-callback'       => 'green_agro_landscaping_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'green_agro_landscaping_custom_header_setup' );

if ( ! function_exists( 'green_agro_landscaping_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see green_agro_landscaping_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'green_agro_landscaping_header_style' );
function green_agro_landscaping_header_style() {
	//Check if user has defined any header image.
	if ( get_header_image() ) :
	$green_agro_landscaping_custom_css = "
        .headerbox,.header-img{
			background-image:url('".esc_url(get_header_image())."') !important;
			background-position: center top;
		}";
	   	wp_add_inline_style( 'green-agro-landscaping-style', $green_agro_landscaping_custom_css );
	endif;
}
endif;
