<?php
/**
 * Tour Operator Agency functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Tour Operator Agency
 */

if ( ! defined( 'TRAVELLER_AGENCY_URL' ) ) {
    define( 'TRAVELLER_AGENCY_URL', esc_url( 'https://www.themagnifico.net/themes/tour-operator-wordpress-theme/', 'tour-operator-agency') );
}
if ( ! defined( 'TRAVELLER_AGENCY_TEXT' ) ) {
    define( 'TRAVELLER_AGENCY_TEXT', __( 'Tour Operator Pro','tour-operator-agency' ));
}
if ( ! defined( 'TRAVELLER_AGENCY_CONTACT_SUPPORT' ) ) {
define('TRAVELLER_AGENCY_CONTACT_SUPPORT',__('https://wordpress.org/support/theme/tour-operator-agency','tour-operator-agency'));
}
if ( ! defined( 'TRAVELLER_AGENCY_REVIEW' ) ) {
define('TRAVELLER_AGENCY_REVIEW',__('https://wordpress.org/support/theme/tour-operator-agency/reviews/#new-post','tour-operator-agency'));
}
if ( ! defined( 'TRAVELLER_AGENCY_LIVE_DEMO' ) ) {
define('TRAVELLER_AGENCY_LIVE_DEMO',__('https://themagnifico.net/demo/tour-operator-agency/','tour-operator-agency'));
}
if ( ! defined( 'TRAVELLER_AGENCY_GET_PREMIUM_PRO' ) ) {
define('TRAVELLER_AGENCY_GET_PREMIUM_PRO',__('https://www.themagnifico.net/themes/tour-operator-wordpress-theme/','tour-operator-agency'));
}
if ( ! defined( 'TRAVELLER_AGENCY_PRO_DOC' ) ) {
define('TRAVELLER_AGENCY_PRO_DOC',__('https://www.themagnifico.net/eard/wathiqa/tour-operator-agency-doc/','tour-operator-agency'));
}
if ( ! defined( 'TRAVELLER_AGENCY_BUY_TEXT' ) ) {
    define( 'TRAVELLER_AGENCY_BUY_TEXT', __( 'Buy Tour Operator Pro','tour-operator-agency' ));
}

function tour_operator_agency_enqueue_styles() {
    
    $parentcss = 'traveller-agency-style';
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.css');
    $theme = wp_get_theme(); wp_enqueue_style( $parentcss, get_template_directory_uri() . '/style.css', array(), $theme->parent()->get('Version'));
    wp_enqueue_style( 'tour-operator-agency-style', get_stylesheet_uri(), array( $parentcss ), $theme->get('Version'));
    wp_enqueue_style( 'flatly-css', esc_url(get_template_directory_uri()) . '/assets/css/flatly.css');

    wp_enqueue_script( 'comment-reply', '/wp-includes/js/comment-reply.min.js', array(), false, true );  
}


add_action( 'wp_enqueue_scripts', 'tour_operator_agency_enqueue_styles' );

function tour_operator_agency_admin_scripts() {
    // demo CSS
    wp_enqueue_style( 'tour-operator-agency-demo-css', get_theme_file_uri( 'assets/css/demo.css' ) );
}
add_action( 'admin_enqueue_scripts', 'tour_operator_agency_admin_scripts' );

function tour_operator_agency_customize_register($wp_customize){

    $wp_customize->add_setting('tour_operator_agency_top_slider_text', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('tour_operator_agency_top_slider_text', array(
        'label' => __('Slider Title', 'tour-operator-agency'),
        'section' => 'traveller_agency_top_slider',
        'priority' => 1,
        'type' => 'text',
    ));

}
add_action('customize_register', 'tour_operator_agency_customize_register');

if ( ! function_exists( 'tour_operator_agency_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function tour_operator_agency_setup() {

        add_theme_support( 'responsive-embeds' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        add_image_size('tour-operator-agency-featured-header-image', 2000, 660, true);

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'traveller_agency_custom_background_args', array(
            'default-color' => '',
            'default-image' => '',
        ) ) );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 50,
            'width'       => 50,
            'flex-width'  => true,
        ) );

        add_editor_style( array( '/editor-style.css' ) );

        add_theme_support( 'align-wide' );

        add_theme_support( 'wp-block-styles' );
    }
endif;
add_action( 'after_setup_theme', 'tour_operator_agency_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tour_operator_agency_widgets_init() {
        register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'tour-operator-agency' ),
        'id'            => 'sidebar',
        'description'   => esc_html__( 'Add widgets here.', 'tour-operator-agency' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ) );
}
add_action( 'widgets_init', 'tour_operator_agency_widgets_init' );

function tour_operator_agency_remove_customize_register() {
    global $wp_customize;
    $wp_customize->remove_section( 'traveller_agency_color_option' );
    $wp_customize->remove_section( 'traveller_agency_general_settings' );

    $wp_customize->remove_control( 'traveller_agency_email_text' );
    $wp_customize->remove_control( 'traveller_agency_email' );
    
}
add_action( 'customize_register', 'tour_operator_agency_remove_customize_register', 11 );


/**
 * Meta Feild
 */
require get_stylesheet_directory() . '/inc/latest-destination-meta.php';