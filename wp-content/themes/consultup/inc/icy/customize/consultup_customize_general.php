<?php
function consultup_general_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

    /* General Section */
    $wp_customize->add_panel( 'general_options', array(
        'priority' => 3,
        'capability' => 'edit_theme_options',
        'title' => __('General Settings', 'consultup'),
    ) );

    //Logo and Background color settings
    $wp_customize->add_section(
        'colors',
        array(
            'priority'      => 1,
            'title'         => __('Colors','consultup'),
            'panel'         => 'general_options',
        )
    );

    $wp_customize->add_section(
        'header_image',
        array(
            'priority'      => 2,
            'title'         => __('Breadcrumb','consultup'),
            'panel'         => 'general_options',
        )
    );

    $wp_customize->add_setting( 
        'breadcrumb_display' , 
            array(
            'default' => '1',
            'sanitize_callback' => 'consultup_general_sanitize_checkbox',
            'capability' => 'edit_theme_options',
            'priority' => 1,
        ) 
    );
    
    $wp_customize->add_control(
    'breadcrumb_display', 
        array(
            'label'       => esc_html__( 'Hide / Show', 'consultup' ),
            'section'     => 'header_image',
            'type'        => 'checkbox'
        ) 
    );

    $wp_customize->add_setting( 
        'breadcrumb_img_type_display' , 
            array(
            'default' => 'scroll',
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'consultup_sanitize_select',
            'priority'  => 10,
        ) 
    );
    
    $wp_customize->add_control(
    'breadcrumb_img_type_display' , 
        array(
            'label'          => __( 'Background Attachment', 'consultup' ),
            'section'        => 'header_image',
            'type'           => 'select',
            'choices'        => 
            array(
                'inherit' => __( 'Inherit', 'consultup' ),
                'scroll' => __( 'Scroll', 'consultup' ),
                'fixed'   => __( 'Fixed', 'consultup' )
            ) 
        ) 
    );

    $wp_customize->add_setting('consultup_title_font_size',
        array(
            'default'           => 25,
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control('consultup_title_font_size',
        array(
            'label'    => esc_html__('Site Title Size', 'consultup'),
            'section'  => 'title_tagline',
            'type'     => 'number',
            'priority' => 50,
        )
    );

    $wp_customize->add_section(
        'nav_menu_section',
        array(
            'priority'      => 29,
            'title'         => __('Menus','consultup'),
            'panel'         => 'header_options',
        )
    );
    $wp_customize->add_setting( 'nav_menu_sticky', array(
        'default'           => 'sticky',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'consultup_sanitize_select',
    ) );
    
    $wp_customize->add_control( 'nav_menu_sticky', array(
        'type'     => 'radio',
        'label'           => esc_html__( 'Menu Style', 'consultup' ),
        'section'         => 'nav_menu_section',
        'choices'         => array(
            'sticky'  => esc_html__( 'Sticky', 'consultup' ),
            'static' => esc_html__( 'Static', 'consultup' ),
    ) ) );


    //Scroller settings
    $wp_customize->add_section(
        'scroller',
        array(
            'priority'      => 1,
            'title'         => __('Scroller','consultup'),
            'panel'         => 'general_options',
        )
    );


    //Enable and disable social icon
    $wp_customize->add_setting(
    'scroller_enable'
    ,
    array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'consultup_social_sanitize_checkbox',
    )   
    );
    $wp_customize->add_control(
    'scroller_enable',
    array(
        'label' => __('Hide / Show','consultup'),
        'section' => 'scroller',
        'type' => 'checkbox',
    )
    );
}
add_action( 'customize_register', 'consultup_general_setting' );



function consultup_general_sanitize_checkbox( $input ) {
            // Boolean check 
    return ( ( isset( $input ) && true == $input ) ? true : false );
    
    }
add_action( 'customize_register', 'consultup_general_sanitize_checkbox' );


function consultup_sanitize_select( $input, $setting ) {
    
    // Ensure input is a slug.
    $input = sanitize_key( $input );
    
    // Get list of choices from the control associated with the setting.
    $choices = $setting->manager->get_control( $setting->id )->choices;
    
    // If the input is a valid key, return it; otherwise, return the default.
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
 