<?php
/**
 * Car Service Theme Customizer
 *
 * @package Car Service
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function car_service_customize_register( $wp_customize ) {

	function car_service_sanitize_dropdown_pages( $page_id, $setting ) {
  		$page_id = absint( $page_id );
  		return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	function car_service_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}

	wp_enqueue_style('car-service-customize-controls', trailingslashit(esc_url(get_template_directory_uri())).'/css/customize-controls.css');

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->add_setting('car_service_title_enable',array(
		'default' => true,
		'sanitize_callback' => 'car_service_sanitize_checkbox',
	));
	$wp_customize->add_control( 'car_service_title_enable', array(
	   'settings' => 'car_service_title_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Title','car-service'),
	   'type'      => 'checkbox'
	));


	// sitetitle color
	$wp_customize->add_setting('car_service_sitetitle_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_sitetitle_col', array(
	   'settings' => 'car_service_sitetitle_col',
	   'section'   => 'title_tagline',
	   'label' => __('Site Title Color', 'car-service'),
	   'type'      => 'color'
	));


	$wp_customize->add_setting('car_service_tagline_enable',array(
		'default' => true,
		'sanitize_callback' => 'car_service_sanitize_checkbox',
	));
	$wp_customize->add_control( 'car_service_tagline_enable', array(
	   'settings' => 'car_service_tagline_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Tagline','car-service'),
	   'type'      => 'checkbox'
	));

	// sitetagline color
	$wp_customize->add_setting('car_service_sitetagline_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_sitetagline_col', array(
	   'settings' => 'car_service_sitetagline_col',
	   'section'   => 'title_tagline',
	   'label' => __('Site Tagline Color', 'car-service'),
	   'type'      => 'color'
	));


	//Theme Options
	$wp_customize->add_panel( 'car_service_panel_area', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'title' => __( 'Theme Options Panel', 'car-service' ),
	) );
	
	//Site Layout Section
	$wp_customize->add_section('car_service_site_layoutsec',array(
		'title'	=> __('Manage Site Layout Section ','car-service'),
		'description' => __('<p class="sec-title">Manage Site Layout Section</p>','car-service'),
		'priority'	=> 1,
		'panel' => 'car_service_panel_area',
	));		
	
	$wp_customize->add_setting('car_service_box_layout',array(
		'sanitize_callback' => 'car_service_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'car_service_box_layout', array(
	   'section'   => 'car_service_site_layoutsec',
	   'label'	=> __('Check to Box Layout','car-service'),
	   'type'      => 'checkbox'
 	));

 	$wp_customize->add_setting('car_service_preloader',array(
		'default' => true,
		'sanitize_callback' => 'car_service_sanitize_checkbox',
	));
	$wp_customize->add_control( 'car_service_preloader', array(
	   'section'   => 'car_service_site_layoutsec',
	   'label'	=> __('Check to show preloader','car-service'),
	   'type'      => 'checkbox'
 	));


 	// Header Section
	$wp_customize->add_section('car_service_header_section',array(
		'title'	=> __('Manage Header Section','car-service'),
		'description' => __('<p class="sec-title">Manage Header Section</p>','car-service'),
		'priority'	=> null,
		'panel' => 'car_service_panel_area'
	));

	$wp_customize->add_setting('car_service_stickyheader',array(
		'default' => false,
		'sanitize_callback' => 'car_service_sanitize_checkbox',
	));

	$wp_customize->add_control( 'car_service_stickyheader', array(
	   'section'   => 'car_service_header_section',
	   'label'	=> __('Check To Show Sticky Header','car-service'),
	   'type'      => 'checkbox'
 	));


	// headerbg color
	$wp_customize->add_setting('car_service_headerbg_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_headerbg_col', array(
	   'settings' => 'car_service_headerbg_col',
	   'section'   => 'car_service_header_section',
	   'label' => __('BG Color', 'car-service'),
	   'type'      => 'color'
	));

	// headermenus color
	$wp_customize->add_setting('car_service_headermenus_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_headermenus_col', array(
	   'settings' => 'car_service_headermenus_col',
	   'section'   => 'car_service_header_section',
	   'label' => __('Menus Color', 'car-service'),
	   'type'      => 'color'
	));

	// headermenushover color
	$wp_customize->add_setting('car_service_headermenushover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_headermenushover_col', array(
	   'settings' => 'car_service_headermenushover_col',
	   'section'   => 'car_service_header_section',
	   'label' => __('Menus Hover Color', 'car-service'),
	   'type'      => 'color'
	));

	// headersubmenus color
	$wp_customize->add_setting('car_service_headersubmenus_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_headersubmenus_col', array(
	   'settings' => 'car_service_headersubmenus_col',
	   'section'   => 'car_service_header_section',
	   'label' => __('SubMenus Color', 'car-service'),
	   'type'      => 'color'
	));

	// headersubmenushover color
	$wp_customize->add_setting('car_service_headersubmenushover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_headersubmenushover_col', array(
	   'settings' => 'car_service_headersubmenushover_col',
	   'section'   => 'car_service_header_section',
	   'label' => __('SubMenus Hover Color', 'car-service'),
	   'type'      => 'color'
	));


	// headersubmenusbg color
	$wp_customize->add_setting('car_service_headersubmenusbg_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	 

	$wp_customize->add_control( 'car_service_headersubmenusbg_col', array(
	   'settings' => 'car_service_headersubmenusbg_col',
	   'section'   => 'car_service_header_section',
	   'label' => __('SubMenus Bg Color', 'car-service'),
	   'type'      => 'color'
	));

	// headersubmenusborder color
	$wp_customize->add_setting('car_service_headersubmenusborder_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_headersubmenusborder_col', array(
	   'settings' => 'car_service_headersubmenusborder_col',
	   'section'   => 'car_service_header_section',
	   'label' => __('SubMenus Border Color', 'car-service'),
	   'type'      => 'color'
	));


	// headerstickybg color
	$wp_customize->add_setting('car_service_headerstickybg_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_headerstickybg_col', array(
	   'settings' => 'car_service_headerstickybg_col',
	   'section'   => 'car_service_header_section',
	   'label' => __('Sticky Header BG Color', 'car-service'),
	   'type'      => 'color'
	));




	// Home Category Dropdown Section
	$wp_customize->add_section('car_service_one_cols_section',array(
		'title'	=> __('Manage Banner Section','car-service'),
		'description'	=> __('<p class="sec-title">Manage Banner Section</p> Select Page from the Dropdown for banner, Also use the given image dimension (450 x 550).','car-service'),
		'priority'	=> null,
		'panel' => 'car_service_panel_area'
	));

	$wp_customize->add_setting('car_service_pgboxes_title',array(
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( 'car_service_pgboxes_title', array(
	   'section'   => 'car_service_one_cols_section',
	   'label'	=> __('Section Title','car-service'),
	   'type'      => 'text',
	   'priority' => null,
    ));
	
	$wp_customize->add_setting('car_service_pageboxes',array(
		'default'	=> '0',
		'capability' => 'edit_theme_options',
		'sanitize_callback'	=> 'car_service_sanitize_dropdown_pages'
	));
	$wp_customize->add_control(	'car_service_pageboxes',array(
		'type' => 'dropdown-pages',
		'section' => 'car_service_one_cols_section',
		'label' => __( 'Select Banner','car-service'),
	));

	$wp_customize->add_setting( 'car_service_banner_excerpt_number', array(
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'car_service_sanitize_number_absint',
	  'default' => '15',
	) );

	$wp_customize->add_control( 'car_service_banner_excerpt_number', array(
	  'settings' => 'car_service_banner_excerpt_number',
	  'type' => 'number',
	  'section' => 'car_service_one_cols_section',
	  'label' => __( 'Number Of Words To Show','car-service'),
	) );	
	
	//Hide Section
	$wp_customize->add_setting('car_service_hide_categorysec',array(
		'default' => false,
		'sanitize_callback' => 'car_service_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 

	$wp_customize->add_control( 'car_service_hide_categorysec', array(
	   'settings' => 'car_service_hide_categorysec',
	   'section'   => 'car_service_one_cols_section',
	   'label'     => __('Check To Enable This Section','car-service'),
	   'type'      => 'checkbox'
	));


	// slider bg color
	$wp_customize->add_setting('car_service_sliderbg_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_sliderbg_col', array(
	   'settings' => 'car_service_sliderbg_col',
	   'section'   => 'car_service_one_cols_section',
	   'label' => __('BG Color', 'car-service'),
	   'type'      => 'color'
	));



	// slider title color
	$wp_customize->add_setting('car_service_slidertitle_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_slidertitle_col', array(
	   'settings' => 'car_service_slidertitle_col',
	   'section'   => 'car_service_one_cols_section',
	   'label' => __('Title Color', 'car-service'),
	   'type'      => 'color'
	));


	// slider heading color
	$wp_customize->add_setting('car_service_sliderheading_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_sliderheading_col', array(
	   'settings' => 'car_service_sliderheading_col',
	   'section'   => 'car_service_one_cols_section',
	   'label' => __('Heading Color', 'car-service'),
	   'type'      => 'color'
	));

	// slider description color
	$wp_customize->add_setting('car_service_sliderdescription_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_sliderdescription_col', array(
	   'settings' => 'car_service_sliderdescription_col',
	   'section'   => 'car_service_one_cols_section',
	   'label' => __('Description Color', 'car-service'),
	   'type'      => 'color'
	));

	// slider button color
	$wp_customize->add_setting('car_service_sliderbutton_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_sliderbutton_col', array(
	   'settings' => 'car_service_sliderbutton_col',
	   'section'   => 'car_service_one_cols_section',
	   'label' => __('Button Color', 'car-service'),
	   'type'      => 'color'
	));

	// slider buttontext color
	$wp_customize->add_setting('car_service_sliderbuttontext_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_sliderbuttontext_col', array(
	   'settings' => 'car_service_sliderbuttontext_col',
	   'section'   => 'car_service_one_cols_section',
	   'label' => __('Button Text Color', 'car-service'),
	   'type'      => 'color'
	));

	// slider buttontexthover color
	$wp_customize->add_setting('car_service_sliderbuttontexthover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_sliderbuttontexthover_col', array(
	   'settings' => 'car_service_sliderbuttontexthover_col',
	   'section'   => 'car_service_one_cols_section',
	   'label' => __('Button Text Hover Color', 'car-service'),
	   'type'      => 'color'
	));

	// slider buttonhover color
	$wp_customize->add_setting('car_service_sliderbuttonhover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_sliderbuttonhover_col', array(
	   'settings' => 'car_service_sliderbuttonhover_col',
	   'section'   => 'car_service_one_cols_section',
	   'label' => __('Button Hover Color', 'car-service'),
	   'type'      => 'color'
	));


	// slider circleone color
	$wp_customize->add_setting('car_service_slidercircleone_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_slidercircleone_col', array(
	   'settings' => 'car_service_slidercircleone_col',
	   'section'   => 'car_service_one_cols_section',
	   'label' => __('Circle One Color', 'car-service'),
	   'type'      => 'color'
	));

	// slider circletwo color
	$wp_customize->add_setting('car_service_slidercircletwo_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_slidercircletwo_col', array(
	   'settings' => 'car_service_slidercircletwo_col',
	   'section'   => 'car_service_one_cols_section',
	   'label' => __('Circle Two Color', 'car-service'),
	   'type'      => 'color'
	));

	// slider circlethree color
	$wp_customize->add_setting('car_service_slidercirclethree_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_slidercirclethree_col', array(
	   'settings' => 'car_service_slidercirclethree_col',
	   'section'   => 'car_service_one_cols_section',
	   'label' => __('Circle Three Color', 'car-service'),
	   'type'      => 'color'
	));
	


	// About Section 
	$wp_customize->add_section('car_service_below_banner_section', array(
		'title'	=> __('Manage About Section','car-service'),
		'description'	=> __('<p class="sec-title">Manage About Section</p> Select Pages from the dropdown for About.','car-service'),
		'priority'	=> null,
		'panel' => 'car_service_panel_area',
	));
	
	$wp_customize->add_setting('car_about_pageboxes',array(
		'default'	=> '0',
		'capability' => 'edit_theme_options',
		'sanitize_callback'	=> 'car_service_sanitize_dropdown_pages'
	));
	$wp_customize->add_control(	'car_about_pageboxes',array(
		'type' => 'dropdown-pages',
		'section' => 'car_service_below_banner_section',
	));	

	$wp_customize->add_setting('car_service_disabled_pgboxes',array(
		'default' => false,
		'sanitize_callback' => 'car_service_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));
	
	$wp_customize->add_control( 'car_service_disabled_pgboxes', array(
	   'settings' => 'car_service_disabled_pgboxes',
	   'section'   => 'car_service_below_banner_section',
	   'label'     => __('Check To Enable This Section','car-service'),
	   'type'      => 'checkbox'
	));

	// about title color
	$wp_customize->add_setting('car_service_abouttitle_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_abouttitle_col', array(
	   'settings' => 'car_service_abouttitle_col',
	   'section'   => 'car_service_below_banner_section',
	   'label' => __('Title Color', 'car-service'),
	   'type'      => 'color'
	));

	// about description color
	$wp_customize->add_setting('car_service_aboutdescription_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_aboutdescription_col', array(
	   'settings' => 'car_service_aboutdescription_col',
	   'section'   => 'car_service_below_banner_section',
	   'label' => __('Description Color', 'car-service'),
	   'type'      => 'color'
	));

	// about button color
	$wp_customize->add_setting('car_service_aboutbutton_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_aboutbutton_col', array(
	   'settings' => 'car_service_aboutbutton_col',
	   'section'   => 'car_service_below_banner_section',
	   'label' => __('Button Color', 'car-service'),
	   'type'      => 'color'
	));

	// about buttontext color
	$wp_customize->add_setting('car_service_aboutbuttontext_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_aboutbuttontext_col', array(
	   'settings' => 'car_service_aboutbuttontext_col',
	   'section'   => 'car_service_below_banner_section',
	   'label' => __('Button Text Color', 'car-service'),
	   'type'      => 'color'
	));

	// about buttonhover color
	$wp_customize->add_setting('car_service_aboutbuttonhover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_aboutbuttonhover_col', array(
	   'settings' => 'car_service_aboutbuttonhover_col',
	   'section'   => 'car_service_below_banner_section',
	   'label' => __('Button Hover Color', 'car-service'),
	   'type'      => 'color'
	));


	// Footer Section 
	$wp_customize->add_section('car_service_footer', array(
		'title'	=> __('Manage Footer Section','car-service'),
		'description'	=> __('<p class="sec-title">Manage Footer Section</p>','car-service'),
		'priority'	=> null,
		'panel' => 'car_service_panel_area',
	));
 
	$wp_customize->add_setting('car_service_copyright_line',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));	
	$wp_customize->add_control( 'car_service_copyright_line', array(
	   'section' 	=> 'car_service_footer',
	   'label'	 	=> __('Copyright Line','car-service'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

    $wp_customize->add_setting('car_service_copyright_link',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));	
	$wp_customize->add_control( 'car_service_copyright_link', array(
	   'section' 	=> 'car_service_footer',
	   'label'	 	=> __('Copyright Link','car-service'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));


    // footer coyprightbg color
	$wp_customize->add_setting('car_service_footercoyprightbg_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_footercoyprightbg_col', array(
	   'settings' => 'car_service_footercoyprightbg_col',
	   'section'   => 'car_service_footer',
	   'label' => __('Copyright BG Color', 'car-service'),
	   'type'      => 'color'
	));

	// footer coypright color
	$wp_customize->add_setting('car_service_footercoypright_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_footercoypright_col', array(
	   'settings' => 'car_service_footercoypright_col',
	   'section'   => 'car_service_footer',
	   'label' => __('Copyright Color', 'car-service'),
	   'type'      => 'color'
	));

	// footer copyrighthover color
	$wp_customize->add_setting('car_service_footercopyrighthover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_footercopyrighthover_col', array(
	   'settings' => 'car_service_footercopyrighthover_col',
	   'section'   => 'car_service_footer',
	   'label' => __('Copyright Hover Color', 'car-service'),
	   'type'      => 'color'
	));


	// footer heading color
	$wp_customize->add_setting('car_service_footerheading_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_footerheading_col', array(
	   'settings' => 'car_service_footerheading_col',
	   'section'   => 'car_service_footer',
	   'label' => __('Heading Color', 'car-service'),
	   'type'      => 'color'
	));

	// footer description color
	$wp_customize->add_setting('car_service_footerdescription_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_footerdescription_col', array(
	   'settings' => 'car_service_footerdescription_col',
	   'section'   => 'car_service_footer',
	   'label' => __('Description Color', 'car-service'),
	   'type'      => 'color'
	));

	// footer list color
	$wp_customize->add_setting('car_service_footerlist_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_footerlist_col', array(
	   'settings' => 'car_service_footerlist_col',
	   'section'   => 'car_service_footer',
	   'label' => __('List Color', 'car-service'),
	   'type'      => 'color'
	));

	// footer listborder color
	$wp_customize->add_setting('car_service_footerlistborder_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_footerlistborder_col', array(
	   'settings' => 'car_service_footerlistborder_col',
	   'section'   => 'car_service_footer',
	   'label' => __('List Border Color', 'car-service'),
	   'type'      => 'color'
	));

	// footer listhover color
	$wp_customize->add_setting('car_service_footerlisthover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_footerlisthover_col', array(
	   'settings' => 'car_service_footerlisthover_col',
	   'section'   => 'car_service_footer',
	   'label' => __('List Hover Color', 'car-service'),
	   'type'      => 'color'
	));

	// footer bg color
	$wp_customize->add_setting('car_service_footerbg_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));	

	$wp_customize->add_control( 'car_service_footerbg_col', array(
	   'settings' => 'car_service_footerbg_col',
	   'section'   => 'car_service_footer',
	   'label' => __('BG Color', 'car-service'),
	   'type'      => 'color'
	));

	// Color Scheme
	$wp_customize->add_setting('car_service_color_scheme_one',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
    $wp_customize->add_control( 
	    new WP_Customize_Color_Control( 
	    $wp_customize, 
	    'car_service_color_scheme_one', 
	    array(
	        'label'      => __( 'Color Scheme 1', 'car-service' ),
	        'section'    => 'colors',
	        'settings'   => 'car_service_color_scheme_one',
	    ) ) 
	);

    // Color
	$wp_customize->add_setting('car_service_color_scheme_two',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
    $wp_customize->add_control( 
	    new WP_Customize_Color_Control( 
	    $wp_customize, 
	    'car_service_color_scheme_two', 
	    array(
	        'label'      => __( 'Color Scheme 2', 'car-service' ),
	        'section'    => 'colors',
	        'settings'   => 'car_service_color_scheme_two',
	    ) )
	);

    // Google Fonts
    $wp_customize->add_section( 'car_service_google_fonts_section', array(
		'title'       => __( 'Google Fonts', 'car-service' ),
		'priority'    => 24,
	) );

	$font_choices = array(
		'Kaushan Script:' => 'Kaushan Script',
		'Emilys Candy:' => 'Emilys Candy',
		'Poppins:0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900' => 'Poppins',
		'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
		'Open Sans:400italic,700italic,400,700' => 'Open Sans',
		'Oswald:400,700' => 'Oswald',
		'Playfair Display:400,700,400italic' => 'Playfair Display',
		'Montserrat:400,700' => 'Montserrat',
		'Raleway:400,700' => 'Raleway',
		'Droid Sans:400,700' => 'Droid Sans',
		'Lato:400,700,400italic,700italic' => 'Lato',
		'Arvo:400,700,400italic,700italic' => 'Arvo',
		'Lora:400,700,400italic,700italic' => 'Lora',
		'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
		'Oxygen:400,300,700' => 'Oxygen',
		'PT Serif:400,700' => 'PT Serif',
		'PT Sans:400,700,400italic,700italic' => 'PT Sans',
		'PT Sans Narrow:400,700' => 'PT Sans Narrow',
		'Cabin:400,700,400italic' => 'Cabin',
		'Fjalla One:400' => 'Fjalla One',
		'Francois One:400' => 'Francois One',
		'Josefin Sans:400,300,600,700' => 'Josefin Sans',
		'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
		'Arimo:400,700,400italic,700italic' => 'Arimo',
		'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
		'Bitter:400,700,400italic' => 'Bitter',
		'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
		'Roboto:400,400italic,700,700italic' => 'Roboto',
		'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
		'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
		'Roboto Slab:400,700' => 'Roboto Slab',
		'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
		'Rokkitt:400' => 'Rokkitt',
	);

	$wp_customize->add_setting( 'car_service_headings_fonts', array(
		'sanitize_callback' => 'car_service_sanitize_fonts',
	));
	$wp_customize->add_control( 'car_service_headings_fonts', array(
		'type' => 'select',
		'description' => __('Select your desired font for the headings.', 'car-service'),
		'section' => 'car_service_google_fonts_section',
		'choices' => $font_choices
	));

	$wp_customize->add_setting( 'car_service_body_fonts', array(
		'sanitize_callback' => 'car_service_sanitize_fonts'
	));
	$wp_customize->add_control( 'car_service_body_fonts', array(
		'type' => 'select',
		'description' => __( 'Select your desired font for the body.', 'car-service' ),
		'section' => 'car_service_google_fonts_section',
		'choices' => $font_choices
	));

	$wp_customize->add_setting('car_service_woocommerce_sidebar_shop',array(
		'sanitize_callback' => 'car_service_sanitize_checkbox',
	));
	$wp_customize->add_control( 'car_service_woocommerce_sidebar_shop', array(
	   'section'   => 'woocommerce_product_catalog',
	   'description'  => __('Click on the check box to remove sidebar from shop page.','car-service'),
	   'label'	=> __('Shop Page Sidebar layout','car-service'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting('car_service_woocommerce_sidebar_product',array(
		'sanitize_callback' => 'car_service_sanitize_checkbox',
	));
	$wp_customize->add_control( 'car_service_woocommerce_sidebar_product', array(
	   'section'   => 'woocommerce_product_catalog',
	   'description'  => __('Click on the check box to remove sidebar from product page.','car-service'),
	   'label'	=> __('Product Page Sidebar layout','car-service'),
	   'type'      => 'checkbox'
 	));
}
add_action( 'customize_register', 'car_service_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function car_service_customize_preview_js() {
	wp_enqueue_script( 'car_service_customizer', esc_url(get_template_directory_uri()) . '/js/customize-preview.js', array( 'customize-preview' ), '20161510', true );
}
add_action( 'customize_preview_init', 'car_service_customize_preview_js' );