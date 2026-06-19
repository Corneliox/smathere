<?php
function avitech_css() {
	$parent_style = 'avril-parent-style';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'avitech-style', get_stylesheet_uri(), array( $parent_style ));
	
	wp_enqueue_style('avitech-color-default',get_stylesheet_directory_uri() .'/assets/css/color/default.css');
	wp_dequeue_style('avril-default');
	
	wp_enqueue_style('avitech-media-query',get_stylesheet_directory_uri().'/assets/css/responsive.css');
	wp_dequeue_style('avril-media-query');

}
add_action( 'wp_enqueue_scripts', 'avitech_css',999);
   	

function avitech_setup()	{	

	add_theme_support( 'custom-header', apply_filters( 'avitech_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'ffffff',
		'width'                  => 2000,
		'height'                 => 200,
		'flex-height'            => true,
		'wp-head-callback'       => 'avril_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'avitech_setup' );


/**
 * Called all the Customize file.
 */
require( get_stylesheet_directory() . '/inc/customize/avitech-premium.php');

/**
 * Import Options From Parent Theme
 *
 */
function avitech_parent_theme_options() {
	$avril_mods = get_option( 'theme_mods_avril' );
	if ( ! empty( $avril_mods ) ) {
		foreach ( $avril_mods as $avril_mod_k => $avril_mod_v ) {
			set_theme_mod( $avril_mod_k, $avril_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'avitech_parent_theme_options' );