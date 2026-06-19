<?php
function envira_css() {
	$parent_style = 'startkit-parent-style';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'envira-style', get_stylesheet_uri(), array( $parent_style ));
	
	wp_enqueue_style('envira-color-default',get_stylesheet_directory_uri() .'/css/colors/default.css');
	wp_dequeue_style('startkit-color-default');
	
	wp_enqueue_style('envira-responsive',get_stylesheet_directory_uri().'/css/responsive.css');
	wp_dequeue_style('startkit-responsive');
	wp_dequeue_style('startkit-fonts');
}
add_action( 'wp_enqueue_scripts', 'envira_css',999);
   	

function envira_setup()	{

	add_theme_support( 'custom-header', apply_filters( 'envira_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'ffffff',
		'width'                  => 2000,
		'height'                 => 200,
		'flex-height'            => true,
		'wp-head-callback'       => 'startkit_header_style',
	) ) );
	
	add_editor_style( array( 'css/editor-style.css', envira_google_font() ) );
}
add_action( 'after_setup_theme', 'envira_setup' );
	
/**
 * Register Google fonts for Envira.
 */
function envira_google_font() {
	
   $get_fonts_url = '';
		
    $font_families = array();
 
	$font_families = array('Open Sans:300,400,600,700,800', 'Raleway:400,700');
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $get_fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return $get_fonts_url;
}



function envira_scripts_styles() {
    wp_enqueue_style( 'envira-fonts', envira_google_font(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'envira_scripts_styles' );


/**
 * Called all the Customize file.
 */
require( get_stylesheet_directory() . '/inc/customize/envira-premium.php');



/**
 * Import Options From Parent Theme
 *
 */
function envira_parent_theme_options() {
	$startkit_mods = get_option( 'theme_mods_startkit' );
	if ( ! empty( $startkit_mods ) ) {
		foreach ( $startkit_mods as $startkit_mod_k => $startkit_mod_v ) {
			set_theme_mod( $startkit_mod_k, $startkit_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'envira_parent_theme_options' );
