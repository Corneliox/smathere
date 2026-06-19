<?php
/*
 * fKidd functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 */

/**
 * Set a constant that holds the theme's minimum supported PHP version.
 */
define( 'FKIDD_MIN_PHP_VERSION', '5.6' );

/**
 * Immediately after theme switch is fired we we want to check php version and
 * revert to previously active theme if version is below our minimum.
 */
add_action( 'after_switch_theme', 'fkidd_test_for_min_php' );

/**
 * Switches back to the previous theme if the minimum PHP version is not met.
 */
function fkidd_test_for_min_php() {

	// Compare versions.
	if ( version_compare( PHP_VERSION, FKIDD_MIN_PHP_VERSION, '<' ) ) {
		// Site doesn't meet themes min php requirements, add notice...
		add_action( 'admin_notices', 'fkidd_min_php_not_met_notice' );
		// ... and switch back to previous theme.
		switch_theme( get_option( 'theme_switched' ) );
		return false;

	};
}

if ( ! function_exists( 'wp_body_open' ) ) {
        function wp_body_open() {
                do_action( 'wp_body_open' );
        }
}

/**
 * An error notice that can be displayed if the Minimum PHP version is not met.
 */
function fkidd_min_php_not_met_notice() {
	?>
	<div class="notice notice-error is_dismissable">
		<p>
			<?php esc_html_e( 'You need to update your PHP version to run this theme.', 'fkidd' ); ?> <br />
			<?php
			printf(
				/* translators: 1 is the current PHP version string, 2 is the minmum supported php version string of the theme */
				esc_html__( 'Actual version is: %1$s, required version is: %2$s.', 'fkidd' ),
				PHP_VERSION,
				FKIDD_MIN_PHP_VERSION
			); // phpcs: XSS ok.
			?>
		</p>
	</div>
	<?php
}


require_once( trailingslashit( get_template_directory() ) . 'customize-pro/class-customize.php' );

if ( ! function_exists( 'fkidd_setup' ) ) :
/**
 * fKidd setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 */
