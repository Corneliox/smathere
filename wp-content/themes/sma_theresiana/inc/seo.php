<?php
/**
 * SMA Theresiana Auto SEO Module
 * 
 * Generates Meta Title, Meta Description, and Open Graph tags automatically.
 */

// Add SEO settings to Customizer
function th_seo_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'th_seo_section', [
        'title'       => __( 'SEO Settings', 'sma-theresiana' ),
        'priority'    => 150,
        'description' => __( 'Configure default SEO options.', 'sma-theresiana' ),
    ] );

    $wp_customize->add_setting( 'th_seo_default_image', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ] );
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'th_seo_default_image', [
        'label'    => __( 'Default Fallback Image (For WhatsApp/Facebook preview)', 'sma-theresiana' ),
        'section'  => 'th_seo_section',
        'settings' => 'th_seo_default_image',
    ] ) );
}
add_action( 'customize_register', 'th_seo_customize_register' );

// Inject Meta Tags into Head
function th_inject_seo_meta_tags() {
    global $post;

    // Default values
    $site_name = get_bloginfo( 'name' );
    $description = get_bloginfo( 'description' );
    $url = home_url( '/' );
    $type = 'website';
    
    // We don't overwrite <title> tag because WordPress core handles it perfectly via add_theme_support('title-tag')
    $og_title = $site_name . ' | ' . $description;
    
    $fallback_image = get_theme_mod( 'th_seo_default_image', '' );
    if ( empty( $fallback_image ) && function_exists('get_custom_logo') && has_custom_logo() ) {
        $logo_id = get_theme_mod( 'custom_logo' );
        $image = wp_get_attachment_image_url( $logo_id, 'full' );
    } else {
        $image = $fallback_image;
    }

    // Dynamic values for single posts/pages
    if ( is_singular() && ! is_front_page() ) {
        $type = 'article';
        $og_title = get_the_title() . ' - ' . $site_name;
        $url = get_permalink();
        
        // Custom excerpt or trim content
        if ( ! empty( $post->post_excerpt ) ) {
            $description = strip_tags( $post->post_excerpt );
        } else {
            $content = strip_shortcodes( $post->post_content );
            $content = wp_strip_all_tags( $content );
            $description = wp_trim_words( $content, 25, '...' );
        }

        if ( has_post_thumbnail() ) {
            $image = get_the_post_thumbnail_url( $post->ID, 'large' );
        }
    }

    // Output tags
    echo "\n<!-- SMA Theresiana Auto SEO Module -->\n";
    echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
    
    // Open Graph
    echo '<meta property="og:title" content="' . esc_attr( $og_title ) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
    echo '<meta property="og:type" content="' . esc_attr( $type ) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '">' . "\n";
    if ( ! empty( $image ) ) {
        echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    }
    
    echo "<!-- End SEO Module -->\n\n";
}
add_action( 'wp_head', 'th_inject_seo_meta_tags', 1 );
