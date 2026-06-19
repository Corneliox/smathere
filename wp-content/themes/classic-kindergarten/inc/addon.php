<?php
/*
 * @package Classic Kindergarten
 */

function classic_kindergarten_admin_enqueue_scripts() {
	wp_enqueue_style( 'classic-kindergarten-admin-style', esc_url( get_template_directory_uri() ).'/css/addon.css' );
}
add_action( 'admin_enqueue_scripts', 'classic_kindergarten_admin_enqueue_scripts' );

add_action('after_switch_theme', 'classic_kindergarten_options');

function classic_kindergarten_options () {
	global $pagenow;
	if( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) && current_user_can( 'manage_options' ) ) {
		wp_redirect( admin_url( 'themes.php?page=classic-kindergarten' ) );
		exit;
	}
}

if ( ! defined( 'CLASSIC_KINDERGARTEN_SUPPORT' ) ) {
define('CLASSIC_KINDERGARTEN_SUPPORT',__('https://wordpress.org/support/theme/classic-kindergarten/','classic-kindergarten'));
}
if ( ! defined( 'CLASSIC_KINDERGARTEN_REVIEW' ) ) {
define('CLASSIC_KINDERGARTEN_REVIEW',__('https://wordpress.org/support/theme/classic-kindergarten/reviews/','classic-kindergarten'));
}
if ( ! defined( 'CLASSIC_KINDERGARTEN_THEME_PAGE' ) ) {
define('CLASSIC_KINDERGARTEN_THEME_PAGE',__('https://www.theclassictemplates.com/themes/','classic-kindergarten'));
}
if ( ! defined( 'CLASSIC_KINDERGARTEN_PRO_DEMO' ) ) {
define('CLASSIC_KINDERGARTEN_PRO_DEMO',__('https://www.theclassictemplates.com/trial/classic-kindergarten-pro/','classic-kindergarten'));
}
if ( ! defined( 'CLASSIC_KINDERGARTEN_PREMIUM_PAGE' ) ) {
define('CLASSIC_KINDERGARTEN_THEME_PREMIUM_PAGE',__('https://www.theclassictemplates.com/wp-themes/kindergarten-preschool-wordpress-theme/','classic-kindergarten'));
}

function classic_kindergarten_theme_info_menu_link() {
	$theme = wp_get_theme();
	add_theme_page(
		sprintf( esc_html__( 'Welcome to %1$s %2$s', 'classic-kindergarten' ), $theme->display( 'Name' ), $theme->display( 'Version' ) ),
		esc_html__( 'Theme Info', 'classic-kindergarten' ),'edit_theme_options','classic-kindergarten','classic_kindergarten_theme_info_page'
	);
}
add_action( 'admin_menu', 'classic_kindergarten_theme_info_menu_link' );

function classic_kindergarten_theme_info_page() {

	$theme = wp_get_theme();
	?>
<div class="wrap theme-info-wrap">
	<h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'classic-kindergarten' ), esc_html($theme->display( 'Name', 'classic-kindergarten'  )),esc_html($theme->display( 'Version', 'classic-kindergarten' ))); ?>
	</h1>
	<p class="theme-description">
	<?php esc_html_e( 'Do you want to configure this theme? Look no further, our easy-to-follow theme documentation will walk you through it.', 'classic-kindergarten' ); ?>
	</p>
	<hr>
	<div class="important-links clearfix">
		<p><strong><?php esc_html_e( 'Theme Links', 'classic-kindergarten' ); ?>:</strong>
			<a href="<?php echo esc_url( CLASSIC_KINDERGARTEN_THEME_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Theme Page', 'classic-kindergarten' ); ?></a>
			<a href="<?php echo esc_url( CLASSIC_KINDERGARTEN_SUPPORT ); ?>" target="_blank"><?php esc_html_e( 'Contact Us', 'classic-kindergarten' ); ?></a>
			<a href="<?php echo esc_url( CLASSIC_KINDERGARTEN_REVIEW ); ?>" target="_blank"><?php esc_html_e( 'Rate This Theme', 'classic-kindergarten' ); ?></a>
			<a href="<?php echo esc_url( CLASSIC_KINDERGARTEN_PRO_DEMO ); ?>" target="_blank"><?php esc_html_e( 'Premium Demo', 'classic-kindergarten' ); ?></a>
			<a href="<?php echo esc_url( CLASSIC_KINDERGARTEN_PREMIUM_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Go To Premium', 'classic-kindergarten' ); ?></a>
		</p>
	</div>
	<hr>
	<div id="getting-started">
		<h3><?php printf( esc_html__( 'Getting started with %s', 'classic-kindergarten' ), 
		esc_html($theme->display( 'Name', 'classic-kindergarten' ))); ?></h3>
		<div class="columns-wrapper clearfix">
			<div class="column column-half clearfix">
				<div class="section">
					<h4><?php esc_html_e( 'Theme Description', 'classic-kindergarten' ); ?></h4>
					<div class="theme-description-1"><?php echo esc_html($theme->display( 'Description' )); ?></div>
				</div>
			</div>
			<div class="column column-half clearfix">
				<img src="<?php echo esc_url( $theme->get_screenshot() ); ?>" />
				<div class="section">
					<h4><?php esc_html_e( 'Theme Options', 'classic-kindergarten' ); ?></h4>
					<p class="about">
					<?php printf( esc_html__( '%s makes use of the Customizer for all theme settings. Click on "Customize Theme" to open the Customizer now.', 'classic-kindergarten' ),esc_html($theme->display( 'Name', 'classic-kindergarten' ))); ?></p>
					<p>
					<a href="<?php echo esc_attr(wp_customize_url()); ?>" class="button button-primary" target="_blank"><?php esc_html_e( 'Customize Theme', 'classic-kindergarten' ); ?></a>
					</p>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div id="theme-author">
	  <p><?php
		printf( esc_html__( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'classic-kindergarten' ),
			esc_html($theme->display( 'Name', 'classic-kindergarten' )),
			'<a target="_blank" href="' . esc_url( 'https://www.theclassictemplates.com/', 'classic-kindergarten' ) . '">classictemplate</a>',
			'<a target="_blank" href="' . esc_url( CLASSIC_KINDERGARTEN_REVIEW ) . '" title="' . esc_attr__( 'Rate it', 'classic-kindergarten' ) . '">' . esc_html_x( 'rate it', 'If you like this theme, rate it', 'classic-kindergarten' ) . '</a>'
		)
		?></p>
	</div>
</div>
<?php
}