function fkidd_setup() {

	load_theme_textdomain( 'fkidd', get_template_directory() . '/languages' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Primary Menu', 'fkidd' ),
		'footer'   => __( 'Footer Menu', 'fkidd' ),
	) );

	add_theme_support( 'post-thumbnails' );
	

	global $content_width;
	if ( ! isset( $content_width ) )
		$content_width = 900;

	add_theme_support( 'automatic-feed-links' );

	// add Custom background				 
	$args = array(
		'default-color' 	 => '#ffffff',
	);
	add_theme_support( 'custom-background', $args );

	// add custom header
    add_theme_support( 'custom-header', array (
                       'default-image'          => '',
                       'random-default'         => '',
                       'flex-height'            => true,
                       'flex-width'             => true,
                       'uploads'                => true,
                       'width'                  => 900,
                       'height'                 => 100,
                       'default-text-color'        => '#000000',
                       'wp-head-callback'       => 'fkidd_header_style',
                    ) );

    // add custom logo
    add_theme_support( 'custom-logo', array (
                       'width'                  => 75,
                       'height'                 => 75,
                       'flex-height'            => true,
                       'flex-width'             => true,
                    ) );
					
	add_theme_support( "title-tag" );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form', 'comment-list',
	) );

	// add WooCommerce support
	add_theme_support( 'woocommerce' );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	add_theme_support( 'editor-styles' );

	// add the visual editor to resemble the theme style
	add_editor_style( 'css/editor-style.css' );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(

		'widgets' => array(
			'sidebar-widget-area' => array(
				'search',
				'recent-posts',
				'categories',
				'archives',
			),

			
			'footer-column-1-widget-area' => array(
				'recent-comments'
			),

			'footer-column-2-widget-area' => array(
				'recent-posts'
			),

			'footer-column-3-widget-area' => array(
				'calendar'
			),
		),

		'posts' => array(
			'home',
			'blog',
			'about',
			'contact'
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'fkidd_slider_display' => 1,
			'fkidd_slide1_image' => esc_url( get_template_directory_uri() . '/images/slider/1.jpg' ),
			'fkidd_slide1_content' => _x( '<h2>Slide 1 Title</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><a href="#" title="Read more">Read more</a>', 'Theme starter content', 'fkidd' ),
			'fkidd_slide2_image' => esc_url( get_template_directory_uri() . '/images/slider/2.jpg' ),
			'fkidd_slide2_content' => _x( '<h2>Slide 2 Title</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><a href="#" title="Read more">Read more</a>', 'Theme starter content', 'fkidd' ),
			'fkidd_slide3_image' => esc_url( get_template_directory_uri() . '/images/slider/3.jpg' ),
			'fkidd_slide3_content' => _x( '<h2>Slide 3 Title</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><a href="#" title="Read more">Read more</a>', 'Theme starter content', 'fkidd' ),
			'fkidd_social_facebook' => _x( '#', 'Theme starter content', 'fkidd' ),
			'fkidd_social_twitter' => _x( '#', 'Theme starter content', 'fkidd' ),
			'fkidd_social_linkedin' => _x( '#', 'Theme starter content', 'fkidd' ),
			'fkidd_social_instagram' => _x( '#', 'Theme starter content', 'fkidd' ),
			'fkidd_social_rss' => _x( '#', 'Theme starter content', 'fkidd' ),
			'fkidd_social_tumblr' => _x( '#', 'Theme starter content', 'fkidd' ),
			'fkidd_social_youtube' => _x( '#', 'Theme starter content', 'fkidd' ),
			'fkidd_social_pinterest' => _x( '#', 'Theme starter content', 'fkidd' ),
			'fkidd_social_vk' => _x( '#', 'Theme starter content', 'fkidd' ),
			'fkidd_social_flickr' => _x( '#', 'Theme starter content', 'fkidd' ),
			'fkidd_social_vine' => _x( '#', 'Theme starter content', 'fkidd' ),
			'fkidd_header_phone' => _x( 'info@example.com', 'Theme starter content', 'fkidd' ),
			'fkidd_header_email' => _x( '1.555.555.555', 'Theme starter content', 'fkidd' ),
		),

		'nav_menus' => array(
			// Assign a menu to the "primary" location.
			'primary' => array(
				'name' => __( 'Primary Menu', 'fkidd' ),
				'items' => array(
					'link_home',
					'page_blog',
					'page_contact',
					'page_about',
				),
			),

			// Assign a menu to the "footer" location.
			'footer' => array(
				'name' => __( 'Footer Menu', 'fkidd' ),
				'items' => array(
					'link_home',
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
		),
	);

	$starter_content = apply_filters( 'fkidd_starter_content', $starter_content );
	add_theme_support( 'starter-content', $starter_content );
}
endif; // fkidd_setup
add_action( 'after_setup_theme', 'fkidd_setup' );

/**
 * Add Social Site control into Customizer
 */
function fkidd_customize_add_social_site($wp_customize, $controlId, $label) {

	$wp_customize->add_setting(
		$controlId,
		array(
		    'sanitize_callback' => 'fkidd_sanitize_url',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $controlId,
        array(
            'label'          => $label,
            'section'        => 'fkidd_social_section',
            'settings'       => $controlId,
            'type'           => 'text',
            )
        )
	);
}

if ( ! function_exists( 'fkidd_sanitize_checkbox' ) ) :
	/**
	 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
	 * as a boolean value, either TRUE or FALSE.
	 *
	 * @param bool $checked Whether the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
	 */
	function fkidd_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
endif; // fkidd_sanitize_checkbox

if ( ! function_exists( 'fkidd_sanitize_html' ) ) :

	function fkidd_sanitize_html( $html ) {
		return wp_kses_post( $html );
	}

endif; // fkidd_sanitize_html

if ( ! function_exists( 'fkidd_sanitize_url' ) ) :

	function fkidd_sanitize_url( $url ) {
		return esc_url_raw( $url );
	}

endif; // fkidd_sanitize_url

if ( ! function_exists( 'fkidd_sanitize_email' ) ) :

	function fkidd_sanitize_email( $email, $setting ) {
		// Strips out all characters that are not allowable in an email address.
		$email = sanitize_email( $email );
		
		// If $email is a valid email, return it; otherwise, return the default.
		return ( ! is_null( $email ) ? $email : $setting->default );
	}

endif; // fkidd_sanitize_email

/**
 * Register theme settings in the customizer
 */
function fkidd_customize_register( $wp_customize ) {

	/**
	 * Add Slider Section
	 */
	$wp_customize->add_section(
		'fkidd_slider_section',
		array(
			'title'       => __( 'Slider', 'fkidd' ),
			'capability'  => 'edit_theme_options',
		)
	);
	
	$wp_customize->add_setting(
			'fkidd_slider_display',
			array(
					'default'           => 0,
					'sanitize_callback' => 'fkidd_sanitize_checkbox',
			)
	);
	
	// Add display slider option
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fkidd_slider_display',
							array(
								'label'          => __( 'Display Slider on a Static Front Page', 'fkidd' ),
								'section'        => 'fkidd_slider_section',
								'settings'       => 'fkidd_slider_display',
								'type'           => 'checkbox',
							)
						)
	);
	
	for ($i = 1; $i <= 3; ++$i) {
	
		$slideContentId = 'fkidd_slide'.$i.'_content';
		$slideImageId = 'fkidd_slide'.$i.'_image';
		$defaultSliderImagePath = get_template_directory_uri().'/images/slider/'.$i.'.jpg';
	
		// Add Slide Content
		$wp_customize->add_setting(
			$slideContentId,
			array(
				'sanitize_callback' => 'fkidd_sanitize_html',
			)
		);
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $slideContentId,
									array(
										'label'          => sprintf( esc_html__( 'Slide #%s Content', 'fkidd' ), $i ),
										'section'        => 'fkidd_slider_section',
										'settings'       => $slideContentId,
										'type'           => 'textarea',
										)
									)
		);
		
		// Add Slide Background Image
		$wp_customize->add_setting( $slideImageId,
			array(
				'default' => $defaultSliderImagePath,
				'sanitize_callback' => 'fkidd_sanitize_url'
			)
		);

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $slideImageId,
				array(
					'label'   	 => sprintf( esc_html__( 'Slide #%s Image', 'fkidd' ), $i ),
					'section' 	 => 'fkidd_slider_section',
					'settings'   => $slideImageId,
				) 
			)
		);
	}

	/**
	 * Add Footer Section
	 */
	$wp_customize->add_section(
		'fkidd_header_and_footer_section',
		array(
			'title'       => __( 'Header and Footer', 'fkidd' ),
			'capability'  => 'edit_theme_options',
		)
	);

	// Add header phone
	$wp_customize->add_setting(
		'fkidd_header_phone',
		array(
		    'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fkidd_header_phone',
        array(
            'label'          => __( 'Your phone to appear in the website header', 'fkidd' ),
            'section'        => 'fkidd_header_and_footer_section',
            'settings'       => 'fkidd_header_phone',
            'type'           => 'text',
            )
        )
	);

	// Add header email
	$wp_customize->add_setting(
		'fkidd_header_email',
		array(
		    'sanitize_callback' => 'fkidd_sanitize_email',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fkidd_header_email',
        array(
            'label'          => __( 'Your e-mail to appear in the website header', 'fkidd' ),
            'section'        => 'fkidd_header_and_footer_section',
            'settings'       => 'fkidd_header_email',
            'type'           => 'text',
            )
        )
	);
	
	// Add footer copyright text
	$wp_customize->add_setting(
		'fkidd_footer_copyright',
		array(
		    'default'           => '',
		    'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fkidd_footer_copyright',
        array(
            'label'          => __( 'Copyright Text', 'fkidd' ),
            'section'        => 'fkidd_header_and_footer_section',
            'settings'       => 'fkidd_footer_copyright',
            'type'           => 'text',
            )
        )
	);

	/**
	 * Add Social Sites Section
	 */
	$wp_customize->add_section(
		'fkidd_social_section',
		array(
			'title'       => __( 'Social Sites', 'fkidd' ),
			'capability'  => 'edit_theme_options',
		)
	);
	
	// Add facebook url
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_facebook',
		__( 'Facebook Page URL', 'fkidd' ));

	// Add twitter url
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_twitter',
		__( 'Twitter URL', 'fkidd' ));

	// Add LinkedIn
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_linkedin',
		__( 'LinkedIn', 'fkidd' ));

	// Add Instagram
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_instagram',
		__( 'Instagram', 'fkidd' ));

	// Add RSS Feeds url
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_rss',
		__( 'RSS Feeds URL', 'fkidd' ));

	// Add Tumblr Text Control
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_tumblr',
		__( 'Tumblr', 'fkidd' ));

	// Add YouTube channel url
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_youtube',
		__( 'YouTube channel URL', 'fkidd' ));

	// Add Pinterest Text Control
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_pinterest',
		__( 'Pinterest', 'fkidd' ));

	// Add VK Text Control
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_vk',
		__( 'VK', 'fkidd' ));

	// Add Flickr Text Control
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_flickr',
		__( 'Flickr', 'fkidd' ));

	// Add Vine Text Control
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_vine',
		__( 'Vine', 'fkidd' ));

	/**
	 * Add Animations Section
	 */
	$wp_customize->add_section(
		'fkidd_animations_display',
		array(
			'title'       => __( 'Animations', 'fkidd' ),
			'capability'  => 'edit_theme_options',
		)
	);

	// Add display Animations option
	$wp_customize->add_setting(
			'fkidd_animations_display',
			array(
					'default'           => 1,
					'sanitize_callback' => 'fkidd_sanitize_checkbox',
			)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
						'fkidd_animations_display',
							array(
								'label'          => __( 'Enable Animations', 'fkidd' ),
								'section'        => 'fkidd_animations_display',
								'settings'       => 'fkidd_animations_display',
								'type'           => 'checkbox',
							)
						)
	);
}
add_action('customize_register', 'fkidd_customize_register');

