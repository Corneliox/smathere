<?php
/**
 * Traveller Agency Theme Customizer
 *
 * @link: https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @package Traveller Agency
 */


if ( ! defined( 'TRAVELLER_AGENCY_URL' ) ) {
    define( 'TRAVELLER_AGENCY_URL', esc_url( 'https://www.themagnifico.net/themes/travel-agency-wordpress-theme/', 'traveller-agency', 'traveller-agency') );
}

if ( ! defined( 'TRAVELLER_AGENCY_TEXT' ) ) {
    define( 'TRAVELLER_AGENCY_TEXT', __( 'Traveller Agency Pro','traveller-agency' ));
}

if ( ! defined( 'TRAVELLER_AGENCY_BUY_TEXT' ) ) {
    define( 'TRAVELLER_AGENCY_BUY_TEXT', __( 'Buy Traveller Agency Pro','traveller-agency' ));
}

use WPTRT\Customize\Section\Traveller_Agency_Button;

add_action( 'customize_register', function( $manager ) {

    $manager->register_section_type( Traveller_Agency_Button::class );

    $manager->add_section(
        new Traveller_Agency_Button( $manager, 'traveller_agency_pro', [
           'title'       => esc_html( TRAVELLER_AGENCY_TEXT,'traveller-agency' ),
            'priority'    => 0,
            'button_text' => __( 'GET PREMIUM', 'traveller-agency' ),
            'button_url'  => esc_url( TRAVELLER_AGENCY_URL )
        ] )
    );

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'traveller-agency-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
        [ 'customize-controls' ],
        $version,
        true
    );

    wp_enqueue_style(
        'traveller-agency-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
        [ 'customize-controls' ],
        $version
    );

} );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function traveller_agency_customize_register($wp_customize){

     // Pro Version
    class Traveller_Agency_Customize_Pro_Version extends WP_Customize_Control {
        public $type = 'pro_options';

        public function render_content() {
            echo '<span>For More <strong>'. esc_html( $this->label ) .'</strong>?</span>';
            echo '<a href="'. esc_url($this->description) .'" target="_blank">';
                echo '<span class="dashicons dashicons-info"></span>';
                echo '<strong> '. esc_html( TRAVELLER_AGENCY_BUY_TEXT,'traveller-agency' ) .'<strong></a>';
            echo '</a>';
        }
    }

    // Custom Controls
    function Traveller_Agency_sanitize_custom_control( $input ) {
        return $input;
    }

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    $wp_customize->add_setting('traveller_agency_logo_title_text', array(
      'default' => true,
      'sanitize_callback' => 'traveller_agency_sanitize_checkbox'
  ));
  $wp_customize->add_control( new WP_Customize_Control($wp_customize,'traveller_agency_logo_title_text',array(
      'label'          => __( 'Enable Disable Title', 'traveller-agency' ),
      'section'        => 'title_tagline',
      'settings'       => 'traveller_agency_logo_title_text',
      'type'           => 'checkbox',
  )));

  $wp_customize->add_setting('traveller_agency_theme_description', array(
      'default' => false,
      'sanitize_callback' => 'traveller_agency_sanitize_checkbox'
  ));
  $wp_customize->add_control( new WP_Customize_Control($wp_customize,'traveller_agency_theme_description',array(
      'label'          => __( 'Enable Disable Tagline', 'traveller-agency' ),
      'section'        => 'title_tagline',
      'settings'       => 'traveller_agency_theme_description',
      'type'           => 'checkbox',
  )));

  // General Settings
     $wp_customize->add_section('traveller_agency_general_settings',array(
        'title' => esc_html__('General Settings','traveller-agency'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting('traveller_agency_scroll_hide', array(
        'default' => false,
        'sanitize_callback' => 'traveller_agency_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'traveller_agency_scroll_hide',array(
        'label'          => __( 'Show Theme Scroll To Top', 'traveller-agency' ),
        'section'        => 'traveller_agency_general_settings',
        'settings'       => 'traveller_agency_scroll_hide',
        'type'           => 'checkbox',
    )));

     // Pro Version
    $wp_customize->add_setting( 'pro_version_general_setting', array(
        'sanitize_callback' => 'Traveller_Agency_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Traveller_Agency_Customize_Pro_Version ( $wp_customize,'pro_version_general_setting', array(
        'section'     => 'traveller_agency_general_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'traveller-agency' ),
        'description' => esc_url( TRAVELLER_AGENCY_URL ),
        'priority'    => 100
    )));

    //Header
    $wp_customize->add_section('traveller_agency_header',array(
        'title' => esc_html__('Header Option','traveller-agency')
    ));

    $wp_customize->add_setting('traveller_agency_phone',array(
        'default' => '',
        'sanitize_callback' => 'traveller_agency_sanitize_phone_number'
    ));
    $wp_customize->add_control('traveller_agency_phone',array(
        'label' => esc_html__('Phone Number','traveller-agency'),
        'section' => 'traveller_agency_header',
        'setting' => 'traveller_agency_phone',
        'type'  => 'text'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_header_setting', array(
        'sanitize_callback' => 'Traveller_Agency_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Traveller_Agency_Customize_Pro_Version ( $wp_customize,'pro_version_header_setting', array(
        'section'     => 'traveller_agency_header',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'traveller-agency' ),
        'description' => esc_url( TRAVELLER_AGENCY_URL ),
        'priority'    => 100
    )));

    //Slider
    $wp_customize->add_section('traveller_agency_top_slider',array(
        'title' => esc_html__('Slider Option','traveller-agency')
    ));

    for ( $count = 1; $count <= 3; $count++ ) {
        $wp_customize->add_setting( 'traveller_agency_top_slider_page' . $count, array(
            'default'           => '',
            'sanitize_callback' => 'traveller_agency_sanitize_dropdown_pages'
        ) );
        $wp_customize->add_control( 'traveller_agency_top_slider_page' . $count, array(
            'label'    => __( 'Select Slide Page', 'traveller-agency' ),
            'section'  => 'traveller_agency_top_slider',
            'type'     => 'dropdown-pages'
        ) );
    }

    $wp_customize->add_setting('traveller_agency_email_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('traveller_agency_email_text',array(
        'label' => esc_html__('Email Text','traveller-agency'),
        'section' => 'traveller_agency_top_slider',
        'setting' => 'traveller_agency_email_text',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('traveller_agency_email',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_email'
    ));
    $wp_customize->add_control('traveller_agency_email',array(
        'label' => esc_html__('Email','traveller-agency'),
        'section' => 'traveller_agency_top_slider',
        'setting' => 'traveller_agency_email',
        'type'  => 'text'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_slider_setting', array(
        'sanitize_callback' => 'Traveller_Agency_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Traveller_Agency_Customize_Pro_Version ( $wp_customize,'pro_version_slider_setting', array(
        'section'     => 'traveller_agency_top_slider',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'traveller-agency' ),
        'description' => esc_url( TRAVELLER_AGENCY_URL ),
        'priority'    => 100
    )));

    // Best Destination

    $wp_customize->add_section('traveller_agency_best_destination',array(
        'title' => esc_html__('Best Destination','traveller-agency'),
        'description' => esc_html__('Here you have to select category which will display Best Destination in the home page.','traveller-agency')
    ));

    $wp_customize->add_setting('traveller_agency_best_destination_title',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('traveller_agency_best_destination_title',array(
        'label' => esc_html__('Title','traveller-agency'),
        'section' => 'traveller_agency_best_destination',
        'setting' => 'traveller_agency_best_destination_title',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('traveller_agency_best_destination_short_title',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('traveller_agency_best_destination_short_title',array(
        'label' => esc_html__('Short Title','traveller-agency'),
        'section' => 'traveller_agency_best_destination',
        'setting' => 'traveller_agency_best_destination_short_title',
        'type'  => 'text'
    ));

    $categories = get_categories();
    $cat_post = array();
    $cat_post[]= 'select';
    $i = 0;
    foreach($categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cat_post[$category->slug] = $category->name;
    }

    $wp_customize->add_setting('traveller_agency_best_destination_category',array(
        'default'   => 'select',
        'sanitize_callback' => 'traveller_agency_sanitize_select',
    ));
    $wp_customize->add_control('traveller_agency_best_destination_category',array(
        'type'    => 'select',
        'choices' => $cat_post,
        'label' => __('Select category to display latest properties','traveller-agency'),
        'section' => 'traveller_agency_best_destination',
    ));

     // Pro Version
    $wp_customize->add_setting( 'pro_version_destination_setting', array(
        'sanitize_callback' => 'Traveller_Agency_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Traveller_Agency_Customize_Pro_Version ( $wp_customize,'pro_version_destination_setting', array(
        'section'     => 'traveller_agency_best_destination',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'traveller-agency' ),
        'description' => esc_url( TRAVELLER_AGENCY_URL ),
        'priority'    => 100
    )));

    // Footer
    $wp_customize->add_section('traveller_agency_site_footer_section', array(
        'title' => esc_html__('Footer', 'traveller-agency'),
    ));

    $wp_customize->add_setting('traveller_agency_footer_text_setting', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('traveller_agency_footer_text_setting', array(
        'label' => __('Replace the footer text', 'traveller-agency'),
        'section' => 'traveller_agency_site_footer_section',
        'priority' => 1,
        'type' => 'text',
    ));

     // Pro Version
    $wp_customize->add_setting( 'pro_version_footer_setting', array(
        'sanitize_callback' => 'Traveller_Agency_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Traveller_Agency_Customize_Pro_Version ( $wp_customize,'pro_version_footer_setting', array(
        'section'     => 'traveller_agency_site_footer_section',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'traveller-agency' ),
        'description' => esc_url( TRAVELLER_AGENCY_URL ),
        'priority'    => 100
    )));
}
add_action('customize_register', 'traveller_agency_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function traveller_agency_customize_partial_blogname(){
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function traveller_agency_customize_partial_blogdescription(){
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function traveller_agency_customize_preview_js(){
    wp_enqueue_script('traveller-agency-customizer', esc_url(get_template_directory_uri()) . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'traveller_agency_customize_preview_js');

/*
** Load dynamic logic for the customizer controls area.
*/
function traveller_agency_panels_js() {
    wp_enqueue_style( 'traveller-agency-customizer-layout-css', get_theme_file_uri( '/assets/css/customizer-layout.css' ) );
    wp_enqueue_script( 'traveller-agency-customize-layout', get_theme_file_uri( '/assets/js/customize-layout.js' ), array(), '1.2', true );
}
add_action( 'customize_controls_enqueue_scripts', 'traveller_agency_panels_js' );

