<?php
/**
 * Green Agro Landscaping functions and definitions
 *
 * @package Green Agro Landscaping
 * @subpackage green_agro_landscaping
 */

function green_agro_landscaping_setup() {

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'title-tag' );
	add_theme_support( "responsive-embeds" );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'green-agro-landscaping-featured-image', 2000, 1200, true );
	add_image_size( 'green-agro-landscaping-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary-menu'    => __( 'Primary Menu', 'green-agro-landscaping' ),
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

	add_theme_support( 'html5', array('comment-form','comment-list','gallery','caption',) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', green_agro_landscaping_fonts_url() ) );
}
add_action( 'after_setup_theme', 'green_agro_landscaping_setup' );

/**
 * Register custom fonts.
 */
function green_agro_landscaping_fonts_url(){
	$green_agro_landscaping_font_url = '';
	$green_agro_landscaping_font_family = array();
	$green_agro_landscaping_font_family[] = 'Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900';

	$green_agro_landscaping_query_args = array(
		'family'	=> rawurlencode(implode('|',$green_agro_landscaping_font_family)),
	);
	$green_agro_landscaping_font_url = add_query_arg($green_agro_landscaping_query_args,'//fonts.googleapis.com/css');
	return $green_agro_landscaping_font_url;
	$contents = wptt_get_webfont_url( esc_url_raw( $green_agro_landscaping_font_url ) );
}

/**
 * Register widget area.
 */
function green_agro_landscaping_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'green-agro-landscaping' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'green-agro-landscaping' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'green-agro-landscaping' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your sidebar on pages.', 'green-agro-landscaping' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'green-agro-landscaping' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'green-agro-landscaping' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'green-agro-landscaping' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'green-agro-landscaping' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'green-agro-landscaping' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'green-agro-landscaping' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'green-agro-landscaping' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'green-agro-landscaping' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'green-agro-landscaping' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'green-agro-landscaping' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'green_agro_landscaping_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function green_agro_landscaping_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'green-agro-landscaping-fonts', green_agro_landscaping_fonts_url(), array(), null );

	// Bootstrap
	wp_enqueue_style( 'bootstrap-css', get_theme_file_uri( '/assets/css/bootstrap.css' ) );

	// Theme stylesheet.
	wp_enqueue_style( 'green-agro-landscaping-style', get_stylesheet_uri() );

	// Theme block stylesheet.
	wp_enqueue_style( 'green-agro-landscaping-block-style', get_theme_file_uri( '/assets/css/blocks.css' ), array( 'green-agro-landscaping-style' ), '1.0' );

	// Fontawesome
	wp_enqueue_style( 'fontawesome-css', get_theme_file_uri( '/assets/css/fontawesome-all.css' ) );

	wp_enqueue_script( 'bootstrap-js', get_theme_file_uri( '/assets/js/bootstrap.js' ), array( 'jquery' ), true );


	if(!wp_is_mobile()){
		wp_enqueue_script( 'jquery-superfish', get_theme_file_uri( '/assets/js/jquery.superfish.js' ), array( 'jquery' ), true );
		wp_enqueue_script( 'green-agro-landscaping-superfish-custom-scripts', esc_url( get_template_directory_uri() ) . '/assets/js/superfish-custom.js', array('jquery','jquery-superfish'), true );
	}

	wp_enqueue_script( 'green-agro-landscaping-custom-scripts', esc_url( get_template_directory_uri() ) . '/assets/js/custom.js', array('jquery'), true );


	wp_enqueue_script( 'green-agro-landscaping-focus-nav', esc_url( get_template_directory_uri() ) . '/assets/js/focus-nav.js', array('jquery'), true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'green_agro_landscaping_scripts' );

/*radio button sanitization*/
function green_agro_landscaping_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

/* Excerpt Limit Begin */
function green_agro_landscaping_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

function green_agro_landscaping_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function green_agro_landscaping_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'green_agro_landscaping_loop_columns');
if (!function_exists('green_agro_landscaping_loop_columns')) {
	function green_agro_landscaping_loop_columns() {
		$columns = get_theme_mod( 'green_agro_landscaping_per_columns', 3 );
		return $columns;
	}
}

//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'green_agro_landscaping_per_page', 20 );
function green_agro_landscaping_per_page( $cols ) {
  	$cols = get_theme_mod( 'green_agro_landscaping_product_per_page', 9 );
	return $cols;
}

function green_agro_landscaping_sanitize_checkbox( $input ) {
	// Boolean check
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

function green_agro_landscaping_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}

function green_agro_landscaping_sanitize_number_range( $number, $setting ) {

	// Ensure input is an absolute integer.
	$number = absint( $number );

	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;

	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );

	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );

	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}

/**
 * Use front-page.php when Front page displays is set to a static page.
 */
function green_agro_landscaping_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'green_agro_landscaping_front_page_template' );

/**
 * Logo Custamization.
 */

function green_agro_landscaping_logo_width(){

	$green_agro_landscaping_logo_width   = get_theme_mod( 'green_agro_landscaping_logo_width', 150 );

	echo "<style type='text/css' media='all'>"; ?>
		img.custom-logo{
		    width: <?php echo absint( $green_agro_landscaping_logo_width ); ?>px;
		    max-width: 100%;
		}
	<?php echo "</style>";
}

add_action( 'wp_head', 'green_agro_landscaping_logo_width' );

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * Load Theme Web File
 */
require get_parent_theme_file_path('/inc/wptt-webfont-loader.php' );
/**
 * Load Toggle file
 */
require get_parent_theme_file_path( '/inc/customize-control-toggle.php' );

// Icon Meta
function green_agro_landscaping_bn_custom_meta_icon() {
    add_meta_box( 'bn_meta', __( 'Icon For Post', 'green-agro-landscaping' ), 'green_agro_landscaping_meta_callback_icon', 'post', 'normal', 'high' );
}
/* Hook things in for admin*/
if (is_admin()){
  add_action('admin_menu', 'green_agro_landscaping_bn_custom_meta_icon');
}

function green_agro_landscaping_meta_callback_icon( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'green_agro_landscaping_offer_icon_meta_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );
    $green_agro_landscaping_font_icon = get_post_meta( $post->ID, 'green_agro_landscaping_font_icon', true );
    ?>
    <div id="testi_custom_stuff">
        <table id="list">
            <tbody id="the-list" data-wp-lists="list:meta">
                <tr id="meta-8">
                    <td class="left">
                        <?php esc_html_e( 'Add Icon', 'green-agro-landscaping' )?>
                    </td>
                    <td class="left">
                        <input type="text" name="green_agro_landscaping_font_icon" id="green_agro_landscaping_font_icon" value="<?php echo esc_attr($green_agro_landscaping_font_icon); ?>" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}

/* Saves the custom meta input */
function green_agro_landscaping_bn_metadesig_save( $post_id ) {
    if (!isset($_POST['green_agro_landscaping_offer_icon_meta_nonce']) || !wp_verify_nonce( strip_tags( wp_unslash( $_POST['green_agro_landscaping_offer_icon_meta_nonce']) ), basename(__FILE__))) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Save Post Icon
    if( isset( $_POST[ 'green_agro_landscaping_font_icon' ] ) ) {
        update_post_meta( $post_id, 'green_agro_landscaping_font_icon', strip_tags( wp_unslash( $_POST[ 'green_agro_landscaping_font_icon' ]) ) );
    }
}
add_action( 'save_post', 'green_agro_landscaping_bn_metadesig_save' );