/**
 * the main function to load scripts in the fKidd theme
 * if you add a new load of script, style, etc. you can use that function
 * instead of adding a new wp_enqueue_scripts action for it.
 */
function fkidd_load_scripts() {

	// load main stylesheet.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array( ) );
	wp_enqueue_style( 'animate-css', get_template_directory_uri() . '/css/animate.css', array( ) );
	wp_enqueue_style( 'fkidd-style', get_stylesheet_uri(), array() );
	
	
	// Load thread comments reply script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
	
	// Load Utilities JS Script
	wp_enqueue_script( 'viewportchecker', get_template_directory_uri() . '/js/viewportchecker.js',
			array( 'jquery' ) );

	wp_enqueue_script( 'fkidd-utilities-js', get_template_directory_uri()
		. '/js/utilities.js', array( 'jquery', 'viewportchecker' ) );

	$data = array(
		'loading_effect' => ( get_theme_mod('fkidd_animations_display', 1) == 1 ),
	);
	wp_localize_script('fkidd-utilities-js', 'fkidd_options', $data);
	
	
	wp_enqueue_script( 'jquery.easing', get_template_directory_uri() . '/js/jquery.easing.js', array( 'jquery' ) );
	wp_enqueue_script( 'camera', get_template_directory_uri() . '/js/camera.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'fkidd_load_scripts' );



/**
 *	widgets-init action handler. Used to register widgets and register widget areas
 */
function fkidd_widgets_init() {

	// Sidebar Widget.
	register_sidebar( array (
						'name'	 		 =>	 __( 'Sidebar Widget Area', 'fkidd'),
						'id'		 	 =>	 'sidebar-widget-area',
						'description'	 =>  __( 'The sidebar widget area', 'fkidd'),
						'before_widget'	 =>  '',
						'after_widget'	 =>  '',
						'before_title'	 =>  '<div class="sidebar-before-title"></div><h3 class="sidebar-title">',
						'after_title'	 =>  '</h3><div class="sidebar-after-title"></div>',
					) );

	// Register Footer Column #1
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #1', 'fkidd' ),
							'id' 			 =>  'footer-column-1-widget-area',
							'description'	 =>  __( 'The Footer Column #1 widget area', 'fkidd' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="footer-title">',
							'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
						) );
	
	// Register Footer Column #2
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #2', 'fkidd' ),
							'id' 			 =>  'footer-column-2-widget-area',
							'description'	 =>  __( 'The Footer Column #2 widget area', 'fkidd' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="footer-title">',
							'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
						) );
	
	// Register Footer Column #3
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #3', 'fkidd' ),
							'id' 			 =>  'footer-column-3-widget-area',
							'description'	 =>  __( 'The Footer Column #3 widget area', 'fkidd' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="footer-title">',
							'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
						) );
}
add_action( 'widgets_init', 'fkidd_widgets_init' );

