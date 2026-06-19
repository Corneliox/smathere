<?php
/**
 * Classic Internet Services Theme Customizer
 *
 * @package Classic Internet Services
 */

get_template_part('/inc/select/category-dropdown-custom-control');

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function Classic_Internet_Services_Customize_register( $wp_customize ) {

	function classic_internet_services_sanitize_dropdown_pages( $page_id, $setting ) {
  		$page_id = absint( $page_id );
  		return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	function classic_internet_services_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}

	function classic_internet_services_sanitize_email( $email, $setting ) {
		// Strips out all characters that are not allowable in an email address.
		$email = sanitize_email( $email );
		
		// If $email is a valid email, return it; otherwise, return the default.
		return ( ! is_null( $email ) ? $email : $setting->default );
	}

	wp_enqueue_style('classic-internet-services-customize-controls', trailingslashit(esc_url(get_template_directory_uri())).'/css/customize-controls.css');

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->add_setting('classic_internet_services_title_enable',array(
		'default' => true,
		'sanitize_callback' => 'classic_internet_services_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_internet_services_title_enable', array(
	   'settings' => 'classic_internet_services_title_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Title','classic-internet-services'),
	   'type'      => 'checkbox'
	));

	// site title color
	$wp_customize->add_setting('classic_internet_services_sitetitle_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_sitetitle_color', array(
	   'settings' => 'classic_internet_services_sitetitle_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Title Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('classic_internet_services_tagline_enable',array(
		'default' => true,
		'sanitize_callback' => 'classic_internet_services_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_internet_services_tagline_enable', array(
	   'settings' => 'classic_internet_services_tagline_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Tagline','classic-internet-services'),
	   'type'      => 'checkbox'
	));

	// site tagline color
	$wp_customize->add_setting('classic_internet_services_sitetagline_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_sitetagline_color', array(
	   'settings' => 'classic_internet_services_sitetagline_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Tagline Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	//Theme Options
	$wp_customize->add_panel( 'classic_internet_services_panel_area', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'title' => __( 'Theme Options Panel', 'classic-internet-services' ),
	) );
	
	//Site Layout Section
	$wp_customize->add_section('classic_internet_services_site_layoutsec',array(
		'title'	=> __('Manage Site Layout Section ','classic-internet-services'),
		'priority'	=> 1,
		'panel' => 'classic_internet_services_panel_area',
	));		
	
	$wp_customize->add_setting('classic_internet_services_box_layout',array(
		'sanitize_callback' => 'classic_internet_services_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_internet_services_box_layout', array(
	   'section'   => 'classic_internet_services_site_layoutsec',
	   'label'	=> __('Check to Box Layout','classic-internet-services'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting('classic_internet_services_preloader',array(
		'default' => true,
		'sanitize_callback' => 'classic_internet_services_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_internet_services_preloader', array(
	   'section'   => 'classic_internet_services_site_layoutsec',
	   'label'	=> __('Check to show preloader','classic-internet-services'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting('classic_internet_services_topbar',array(
		'default' => true,
		'sanitize_callback' => 'classic_internet_services_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_internet_services_topbar', array(
	   'section'   => 'classic_internet_services_site_layoutsec',
	   'label'	=> __('Check to show topbar','classic-internet-services'),
	   'type'      => 'checkbox'
 	));

	// Header Section 
	$wp_customize->add_section('classic_internet_services_header', array(
		'title'	=> __('Manage Header Section','classic-internet-services'),
		'priority'	=> null,
		'panel' => 'classic_internet_services_panel_area',
	));

	// topheader color
	$wp_customize->add_setting('classic_internet_services_topheaderbg_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_topheaderbg_color', array(
	   'settings' => 'classic_internet_services_topheaderbg_color',
	   'section'   => 'classic_internet_services_header',
	   'label' => __('Top BG Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// header_accounticon_col
	$wp_customize->add_setting('classic_internet_services_header_accounticon_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_header_accounticon_col', array(
	   'settings' => 'classic_internet_services_header_accounticon_col',
	   'section'   => 'classic_internet_services_header',
	   'label' => __('Account Icon Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// header_carticon_col
	$wp_customize->add_setting('classic_internet_services_header_carticon_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_header_carticon_col', array(
	   'settings' => 'classic_internet_services_header_carticon_col',
	   'section'   => 'classic_internet_services_header',
	   'label' => __('Cart Icon Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// header bottombg col
	$wp_customize->add_setting('classic_internet_services_header_bottombg_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_header_bottombg_col', array(
	   'settings' => 'classic_internet_services_header_bottombg_col',
	   'section'   => 'classic_internet_services_header',
	   'label' => __('Bottom BG Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// header menus col
	$wp_customize->add_setting('classic_internet_services_header_menus_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_header_menus_col', array(
	   'settings' => 'classic_internet_services_header_menus_col',
	   'section'   => 'classic_internet_services_header',
	   'label' => __('Menus Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// header menushov col
	$wp_customize->add_setting('classic_internet_services_header_menushov_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_header_menushov_col', array(
	   'settings' => 'classic_internet_services_header_menushov_col',
	   'section'   => 'classic_internet_services_header',
	   'label' => __('Menus Hover Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// header menushover col
	$wp_customize->add_setting('classic_internet_services_header_menushover1_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_header_menushover1_col', array(
	   'settings' => 'classic_internet_services_header_menushover1_col',
	   'section'   => 'classic_internet_services_header',
	   'label' => __('Menus BG Hover Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// header submenubg1 col
	$wp_customize->add_setting('classic_internet_services_header_submenubg1_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_header_submenubg1_col', array(
	   'settings' => 'classic_internet_services_header_submenubg1_col',
	   'section'   => 'classic_internet_services_header',
	   'label' => __('SubMenus BG Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// header submenu col
	$wp_customize->add_setting('classic_internet_services_header_submenu_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_header_submenu_col', array(
	   'settings' => 'classic_internet_services_header_submenu_col',
	   'section'   => 'classic_internet_services_header',
	   'label' => __('SubMenus Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// header submenuhover col
	$wp_customize->add_setting('classic_internet_services_header_submenuhover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_header_submenuhover_col', array(
	   'settings' => 'classic_internet_services_header_submenuhover_col',
	   'section'   => 'classic_internet_services_header',
	   'label' => __('SubMenu Hover Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// Home Category Dropdown Section
	$wp_customize->add_section('classic_internet_services_one_cols_section',array(
		'title'	=> __('Manage Slider','classic-internet-services'),
		'description'	=> __('Select Category from the Dropdowns for slider, Also use the given image dimension (1600 x 600).','classic-internet-services'),
		'priority'	=> null,
		'panel' => 'classic_internet_services_panel_area'
	));

	// Add a category dropdown Slider Coloumn
	$wp_customize->add_setting( 'classic_internet_services_pageboxes', array(
		'default'	=> '0',	
		'sanitize_callback'	=> 'absint'
	) );
	$wp_customize->add_control( new Classic_Internet_Services_Category_Dropdown_Custom_Control( $wp_customize, 'classic_internet_services_pageboxes', array(
		'section' => 'classic_internet_services_one_cols_section',
		'settings'   => 'classic_internet_services_pageboxes',
	) ) );
	
	//Hide Section
	$wp_customize->add_setting('classic_internet_services_hide_categorysec',array(
		'default' => false,
		'sanitize_callback' => 'classic_internet_services_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_internet_services_hide_categorysec', array(
	   'settings' => 'classic_internet_services_hide_categorysec',
	   'section'   => 'classic_internet_services_one_cols_section',
	   'label'     => __('Check To Enable This Section','classic-internet-services'),
	   'type'      => 'checkbox'
	));

	$wp_customize->add_setting('classic_internet_services_pgboxes_title',array(
		'sanitize_callback' => 'sanitize_text_field',
	));	
	$wp_customize->add_control( 'classic_internet_services_pgboxes_title', array(
	   'section' 	=> 'classic_internet_services_one_cols_section',
	   'label'	 	=> __('Short Text','classic-internet-services'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

    // slider shorttext col
	$wp_customize->add_setting('classic_internet_services_slider_shorttext_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_internet_services_slider_shorttext_col', array(
	   'settings' => 'classic_internet_services_slider_shorttext_col',
	   'section'   => 'classic_internet_services_one_cols_section',
	   'label' => __('Short Text Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// slider title col
	$wp_customize->add_setting('classic_internet_services_slider_title_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_slider_title_col', array(
	   'settings' => 'classic_internet_services_slider_title_col',
	   'section'   => 'classic_internet_services_one_cols_section',
	   'label' => __('Title Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// slider description col
	$wp_customize->add_setting('classic_internet_services_slider_description_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_slider_description_col', array(
	   'settings' => 'classic_internet_services_slider_description_col',
	   'section'   => 'classic_internet_services_one_cols_section',
	   'label' => __('Description Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// slider buttontext col
	$wp_customize->add_setting('classic_internet_services_slider_buttontext_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_slider_buttontext_col', array(
	   'settings' => 'classic_internet_services_slider_buttontext_col',
	   'section'   => 'classic_internet_services_one_cols_section',
	   'label' => __('Button Text Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// slider buttonbg col
	$wp_customize->add_setting('classic_internet_services_slider_buttonbg_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_slider_buttonbg_col', array(
	   'settings' => 'classic_internet_services_slider_buttonbg_col',
	   'section'   => 'classic_internet_services_one_cols_section',
	   'label' => __('Button BG Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// slider buttonbghover col
	$wp_customize->add_setting('classic_internet_services_slider_buttonbghover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_slider_buttonbghover_col', array(
	   'settings' => 'classic_internet_services_slider_buttonbghover_col',
	   'section'   => 'classic_internet_services_one_cols_section',
	   'label' => __('Button BG Hover Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// slider bg1 col
	$wp_customize->add_setting('classic_internet_services_slider_bg1_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_slider_bg1_col', array(
	   'settings' => 'classic_internet_services_slider_bg1_col',
	   'section'   => 'classic_internet_services_one_cols_section',
	   'label' => __('BG Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// slider arrow col
	$wp_customize->add_setting('classic_internet_services_slider_arrow_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_slider_arrow_col', array(
	   'settings' => 'classic_internet_services_slider_arrow_col',
	   'section'   => 'classic_internet_services_one_cols_section',
	   'label' => __('Arrows Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// slider arrowhover col
	$wp_customize->add_setting('classic_internet_services_slider_arrowhover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_slider_arrowhover_col', array(
	   'settings' => 'classic_internet_services_slider_arrowhover_col',
	   'section'   => 'classic_internet_services_one_cols_section',
	   'label' => __('Arrows hover Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// Home Three Boxes Section 
	$wp_customize->add_section('classic_internet_services_below_banner_section', array(
		'title'	=> __('Manage Services Section','classic-internet-services'),
		'description'	=> __('Select Pages from the dropdown for Services, Also use the given image dimension (500 x 500).','classic-internet-services'),
		'priority'	=> null,
		'panel' => 'classic_internet_services_panel_area',
	));

	$wp_customize->add_setting('classic_internet_services_servicebox_title',array(
		'default'	=> '',
		'capability' => 'edit_theme_options',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(	'classic_internet_services_servicebox_title',array(
		'type' => 'text',
		'label'	 	=> __('Heading','classic-internet-services'),
		'section' => 'classic_internet_services_below_banner_section',
	));

	$wp_customize->add_setting('classic_internet_services_servicebox_btn_link',array(
		'default'	=> '',
		'capability' => 'edit_theme_options',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control(	'classic_internet_services_servicebox_btn_link',array(
		'type' => 'url',
		'label'	 	=> __('Heading Button URL','classic-internet-services'),
		'section' => 'classic_internet_services_below_banner_section',
	));	

	$wp_customize->add_setting('classic_internet_services_pageboxes1',array(
		'default'	=> '0',
		'capability' => 'edit_theme_options',
		'sanitize_callback'	=> 'classic_internet_services_sanitize_dropdown_pages'
	));
	$wp_customize->add_control(	'classic_internet_services_pageboxes1',array(
		'type' => 'dropdown-pages',
		'section' => 'classic_internet_services_below_banner_section',
	));	

	$wp_customize->add_setting('classic_internet_services_pageboxes2',array(
		'default'	=> '0',
		'capability' => 'edit_theme_options',
		'sanitize_callback'	=> 'classic_internet_services_sanitize_dropdown_pages'
	)); 
	$wp_customize->add_control(	'classic_internet_services_pageboxes2',array(
		'type' => 'dropdown-pages',
		'section' => 'classic_internet_services_below_banner_section',
	));
	
	$wp_customize->add_setting('classic_internet_services_pageboxes3',array(
		'default'	=> '0',
		'capability' => 'edit_theme_options',
		'sanitize_callback'	=> 'classic_internet_services_sanitize_dropdown_pages'
	));

	$wp_customize->add_control(	'classic_internet_services_pageboxes3',array(
		'type' => 'dropdown-pages',
		'section' => 'classic_internet_services_below_banner_section',
	));
	
	$wp_customize->add_setting('classic_internet_services_disabled_pgboxes',array(
		'default' => false,
		'sanitize_callback' => 'classic_internet_services_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));
	
	$wp_customize->add_control( 'classic_internet_services_disabled_pgboxes', array(
	   'settings' => 'classic_internet_services_disabled_pgboxes',
	   'section'   => 'classic_internet_services_below_banner_section',
	   'label'     => __('Check To Enable This Section','classic-internet-services'),
	   'type'      => 'checkbox'
	));

	// services heading col
	$wp_customize->add_setting('classic_internet_services_services_heading_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_services_heading_col', array(
	   'settings' => 'classic_internet_services_services_heading_col',
	   'section'   => 'classic_internet_services_below_banner_section',
	   'label' => __('Heading Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// services buton bg col
	$wp_customize->add_setting('classic_internet_services_services_btnbg_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_services_btnbg_col', array(
	   'settings' => 'classic_internet_services_services_btnbg_col',
	   'section'   => 'classic_internet_services_below_banner_section',
	   'label' => __('Button Bg Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// services buton text col
	$wp_customize->add_setting('classic_internet_services_services_btntxt_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_services_btntxt_col', array(
	   'settings' => 'classic_internet_services_services_btntxt_col',
	   'section'   => 'classic_internet_services_below_banner_section',
	   'label' => __('Button Text Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// services butonbghover col
	$wp_customize->add_setting('classic_internet_services_services_btnbghover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_services_btnbghover_col', array(
	   'settings' => 'classic_internet_services_services_btnbghover_col',
	   'section'   => 'classic_internet_services_below_banner_section',
	   'label' => __('Button Bg Hover Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// services butontxthover col
	$wp_customize->add_setting('classic_internet_services_services_btntxthover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_services_btntxthover_col', array(
	   'settings' => 'classic_internet_services_services_btntxthover_col',
	   'section'   => 'classic_internet_services_below_banner_section',
	   'label' => __('Button Text Hover Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// services boxbg col
	$wp_customize->add_setting('classic_internet_services_services_boxbg_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_services_boxbg_col', array(
	   'settings' => 'classic_internet_services_services_boxbg_col',
	   'section'   => 'classic_internet_services_below_banner_section',
	   'label' => __('Service Bg Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// services boxheading col
	$wp_customize->add_setting('classic_internet_services_services_boxheading_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_services_boxheading_col', array(
	   'settings' => 'classic_internet_services_services_boxheading_col',
	   'section'   => 'classic_internet_services_below_banner_section',
	   'label' => __('Service Heading Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// services boxheadinghover col
	$wp_customize->add_setting('classic_internet_services_services_boxheadinghover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_services_boxheadinghover_col', array(
	   'settings' => 'classic_internet_services_services_boxheadinghover_col',
	   'section'   => 'classic_internet_services_below_banner_section',
	   'label' => __('Service Heading Hover Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// services boxtxt col
	$wp_customize->add_setting('classic_internet_services_services_boxtxt_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_services_boxtxt_col', array(
	   'settings' => 'classic_internet_services_services_boxtxt_col',
	   'section'   => 'classic_internet_services_below_banner_section',
	   'label' => __('Service Text Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// Footer Section 
	$wp_customize->add_section('classic_internet_services_footer', array(
		'title'	=> __('Manage Footer Section','classic-internet-services'),
		'priority'	=> null,
		'panel' => 'classic_internet_services_panel_area',
	));

	$wp_customize->add_setting('classic_internet_services_copyright_line',array(
		'default' => 'Classic Internet Services WordPress Theme',
		'sanitize_callback' => 'sanitize_text_field',
	));	
	$wp_customize->add_control( 'classic_internet_services_copyright_line', array(
	   'section' 	=> 'classic_internet_services_footer',
	   'label'	 	=> __('Copyright Line','classic-internet-services'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

    $wp_customize->add_setting('classic_internet_services_copyright_link',array( 
    	'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));	
	$wp_customize->add_control( 'classic_internet_services_copyright_link', array(
	   'section' 	=> 'classic_internet_services_footer',
	   'label'	 	=> __('Copyright Link','classic-internet-services'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

    // footer coypright col
	$wp_customize->add_setting('classic_internet_services_footer_coypright_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_footer_coypright_col', array(
	   'settings' => 'classic_internet_services_footer_coypright_col',
	   'section'   => 'classic_internet_services_footer',
	   'label' => __('Copyright Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// footer coyprighthover col
	$wp_customize->add_setting('classic_internet_services_footer_coyprighthover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_footer_coyprighthover_col', array(
	   'settings' => 'classic_internet_services_footer_coyprighthover_col',
	   'section'   => 'classic_internet_services_footer',
	   'label' => __('Copyright Hover Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// footer coyprightbg col
	$wp_customize->add_setting('classic_internet_services_footer_coyprightbg_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_footer_coyprightbg_col', array(
	   'settings' => 'classic_internet_services_footer_coyprightbg_col',
	   'section'   => 'classic_internet_services_footer',
	   'label' => __('Copyright BG Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// footer topbg col
	$wp_customize->add_setting('classic_internet_services_footer_topbg_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_footer_topbg_col', array(
	   'settings' => 'classic_internet_services_footer_topbg_col',
	   'section'   => 'classic_internet_services_footer',
	   'label' => __('Top BG Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// footer heading col
	$wp_customize->add_setting('classic_internet_services_footer_heading_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_footer_heading_col', array(
	   'settings' => 'classic_internet_services_footer_heading_col',
	   'section'   => 'classic_internet_services_footer',
	   'label' => __('Heading Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// footer text col
	$wp_customize->add_setting('classic_internet_services_footer_text_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_footer_text_col', array(
	   'settings' => 'classic_internet_services_footer_text_col',
	   'section'   => 'classic_internet_services_footer',
	   'label' => __('Text Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// footer list col
	$wp_customize->add_setting('classic_internet_services_footer_list_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_footer_list_col', array(
	   'settings' => 'classic_internet_services_footer_list_col',
	   'section'   => 'classic_internet_services_footer',
	   'label' => __('List Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// footer listhover col
	$wp_customize->add_setting('classic_internet_services_footer_listhover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_footer_listhover_col', array(
	   'settings' => 'classic_internet_services_footer_listhover_col',
	   'section'   => 'classic_internet_services_footer',
	   'label' => __('List Hover Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

	// footer listborder col
	$wp_customize->add_setting('classic_internet_services_footer_listborder_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'classic_internet_services_footer_listborder_col', array(
	   'settings' => 'classic_internet_services_footer_listborder_col',
	   'section'   => 'classic_internet_services_footer',
	   'label' => __('List Border Color', 'classic-internet-services'),
	   'type'      => 'color'
	));

    // Google Fonts
    $wp_customize->add_section( 'classic_internet_services_google_fonts_section', array(
		'title'       => __( 'Google Fonts', 'classic-internet-services' ),
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

	$wp_customize->add_setting( 'classic_internet_services_headings_fonts', array(
		'sanitize_callback' => 'classic_internet_services_sanitize_fonts',
	));
	$wp_customize->add_control( 'classic_internet_services_headings_fonts', array(
		'type' => 'select',
		'description' => __('Select your desired font for the headings.', 'classic-internet-services'),
		'section' => 'classic_internet_services_google_fonts_section',
		'choices' => $font_choices
	));

	$wp_customize->add_setting( 'classic_internet_services_body_fonts', array(
		'sanitize_callback' => 'classic_internet_services_sanitize_fonts'
	));
	$wp_customize->add_control( 'classic_internet_services_body_fonts', array(
		'type' => 'select',
		'description' => __( 'Select your desired font for the body.', 'classic-internet-services' ),
		'section' => 'classic_internet_services_google_fonts_section',
		'choices' => $font_choices
	));
}
add_action( 'customize_register', 'Classic_Internet_Services_Customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function Classic_Internet_Services_Customize_preview_js() {
	wp_enqueue_script( 'Classic_Internet_Services_Customizer', esc_url(get_template_directory_uri()) . '/js/customize-preview.js', array( 'customize-preview' ), '20161510', true );
}
add_action( 'customize_preview_init', 'Classic_Internet_Services_Customize_preview_js' );