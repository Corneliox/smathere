<?php
/**
 * Default theme options.
 *
 * @package retina-blog
 */

if (!function_exists('retina_blog_get_default_theme_options')):

/**
 * Get default theme options
 *
 * @since 1.0.0
 *
 * @return array Default theme options.
 */
function retina_blog_get_default_theme_options() {

	$defaults = array();

	// Slider Section.
	$defaults['show_slider_section']                    = 0;
	$defaults['show_fullwidth_slider_section']          = 1;
	$defaults['number_of_home_slider']                  = 4;
	$defaults['select_category_for_slider']             = 1;
	$defaults['read_more_button_text'] = esc_html__( 'Continue Reading', 'retina-blog' );
	/*layout*/
	$defaults['home_page_content_status'] = 1;
	$defaults['enable_overlay_option']    = 1;
	$defaults['homepage_layout_option']   = 'full-width';
	$defaults['global_layout']            = 'full-width';
	$defaults['excerpt_length_global']    = 35;
	$defaults['pagination_type']          = 'default';
	$defaults['copyright_text']           = esc_html__('Copyright All rights reserved', 'retina-blog');
	$defaults['enable_preloader']         = 1;

	$defaults['number_of_footer_widget'] = 3;
	$defaults['breadcrumb_type']         = 'simple';

	// Pass through filter.
	$defaults = apply_filters('retina_blog_filter_default_theme_options', $defaults);

	return $defaults;

}

endif;