function fkidd_display_single_social_site($socialSiteID, $title, $cssClass) {

	$socialURL = get_theme_mod( $socialSiteID );
	if ( !empty($socialURL) ) {

		echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . esc_url( $title )
							. '" class="' . esc_attr( $cssClass ) . '"></a></li>';
	}

}

/**
 * Display Social Websites
 */
function fkidd_display_social_sites() {

	fkidd_display_single_social_site('fkidd_social_facebook', __('Follow us on Facebook', 'fkidd'), 'facebook16' );

	fkidd_display_single_social_site('fkidd_social_twitter', __('Follow us on Twitter', 'fkidd'), 'twitter16' );

	fkidd_display_single_social_site('fkidd_social_linkedin', __('Follow us on LinkedIn', 'fkidd'), 'linkedin16' );

	fkidd_display_single_social_site('fkidd_social_instagram', __('Follow us on Instagram', 'fkidd'), 'instagram16' );

	fkidd_display_single_social_site('fkidd_social_rss', __('Follow our RSS Feeds', 'fkidd'), 'rss16' );

	fkidd_display_single_social_site('fkidd_social_tumblr', __('Follow us on Tumblr', 'fkidd'), 'tumblr16' );

	fkidd_display_single_social_site('fkidd_social_youtube', __('Follow us on Youtube', 'fkidd'), 'youtube16' );

	fkidd_display_single_social_site('fkidd_social_pinterest', __('Follow us on Pinterest', 'fkidd'), 'pinterest16' );

	fkidd_display_single_social_site('fkidd_social_vk', __('Follow us on VK', 'fkidd'), 'vk16' );

	fkidd_display_single_social_site('fkidd_social_flickr', __('Follow us on Flickr', 'fkidd'), 'flickr16' );

	fkidd_display_single_social_site('fkidd_social_vine', __('Follow us on Vine', 'fkidd'), 'vine16' );
}

