<?php
/**
 * Elearning Online Courses functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Elearning Online Courses
 */

if ( ! defined( 'ONLINE_TUTOR_URL' ) ) {
    define( 'ONLINE_TUTOR_URL', esc_url( 'https://www.themagnifico.net/themes/online-courses-wordpress-theme/', 'elearning-online-courses') );
}
if ( ! defined( 'ONLINE_TUTOR_TEXT' ) ) {
    define( 'ONLINE_TUTOR_TEXT', __( 'Elearning Courses Pro','elearning-online-courses' ));
}

function elearning_online_courses_enqueue_styles() {
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.css');
    $parentcss = 'online-tutor-style';
    $theme = wp_get_theme(); wp_enqueue_style( $parentcss, get_template_directory_uri() . '/style.css', array(), $theme->parent()->get('Version'));
    wp_enqueue_style( 'elearning-online-courses-style', get_stylesheet_uri(), array( $parentcss ), $theme->get('Version'));

    wp_enqueue_script( 'comment-reply', '/wp-includes/js/comment-reply.min.js', array(), false, true );  
}

add_action( 'wp_enqueue_scripts', 'elearning_online_courses_enqueue_styles' );

function elearning_online_courses_customize_register($wp_customize){ 

    $wp_customize->add_setting('elearning_online_courses_admission',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('elearning_online_courses_admission',array(
        'label' => esc_html__('Addmission Text','elearning-online-courses'),
        'section' => 'online_tutor_top_header',
        'setting' => 'elearning_online_courses_admission',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('elearning_online_courses_admission_link',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('elearning_online_courses_admission_link',array(
        'label' => esc_html__('Addmission Link','elearning-online-courses'),
        'section' => 'online_tutor_top_header',
        'setting' => 'elearning_online_courses_admission_link',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('elearning_online_courses_research',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('elearning_online_courses_research',array(
        'label' => esc_html__('Research Text','elearning-online-courses'),
        'section' => 'online_tutor_top_header',
        'setting' => 'elearning_online_courses_research',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('elearning_online_courses_research_link',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('elearning_online_courses_research_link',array(
        'label' => esc_html__('Research Link','elearning-online-courses'),
        'section' => 'online_tutor_top_header',
        'setting' => 'elearning_online_courses_research_link',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('elearning_online_courses_faq',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('elearning_online_courses_faq',array(
        'label' => esc_html__('FAQs Text','elearning-online-courses'),
        'section' => 'online_tutor_top_header',
        'setting' => 'elearning_online_courses_faq',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('elearning_online_courses_faq_link',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('elearning_online_courses_faq_link',array(
        'label' => esc_html__('FAQs Link','elearning-online-courses'),
        'section' => 'online_tutor_top_header',
        'setting' => 'elearning_online_courses_faq_link',
        'type'  => 'url'
    ));
    $project_loop = get_theme_mod('online_tutor_project_loop');

    $online_tutor_args = array('numberposts' => -1);
    $post_list = get_posts($online_tutor_args);
    $i = 1;
    $pst_sls[]= __('Select','elearning-online-courses');
    foreach ($post_list as $key => $p_post) {
        $pst_sls[$p_post->ID]=$p_post->post_title;
    }
    
    for ( $i = 1; $i <= $project_loop; $i++ ) {
        $wp_customize->add_setting('elearning_online_courses_projects_courses_text' .$i,array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('elearning_online_courses_projects_courses_text'.$i,array(
            'label' => esc_html__('Course Text','elearning-online-courses'),
            'section' => 'online_tutor_latest_project',
            'setting' => 'elearning_online_courses_projects_courses_text'.$i,
            'type'  => 'text'
        ));
        
    } 
}
add_action('customize_register', 'elearning_online_courses_customize_register');

if ( ! function_exists( 'elearning_online_courses_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function elearning_online_courses_setup() {

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

        add_image_size('elearning-online-courses-featured-header-image', 2000, 660, true);

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
        add_theme_support( 'custom-background', apply_filters( 'online_tutor_custom_background_args', array(
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
add_action( 'after_setup_theme', 'elearning_online_courses_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function elearning_online_courses_widgets_init() {
        register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'elearning-online-courses' ),
        'id'            => 'sidebar',
        'description'   => esc_html__( 'Add widgets here.', 'elearning-online-courses' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ) );
}
add_action( 'widgets_init', 'elearning_online_courses_widgets_init' );

function elearning_online_courses_remove_customize_register() {
    global $wp_customize;
    $wp_customize->remove_section( 'online_tutor_color_option' );
    $wp_customize->remove_section( 'online_tutor_general_settings' );

    $wp_customize->remove_setting( 'online_tutor_ticket_url' );
    $wp_customize->remove_control( 'online_tutor_ticket_url' );

    $wp_customize->remove_setting( 'online_tutor_phone_number' );
    $wp_customize->remove_control( 'online_tutor_phone_number' );

    $wp_customize->remove_setting( 'online_tutor_email' );
    $wp_customize->remove_control( 'online_tutor_email' );

    $wp_customize->remove_setting( 'online_tutor_consultation_button2' );
    $wp_customize->remove_control( 'online_tutor_consultation_button2' );

    $wp_customize->remove_setting( 'online_tutor_button2_url' );
    $wp_customize->remove_control( 'online_tutor_button2_url' );

    $wp_customize->remove_setting( 'pro_version_top_header_setting' );
    $wp_customize->remove_control( 'pro_version_top_header_setting' );

    $wp_customize->remove_setting( 'pro_version_header_setting' );
    $wp_customize->remove_control( 'pro_version_header_setting' );

    $wp_customize->remove_setting( 'pro_version_slider_setting' );
    $wp_customize->remove_control( 'pro_version_slider_setting' );

    $wp_customize->remove_setting( 'pro_version_project_setting' );
    $wp_customize->remove_control( 'pro_version_project_setting' );

    $wp_customize->remove_setting( 'pro_version_footer_setting' );
    $wp_customize->remove_control( 'pro_version_footer_setting' );
}
add_action( 'customize_register', 'elearning_online_courses_remove_customize_register', 11 );

function elearning_online_courses_remove_my_action() {
    remove_action( 'admin_menu','online_tutor_themepage' );
    remove_action( 'after_switch_theme','online_tutor_setup_options' );
}
add_action( 'init', 'elearning_online_courses_remove_my_action');