<?php
	
require get_template_directory() . '/inc/recomended-plugins/class-tgm-plugin-activation.php';

/**
 * Recommended plugins.
 */
function traveller_agency_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'kk Star Ratings', 'traveller-agency' ),
			'slug'             => 'kk-star-ratings',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$config = array();
	traveller_agency_tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'traveller_agency_register_recommended_plugins' );