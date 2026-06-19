<?php
/**
 * Green Agro Landscaping: Customizer
 *
 * @package Green Agro Landscaping
 * @subpackage green_agro_landscaping
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function green_agro_landscaping_customize_register( $wp_customize ) {

	// Register the custom control type.
		$wp_customize->register_control_type( 'Green_Agro_Landscaping_Toggle_Control' );

	//add home page setting pannel
	$wp_customize->add_panel( 'green_agro_landscaping_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Home Page Settings', 'green-agro-landscaping' ),
	    'description' => __( 'Description of what this panel does.', 'green-agro-landscaping' ),
	) );


	//TP General Option
	$wp_customize->add_section('green_agro_landscaping_tp_general_settings',array(
        'title' => __('TP General Option', 'green-agro-landscaping'),
        'panel' => 'green_agro_landscaping_panel_id',
        'priority' => 10,
    ) );

    // Add Settings and Controls for Post Layout
	$wp_customize->add_setting('green_agro_landscaping_sidebar_post_layout',array(
        'default' => 'right',
        'sanitize_callback' => 'green_agro_landscaping_sanitize_choices'
	));
	$wp_customize->add_control('green_agro_landscaping_sidebar_post_layout',array(
        'type' => 'radio',
        'label'     => __('Theme Sidebar Position', 'green-agro-landscaping'),
        'description'   => __('This option work for blog page, blog single page, archive page and search page.', 'green-agro-landscaping'),
        'section' => 'green_agro_landscaping_tp_general_settings',
        'choices' => array(
            'full' => __('Full','green-agro-landscaping'),
            'left' => __('Left','green-agro-landscaping'),
            'right' => __('Right','green-agro-landscaping'),
            'three-column' => __('Three Columns','green-agro-landscaping'),
            'four-column' => __('Four Columns','green-agro-landscaping'),
            'grid' => __('Grid Layout','green-agro-landscaping')
        ),
	) );

	// Add Settings and Controls for Page Layout
	$wp_customize->add_setting('green_agro_landscaping_sidebar_page_layout',array(
        'default' => 'right',
        'sanitize_callback' => 'green_agro_landscaping_sanitize_choices'
	));
	$wp_customize->add_control('green_agro_landscaping_sidebar_page_layout',array(
        'type' => 'radio',
        'label'     => __('Page Sidebar Position', 'green-agro-landscaping'),
        'description'   => __('This option work for pages.', 'green-agro-landscaping'),
        'section' => 'green_agro_landscaping_tp_general_settings',
        'choices' => array(
            'full' => __('Full','green-agro-landscaping'),
            'left' => __('Left','green-agro-landscaping'),
            'right' => __('Right','green-agro-landscaping')
        ),
	) );

	$wp_customize->add_setting('green_agro_landscaping_sticky',array(
		'default' => false,
		'sanitize_callback'	=> 'green_agro_landscaping_sanitize_checkbox'
	));
	$wp_customize->add_control('green_agro_landscaping_sticky',array(
		'type' => 'checkbox',
		'label' => __('Show / Hide Sticky Header','green-agro-landscaping'),
		'section' => 'green_agro_landscaping_tp_general_settings',
	));

	$wp_customize->add_setting( 'green_agro_landscaping_preloader_show_hide', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'green_agro_landscaping_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Green_Agro_Landscaping_Toggle_Control( $wp_customize, 'green_agro_landscaping_preloader_show_hide', array(
		'label'       => esc_html__( 'Show / Hide Preloader Option', 'green-agro-landscaping' ),
		'section'     => 'green_agro_landscaping_tp_general_settings',
		'type'        => 'toggle',
		'settings'    => 'green_agro_landscaping_preloader_show_hide',
		) ) );

	$wp_customize->add_setting( 'green_agro_landscaping_sticky', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'green_agro_landscaping_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Green_Agro_Landscaping_Toggle_Control( $wp_customize, 'green_agro_landscaping_sticky', array(
		'label'       => esc_html__( 'Show Sticky Header', 'green-agro-landscaping' ),
		'section'     => 'green_agro_landscaping_tp_general_settings',
		'type'        => 'toggle',
		'settings'    => 'green_agro_landscaping_sticky',
	) ) );

	//TP Blog Option
	$wp_customize->add_section('green_agro_landscaping_blog_option',array(
        'title' => __('TP Blog Option', 'green-agro-landscaping'),
        'panel' => 'green_agro_landscaping_panel_id',
        'priority' => 10,
    ) );

	$wp_customize->add_setting( 'green_agro_landscaping_remove_date', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'green_agro_landscaping_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Green_Agro_Landscaping_Toggle_Control( $wp_customize, 'green_agro_landscaping_remove_date', array(
		'label'       => esc_html__( 'Show / Hide Date Option', 'green-agro-landscaping' ),
		'section'     => 'green_agro_landscaping_blog_option',
		'type'        => 'toggle',
		'settings'    => 'green_agro_landscaping_remove_date',
	) ) );


	$wp_customize->add_setting( 'green_agro_landscaping_remove_author', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'green_agro_landscaping_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Green_Agro_Landscaping_Toggle_Control( $wp_customize, 'green_agro_landscaping_remove_author', array(
		'label'       => esc_html__( 'Show / Hide Author Option', 'green-agro-landscaping' ),
		'section'     => 'green_agro_landscaping_blog_option',
		'type'        => 'toggle',
		'settings'    => 'green_agro_landscaping_remove_author',
	) ) );


	$wp_customize->add_setting( 'green_agro_landscaping_remove_comments', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'green_agro_landscaping_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Green_Agro_Landscaping_Toggle_Control( $wp_customize, 'green_agro_landscaping_remove_comments', array(
		'label'       => esc_html__( 'Show / Hide Comment Option', 'green-agro-landscaping' ),
		'section'     => 'green_agro_landscaping_blog_option',
		'type'        => 'toggle',
		'settings'    => 'green_agro_landscaping_remove_comments',
	) ) );


	$wp_customize->add_setting( 'green_agro_landscaping_remove_tags', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'green_agro_landscaping_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Green_Agro_Landscaping_Toggle_Control( $wp_customize, 'green_agro_landscaping_remove_tags', array(
		'label'       => esc_html__( 'Show / Hide Tags Option', 'green-agro-landscaping' ),
		'section'     => 'green_agro_landscaping_blog_option',
		'type'        => 'toggle',
		'settings'    => 'green_agro_landscaping_remove_tags',
	) ) );


 	$wp_customize->add_setting( 'green_agro_landscaping_remove_read_button', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'green_agro_landscaping_sanitize_checkbox',
	) );
	 $wp_customize->add_control( new Green_Agro_Landscaping_Toggle_Control( $wp_customize, 'green_agro_landscaping_remove_read_button', array(
		'label'       => esc_html__( 'Show / Hide Read More Button', 'green-agro-landscaping' ),
		'section'     => 'green_agro_landscaping_blog_option',
		'type'        => 'toggle',
		'settings'    => 'green_agro_landscaping_remove_read_button',
	) ) );

    $wp_customize->add_setting('green_agro_landscaping_read_more_text',array(
		'default'=> __('Read More','green-agro-landscaping'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('green_agro_landscaping_read_more_text',array(
		'label'	=> __('Edit Button Text','green-agro-landscaping'),
		'section'=> 'green_agro_landscaping_blog_option',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'green_agro_landscaping_excerpt_count', array(
		'default'              => 35,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'green_agro_landscaping_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'green_agro_landscaping_excerpt_count', array(
		'label'       => esc_html__( 'Edit Excerpt Limit','green-agro-landscaping' ),
		'section'     => 'green_agro_landscaping_blog_option',
		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	// Top bar Section
	$wp_customize->add_section( 'green_agro_landscaping_topbar', array(
    	'title'      => __( 'Header Details', 'green-agro-landscaping' ),
    	'description' => __( 'Add your contact details', 'green-agro-landscaping' ),
		'panel' => 'green_agro_landscaping_panel_id',
      	'priority' => 10,
	) );

	$wp_customize->add_setting('green_agro_landscaping_mail_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('green_agro_landscaping_mail_text',array(
		'label'	=> __('Add Email Text','green-agro-landscaping'),
		'section'=> 'green_agro_landscaping_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('green_agro_landscaping_mail',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_email'
	));
	$wp_customize->add_control('green_agro_landscaping_mail',array(
		'label'	=> __('Add Mail Address','green-agro-landscaping'),
		'section'=> 'green_agro_landscaping_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('green_agro_landscaping_call_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('green_agro_landscaping_call_text',array(
		'label'	=> __('Add Call Text','green-agro-landscaping'),
		'section'=> 'green_agro_landscaping_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('green_agro_landscaping_call',array(
		'default'=> '',
		'sanitize_callback'	=> 'green_agro_landscaping_sanitize_phone_number'
	));
	$wp_customize->add_control('green_agro_landscaping_call',array(
		'label'	=> __('Add Phone Number','green-agro-landscaping'),
		'section'=> 'green_agro_landscaping_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('green_agro_landscaping_hour_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('green_agro_landscaping_hour_text',array(
		'label'	=> __('Add Hours Text','green-agro-landscaping'),
		'section'=> 'green_agro_landscaping_topbar',
		'type'=> 'text'
	));


	$wp_customize->add_setting('green_agro_landscaping_hour',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('green_agro_landscaping_hour',array(
		'label'	=> __('Add Hours','green-agro-landscaping'),
		'section'=> 'green_agro_landscaping_topbar',
		'type'=> 'text'
	));

	//Social Media
	$wp_customize->add_section( 'green_agro_landscaping_social_media', array(
    	'title'      => __( 'Social Media Links', 'green-agro-landscaping' ),
    	'priority' => 10,
    	'description' => __( 'Add your Social Links', 'green-agro-landscaping' ),
		'panel' => 'green_agro_landscaping_panel_id'
	) );

	$wp_customize->selective_refresh->add_partial( 'green_agro_landscaping_facebook_url', array(
		'selector' => '.social-media',
		'render_callback' => 'green_agro_landscaping_customize_partial_green_agro_landscaping_facebook_url',
	) );

	$wp_customize->add_setting('green_agro_landscaping_facebook_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('green_agro_landscaping_facebook_url',array(
		'label'	=> __('Facebook Link','green-agro-landscaping'),
		'section'=> 'green_agro_landscaping_social_media',
		'type'=> 'url'
	));

	$wp_customize->add_setting('green_agro_landscaping_twitter_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('green_agro_landscaping_twitter_url',array(
		'label'	=> __('Twitter Link','green-agro-landscaping'),
		'section'=> 'green_agro_landscaping_social_media',
		'type'=> 'url'
	));

	$wp_customize->add_setting('green_agro_landscaping_instagram_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('green_agro_landscaping_instagram_url',array(
		'label'	=> __('Instagram Link','green-agro-landscaping'),
		'section'=> 'green_agro_landscaping_social_media',
		'type'=> 'url'
	));

	$wp_customize->add_setting('green_agro_landscaping_youtube_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('green_agro_landscaping_youtube_url',array(
		'label'	=> __('YouTube Link','green-agro-landscaping'),
		'section'=> 'green_agro_landscaping_social_media',
		'type'=> 'url'
	));

	$wp_customize->add_setting('green_agro_landscaping_pint_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('green_agro_landscaping_pint_url',array(
		'label'	=> __('Pinterest Link','green-agro-landscaping'),
		'section'=> 'green_agro_landscaping_social_media',
		'type'=> 'url'
	));



	//home page slider
	$wp_customize->add_section( 'green_agro_landscaping_slider_section' , array(
    	'title'      => __( 'Slider Settings', 'green-agro-landscaping' ),
		'panel' => 'green_agro_landscaping_panel_id',
      'priority' => 10,
	) );

	$wp_customize->add_setting( 'green_agro_landscaping_slider_arrows', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'green_agro_landscaping_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Green_Agro_Landscaping_Toggle_Control( $wp_customize, 'green_agro_landscaping_slider_arrows', array(
		'label'       => esc_html__( 'Show / Hide slider', 'green-agro-landscaping' ),
		'section'     => 'green_agro_landscaping_slider_section',
		'type'        => 'toggle',
		'settings'    => 'green_agro_landscaping_slider_arrows',
	) ) );

	for ( $green_agro_landscaping_count = 1; $green_agro_landscaping_count <= 4; $green_agro_landscaping_count++ ) {

		// Add color scheme setting and control.
		$wp_customize->add_setting( 'green_agro_landscaping_slider_page' . $green_agro_landscaping_count, array(
			'default'           => '',
			'sanitize_callback' => 'green_agro_landscaping_sanitize_dropdown_pages'
		) );

		$wp_customize->add_control( 'green_agro_landscaping_slider_page' . $green_agro_landscaping_count, array(
			'label'    => __( 'Select Slide Image Page', 'green-agro-landscaping' ),
			'section'  => 'green_agro_landscaping_slider_section',
			'type'     => 'dropdown-pages'
		) );
	}

	$wp_customize->add_setting( 'green_agro_landscaping_slider_button', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'green_agro_landscaping_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Green_Agro_Landscaping_Toggle_Control( $wp_customize, 'green_agro_landscaping_slider_button', array(
		'label'       => esc_html__( 'Show / Hide Slider Button', 'green-agro-landscaping' ),
		'section'     => 'green_agro_landscaping_slider_section',
		'type'        => 'toggle',
		'settings'    => 'green_agro_landscaping_slider_button',
	) ) );

	//From Our Blog
	$wp_customize->add_section('green_agro_landscaping_static_blog_section',array(
		'title'	=> __('What We Offer Section','green-agro-landscaping'),
		'panel' => 'green_agro_landscaping_panel_id',
      'priority' => 10,
	));

	$wp_customize->add_setting('green_agro_landscaping_blog_tittle',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('green_agro_landscaping_blog_tittle',array(
		'label'	=> __('Section Title','green-agro-landscaping'),
		'section'	=> 'green_agro_landscaping_static_blog_section',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('green_agro_landscaping_blog_sub_tittle',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('green_agro_landscaping_blog_sub_tittle',array(
		'label'	=> __('Section Sub Title','green-agro-landscaping'),
		'section'	=> 'green_agro_landscaping_static_blog_section',
		'type'		=> 'text'
	));

	$green_agro_landscaping_categories = get_categories();
	$cats = array();
	$i = 0;
	$green_agro_landscaping_offer_cat[]= 'select';
	foreach($green_agro_landscaping_categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$green_agro_landscaping_offer_cat[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('green_agro_landscaping_our_fund_section_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'green_agro_landscaping_sanitize_choices',
	));
	$wp_customize->add_control('green_agro_landscaping_our_fund_section_category',array(
		'type'    => 'select',
		'choices' => $green_agro_landscaping_offer_cat,
		'label' => __('Select offer category','green-agro-landscaping'),
		'section' => 'green_agro_landscaping_static_blog_section',
	));

	//footer
	$wp_customize->add_section('green_agro_landscaping_footer_section',array(
		'title'	=> __('Footer Text','green-agro-landscaping'),
		'description'	=> __('Add copyright text.','green-agro-landscaping'),
		'panel' => 'green_agro_landscaping_panel_id'
	));

	$wp_customize->add_setting('green_agro_landscaping_footer_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('green_agro_landscaping_footer_text',array(
		'label'	=> __('Copyright Text','green-agro-landscaping'),
		'section'	=> 'green_agro_landscaping_footer_section',
		'type'		=> 'text'
	));

    $wp_customize->add_setting('green_agro_landscaping_return_to_header',array(
       'default' => true,
       'sanitize_callback'	=> 'green_agro_landscaping_sanitize_checkbox'
    ));
    $wp_customize->add_control('green_agro_landscaping_return_to_header',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Return to header','green-agro-landscaping'),
       'section' => 'green_agro_landscaping_footer_section',
    ));

	$wp_customize->add_setting( 'green_agro_landscaping_return_to_header', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'green_agro_landscaping_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Green_Agro_Landscaping_Toggle_Control( $wp_customize, 'green_agro_landscaping_return_to_header', array(
		'label'       => esc_html__( 'Show / Hide Return to header', 'green-agro-landscaping' ),
		'section'     => 'green_agro_landscaping_footer_section',
		'type'        => 'toggle',
		'settings'    => 'green_agro_landscaping_return_to_header',
	) ) );

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';


	$wp_customize->add_setting( 'green_agro_landscaping_site_title_text', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'green_agro_landscaping_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Green_Agro_Landscaping_Toggle_Control( $wp_customize, 'green_agro_landscaping_site_title_text', array(
		'label'       => esc_html__( 'Show / Hide Site Title', 'green-agro-landscaping' ),
		'section'     => 'title_tagline',
		'type'        => 'toggle',
		'settings'    => 'green_agro_landscaping_site_title_text',
	) ) );

	$wp_customize->add_setting( 'green_agro_landscaping_site_tagline_text', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'green_agro_landscaping_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Green_Agro_Landscaping_Toggle_Control( $wp_customize, 'green_agro_landscaping_site_tagline_text', array(
		'label'       => esc_html__( 'Show / Hide Site Tagline', 'green-agro-landscaping' ),
		'section'     => 'title_tagline',
		'type'        => 'toggle',
		'settings'    => 'green_agro_landscaping_site_tagline_text',
	) ) );


    $wp_customize->add_setting('green_agro_landscaping_logo_width',array(
		'default' => 150,
		'sanitize_callback'	=> 'green_agro_landscaping_sanitize_number_absint'
	));
	 $wp_customize->add_control('green_agro_landscaping_logo_width',array(
		'label'	=> esc_html__('Here You Can Customize Your Logo Size','green-agro-landscaping'),
		'section'	=> 'title_tagline',
		'type'		=> 'number'
	));

	$wp_customize->add_setting('green_agro_landscaping_logo_settings',array(
        'default' => 'Different Line',
        'sanitize_callback' => 'green_agro_landscaping_sanitize_choices'
	));
   $wp_customize->add_control('green_agro_landscaping_logo_settings',array(
        'type' => 'radio',
        'label'     => __('Logo Layout Settings', 'green-agro-landscaping'),
        'description'   => __('Here you have two options 1. Logo and Site tite in differnt line. 2. Logo and Site title in same line.', 'green-agro-landscaping'),
        'section' => 'title_tagline',
        'choices' => array(
            'Different Line' => __('Different Line','green-agro-landscaping'),
            'Same Line' => __('Same Line','green-agro-landscaping')
        ),
	) );

	$wp_customize->add_setting('green_agro_landscaping_per_columns',array(
		'default'=> 3,
		'sanitize_callback'	=> 'green_agro_landscaping_sanitize_number_absint'
	));
	$wp_customize->add_control('green_agro_landscaping_per_columns',array(
		'label'	=> __('Product Per Row','green-agro-landscaping'),
		'section'=> 'woocommerce_product_catalog',
		'type'=> 'number'
	));

	$wp_customize->add_setting('green_agro_landscaping_product_per_page',array(
		'default'=> 9,
		'sanitize_callback'	=> 'green_agro_landscaping_sanitize_number_absint'
	));
	$wp_customize->add_control('green_agro_landscaping_product_per_page',array(
		'label'	=> __('Product Per Page','green-agro-landscaping'),
		'section'=> 'woocommerce_product_catalog',
		'type'=> 'number'
	));

    $wp_customize->add_setting('green_agro_landscaping_product_sidebar',array(
       'default' => true,
       'sanitize_callback'	=> 'green_agro_landscaping_sanitize_checkbox'
    ));
    $wp_customize->add_control('green_agro_landscaping_product_sidebar',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Shop page sidebar','green-agro-landscaping'),
       'section' => 'woocommerce_product_catalog',
    ));

    $wp_customize->add_setting('green_agro_landscaping_single_product_sidebar',array(
       'default' => true,
       'sanitize_callback'	=> 'green_agro_landscaping_sanitize_checkbox'
    ));
    $wp_customize->add_control('green_agro_landscaping_single_product_sidebar',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Product page sidebar','green-agro-landscaping'),
       'section' => 'woocommerce_product_catalog',
    ));
}
add_action( 'customize_register', 'green_agro_landscaping_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Green Agro Landscaping 1.0
 * @see green_agro_landscaping_customize_register()
 *
 * @return void
 */
