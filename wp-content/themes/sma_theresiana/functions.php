<?php
/**
 * SMA Theresiana Theme Functions
 *
 * @package SMA_Theresiana
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ──────────────────────────────────────────────────────────────────────────────
// 1. THEME SETUP
// ──────────────────────────────────────────────────────────────────────────────

if ( ! function_exists( 'sma_theresiana_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function sma_theresiana_setup() {

        // Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        // Enable support for post thumbnails / featured images.
        add_theme_support( 'post-thumbnails' );

        // Switch default core markup to valid HTML5.
        add_theme_support( 'html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ] );

        // Automatic feed links in <head>.
        add_theme_support( 'automatic-feed-links' );

        // Custom logo support.
        add_theme_support( 'custom-logo', [
            'width'      => 200,
            'height'     => 80,
            'flex-width' => true,
        ] );

        // Register navigation menus.
        register_nav_menus( [
            'main'    => __( 'Main Menu', 'sma-theresiana' ),
            'primary' => __( 'Primary Menu', 'sma-theresiana' ), // Keeping primary just in case
            'footer'  => __( 'Menu Footer', 'sma-theresiana' ),
        ] );

        // Register custom image sizes.
        add_image_size( 'th-hero',  1920, 1080, true );
        add_image_size( 'th-card',   640,  400, true );
        add_image_size( 'th-thumb',  400,  280, true );

        // Load theme text domain for translations.
        load_theme_textdomain(
            'sma-theresiana',
            get_template_directory() . '/languages'
        );
    }
endif;

add_action( 'after_setup_theme', 'sma_theresiana_setup' );

// ──────────────────────────────────────────────────────────────────────────────
// 2. ENQUEUE SCRIPTS & STYLES
// ──────────────────────────────────────────────────────────────────────────────

if ( ! function_exists( 'sma_theresiana_enqueue' ) ) :
    /**
     * Enqueues scripts and styles for the front end.
     */
    function sma_theresiana_enqueue() {

        // Google Fonts — Inter + Raleway.
        wp_enqueue_style(
            'th-google-fonts',
            'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Raleway:wght@400;600;700;800&display=swap',
            [],
            null
        );

        // Font Awesome 4.7 from cdnjs.
        wp_enqueue_style(
            'th-font-awesome',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
            [],
            '4.7.0'
        );

        // Main stylesheet (actual theme styles).
        wp_enqueue_style(
            'th-main-style',
            get_template_directory_uri() . '/assets/css/main.css',
            [ 'th-google-fonts', 'th-font-awesome' ],
            filemtime( get_template_directory() . '/assets/css/main.css' )
        );

        // Main JavaScript — loaded in footer.
        wp_enqueue_script(
            'th-main-js',
            get_template_directory_uri() . '/assets/js/main.js',
            [],
            filemtime( get_template_directory() . '/assets/js/main.js' ),
            true // Load in footer.
        );

        // Localize script with useful PHP values.
        wp_localize_script(
            'th-main-js',
            'thTheme',
            [
                'ajaxUrl' => admin_url( 'admin-ajax.php' ),
                'homeUrl' => esc_url( home_url( '/' ) ),
            ]
        );
    }
endif;

add_action( 'wp_enqueue_scripts', 'sma_theresiana_enqueue' );

// ──────────────────────────────────────────────────────────────────────────────
// 3. ADD defer ATTRIBUTE TO main.js
// ──────────────────────────────────────────────────────────────────────────────

add_filter( 'script_loader_tag', function( $tag, $handle, $src ) {
    if ( 'th-main-js' === $handle ) {
        // Replace the plain <script src="..."> with a deferred version.
        $tag = '<script defer src="' . esc_url( $src ) . '"></script>' . "\n";
    }
    return $tag;
}, 10, 3 );

// ──────────────────────────────────────────────────────────────────────────────
// 4. WIDGETS / SIDEBARS
// ──────────────────────────────────────────────────────────────────────────────