/**
 *	Displays the header phone.
 */
function fkidd_show_header_phone() {

	$phone = get_theme_mod('fkidd_header_phone');

	if ( !empty( $phone ) ) {

		echo '<span id="header-phone">' . esc_html($phone) . '</span>';
	}
}

/**
 *	Displays the header email.
 */
function fkidd_show_header_email() {

	$email = get_theme_mod('fkidd_header_email');

	if ( !empty( $email ) ) {

		echo '<span id="header-email"><a href="mailto:' . antispambot($email, 1) . '" title="' . esc_attr($email) . '">'
				. esc_html($email) . '</a></span>';
	}
}

/**
 *	Displays the copyright text.
 */
function fkidd_show_copyright_text() {

	$footerText = get_theme_mod('fkidd_footer_copyright', null);

	if ( !empty( $footerText ) ) {

		echo esc_html( $footerText ) . ' | ';		
	}
}

function fkidd_show_website_logo_image_and_title() {

	if ( has_custom_logo() ) {

        the_custom_logo();
    }

    $header_text_color = get_header_textcolor();

    if ( 'blank' !== $header_text_color ) {
    
        echo '<div id="site-identity">';
        echo '<a href="' . esc_url( home_url('/') ) . '" title="' . esc_attr( get_bloginfo('name') ) . '">';
        echo '<h1 class="entry-title">' . esc_html( get_bloginfo('name') ) . '</h1>';
        echo '</a>';
        echo '<strong>' . esc_html( get_bloginfo('description') ) . '</strong>';
        echo '</div>';
    }
}

/**
 * Displays the slider
 */
