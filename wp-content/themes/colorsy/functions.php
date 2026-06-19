<?php
function colorsy_css() {
	$parent_style = 'gradiant-parent-style';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'colorsy-style', get_stylesheet_uri(), array( $parent_style ));
	
	wp_enqueue_style('colorsy-color-default',get_stylesheet_directory_uri() .'/assets/css/color/default.css');
	wp_dequeue_style('gradiant-default');
	
	wp_enqueue_style('colorsy-media-query',get_stylesheet_directory_uri().'/assets/css/responsive.css');
	wp_dequeue_style('gradiant-media-query');
	
	wp_enqueue_script('colorsy-custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), false, true);

}
add_action( 'wp_enqueue_scripts', 'colorsy_css',999);



function colorsy_setup()	{	

	add_theme_support( 'custom-header', apply_filters( 'colorsy_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'ffffff',
		'width'                  => 2000,
		'height'                 => 200,
		'flex-height'            => true,
		'wp-head-callback'       => 'gradiant_header_style',
	) ) );
	
}
add_action( 'after_setup_theme', 'colorsy_setup' );


/**
 * Dynamic Styles
 */
if( ! function_exists( 'colorsy_dynamic_style' ) ):
    function colorsy_dynamic_style() {

		$output_css = '';
		
			
		 /**
		 *  Breadcrumb Style
		 */
		$colorsy_hs_breadcrumb	= get_theme_mod('hs_breadcrumb','1');	
		
		if($colorsy_hs_breadcrumb == '') { 
				$output_css .=".gradiant-content {
					padding-top: 200px;
				}\n";
			}
		
		
		/**
		 *  Parallax
		 */
		$colorsy_footer_parallax_enable	= get_theme_mod('footer_parallax_enable','1');	
		$colorsy_footer_parallax_margin	= get_theme_mod('footer_parallax_margin','775');	
		
		if($colorsy_footer_parallax_enable =='1'):
			 $output_css .="@media (min-width: 992px){.footer-parallax #content.gradiant-content { 
					 margin-bottom: ".esc_attr($colorsy_footer_parallax_margin)."px;
			 }}\n";	
		endif; 	
		
        wp_add_inline_style( 'colorsy-style', $output_css );
    }
endif;
add_action( 'wp_enqueue_scripts', 'colorsy_dynamic_style',999);


/**
 * Called all the Customize file.
 */
require( get_stylesheet_directory() . '/inc/customize/colorsy-premium.php');

/**
 * Import Options From Parent Theme
 *
 */
function colorsy_parent_theme_options() {
	$gradiant_mods = get_option( 'theme_mods_gradiant' );
	if ( ! empty( $gradiant_mods ) ) {
		foreach ( $gradiant_mods as $gradiant_mod_k => $gradiant_mod_v ) {
			set_theme_mod( $gradiant_mod_k, $gradiant_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'colorsy_parent_theme_options' );