function green_agro_landscaping_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Green Agro Landscaping 1.0
 * @see green_agro_landscaping_customize_register()
 *
 * @return void
 */
function green_agro_landscaping_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

if ( ! defined( 'GREEN_AGRO_LANDSCAPING_PRO_THEME_NAME' ) ) {
	define( 'GREEN_AGRO_LANDSCAPING_PRO_THEME_NAME', esc_html__( 'Green Landscaping Pro', 'green-agro-landscaping' ));
}
if ( ! defined( 'GREEN_AGRO_LANDSCAPING_PRO_THEME_URL' ) ) {
	define( 'GREEN_AGRO_LANDSCAPING_PRO_THEME_URL', esc_url('https://www.themespride.com/themes/agro-green-wordpress-theme/'));
}

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Green_Agro_Landscaping_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Green_Agro_Landscaping_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Green_Agro_Landscaping_Customize_Section_Pro(
				$manager,
				'green_agro_landscaping_section_pro',
				array(
					'priority'   => 9,
					'title'    => GREEN_AGRO_LANDSCAPING_PRO_THEME_NAME,
					'pro_text' => esc_html__( 'Upgrade Pro', 'green-agro-landscaping' ),
					'pro_url'  => esc_url( GREEN_AGRO_LANDSCAPING_PRO_THEME_URL, 'green-agro-landscaping' ),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'green-agro-landscaping-customize-controls', trailingslashit( esc_url( get_template_directory_uri() ) ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'green-agro-landscaping-customize-controls', trailingslashit( esc_url( get_template_directory_uri() ) ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Green_Agro_Landscaping_Customize::get_instance();