function fkidd_display_slider() { ?>
	 
	<div class="camera_wrap camera_emboss" id="camera_wrap">
		<?php
			// display slides
			for ( $i = 1; $i <= 3; ++$i ) {
					
					$defaultSlideImage = get_template_directory_uri().'/images/slider/' . $i .'.jpg';

					$slideContent = get_theme_mod( 'fkidd_slide'.$i.'_content' );
					$slideImage = get_theme_mod( 'fkidd_slide'.$i.'_image', $defaultSlideImage );

				?>

					<div data-thumb="<?php echo esc_attr( $slideImage ); ?>" data-src="<?php echo esc_attr( $slideImage ); ?>">
						<?php if ( $slideContent ) : ?>
								<div class="camera_caption fadeFromBottom">
									<?php echo $slideContent; ?>
								</div>
						<?php endif; ?>
					</div>
<?php		} ?>
	</div><!-- #camera_wrap -->
<?php  
}

/**
 *	Used to load the content for posts and pages.
 */
function fkidd_the_content() {

	// Display Thumbnails if thumbnail is set for the post
	if ( has_post_thumbnail() ) {
?>

		<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail(); ?>
		</a>
								
<?php
	}
	the_content( __( 'Read More', 'fkidd') );
}

/**
 *	Displays the single content.
 */
function fkidd_the_content_single() {

	// Display Thumbnails if thumbnail is set for the post
	if ( has_post_thumbnail() ) {

		the_post_thumbnail();
	}
	the_content( __( 'Read More...', 'fkidd') );
}

function fkidd_header_style() {

    $header_text_color = get_header_textcolor();

    if ( ! has_header_image()
        && ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color
             || 'blank' === $header_text_color ) ) {

        return;
    }

    $headerImage = get_header_image();
?>
    <style type="text/css">
        <?php if ( has_header_image() ) : ?>

                #header-main {background-image: url("<?php echo esc_url( $headerImage ); ?>");}

        <?php endif; ?>

        <?php if ( get_theme_support( 'custom-header', 'default-text-color' ) !== $header_text_color
                    && 'blank' !== $header_text_color ) : ?>

                #header-main, #header-main h1.entry-title {color: #<?php echo sanitize_hex_color_no_hash( $header_text_color ); ?>;}

        <?php endif; ?>
    </style>
<?php
}

if ( ! function_exists( 'fkidd_nav_wrap' ) ) :

	function fkidd_nav_wrap() {

		// open the <ul>, set 'menu_class' and 'menu_id' values
  		$wrap  = '<ul id="%1$s" class="%2$s">';
  
	  	// get nav items as configured in /wp-admin/
	  	$wrap .= '%3$s';

	  	if ( class_exists( 'WooCommerce' ) ) {

	  		global $woocommerce;

			$wrap .= '<li><a class="cart-contents-icon" href="'.wc_get_cart_url().'" title="'.__('View your shopping cart', 'fkidd')
					   .'"></a><div id="cart-popup-content"><div class="widget_shopping_cart_content"></div></div></li>';

		}
  
  		// close the <ul>
  		$wrap .= '</ul>';
  
  		// return the result
  		return $wrap;
	}

endif; // fkidd_nav_wrap

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function fkidd_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'fkidd_skip_link_focus_fix' );

function fkidd_register_block_styles() {

	register_block_style(
		'core/button',
		array(
			'name'  => 'btn',
			'label' => __( 'Hover Effect', 'fkidd' ),
		)
	);

	register_block_style(
		'core/group',
		array(
			'name'  => 'tgroup',
			'label' => __( 'Margin Bottom Space', 'fkidd' ),
		)
	);

	register_block_style(
		'core/site-title',
		array(
			'name'  => 'tsitetitle',
			'label' => __( 'Bold', 'fkidd' ),
		)
	);

	register_block_style(
		'core/post-title',
		array(
			'name'  => 'tposttitle',
			'label' => __( 'Bold', 'fkidd' ),
		)
	);

	register_block_style(
		'core/social-link',
		array(
			'name'  => 'tsociallinks',
			'label' => __( 'Square', 'fkidd' ),
		)
	);
}
add_action( 'init', 'fkidd_register_block_styles' );

?>