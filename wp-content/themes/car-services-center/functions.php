<?php
/**
 * Car Services Center functions and definitions
 *
 * @package Car Services Center
 */

if ( ! function_exists( 'car_services_center_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function car_services_center_setup() {
	global $car_services_center_content_width;
	if ( ! isset( $car_services_center_content_width ) )
		$car_services_center_content_width = 680;

	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'wp-block-styles');
	add_theme_support( 'align-wide' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 100,
		'flex-height' => true,
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	add_editor_style( 'editor-style.css' );
}
endif; // car_service_setup
add_action( 'after_setup_theme', 'car_services_center_setup' );

function car_services_center_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'car-services-center' ),
		'description'   => __( 'Appears on blog page sidebar', 'car-services-center' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget 1', 'car-services-center' ),
		'description'   => __( 'Appears on footer', 'car-services-center' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="ftr-4-box widget-column-1 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget 2', 'car-services-center' ),
		'description'   => __( 'Appears on footer', 'car-services-center' ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="ftr-4-box widget-column-2 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget 3', 'car-services-center' ),
		'description'   => __( 'Appears on footer', 'car-services-center' ),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="ftr-4-box widget-column-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget 4', 'car-services-center' ),
		'description'   => __( 'Appears on footer', 'car-services-center' ),
		'id'            => 'footer-4',
		'before_widget' => '<aside id="%1$s" class="ftr-4-box widget-column-4 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'car_services_center_widgets_init' );

add_action( 'wp_enqueue_scripts', 'car_services_center_enqueue_styles' );
function car_services_center_enqueue_styles() {
    $parenthandle = 'car-services-center-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    $car_services_center_color_scheme_css = get_theme_mod('car_services_center_color_scheme_css');
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, esc_url(get_template_directory_uri()) . '/style.css',
        array(),  // if the parent theme code has a dependency, copy it to here
        $theme->parent()->get('Version')
    );
    wp_enqueue_style( 'car-services-center-child-style', get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get('Version') // this only works if you have Version in the style header
    );
}

function Car_Services_Center_Category_Dropdown_Custom_Control( $page_id, $setting ) {
  		$page_id = absint( $page_id );
  		return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

// Customizer Section
function car_services_center_customizer ( $wp_customize ) {
	// Services Section
	$wp_customize->add_section('car_services_center_service_section', array(
		'title'	=> __('Manage Services Section','car-services-center'),
		'priority'	=> null,
		'description'	=> __('<p class="sec-title">Manage Services Section</p> Select Pages from the dropdown for Services.','car-services-center'),
		'panel' => 'car_service_panel_area',
	));

	// Add a category dropdown Slider Coloumn
	$wp_customize->add_setting( 'car_services_center_services_cat', array(
		'default'	=> '0',
		'sanitize_callback'	=> 'absint'
	) );
	$wp_customize->add_control( new Car_Services_Center_Category_Dropdown_Custom_Control( $wp_customize, 'car_services_center_services_cat', array(
		'section' => 'car_services_center_service_section',
		'settings'   => 'car_services_center_services_cat',
	) ) );

	$wp_customize->add_setting('car_services_center_disabled_pgboxes',array(
		'default' => false,
		'sanitize_callback' => 'car_service_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'car_services_center_disabled_pgboxes', array(
	   'settings' => 'car_services_center_disabled_pgboxes',
	   'section'   => 'car_services_center_service_section',
	   'label'     => __('Check To Enable This Section','car-services-center'),
	   'type'      => 'checkbox'
	));


	$wp_customize->add_setting('car_services_center_service_spanheading',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'car_services_center_service_spanheading', array(
	   'settings' => 'car_services_center_service_spanheading',
	   'section'   => 'car_services_center_service_section',
	   'label' => __('Add Heading', 'car-services-center'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('car_services_center_headingtext_para',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'car_services_center_headingtext_para', array(
	   'settings' => 'car_services_center_headingtext_para',
	   'section'   => 'car_services_center_service_section',
	   'label' => __('Add Heading Content', 'car-services-center'),
	   'type'      => 'text'
	));

}
add_action( 'customize_register', 'car_services_center_customizer' );

// customizer css
function car_services_center_enqueue_customizer_css() {
    wp_enqueue_style( 'car_services_center-customizer-css', get_stylesheet_directory_uri() . '/css/customize-controls.css' );
}
add_action( 'customize_controls_print_styles', 'car_services_center_enqueue_customizer_css' );

function car_services_center_scripts() {
	wp_enqueue_style( 'car-services-center-responsive', esc_url(get_theme_file_uri())."/css/responsive.css" );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'car_services_center_scripts' );

add_action( 'customize_register', 'car_services_center_customize_register', 11 );
function car_services_center_customize_register() {
	global $wp_customize;

	$wp_customize->remove_setting( 'car_service_stickyheader' );
	$wp_customize->remove_control( 'car_service_stickyheader' );
	$wp_customize->remove_setting( 'car_service_headerstickybg_col' );
	$wp_customize->remove_control( 'car_service_headerstickybg_col' );
	$wp_customize->remove_setting( 'car_service_pgboxes_title' );
	$wp_customize->remove_control( 'car_service_pgboxes_title' );
	$wp_customize->remove_section( 'car_service_below_banner_section' );

	$wp_customize->remove_setting( 'car_service_slidertitle_col' );
	$wp_customize->remove_control( 'car_service_slidertitle_col' );
	$wp_customize->remove_setting( 'car_service_slidercircleone_col' );
	$wp_customize->remove_control( 'car_service_slidercircleone_col' );
	$wp_customize->remove_setting( 'car_service_slidercircletwo_col' );
	$wp_customize->remove_control( 'car_service_slidercircletwo_col' );
	$wp_customize->remove_setting( 'car_service_slidercirclethree_col' );
	$wp_customize->remove_control( 'car_service_slidercirclethree_col' );

	$wp_customize->remove_setting( 'car_service_color_scheme_one' );
	$wp_customize->remove_control( 'car_service_color_scheme_one' );
	$wp_customize->remove_setting( 'car_service_color_scheme_two' );
	$wp_customize->remove_control( 'car_service_color_scheme_two' );

}

get_template_part('/inc/select/category-dropdown-custom-control');

/**
 * Theme Info Page.
 */
if ( ! defined( 'CAR_SERVICE_PRO_NAME' ) ) {
	define( 'CAR_SERVICE_PRO_NAME', __( 'About Car Services Center', 'car-services-center' ));
}

if ( ! defined( 'CAR_SERVICE_THEME_PAGE' ) ) {
define('CAR_SERVICE_THEME_PAGE',__('https://www.theclassictemplates.com/themes/','car-services-center'));
}
if ( ! defined( 'CAR_SERVICE_SUPPORT' ) ) {
define('CAR_SERVICE_SUPPORT',__('https://wordpress.org/support/theme/car-services-center/','car-services-center'));
}
if ( ! defined( 'CAR_SERVICE_REVIEW' ) ) {
define('CAR_SERVICE_REVIEW',__('https://wordpress.org/support/theme/car-services-center/reviews/#new-post','car-services-center'));
}
if ( ! defined( 'CAR_SERVICE_PRO_DEMO' ) ) {
define('CAR_SERVICE_PRO_DEMO',__('https://theclassictemplates.com/demo/car-service/','car-services-center'));
}
if ( ! defined( 'CAR_SERVICE_PREMIUM_PAGE' ) ) {
define('CAR_SERVICE_PREMIUM_PAGE',__('https://www.theclassictemplates.com/wp-themes/car-service-wordpress-theme/','car-services-center'));
}
if ( ! defined( 'CAR_SERVICE_THEME_DOCUMENTATION' ) ) {
define('CAR_SERVICE_THEME_DOCUMENTATION',__('https://theclassictemplates.com/documentation/car-service/','car-services-center'));
}