<?php
/**
 * VW Kindergarten Theme Customizer
 *
 * @package VW Kindergarten
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function vw_kindergarten_custom_controls() {
	load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'vw_kindergarten_custom_controls' );

function vw_kindergarten_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage'; 
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'blogname', array( 
		'selector' => '.logo .site-title a', 
	 	'render_callback' => 'vw_kindergarten_Customize_partial_blogname',
	)); 

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array( 
		'selector' => 'p.site-description', 
		'render_callback' => 'vw_kindergarten_Customize_partial_blogdescription',
	));

	//Homepage Settings
	$wp_customize->add_panel( 'vw_kindergarten_homepage_panel', array(
		'title' => esc_html__( 'Homepage Settings', 'vw-kindergarten' ),
		'panel' => 'vw_kindergarten_panel_id',
		'priority' => 20,
	));

	// Top Bar
	$wp_customize->add_section( 'vw_kindergarten_top_bar' , array(
    	'title' => esc_html__( 'Top Bar', 'vw-kindergarten' ),
		'panel' => 'vw_kindergarten_homepage_panel'
	) );

   	// Header Background color

	$wp_customize->add_setting('vw_kindergarten_header_background_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_kindergarten_header_background_color', array(
		'label'    => __('Header Background Color', 'vw-kindergarten'),
		'section'  => 'vw_kindergarten_top_bar',
	)));

	$wp_customize->add_setting('vw_kindergarten_phone_number',array(
		'default'=> '',
		'sanitize_callback'	=> 'vw_kindergarten_sanitize_phone_number'
	));
	$wp_customize->add_control('vw_kindergarten_phone_number',array(
		'label'	=> esc_html__('Add Phone No.','vw-kindergarten'),
		'input_attrs' => array(
            'placeholder' => esc_html__( '+1234567890', 'vw-kindergarten' ),
        ),
		'section'=> 'vw_kindergarten_top_bar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_kindergarten_email_address',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_email'
	));
	$wp_customize->add_control('vw_kindergarten_email_address',array(
		'label'	=> esc_html__('Add Email Address','vw-kindergarten'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'example@gmail.com', 'vw-kindergarten' ),
        ),
		'section'=> 'vw_kindergarten_top_bar',
		'type'=> 'text'
	));

	//Menus Settings
	$wp_customize->add_section( 'vw_kindergarten_menu_section' , array(
    	'title' => __( 'Menus Settings', 'vw-kindergarten' ),
		'panel' => 'vw_kindergarten_homepage_panel'
	) );

	$wp_customize->add_setting('vw_kindergarten_navigation_menu_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_navigation_menu_font_size',array(
		'label'	=> __('Menus Font Size','vw-kindergarten'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-kindergarten'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-kindergarten' ),
        ),
		'section'=> 'vw_kindergarten_menu_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_kindergarten_navigation_menu_font_weight',array(
        'default' => 600,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_kindergarten_sanitize_choices'
	));
	$wp_customize->add_control('vw_kindergarten_navigation_menu_font_weight',array(
        'type' => 'select',
        'label' => __('Menus Font Weight','vw-kindergarten'),
        'section' => 'vw_kindergarten_menu_section',
        'choices' => array(
        	'100' => __('100','vw-kindergarten'),
            '200' => __('200','vw-kindergarten'),
            '300' => __('300','vw-kindergarten'),
            '400' => __('400','vw-kindergarten'),
            '500' => __('500','vw-kindergarten'),
            '600' => __('600','vw-kindergarten'),
            '700' => __('700','vw-kindergarten'),
            '800' => __('800','vw-kindergarten'),
            '900' => __('900','vw-kindergarten'),
        ),
	) );

	// text trasform
	$wp_customize->add_setting('vw_kindergarten_menu_text_transform',array(
		'default'=> 'Capitalize',
		'sanitize_callback'	=> 'vw_kindergarten_sanitize_choices'
	));
	$wp_customize->add_control('vw_kindergarten_menu_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Menus Text Transform','vw-kindergarten'),
		'choices' => array(
            'Uppercase' => __('Uppercase','vw-kindergarten'),
            'Capitalize' => __('Capitalize','vw-kindergarten'),
            'Lowercase' => __('Lowercase','vw-kindergarten'),
        ),
		'section'=> 'vw_kindergarten_menu_section',
	));

	$wp_customize->add_setting('vw_kindergarten_menus_item_style',array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_kindergarten_sanitize_choices'
	));
	$wp_customize->add_control('vw_kindergarten_menus_item_style',array(
        'type' => 'select',
        'section' => 'vw_kindergarten_menu_section',
		'label' => __('Menu Item Hover Style','vw-kindergarten'),
		'choices' => array(
            'None' => __('None','vw-kindergarten'),
            'Zoom In' => __('Zoom In','vw-kindergarten'),
        ),
	) );

	$wp_customize->add_setting('vw_kindergarten_header_menus_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_kindergarten_header_menus_color', array(
		'label'    => __('Menus Color', 'vw-kindergarten'),
		'section'  => 'vw_kindergarten_menu_section',
	)));

	$wp_customize->add_setting('vw_kindergarten_header_menus_hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_kindergarten_header_menus_hover_color', array(
		'label'    => __('Menus Hover Color', 'vw-kindergarten'),
		'section'  => 'vw_kindergarten_menu_section',
	)));

	$wp_customize->add_setting('vw_kindergarten_header_submenus_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_kindergarten_header_submenus_color', array(
		'label'    => __('Sub Menus Color', 'vw-kindergarten'),
		'section'  => 'vw_kindergarten_menu_section',
	)));

	$wp_customize->add_setting('vw_kindergarten_header_submenus_hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_kindergarten_header_submenus_hover_color', array(
		'label'    => __('Sub Menus Hover Color', 'vw-kindergarten'),
		'section'  => 'vw_kindergarten_menu_section',
	)));

	//Social links
	$wp_customize->add_section(
		'vw_kindergarten_social_links', array(
			'title'		=>	__('Social Links', 'vw-kindergarten'),
			'priority'	=>	null,
			'panel'		=>	'vw_kindergarten_homepage_panel'
	));

	$wp_customize->add_setting('vw_kindergarten_social_icons',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_social_icons',array(
		'label' =>  __('Steps to setup social icons','vw-kindergarten'),
		'description' => __('<p>1. Go to Dashboard >> Appearance >> Widgets</p>
			<p>2. Add Vw Social Icon Widget in Header Social Media.</p>
			<p>3. Add social icons url and save.</p>','vw-kindergarten'),
		'section'=> 'vw_kindergarten_social_links',
		'type'=> 'hidden'
	));
	$wp_customize->add_setting('vw_kindergarten_social_icon_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_social_icon_btn',array(
		'description' => "<a target='_blank' href='". admin_url('widgets.php') ." '>Setup Social Icons</a>",
		'section'=> 'vw_kindergarten_social_links',
		'type'=> 'hidden'
	));

	//Slider
	$wp_customize->add_section( 'vw_kindergarten_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'vw-kindergarten' ),
    	'description' => __('Free theme has 3 slides options, For unlimited slides and more options </br> <a class="go-pro-btn" target="blank" href="https://www.vwthemes.com/themes/kindergarten-wordpress-theme/">GO PRO</a>','vw-kindergarten'),
		'panel' => 'vw_kindergarten_homepage_panel'
	) );

	$wp_customize->add_setting( 'vw_kindergarten_slider_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_slider_hide_show',array(
      'label' => esc_html__( 'Show / Hide Slider','vw-kindergarten' ),
      'section' => 'vw_kindergarten_slidersettings'
    )));

    $wp_customize->add_setting('vw_kindergarten_slider_type',array(
        'default' => 'Default slider',
        'sanitize_callback' => 'vw_kindergarten_sanitize_choices'
	) );
	$wp_customize->add_control('vw_kindergarten_slider_type', array(
        'type' => 'select',
        'label' => __('Slider Type','vw-kindergarten'),
        'section' => 'vw_kindergarten_slidersettings',
        'choices' => array(
            'Default slider' => __('Default slider','vw-kindergarten'),
            'Advance slider' => __('Advance slider','vw-kindergarten'),
        ),
	));

	$wp_customize->add_setting('vw_kindergarten_advance_slider_shortcode',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_advance_slider_shortcode',array(
		'label'	=> __('Add Slider Shortcode','vw-kindergarten'),
		'section'=> 'vw_kindergarten_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_kindergarten_advance_slider'
	));

     //Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_kindergarten_slider_hide_show',array(
		'selector'        => '.slider-btn a',
		'render_callback' => 'vw_kindergarten_customize_partial_vw_kindergarten_slider_hide_show',
	));

	for ( $count = 1; $count <= 3; $count++ ) {
		$wp_customize->add_setting( 'vw_kindergarten_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_kindergarten_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'vw_kindergarten_slider_page' . $count, array(
			'label'    => __( 'Select Slider Page', 'vw-kindergarten' ),
			'description' => __('Slider image size (1500 x 600)','vw-kindergarten'),
			'section'  => 'vw_kindergarten_slidersettings',
			'type'     => 'dropdown-pages',
			'active_callback' => 'vw_kindergarten_default_slider'
		) );
	}

	$wp_customize->add_setting('vw_kindergarten_slider_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_slider_button_text',array(
		'label'	=> __('Add Slider Button Text','vw-kindergarten'),
		'input_attrs' => array(
            'placeholder' => __( 'Discover More', 'vw-kindergarten' ),
        ),
		'section'=> 'vw_kindergarten_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_kindergarten_default_slider'
	));

	$wp_customize->add_setting( 'vw_kindergarten_slider_title_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_slider_title_hide_show',array(
		'label' => esc_html__( 'Show / Hide Slider Title','vw-kindergarten' ),
		'section' => 'vw_kindergarten_slidersettings',
		'active_callback' => 'vw_kindergarten_default_slider'
    )));

	$wp_customize->add_setting( 'vw_kindergarten_slider_content_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_slider_content_hide_show',array(
		'label' => esc_html__( 'Show / Hide Slider Content','vw-kindergarten' ),
		'section' => 'vw_kindergarten_slidersettings',
		'active_callback' => 'vw_kindergarten_default_slider'
    )));

	//content layout
	$wp_customize->add_setting('vw_kindergarten_slider_content_option',array(
        'default' => 'Left',
        'sanitize_callback' => 'vw_kindergarten_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Kindergarten_Image_Radio_Control($wp_customize, 'vw_kindergarten_slider_content_option', array(
        'type' => 'select',
        'label' => __('Slider Content Layouts','vw-kindergarten'),
        'section' => 'vw_kindergarten_slidersettings',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/slider-content1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/slider-content2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/slider-content3.png',
    ),'active_callback' => 'vw_kindergarten_default_slider'
    )));

    //Slider excerpt
	$wp_customize->add_setting( 'vw_kindergarten_slider_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_kindergarten_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_kindergarten_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Excerpt length','vw-kindergarten' ),
		'section'     => 'vw_kindergarten_slidersettings',
		'type'        => 'range',
		'settings'    => 'vw_kindergarten_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),'active_callback' => 'vw_kindergarten_default_slider'
	) );

	//Slider height
	$wp_customize->add_setting('vw_kindergarten_slider_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_slider_height',array(
		'label'	=> __('Slider Height','vw-kindergarten'),
		'description'	=> __('Specify the slider height (px).','vw-kindergarten'),
		'input_attrs' => array(
            'placeholder' => __( '500px', 'vw-kindergarten' ),
        ),
		'section'=> 'vw_kindergarten_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_kindergarten_default_slider'
	));

	$wp_customize->add_setting( 'vw_kindergarten_slider_speed', array(
		'default'  => 4000,
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'vw_kindergarten_slider_speed', array(
		'label' => esc_html__('Slider Transition Speed','vw-kindergarten'),
		'section' => 'vw_kindergarten_slidersettings',
		'type'  => 'text',
		'active_callback' => 'vw_kindergarten_default_slider'
	) );

	//Opacity
	$wp_customize->add_setting('vw_kindergarten_slider_opacity_color',array(
		'default'              => 0.3,
		'sanitize_callback' => 'vw_kindergarten_sanitize_choices'
	));

	$wp_customize->add_control( 'vw_kindergarten_slider_opacity_color', array(
		'label'       => esc_html__( 'Slider Image Opacity','vw-kindergarten' ),
		'section'     => 'vw_kindergarten_slidersettings',
		'type'        => 'select',
		'settings'    => 'vw_kindergarten_slider_opacity_color',
		'choices' => array(
			'0' =>  esc_attr('0','vw-kindergarten'),
			'0.1' =>  esc_attr('0.1','vw-kindergarten'),
			'0.2' =>  esc_attr('0.2','vw-kindergarten'),
			'0.3' =>  esc_attr('0.3','vw-kindergarten'),
			'0.4' =>  esc_attr('0.4','vw-kindergarten'),
			'0.5' =>  esc_attr('0.5','vw-kindergarten'),
			'0.6' =>  esc_attr('0.6','vw-kindergarten'),
			'0.7' =>  esc_attr('0.7','vw-kindergarten'),
			'0.8' =>  esc_attr('0.8','vw-kindergarten'),
			'0.9' =>  esc_attr('0.9','vw-kindergarten')
		),'active_callback' => 'vw_kindergarten_default_slider'
	));

	$wp_customize->add_setting( 'vw_kindergarten_slider_image_overlay',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
   	));
   	$wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_slider_image_overlay',array(
      	'label' => esc_html__( 'Slider Image Overlay','vw-kindergarten' ),
      	'section' => 'vw_kindergarten_slidersettings',
      	'active_callback' => 'vw_kindergarten_default_slider'
   	)));

   	$wp_customize->add_setting('vw_kindergarten_slider_image_overlay_color', array(
		'default'           => '#404376',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_kindergarten_slider_image_overlay_color', array(
		'label'    => __('Slider Image Overlay Color', 'vw-kindergarten'),
		'section'  => 'vw_kindergarten_slidersettings',
		'active_callback' => 'vw_kindergarten_default_slider'
	)));

	//Services Section 
	$wp_customize->add_section('vw_kindergarten_service_section', array(
		'title'       => __('Services Section', 'vw-kindergarten'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-kindergarten'),
		'priority'    => null,
		'panel'       => 'vw_kindergarten_homepage_panel',
	));

	$wp_customize->add_setting('vw_kindergarten_service_section_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_service_section_text',array(
		'description' => __('<p>1. More options for service section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for service section.</p>','vw-kindergarten'),
		'section'=> 'vw_kindergarten_service_section',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_kindergarten_service_section_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_service_section_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_kindergarten_guide') ." '>More Info</a>",
		'section'=> 'vw_kindergarten_service_section',
		'type'=> 'hidden'
	));

	// About Section
	$wp_customize->add_section('vw_kindergarten_about_section',array(
		'title'	=> __('About Section','vw-kindergarten'),
		'description' => __('For more options of the about section </br> <a class="go-pro-btn" target="blank" href="https://www.vwthemes.com/themes/kindergarten-wordpress-theme/">GO PRO</a>','vw-kindergarten'),
		'panel' => 'vw_kindergarten_homepage_panel',
	));

	$wp_customize->add_setting( 'vw_kindergarten_section_title', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'vw_kindergarten_section_title', array(
		'label'    => __( 'Add Section Title', 'vw-kindergarten' ),
		'input_attrs' => array(
            'placeholder' => __( 'About Us', 'vw-kindergarten' ),
        ),
		'section'  => 'vw_kindergarten_about_section',
		'type'     => 'text'
	) );

	$wp_customize->add_setting( 'vw_kindergarten_about_page', array(
		'default'           => '',
		'sanitize_callback' => 'vw_kindergarten_sanitize_dropdown_pages'
	) );
	$wp_customize->add_control( 'vw_kindergarten_about_page', array(
		'label'    => __( 'Select Page of About', 'vw-kindergarten' ),
		'description'	=> __('About image size (400 x 400)','vw-kindergarten'),
		'section'  => 'vw_kindergarten_about_section',
		'type'     => 'dropdown-pages'
	) );

	$wp_customize->add_setting( 'vw_kindergarten_image_text', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'vw_kindergarten_image_text', array(
		'label'    => __( 'Add Image Text', 'vw-kindergarten' ),
		'input_attrs' => array(
            'placeholder' => __( 'Trusted By 5799+', 'vw-kindergarten' ),
        ),
		'section'  => 'vw_kindergarten_about_section',
		'type'     => 'text'
	) );

	// Classes Section
	$wp_customize->add_section('vw_kindergarten_classes_section', array(
		'title'       => __('Classes Section', 'vw-kindergarten'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-kindergarten'),
		'priority'    => null,
		'panel'       => 'vw_kindergarten_homepage_panel',
	));

	$wp_customize->add_setting('vw_kindergarten_classes_section_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_classes_section_text',array(
		'description' => __('<p>1. More options for classes section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for classes section.</p>','vw-kindergarten'),
		'section'=> 'vw_kindergarten_classes_section',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_kindergarten_classes_section_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_classes_section_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_kindergarten_guide') ." '>More Info</a>",
		'section'=> 'vw_kindergarten_classes_section',
		'type'=> 'hidden'
	));

	// Online Class Section
	$wp_customize->add_section('vw_kindergarten_online_class_section', array(
		'title'       => __('Online Class Section', 'vw-kindergarten'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-kindergarten'),
		'priority'    => null,
		'panel'       => 'vw_kindergarten_homepage_panel',
	));

	$wp_customize->add_setting('vw_kindergarten_online_class_section_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_online_class_section_text',array(
		'description' => __('<p>1. More options for online class section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for online class section.</p>','vw-kindergarten'),
		'section'=> 'vw_kindergarten_online_class_section',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_kindergarten_online_class_section_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_online_class_section_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_kindergarten_guide') ." '>More Info</a>",
		'section'=> 'vw_kindergarten_online_class_section',
		'type'=> 'hidden'
	));

	// school activities Section
	$wp_customize->add_section('vw_kindergarten_school_activities_section', array(
		'title'       => __('School Activities Section', 'vw-kindergarten'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-kindergarten'),
		'priority'    => null,
		'panel'       => 'vw_kindergarten_homepage_panel',
	));

	$wp_customize->add_setting('vw_kindergarten_school_activities_section_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_school_activities_section_text',array(
		'description' => __('<p>1. More options for school activities section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for school activities section.</p>','vw-kindergarten'),
		'section'=> 'vw_kindergarten_school_activities_section',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_kindergarten_school_activities_section_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_school_activities_section_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_kindergarten_guide') ." '>More Info</a>",
		'section'=> 'vw_kindergarten_school_activities_section',
		'type'=> 'hidden'
	));

	// our gallery Section
	$wp_customize->add_section('vw_kindergarten_gallery_section', array(
		'title'       => __('Gallery Section', 'vw-kindergarten'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-kindergarten'),
		'priority'    => null,
		'panel'       => 'vw_kindergarten_homepage_panel',
	));

	$wp_customize->add_setting('vw_kindergarten_gallery_section_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_gallery_section_text',array(
		'description' => __('<p>1. More options for our gallery section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for our gallery section.</p>','vw-kindergarten'),
		'section'=> 'vw_kindergarten_gallery_section',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_kindergarten_gallery_section_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_gallery_section_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_kindergarten_guide') ." '>More Info</a>",
		'section'=> 'vw_kindergarten_gallery_section',
		'type'=> 'hidden'
	));

	// our feature Section
	$wp_customize->add_section('vw_kindergarten_our_feature_section', array(
		'title'       => __('Feature Section', 'vw-kindergarten'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-kindergarten'),
		'priority'    => null,
		'panel'       => 'vw_kindergarten_homepage_panel',
	));

	$wp_customize->add_setting('vw_kindergarten_our_feature_section_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_our_feature_section_text',array(
		'description' => __('<p>1. More options for our feature section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for our feature section.</p>','vw-kindergarten'),
		'section'=> 'vw_kindergarten_our_feature_section',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_kindergarten_our_feature_section_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_our_feature_section_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_kindergarten_guide') ." '>More Info</a>",
		'section'=> 'vw_kindergarten_our_feature_section',
		'type'=> 'hidden'
	));

	// our staff Section
	$wp_customize->add_section('vw_kindergarten_our_staff_section', array(
		'title'       => __('Staff Section', 'vw-kindergarten'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-kindergarten'),
		'priority'    => null,
		'panel'       => 'vw_kindergarten_homepage_panel',
	));

	$wp_customize->add_setting('vw_kindergarten_our_staff_section_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_our_staff_section_text',array(
		'description' => __('<p>1. More options for our staff section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for our staff section.</p>','vw-kindergarten'),
		'section'=> 'vw_kindergarten_our_staff_section',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_kindergarten_our_staff_section_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_our_staff_section_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_kindergarten_guide') ." '>More Info</a>",
		'section'=> 'vw_kindergarten_our_staff_section',
		'type'=> 'hidden'
	));

	// testimonials Section
	$wp_customize->add_section('vw_kindergarten_testimonials_section', array(
		'title'       => __('Testimonials Section', 'vw-kindergarten'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-kindergarten'),
		'priority'    => null,
		'panel'       => 'vw_kindergarten_homepage_panel',
	));

	$wp_customize->add_setting('vw_kindergarten_testimonials_section_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_testimonials_section_text',array(
		'description' => __('<p>1. More options for testimonials section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for testimonials section.</p>','vw-kindergarten'),
		'section'=> 'vw_kindergarten_testimonials_section',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_kindergarten_testimonials_section_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_testimonials_section_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_kindergarten_guide') ." '>More Info</a>",
		'section'=> 'vw_kindergarten_testimonials_section',
		'type'=> 'hidden'
	));

	// our events Section
	$wp_customize->add_section('vw_kindergarten_our_events_section', array(
		'title'       => __('Events Section', 'vw-kindergarten'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-kindergarten'),
		'priority'    => null,
		'panel'       => 'vw_kindergarten_homepage_panel',
	));

	$wp_customize->add_setting('vw_kindergarten_our_events_section_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_our_events_section_text',array(
		'description' => __('<p>1. More options for our events section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for our events section.</p>','vw-kindergarten'),
		'section'=> 'vw_kindergarten_our_events_section',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_kindergarten_our_events_section_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_our_events_section_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_kindergarten_guide') ." '>More Info</a>",
		'section'=> 'vw_kindergarten_our_events_section',
		'type'=> 'hidden'
	));

	// newsletters Section
	$wp_customize->add_section('vw_kindergarten_newsletters_section', array(
		'title'       => __('Newsletters Section', 'vw-kindergarten'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-kindergarten'),
		'priority'    => null,
		'panel'       => 'vw_kindergarten_homepage_panel',
	));

	$wp_customize->add_setting('vw_kindergarten_newsletters_section_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_newsletters_section_text',array(
		'description' => __('<p>1. More options for newsletters section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for newsletters section.</p>','vw-kindergarten'),
		'section'=> 'vw_kindergarten_newsletters_section',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_kindergarten_newsletters_section_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_newsletters_section_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_kindergarten_guide') ." '>More Info</a>",
		'section'=> 'vw_kindergarten_newsletters_section',
		'type'=> 'hidden'
	));

	// our blog Section
	$wp_customize->add_section('vw_kindergarten_blog_section', array(
		'title'       => __('Blog Section', 'vw-kindergarten'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-kindergarten'),
		'priority'    => null,
		'panel'       => 'vw_kindergarten_homepage_panel',
	));

	$wp_customize->add_setting('vw_kindergarten_blog_section_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_blog_section_text',array(
		'description' => __('<p>1. More options for blog section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for blog section.</p>','vw-kindergarten'),
		'section'=> 'vw_kindergarten_blog_section',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_kindergarten_blog_section_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_blog_section_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_kindergarten_guide') ." '>More Info</a>",
		'section'=> 'vw_kindergarten_blog_section',
		'type'=> 'hidden'
	));

	// sponsor Section
	$wp_customize->add_section('vw_kindergarten_sponsor_section', array(
		'title'       => __('Sponsor Section', 'vw-kindergarten'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-kindergarten'),
		'priority'    => null,
		'panel'       => 'vw_kindergarten_homepage_panel',
	));

	$wp_customize->add_setting('vw_kindergarten_sponsor_section_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_sponsor_section_text',array(
		'description' => __('<p>1. More options for sponsor section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for sponsor section.</p>','vw-kindergarten'),
		'section'=> 'vw_kindergarten_sponsor_section',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_kindergarten_sponsor_section_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_sponsor_section_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_kindergarten_guide') ." '>More Info</a>",
		'section'=> 'vw_kindergarten_sponsor_section',
		'type'=> 'hidden'
	));

	//Footer Text
	$wp_customize->add_section('vw_kindergarten_footer',array(
		'title'	=> esc_html__('Footer Settings','vw-kindergarten'),
		'description' => __('For more options of the footer section </br> <a class="go-pro-btn" target="blank" href="https://www.vwthemes.com/themes/kindergarten-wordpress-theme/">GO PRO</a>','vw-kindergarten'),
		'panel' => 'vw_kindergarten_homepage_panel',
	));	

	$wp_customize->add_setting( 'vw_kindergarten_footer_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ));
    $wp_customize->add_control( new vw_kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_footer_hide_show',array(
      'label' => esc_html__( 'Show / Hide Footer','vw-kindergarten' ),
      'section' => 'vw_kindergarten_footer'
    )));

	$wp_customize->add_setting('vw_kindergarten_footer_background_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_kindergarten_footer_background_color', array(
		'label'    => __('Footer Background Color', 'vw-kindergarten'),
		'section'  => 'vw_kindergarten_footer',
	)));

	$wp_customize->add_setting('vw_kindergarten_footer_background_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'vw_kindergarten_footer_background_image',array(
        'label' => __('Footer Background Image','vw-kindergarten'),
        'section' => 'vw_kindergarten_footer'
	)));

	$wp_customize->add_setting('vw_kindergarten_footer_img_position',array(
	  'default' => 'center center',
	  'transport' => 'refresh',
	  'sanitize_callback' => 'vw_kindergarten_sanitize_choices'
	));
	$wp_customize->add_control('vw_kindergarten_footer_img_position',array(
		'type' => 'select',
		'label' => __('Footer Image Position','vw-kindergarten'),
		'section' => 'vw_kindergarten_footer',
		'choices' 	=> array(
			'left top' 		=> esc_html__( 'Top Left', 'vw-kindergarten' ),
			'center top'   => esc_html__( 'Top', 'vw-kindergarten' ),
			'right top'   => esc_html__( 'Top Right', 'vw-kindergarten' ),
			'left center'   => esc_html__( 'Left', 'vw-kindergarten' ),
			'center center'   => esc_html__( 'Center', 'vw-kindergarten' ),
			'right center'   => esc_html__( 'Right', 'vw-kindergarten' ),
			'left bottom'   => esc_html__( 'Bottom Left', 'vw-kindergarten' ),
			'center bottom'   => esc_html__( 'Bottom', 'vw-kindergarten' ),
			'right bottom'   => esc_html__( 'Bottom Right', 'vw-kindergarten' ),
		),
	)); 

	// Footer
	$wp_customize->add_setting('vw_kindergarten_img_footer',array(
		'default'=> 'scroll',
		'sanitize_callback'	=> 'vw_kindergarten_sanitize_choices'
	));
	$wp_customize->add_control('vw_kindergarten_img_footer',array(
		'type' => 'select',
		'label'	=> __('Footer Background Attatchment','vw-kindergarten'),
		'choices' => array(
            'fixed' => __('fixed','vw-kindergarten'),
            'scroll' => __('scroll','vw-kindergarten'),
        ),
		'section'=> 'vw_kindergarten_footer',
	));

	$wp_customize->add_setting('vw_kindergarten_footer_widgets_heading',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_kindergarten_sanitize_choices'
	));
	$wp_customize->add_control('vw_kindergarten_footer_widgets_heading',array(
        'type' => 'select',
        'label' => __('Footer Widget Heading','vw-kindergarten'),
        'section' => 'vw_kindergarten_footer',
        'choices' => array(
        	'Left' => __('Left','vw-kindergarten'),
            'Center' => __('Center','vw-kindergarten'),
            'Right' => __('Right','vw-kindergarten')
        ),
	) );

	$wp_customize->add_setting('vw_kindergarten_footer_widgets_content',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_kindergarten_sanitize_choices'
	));
	$wp_customize->add_control('vw_kindergarten_footer_widgets_content',array(
        'type' => 'select',
        'label' => __('Footer Widget Content','vw-kindergarten'),
        'section' => 'vw_kindergarten_footer',
        'choices' => array(
        	'Left' => __('Left','vw-kindergarten'),
            'Center' => __('Center','vw-kindergarten'),
            'Right' => __('Right','vw-kindergarten')
        ),
	) );

	// footer padding
	$wp_customize->add_setting('vw_kindergarten_footer_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_footer_padding',array(
		'label'	=> __('Footer Top Bottom Padding','vw-kindergarten'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-kindergarten'),
		'input_attrs' => array(
      'placeholder' => __( '10px', 'vw-kindergarten' ),
    ),
		'section'=> 'vw_kindergarten_footer',
		'type'=> 'text'
	));

    // footer social icon
  	$wp_customize->add_setting( 'vw_kindergarten_footer_icon',array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ) );
  	$wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_footer_icon',array(
		'label' => esc_html__( 'Footer Social Icon','vw-kindergarten' ),
		'section' => 'vw_kindergarten_footer'
    ))); 

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_kindergarten_footer_text', array( 
		'selector' => '.copyright p', 
		'render_callback' => 'vw_kindergarten_Customize_partial_vw_kindergarten_footer_text', 
	));

	$wp_customize->add_setting( 'vw_kindergarten_copyright_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ));
    $wp_customize->add_control( new vw_kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_copyright_hide_show',array(
      'label' => esc_html__( 'Show / Hide Copyright','vw-kindergarten' ),
      'section' => 'vw_kindergarten_footer'
    )));

	$wp_customize->add_setting('vw_kindergarten_copyright_background_color', array(
		'default'           => '#404376',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_kindergarten_copyright_background_color', array(
		'label'    => __('Copyright Background Color', 'vw-kindergarten'),
		'section'  => 'vw_kindergarten_footer',
	)));
	
	$wp_customize->add_setting('vw_kindergarten_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_kindergarten_footer_text',array(
		'label'	=> esc_html__('Copyright Text','vw-kindergarten'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Copyright 2021, .....', 'vw-kindergarten' ),
        ),
		'section'=> 'vw_kindergarten_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_kindergarten_copyright_alingment',array(
        'default' => 'center',
        'sanitize_callback' => 'vw_kindergarten_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Kindergarten_Image_Radio_Control($wp_customize, 'vw_kindergarten_copyright_alingment', array(
        'type' => 'select',
        'label' => esc_html__('Copyright Alignment','vw-kindergarten'),
        'section' => 'vw_kindergarten_footer',
        'settings' => 'vw_kindergarten_copyright_alingment',
        'choices' => array(
            'left' => esc_url(get_template_directory_uri()).'/assets/images/copyright1.png',
            'center' => esc_url(get_template_directory_uri()).'/assets/images/copyright2.png',
            'right' => esc_url(get_template_directory_uri()).'/assets/images/copyright3.png'
    ))));

    $wp_customize->add_setting( 'vw_kindergarten_hide_show_scroll',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_hide_show_scroll',array(
      	'label' => esc_html__( 'Show / Hide Scroll to Top','vw-kindergarten' ),
      	'section' => 'vw_kindergarten_footer'
    )));

    //Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_kindergarten_scroll_to_top_icon', array( 
		'selector' => '.scrollup i', 
		'render_callback' => 'vw_kindergarten_Customize_partial_vw_kindergarten_scroll_to_top_icon', 
	));

    $wp_customize->add_setting('vw_kindergarten_scroll_to_top_icon',array(
		'default'	=> 'fas fa-long-arrow-alt-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new vw_kindergarten_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_kindergarten_scroll_to_top_icon',array(
		'label'	=> __('Add Scroll to Top Icon','vw-kindergarten'),
		'transport' => 'refresh',
		'section'	=> 'vw_kindergarten_footer',
		'setting'	=> 'vw_kindergarten_scroll_to_top_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_kindergarten_scroll_to_top_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_scroll_to_top_font_size',array(
		'label'	=> __('Icon Font Size','vw-kindergarten'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-kindergarten'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-kindergarten' ),
        ),
		'section'=> 'vw_kindergarten_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_kindergarten_scroll_to_top_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_scroll_to_top_padding',array(
		'label'	=> __('Icon Top Bottom Padding','vw-kindergarten'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-kindergarten'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-kindergarten' ),
        ),
		'section'=> 'vw_kindergarten_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_kindergarten_scroll_to_top_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_scroll_to_top_width',array(
		'label'	=> __('Icon Width','vw-kindergarten'),
		'description'	=> __('Enter a value in pixels Example:20px','vw-kindergarten'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-kindergarten' ),
        ),
		'section'=> 'vw_kindergarten_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_kindergarten_scroll_to_top_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_scroll_to_top_height',array(
		'label'	=> __('Icon Height','vw-kindergarten'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-kindergarten'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-kindergarten' ),
        ),
		'section'=> 'vw_kindergarten_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_kindergarten_scroll_to_top_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_kindergarten_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_kindergarten_scroll_to_top_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','vw-kindergarten' ),
		'section'     => 'vw_kindergarten_footer',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

    $wp_customize->add_setting('vw_kindergarten_scroll_top_alignment',array(
        'default' => 'Right',
        'sanitize_callback' => 'vw_kindergarten_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Kindergarten_Image_Radio_Control($wp_customize, 'vw_kindergarten_scroll_top_alignment', array(
        'type' => 'select',
        'label' => esc_html__('Scroll To Top','vw-kindergarten'),
        'section' => 'vw_kindergarten_footer',
        'settings' => 'vw_kindergarten_scroll_top_alignment',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/layout2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/layout3.png'
    ))));

	//Blog Post
	$wp_customize->add_panel( 'vw_kindergarten_blog_post_parent_panel', array(
		'title' => esc_html__( 'Blog Post Settings', 'vw-kindergarten' ),
		'panel' => 'vw_kindergarten_panel_id',
		'priority' => 20,
	));

	// Add example section and controls to the middle (second) panel
	$wp_customize->add_section( 'vw_kindergarten_post_settings', array(
		'title' => esc_html__( 'Post Settings', 'vw-kindergarten' ),
		'panel' => 'vw_kindergarten_blog_post_parent_panel',
	));

	//Blog Post Layout
    $wp_customize->add_setting('vw_kindergarten_blog_layout_option',array(
        'default' => 'Default',
        'sanitize_callback' => 'vw_kindergarten_sanitize_choices'
    ));
    $wp_customize->add_control(new VW_Kindergarten_Image_Radio_Control($wp_customize, 'vw_kindergarten_blog_layout_option', array(
        'type' => 'select',
        'label' => __('Blog Post Layouts','vw-kindergarten'),
        'section' => 'vw_kindergarten_post_settings',
        'choices' => array(
            'Default' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout2.png',
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout3.png',
    ))));

   	$wp_customize->add_setting('vw_kindergarten_theme_options',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'vw_kindergarten_sanitize_choices'
	));
	$wp_customize->add_control('vw_kindergarten_theme_options',array(
        'type' => 'select',
        'label' => esc_html__('Post Sidebar Layout','vw-kindergarten'),
        'description' => esc_html__('Here you can change the sidebar layout for posts. ','vw-kindergarten'),
        'section' => 'vw_kindergarten_post_settings',
        'choices' => array(
            'Left Sidebar' => esc_html__('Left Sidebar','vw-kindergarten'),
            'Right Sidebar' => esc_html__('Right Sidebar','vw-kindergarten'),
            'One Column' => esc_html__('One Column','vw-kindergarten'),
            'Grid Layout' => esc_html__('Grid Layout','vw-kindergarten')
        ),
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_kindergarten_toggle_postdate', array( 
		'selector' => '.post-main-box h2 a', 
		'render_callback' => 'vw_kindergarten_Customize_partial_vw_kindergarten_toggle_postdate', 
	));

  	$wp_customize->add_setting('vw_kindergarten_toggle_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Kindergarten_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_kindergarten_toggle_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','vw-kindergarten'),
		'transport' => 'refresh',
		'section'	=> 'vw_kindergarten_post_settings',
		'setting'	=> 'vw_kindergarten_toggle_postdate_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_kindergarten_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_toggle_postdate',array(
        'label' => esc_html__( 'Post Date','vw-kindergarten' ),
        'section' => 'vw_kindergarten_post_settings'
    )));

	$wp_customize->add_setting('vw_kindergarten_toggle_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Kindergarten_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_kindergarten_toggle_author_icon',array(
		'label'	=> __('Add Author Icon','vw-kindergarten'),
		'transport' => 'refresh',
		'section'	=> 'vw_kindergarten_post_settings',
		'setting'	=> 'vw_kindergarten_toggle_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_kindergarten_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_toggle_author',array(
		'label' => esc_html__( 'Author','vw-kindergarten' ),
		'section' => 'vw_kindergarten_post_settings'
    )));

    $wp_customize->add_setting('vw_kindergarten_toggle_comments_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Kindergarten_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_kindergarten_toggle_comments_icon',array(
		'label'	=> __('Add Comments Icon','vw-kindergarten'),
		'transport' => 'refresh',
		'section'	=> 'vw_kindergarten_post_settings',
		'setting'	=> 'vw_kindergarten_toggle_comments_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_kindergarten_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_toggle_comments',array(
		'label' => esc_html__( 'Comments','vw-kindergarten' ),
		'section' => 'vw_kindergarten_post_settings'
    )));

  	$wp_customize->add_setting('vw_kindergarten_toggle_time_icon',array(
		'default'	=> 'fas fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Kindergarten_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_kindergarten_toggle_time_icon',array(
		'label'	=> __('Add Time Icon','vw-kindergarten'),
		'transport' => 'refresh',
		'section'	=> 'vw_kindergarten_post_settings',
		'setting'	=> 'vw_kindergarten_toggle_time_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_kindergarten_toggle_time',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_toggle_time',array(
		'label' => esc_html__( 'Time','vw-kindergarten' ),
		'section' => 'vw_kindergarten_post_settings'
    )));

    $wp_customize->add_setting( 'vw_kindergarten_featured_image_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_featured_image_hide_show', array(
		'label' => esc_html__( 'Featured Image','vw-kindergarten' ),
		'section' => 'vw_kindergarten_post_settings'
    )));

    //Featured Image
	$wp_customize->add_setting( 'vw_kindergarten_featured_image_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_kindergarten_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_kindergarten_featured_image_border_radius', array(
		'label'       => esc_html__( 'Featured Image Border Radius','vw-kindergarten' ),
		'section'     => 'vw_kindergarten_post_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'vw_kindergarten_featured_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_kindergarten_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_kindergarten_featured_image_box_shadow', array(
		'label'       => esc_html__( 'Featured Image Box Shadow','vw-kindergarten' ),
		'section'     => 'vw_kindergarten_post_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Featured Image
	$wp_customize->add_setting('vw_kindergarten_blog_post_featured_image_dimension',array(
       'default' => 'default',
       'sanitize_callback'	=> 'vw_kindergarten_sanitize_choices'
	));
  	$wp_customize->add_control('vw_kindergarten_blog_post_featured_image_dimension',array(
		'type' => 'select',
		'label'	=> __('Blog Post Featured Image Dimension','vw-kindergarten'),
		'section'	=> 'vw_kindergarten_post_settings',
		'choices' => array(
		'default' => __('Default','vw-kindergarten'),
		'custom' => __('Custom Image Size','vw-kindergarten'),
      ),
  	));

	$wp_customize->add_setting('vw_kindergarten_blog_post_featured_image_custom_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		));
	$wp_customize->add_control('vw_kindergarten_blog_post_featured_image_custom_width',array(
		'label'	=> __('Featured Image Custom Width','vw-kindergarten'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-kindergarten'),
		'input_attrs' => array(
    	'placeholder' => __( '10px', 'vw-kindergarten' ),),
		'section'=> 'vw_kindergarten_post_settings',
		'type'=> 'text',
		'active_callback' => 'vw_kindergarten_blog_post_featured_image_dimension'
		));

	$wp_customize->add_setting('vw_kindergarten_blog_post_featured_image_custom_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_blog_post_featured_image_custom_height',array(
		'label'	=> __('Featured Image Custom Height','vw-kindergarten'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-kindergarten'),
		'input_attrs' => array(
    	'placeholder' => __( '10px', 'vw-kindergarten' ),),
		'section'=> 'vw_kindergarten_post_settings',
		'type'=> 'text',
		'active_callback' => 'vw_kindergarten_blog_post_featured_image_dimension'
	));

    $wp_customize->add_setting( 'vw_kindergarten_toggle_tags',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_toggle_tags', array(
		'label' => esc_html__( 'Tags','vw-kindergarten' ),
		'section' => 'vw_kindergarten_post_settings'
    )));

    $wp_customize->add_setting( 'vw_kindergarten_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_kindergarten_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'vw_kindergarten_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','vw-kindergarten' ),
		'section'     => 'vw_kindergarten_post_settings',
		'type'        => 'range',
		'settings'    => 'vw_kindergarten_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_kindergarten_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','vw-kindergarten'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','vw-kindergarten'),
		'section'=> 'vw_kindergarten_post_settings',
		'type'=> 'text'
	));

    $wp_customize->add_setting('vw_kindergarten_excerpt_settings',array(
        'default' => 'Excerpt',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_kindergarten_sanitize_choices'
	));
	$wp_customize->add_control('vw_kindergarten_excerpt_settings',array(
        'type' => 'select',
        'label' => esc_html__('Post Content','vw-kindergarten'),
        'section' => 'vw_kindergarten_post_settings',
        'choices' => array(
        	'Content' => esc_html__('Content','vw-kindergarten'),
            'Excerpt' => esc_html__('Excerpt','vw-kindergarten'),
            'No Content' => esc_html__('No Content','vw-kindergarten')
        ),
	) );

   	$wp_customize->add_setting('vw_kindergarten_blog_page_posts_settings',array(
        'default' => 'Into Blocks',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_kindergarten_sanitize_choices'
	));
	$wp_customize->add_control('vw_kindergarten_blog_page_posts_settings',array(
        'type' => 'select',
        'label' => __('Display Blog Page posts','vw-kindergarten'),
        'section' => 'vw_kindergarten_post_settings',
        'choices' => array(
        	'Into Blocks' => __('Into Blocks','vw-kindergarten'),
            'Without Blocks' => __('Without Blocks','vw-kindergarten')
        ),
	) );

    // Button Settings
	$wp_customize->add_section( 'vw_kindergarten_button_settings', array(
		'title' => esc_html__( 'Button Settings', 'vw-kindergarten' ),
		'panel' => 'vw_kindergarten_blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_kindergarten_button_text', array( 
		'selector' => '.post-main-box .more-btn a', 
		'render_callback' => 'vw_kindergarten_Customize_partial_vw_kindergarten_button_text', 
	));

    $wp_customize->add_setting('vw_kindergarten_button_text',array(
		'default'=> esc_html__('Read More','vw-kindergarten'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_button_text',array(
		'label'	=> esc_html__('Add Button Text','vw-kindergarten'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Read More', 'vw-kindergarten' ),
        ),
		'section'=> 'vw_kindergarten_button_settings',
		'type'=> 'text'
	));

	// font size button
	$wp_customize->add_setting('vw_kindergarten_button_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_button_font_size',array(
		'label'	=> __('Button Font Size','vw-kindergarten'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-kindergarten'),
		'input_attrs' => array(
      	'placeholder' => __( '10px', 'vw-kindergarten' ),
    ),
    	'type'        => 'text',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'vw_kindergarten_button_settings',
	));

	$wp_customize->add_setting( 'vw_kindergarten_button_border_radius', array(
		'default'              => 5,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_kindergarten_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'vw_kindergarten_button_border_radius', array(
		'label'       => esc_html__( 'Button Border Radius','vw-kindergarten' ),
		'section'     => 'vw_kindergarten_button_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_kindergarten_button_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_button_padding_top_bottom',array(
		'label'	=> __('Padding Top Bottom','vw-kindergarten'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-kindergarten'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-kindergarten' ),
        ),
		'section'=> 'vw_kindergarten_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_kindergarten_button_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_button_padding_left_right',array(
		'label'	=> __('Padding Left Right','vw-kindergarten'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-kindergarten'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-kindergarten' ),
        ),
		'section'=> 'vw_kindergarten_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_kindergarten_button_letter_spacing',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_button_letter_spacing',array(
		'label'	=> __('Button Letter Spacing','vw-kindergarten'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-kindergarten'),
		'input_attrs' => array(
      	'placeholder' => __( '10px', 'vw-kindergarten' ),
    ),
    	'type'        => 'text',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'vw_kindergarten_button_settings',
	));

	// text trasform
	$wp_customize->add_setting('vw_kindergarten_button_text_transform',array(
		'default'=> 'Uppercase',
		'sanitize_callback'	=> 'vw_kindergarten_sanitize_choices'
	));
	$wp_customize->add_control('vw_kindergarten_button_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Button Text Transform','vw-kindergarten'),
		'choices' => array(
            'Uppercase' => __('Uppercase','vw-kindergarten'),
            'Capitalize' => __('Capitalize','vw-kindergarten'),
            'Lowercase' => __('Lowercase','vw-kindergarten'),
        ),
		'section'=> 'vw_kindergarten_button_settings',
	));

	// Related Post Settings
	$wp_customize->add_section( 'vw_kindergarten_related_posts_settings', array(
		'title' => esc_html__( 'Related Posts Settings', 'vw-kindergarten' ),
		'panel' => 'vw_kindergarten_blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_kindergarten_related_post_title', array( 
		'selector' => '.related-post h3', 
		'render_callback' => 'vw_kindergarten_Customize_partial_vw_kindergarten_related_post_title', 
	));

    $wp_customize->add_setting( 'vw_kindergarten_related_post',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_related_post',array(
		'label' => esc_html__( 'Related Post','vw-kindergarten' ),
		'section' => 'vw_kindergarten_related_posts_settings'
    )));

    $wp_customize->add_setting('vw_kindergarten_related_post_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_related_post_title',array(
		'label'	=> esc_html__('Add Related Post Title','vw-kindergarten'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Related Post', 'vw-kindergarten' ),
        ),
		'section'=> 'vw_kindergarten_related_posts_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('vw_kindergarten_related_posts_count',array(
		'default'=> 3,
		'sanitize_callback'	=> 'vw_kindergarten_sanitize_number_absint'
	));
	$wp_customize->add_control('vw_kindergarten_related_posts_count',array(
		'label'	=> esc_html__('Add Related Post Count','vw-kindergarten'),
		'input_attrs' => array(
            'placeholder' => esc_html__( '3', 'vw-kindergarten' ),
        ),
		'section'=> 'vw_kindergarten_related_posts_settings',
		'type'=> 'number'
	));

	$wp_customize->add_setting( 'vw_kindergarten_related_posts_excerpt_number', array(
		'default'              => 20,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_kindergarten_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_kindergarten_related_posts_excerpt_number', array(
		'label'       => esc_html__( 'Related Posts Excerpt length','vw-kindergarten' ),
		'section'     => 'vw_kindergarten_related_posts_settings',
		'type'        => 'range',
		'settings'    => 'vw_kindergarten_related_posts_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	// Single Posts Settings
	$wp_customize->add_section( 'vw_kindergarten_single_blog_settings', array(
		'title' => __( 'Single Post Settings', 'vw-kindergarten' ),
		'panel' => 'vw_kindergarten_blog_post_parent_panel',
	));

  	$wp_customize->add_setting('vw_kindergarten_single_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new vw_kindergarten_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_kindergarten_single_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','vw-kindergarten'),
		'transport' => 'refresh',
		'section'	=> 'vw_kindergarten_single_blog_settings',
		'setting'	=> 'vw_kindergarten_single_postdate_icon',
		'type'		=> 'icon'
	)));

 	$wp_customize->add_setting( 'vw_kindergarten_single_postdate',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_single_postdate',array(
	    'label' => esc_html__( 'Date','vw-kindergarten' ),
	   'section' => 'vw_kindergarten_single_blog_settings'
	)));

	$wp_customize->add_setting('vw_kindergarten_single_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new vw_kindergarten_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_kindergarten_single_author_icon',array(
		'label'	=> __('Add Author Icon','vw-kindergarten'),
		'transport' => 'refresh',
		'section'	=> 'vw_kindergarten_single_blog_settings',
		'setting'	=> 'vw_kindergarten_single_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_kindergarten_single_author',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_single_author',array(
	    'label' => esc_html__( 'Author','vw-kindergarten' ),
	    'section' => 'vw_kindergarten_single_blog_settings'
	)));

   	$wp_customize->add_setting('vw_kindergarten_single_comments_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new vw_kindergarten_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_kindergarten_single_comments_icon',array(
		'label'	=> __('Add Comments Icon','vw-kindergarten'),
		'transport' => 'refresh',
		'section'	=> 'vw_kindergarten_single_blog_settings',
		'setting'	=> 'vw_kindergarten_single_comments_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_kindergarten_single_comments',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_single_comments',array(
	    'label' => esc_html__( 'Comments','vw-kindergarten' ),
	    'section' => 'vw_kindergarten_single_blog_settings'
	)));

  	$wp_customize->add_setting('vw_kindergarten_single_time_icon',array(
		'default'	=> 'fas fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new vw_kindergarten_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_kindergarten_single_time_icon',array(
		'label'	=> __('Add Time Icon','vw-kindergarten'),
		'transport' => 'refresh',
		'section'	=> 'vw_kindergarten_single_blog_settings',
		'setting'	=> 'vw_kindergarten_single_time_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_kindergarten_single_time',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_single_time',array(
	    'label' => esc_html__( 'Time','vw-kindergarten' ),
	    'section' => 'vw_kindergarten_single_blog_settings'
	)));

	$wp_customize->add_setting( 'vw_kindergarten_toggle_tags',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_toggle_tags', array(
		'label' => esc_html__( 'Tags','vw-kindergarten' ),
		'section' => 'vw_kindergarten_single_blog_settings'
    )));

	$wp_customize->add_setting( 'vw_kindergarten_single_post_breadcrumb',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_single_post_breadcrumb',array(
		'label' => esc_html__( 'Single Post Breadcrumb','vw-kindergarten' ),
		'section' => 'vw_kindergarten_single_blog_settings'
    )));

    // Single Posts Category
  	$wp_customize->add_setting( 'vw_kindergarten_single_post_category',array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ) );
  	$wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_single_post_category',array(
		'label' => esc_html__( 'Single Post Category','vw-kindergarten' ),
		'section' => 'vw_kindergarten_single_blog_settings'
    )));

   	$wp_customize->add_setting( 'vw_kindergarten_single_blog_post_navigation_show_hide',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
	));
	$wp_customize->add_control( new vw_kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_single_blog_post_navigation_show_hide', array(
		  'label' => esc_html__( 'Post Navigation','vw-kindergarten' ),
		  'section' => 'vw_kindergarten_single_blog_settings'
	)));

	$wp_customize->add_setting('vw_kindergarten_single_post_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_single_post_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','vw-kindergarten'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','vw-kindergarten'),
		'section'=> 'vw_kindergarten_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_kindergarten_single_blog_comment_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_kindergarten_single_blog_comment_title',array(
		'label'	=> __('Add Comment Title','vw-kindergarten'),
		'input_attrs' => array(
            'placeholder' => __( 'Leave a Reply', 'vw-kindergarten' ),
        ),
		'section'=> 'vw_kindergarten_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_kindergarten_single_blog_comment_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_kindergarten_single_blog_comment_button_text',array(
		'label'	=> __('Add Comment Button Text','vw-kindergarten'),
		'input_attrs' => array(
            'placeholder' => __( 'Post Comment', 'vw-kindergarten' ),
        ),
		'section'=> 'vw_kindergarten_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_kindergarten_single_blog_comment_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_single_blog_comment_width',array(
		'label'	=> __('Comment Form Width','vw-kindergarten'),
		'description'	=> __('Enter a value in %. Example:50%','vw-kindergarten'),
		'input_attrs' => array(
            'placeholder' => __( '100%', 'vw-kindergarten' ),
        ),
		'section'=> 'vw_kindergarten_single_blog_settings',
		'type'=> 'text'
	));

	// Grid layout setting
	$wp_customize->add_section( 'vw_kindergarten_grid_layout_settings', array(
		'title' => __( 'Grid Layout Settings', 'vw-kindergarten' ),
		'panel' => 'vw_kindergarten_blog_post_parent_panel',
	));

  	$wp_customize->add_setting('vw_kindergarten_grid_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new vw_kindergarten_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_kindergarten_grid_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','vw-kindergarten'),
		'transport' => 'refresh',
		'section'	=> 'vw_kindergarten_grid_layout_settings',
		'setting'	=> 'vw_kindergarten_grid_postdate_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_kindergarten_grid_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_grid_postdate',array(
        'label' => esc_html__( 'Post Date','vw-kindergarten' ),
        'section' => 'vw_kindergarten_grid_layout_settings'
    )));

	$wp_customize->add_setting('vw_kindergarten_grid_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new vw_kindergarten_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_kindergarten_grid_author_icon',array(
		'label'	=> __('Add Author Icon','vw-kindergarten'),
		'transport' => 'refresh',
		'section'	=> 'vw_kindergarten_grid_layout_settings',
		'setting'	=> 'vw_kindergarten_grid_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_kindergarten_grid_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_grid_author',array(
		'label' => esc_html__( 'Author','vw-kindergarten' ),
		'section' => 'vw_kindergarten_grid_layout_settings'
    )));

    $wp_customize->add_setting('vw_kindergarten_grid_comments_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new vw_kindergarten_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_kindergarten_grid_comments_icon',array(
		'label'	=> __('Add Comments Icon','vw-kindergarten'),
		'transport' => 'refresh',
		'section'	=> 'vw_kindergarten_grid_layout_settings',
		'setting'	=> 'vw_kindergarten_grid_comments_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_kindergarten_grid_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_grid_comments',array(
		'label' => esc_html__( 'Comments','vw-kindergarten' ),
		'section' => 'vw_kindergarten_grid_layout_settings'
    )));

	//Others Settings
	$wp_customize->add_panel( 'vw_kindergarten_others_panel', array(
		'title' => esc_html__( 'Others Settings', 'vw-kindergarten' ),
		'panel' => 'vw_kindergarten_panel_id',
		'priority' => 20,
	));

	// Layout
	$wp_customize->add_section( 'vw_kindergarten_left_right', array(
    	'title' => esc_html__( 'General Settings', 'vw-kindergarten' ),
		'panel' => 'vw_kindergarten_others_panel'
	) );

	$wp_customize->add_setting('vw_kindergarten_width_option',array(
        'default' => 'Full Width',
        'sanitize_callback' => 'vw_kindergarten_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Kindergarten_Image_Radio_Control($wp_customize, 'vw_kindergarten_width_option', array(
        'type' => 'select',
        'label' => esc_html__('Width Layouts','vw-kindergarten'),
        'description' => esc_html__('Here you can change the width layout of Website.','vw-kindergarten'),
        'section' => 'vw_kindergarten_left_right',
        'choices' => array(
            'Full Width' => esc_url(get_template_directory_uri()).'/assets/images/full-width.png',
            'Wide Width' => esc_url(get_template_directory_uri()).'/assets/images/wide-width.png',
            'Boxed' => esc_url(get_template_directory_uri()).'/assets/images/boxed-width.png',
    ))));

	$wp_customize->add_setting('vw_kindergarten_page_layout',array(
        'default' => 'One_Column',
        'sanitize_callback' => 'vw_kindergarten_sanitize_choices'
	));
	$wp_customize->add_control('vw_kindergarten_page_layout',array(
        'type' => 'select',
        'label' => esc_html__('Page Sidebar Layout','vw-kindergarten'),
        'description' => esc_html__('Here you can change the sidebar layout for pages. ','vw-kindergarten'),
        'section' => 'vw_kindergarten_left_right',
        'choices' => array(
            'Left_Sidebar' => esc_html__('Left Sidebar','vw-kindergarten'),
            'Right_Sidebar' => esc_html__('Right Sidebar','vw-kindergarten'),
            'One_Column' => esc_html__('One Column','vw-kindergarten')
        ),
	) );

    $wp_customize->add_setting( 'vw_kindergarten_single_page_breadcrumb',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_single_page_breadcrumb',array(
		'label' => esc_html__( 'Single Page Breadcrumb','vw-kindergarten' ),
		'section' => 'vw_kindergarten_left_right'
    )));

    //Wow Animation
	$wp_customize->add_setting( 'vw_kindergarten_animation',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_animation',array(
        'label' => esc_html__( 'Animations','vw-kindergarten' ),
        'description' => __('Here you can disable overall site animation effect','vw-kindergarten'),
        'section' => 'vw_kindergarten_left_right'
    )));

    // Pre-Loader
	$wp_customize->add_setting( 'vw_kindergarten_loader_enable',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_loader_enable',array(
        'label' => esc_html__( 'Pre-Loader','vw-kindergarten' ),
        'section' => 'vw_kindergarten_left_right'
    )));

	$wp_customize->add_setting('vw_kindergarten_preloader_bg_color', array(
		'default'           => '#404376',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_kindergarten_preloader_bg_color', array(
		'label'    => __('Pre-Loader Background Color', 'vw-kindergarten'),
		'section'  => 'vw_kindergarten_left_right',
	)));

	$wp_customize->add_setting('vw_kindergarten_preloader_border_color', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_kindergarten_preloader_border_color', array(
		'label'    => __('Pre-Loader Border Color', 'vw-kindergarten'),
		'section'  => 'vw_kindergarten_left_right',
	)));

	$wp_customize->add_setting('vw_kindergarten_preloader_bg_img',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'vw_kindergarten_preloader_bg_img',array(
        'label' => __('Preloader Background Image','vw-kindergarten'),
        'section' => 'vw_kindergarten_left_right'
	)));

	//Responsive Media Settings
	$wp_customize->add_section('vw_kindergarten_responsive_media',array(
		'title'	=> esc_html__('Responsive Media','vw-kindergarten'),
		'panel' => 'vw_kindergarten_others_panel',
	));

    $wp_customize->add_setting( 'vw_kindergarten_resp_slider_hide_show',array(
      	'default' => 0,
     	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_resp_slider_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Slider','vw-kindergarten' ),
      	'section' => 'vw_kindergarten_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_kindergarten_sidebar_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_sidebar_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Sidebar','vw-kindergarten' ),
      	'section' => 'vw_kindergarten_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_kindergarten_resp_scroll_top_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_resp_scroll_top_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Scroll To Top','vw-kindergarten' ),
      	'section' => 'vw_kindergarten_responsive_media'
    )));

    $wp_customize->add_setting('vw_kindergarten_res_open_menu_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Kindergarten_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_kindergarten_res_open_menu_icon',array(
		'label'	=> __('Add Open Menu Icon','vw-kindergarten'),
		'transport' => 'refresh',
		'section'	=> 'vw_kindergarten_responsive_media',
		'setting'	=> 'vw_kindergarten_res_open_menu_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_kindergarten_res_menu_close_icon',array(
		'default'	=> 'fas fa-times',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Kindergarten_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_kindergarten_res_menu_close_icon',array(
		'label'	=> __('Add Close Menu Icon','vw-kindergarten'),
		'transport' => 'refresh',
		'section'	=> 'vw_kindergarten_responsive_media',
		'setting'	=> 'vw_kindergarten_res_menu_close_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_kindergarten_resp_menu_toggle_btn_bg_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_kindergarten_resp_menu_toggle_btn_bg_color', array(
		'label'    => __('Toggle Button Bg Color', 'vw-kindergarten'),
		'section'  => 'vw_kindergarten_responsive_media',
	)));

    //Woocommerce settings
	$wp_customize->add_section('vw_kindergarten_woocommerce_section', array(
		'title'    => __('WooCommerce Layout', 'vw-kindergarten'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

    //Shop Page Featured Image
	$wp_customize->add_setting( 'vw_kindergarten_shop_featured_image_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_kindergarten_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_kindergarten_shop_featured_image_border_radius', array(
		'label'       => esc_html__( 'Shop Page Featured Image Border Radius','vw-kindergarten' ),
		'section'     => 'vw_kindergarten_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'vw_kindergarten_shop_featured_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_kindergarten_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_kindergarten_shop_featured_image_box_shadow', array(
		'label'       => esc_html__( 'Shop Page Featured Image Box Shadow','vw-kindergarten' ),
		'section'     => 'vw_kindergarten_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	// Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'vw_kindergarten_woocommerce_shop_page_sidebar', array( 'selector' => '.post-type-archive-product #sidebar', 
		'render_callback' => 'vw_kindergarten_customize_partial_vw_kindergarten_woocommerce_shop_page_sidebar', ) );

    // Woocommerce Shop Page Sidebar
	$wp_customize->add_setting( 'vw_kindergarten_woocommerce_shop_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_woocommerce_shop_page_sidebar',array(
		'label' => esc_html__( 'Shop Page Sidebar','vw-kindergarten' ),
		'section' => 'vw_kindergarten_woocommerce_section'
    )));

    $wp_customize->add_setting('vw_kindergarten_shop_page_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'vw_kindergarten_sanitize_choices'
	));
	$wp_customize->add_control('vw_kindergarten_shop_page_layout',array(
        'type' => 'select',
        'label' => __('Shop Page Sidebar Layout','vw-kindergarten'),
        'section' => 'vw_kindergarten_woocommerce_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-kindergarten'),
            'Right Sidebar' => __('Right Sidebar','vw-kindergarten'),
        ),
	) );

    // Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'vw_kindergarten_woocommerce_single_product_page_sidebar', array( 'selector' => '.single-product #sidebar', 
		'render_callback' => 'vw_kindergarten_customize_partial_vw_kindergarten_woocommerce_single_product_page_sidebar', ) );

    //Woocommerce Single Product page Sidebar
	$wp_customize->add_setting( 'vw_kindergarten_woocommerce_single_product_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_woocommerce_single_product_page_sidebar',array(
		'label' => esc_html__( 'Single Product Sidebar','vw-kindergarten' ),
		'section' => 'vw_kindergarten_woocommerce_section'
    )));

   	$wp_customize->add_setting('vw_kindergarten_single_product_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'vw_kindergarten_sanitize_choices'
	));
	$wp_customize->add_control('vw_kindergarten_single_product_layout',array(
        'type' => 'select',
        'label' => __('Single Product Sidebar Layout','vw-kindergarten'),
        'section' => 'vw_kindergarten_woocommerce_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-kindergarten'),
            'Right Sidebar' => __('Right Sidebar','vw-kindergarten'),
        ),
	) );

	$wp_customize->add_setting('vw_kindergarten_products_btn_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_products_btn_padding_top_bottom',array(
		'label'	=> __('Products Button Padding Top Bottom','vw-kindergarten'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-kindergarten'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-kindergarten' ),
        ),
		'section'=> 'vw_kindergarten_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_kindergarten_products_btn_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_products_btn_padding_left_right',array(
		'label'	=> __('Products Button Padding Left Right','vw-kindergarten'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-kindergarten'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-kindergarten' ),
        ),
		'section'=> 'vw_kindergarten_woocommerce_section',
		'type'=> 'text'
	));

    //Products Sale Badge
	$wp_customize->add_setting('vw_kindergarten_woocommerce_sale_position',array(
        'default' => 'left',
        'sanitize_callback' => 'vw_kindergarten_sanitize_choices'
	));
	$wp_customize->add_control('vw_kindergarten_woocommerce_sale_position',array(
        'type' => 'select',
        'label' => __('Sale Badge Position','vw-kindergarten'),
        'section' => 'vw_kindergarten_woocommerce_section',
        'choices' => array(
            'left' => __('Left','vw-kindergarten'),
            'right' => __('Right','vw-kindergarten'),
        ),
	) );

	$wp_customize->add_setting('vw_kindergarten_woocommerce_sale_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_kindergarten_woocommerce_sale_font_size',array(
		'label'	=> __('Sale Font Size','vw-kindergarten'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-kindergarten'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-kindergarten' ),
        ),
		'section'=> 'vw_kindergarten_woocommerce_section',
		'type'=> 'text'
	));

  	// Related Product
    $wp_customize->add_setting( 'vw_kindergarten_related_product_show_hide',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_kindergarten_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Kindergarten_Toggle_Switch_Custom_Control( $wp_customize, 'vw_kindergarten_related_product_show_hide',array(
        'label' => esc_html__( 'Related product','vw-kindergarten' ),
        'section' => 'vw_kindergarten_woocommerce_section'
    )));
}

add_action( 'customize_register', 'vw_kindergarten_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_Kindergarten_Customize {

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
		$manager->register_section_type( 'VW_Kindergarten_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section( new VW_Kindergarten_Customize_Section_Pro( $manager,'vw_kindergarten_go_pro', array(
			'priority'   => 1,
			'title'    => esc_html__( 'KINDERGARTEN PRO', 'vw-kindergarten' ),
			'pro_text' => esc_html__( 'UPGRADE PRO', 'vw-kindergarten' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/themes/kindergarten-wordpress-theme/'),
		) )	);

		// Register sections.
		$manager->add_section(new VW_Kindergarten_Customize_Section_Pro($manager,'vw_kindergarten_get_started_link',array(
			'priority'   => 1,
			'title'    => esc_html__( 'DOCUMENTATION', 'vw-kindergarten' ),
			'pro_text' => esc_html__( 'DOCS', 'vw-kindergarten' ),
			'pro_url'  => esc_url('https://www.vwthemesdemo.com/docs/free-vw-kindergarten/'),
		)));
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-kindergarten-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-kindergarten-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_Kindergarten_Customize::get_instance();