if ( ! function_exists( 'sma_theresiana_widgets_init' ) ) :
    /**
     * Registers widget areas (sidebars).
     */
    function sma_theresiana_widgets_init() {

        // Primary sidebar.
        register_sidebar( [
            'name'          => __( 'Sidebar Utama', 'sma-theresiana' ),
            'id'            => 'th-sidebar',
            'description'   => __( 'Sidebar utama yang muncul di halaman arsip dan single post.', 'sma-theresiana' ),
            'before_widget' => '<section id="%1$s" class="th-widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="th-widget__title">',
            'after_title'   => '</h3>',
        ] );

        // Footer widget area.
        register_sidebar( [
            'name'          => __( 'Footer Widget Area', 'sma-theresiana' ),
            'id'            => 'th-footer-widgets',
            'description'   => __( 'Area widget di bagian footer halaman.', 'sma-theresiana' ),
            'before_widget' => '<section id="%1$s" class="th-footer-widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="th-footer-widget__title">',
            'after_title'   => '</h4>',
        ] );
    }
endif;

add_action( 'widgets_init', 'sma_theresiana_widgets_init' );


// ──────────────────────────────────────────────────────────────────────────────
// 5. DYNAMIC MENU ITEMS (Recent Posts & Categories)
// ──────────────────────────────────────────────────────────────────────────────
add_filter('wp_nav_menu_items', 'th_add_dynamic_dropdowns', 10, 2);
function th_add_dynamic_dropdowns($items, $args) {
    if ($args->theme_location == 'main' || $args->menu == 'Main Menu') {
        
        // 1. Recent Posts Dropdown
        $recent_posts = wp_get_recent_posts([
            'numberposts' => 5,
            'post_status' => 'publish'
        ]);
        
        $recent_html = '<li class="menu-item menu-item-has-children"><a href="#" class="th-menu__link">Recent Posts</a><ul class="sub-menu">';
        foreach($recent_posts as $post) {
            $recent_html .= '<li><a href="' . get_permalink($post['ID']) . '">' . esc_html($post['post_title']) . '<br><span class="post-date" style="font-size:11px; opacity:0.7; font-weight:normal;">' . get_the_date('jS F Y', $post['ID']) . '</span></a></li>';
        }
        $recent_html .= '</ul></li>';

        // 2. Categories Dropdown (Our High School)
        $categories = get_categories(['hide_empty' => false]);
        $cat_html = '<li class="menu-item menu-item-has-children"><a href="#" class="th-menu__link">Our High School</a><ul class="sub-menu">';
        foreach($categories as $cat) {
            $cat_html .= '<li><a href="' . get_category_link($cat->term_id) . '">' . esc_html($cat->name) . '</a></li>';
        }
        $cat_html .= '</ul></li>';

        // Append to existing items
        $items .= $recent_html . $cat_html;
    }
    return $items;
}

// ──────────────────────────────────────────────────────────────────────────────
// 5. EXCERPT CUSTOMISATION
// ──────────────────────────────────────────────────────────────────────────────

add_filter( 'excerpt_length', function() { return 20; }, 999 );

add_filter( 'excerpt_more', function() { return '...'; } );

// ──────────────────────────────────────────────────────────────────────────────
// 6. HELPER FUNCTIONS
// ──────────────────────────────────────────────────────────────────────────────

if ( ! function_exists( 'th_get_excerpt' ) ) :
    /**
     * Returns a trimmed excerpt for a given post.
     *
     * @param int $post_id  Post ID.
     * @param int $length   Character limit (default 120).
     * @return string       Plain-text excerpt, trimmed to $length characters.
     */
    function th_get_excerpt( $post_id, $length = 120 ) {
        $post = get_post( $post_id );

        if ( ! $post ) {
            return '';
        }

        // Use manual excerpt if available, otherwise generate from content.
        $raw = $post->post_excerpt
            ? $post->post_excerpt
            : wp_strip_all_tags( $post->post_content );

        $raw = wp_strip_all_tags( $raw );
        $raw = preg_replace( '/\s+/', ' ', trim( $raw ) );

        if ( mb_strlen( $raw ) <= $length ) {
            return $raw;
        }

        return mb_substr( $raw, 0, $length ) . '...';
    }
endif;

if ( ! function_exists( 'th_format_date' ) ) :
    /**
     * Returns the post date formatted in Indonesian (d M Y).
     *
     * @param int $post_id Post ID.
     * @return string      Formatted date string, e.g. "20 Jun 2026".
     */
    function th_format_date( $post_id ) {
        return get_the_date( 'd M Y', $post_id );
    }
endif;
// ──────────────────────────────────────────────────────────────────────────────
// 10. CUSTOMIZER INTEGRATION
// ──────────────────────────────────────────────────────────────────────────────
require get_template_directory() . '/inc/customizer.php';
