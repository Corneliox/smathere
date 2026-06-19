<?php
function agencyup_archive_page_setting( $wp_customize ) {

	/* General Section */
	$wp_customize->add_section( 'archive_options', array(
		'priority' => 4,
		'capability' => 'edit_theme_options',
		'title' => __('Archive page title', 'agencyup'),
	) );

	

    $wp_customize->add_setting(
    'archive_page_title',
    array(
        'default' => esc_html__('Archive','agencyup'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'agencyup_archive_page_sanitize_text',
        )
    );  
    $wp_customize->add_control( 'archive_page_title',array(
    'label'   => esc_html__('Archive','agencyup'),
    'section' => 'archive_options',
     'type' => 'text'
    )); 
    
    $wp_customize->add_setting(
    'category_page_title',
    array(
        'default' => esc_html__('Category','agencyup'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'agencyup_archive_page_sanitize_text',
        )
    );  
    $wp_customize->add_control( 'category_page_title',array(
    'label'   => esc_html__('Category','agencyup'),
    'section' => 'archive_options',
     'type' => 'text'
    ));

    $wp_customize->add_setting(
    'author_page_title',
    array(
        'default' => esc_html__('All posts by','agencyup'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'agencyup_archive_page_sanitize_text',
        )
    );  
    $wp_customize->add_control( 'author_page_title',array(
    'label'   => esc_html__('Author','agencyup'),
    'section' => 'archive_options',
     'type' => 'text'
    ));
    
    $wp_customize->add_setting(
    'tag_page_title',
    array(
        'default' => esc_html__('Tag','agencyup'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'agencyup_archive_page_sanitize_text',
        )
    );  
    $wp_customize->add_control( 'tag_page_title',array(
    'label'   => esc_html__('Tag','agencyup'),
    'section' => 'archive_options',
     'type' => 'text'
    ));
    
    
    $wp_customize->add_setting(
    'search_page_title',
    array(
        'default' => esc_html__('Search results for','agencyup'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'agencyup_archive_page_sanitize_text',
        )
    );  
    $wp_customize->add_control( 'search_page_title',array(
    'label'   => esc_html__('Search','agencyup'),
    'section' => 'archive_options',
     'type' => 'text'
    ));
    
    $wp_customize->add_setting(
    '404_page_title',
    array(
        'default' => esc_html__('404','agencyup'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'agencyup_archive_page_sanitize_text',
        )
    );  
    $wp_customize->add_control( '404_page_title',array(
    'label'   => esc_html__('404','agencyup'),
    'section' => 'archive_options',
     'type' => 'text'
    ));
    
    
    $wp_customize->add_setting(
    'shop_page_title',
    array(
        'default' => esc_html__('Shop','agencyup'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'agencyup_archive_page_sanitize_text',
        )
    );  
    $wp_customize->add_control( 'shop_page_title',array(
    'label'   => esc_html__('Shop','agencyup'),
    'section' => 'archive_options',
     'type' => 'text'
    ));
    }
add_action( 'customize_register', 'agencyup_archive_page_setting' );

function agencyup_archive_page_sanitize_text( $input ) {

    return wp_kses_post( force_balance_tags( $input ) );

}