<?php
/*
 * @package Classic Internet Services
 */

function classic_internet_services_admin_enqueue_scripts() {
	wp_enqueue_style( 'classic-internet-services-admin-style', esc_url( get_template_directory_uri() ).'/css/addon.css' );
}
add_action( 'admin_enqueue_scripts', 'classic_internet_services_admin_enqueue_scripts' );

add_action('after_switch_theme', 'classic_internet_services_options');

function classic_internet_services_options () {
	global $pagenow;
	if( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) && current_user_can( 'manage_options' ) ) {
		wp_redirect( admin_url( 'themes.php?page=classic-internet-services' ) );
		exit;
	}
}

if ( ! defined( 'CLASSIC_INTERNET_SERVICES_SUPPORT' ) ) {
define('CLASSIC_INTERNET_SERVICES_SUPPORT',__('https://wordpress.org/support/theme/classic-internet-services/','classic-internet-services'));
}
if ( ! defined( 'CLASSIC_INTERNET_SERVICES_REVIEW' ) ) {
define('CLASSIC_INTERNET_SERVICES_REVIEW',__('https://wordpress.org/support/theme/classic-internet-services/reviews/#new-post','classic-internet-services'));
}
if ( ! defined( 'CLASSIC_INTERNET_SERVICES_PRO_DEMO' ) ) {
define('CLASSIC_INTERNET_SERVICES_PRO_DEMO',__('https://www.theclassictemplates.com/trial/classic-internet-services-pro/','classic-internet-services'));
}
if ( ! defined( 'CLASSIC_INTERNET_SERVICES_THEME_PAGE' ) ) {
define('CLASSIC_INTERNET_SERVICES_THEME_PAGE',__('https://www.theclassictemplates.com/themes/','classic-internet-services'));
}
if ( ! defined( 'CLASSIC_INTERNET_SERVICES_PREMIUM_PAGE' ) ) {
define('CLASSIC_INTERNET_SERVICES_PREMIUM_PAGE',__('https://www.theclassictemplates.com/wp-themes/internet-service-provider-wordpress-theme/','classic-internet-services'));
}
// Footer Link
define('CLASSIC_INTERNET_SERVICES_FOOTER_LINK',__('https://www.theclassictemplates.com/themes/free-internet-provider-wordpress-theme/','classic-internet-services'));

function classic_internet_services_theme_info_menu_link() {

	$classic_internet_services_theme = wp_get_theme();
	add_theme_page(
		sprintf( esc_html__( 'Welcome to %1$s %2$s', 'classic-internet-services' ), $classic_internet_services_theme->display( 'Name' ), $classic_internet_services_theme->display( 'Version' ) ),
		esc_html__( 'Theme Info', 'classic-internet-services' ),'edit_theme_options','classic-internet-services','classic_internet_services_theme_info_page'
	);
}
add_action( 'admin_menu', 'classic_internet_services_theme_info_menu_link' );

function classic_internet_services_theme_info_page() {

	$classic_internet_services_theme = wp_get_theme();
	?>
<div class="wrap theme-info-wrap">
	<h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'classic-internet-services' ), esc_html($classic_internet_services_theme->display( 'Name', 'classic-internet-services'  )),esc_html($classic_internet_services_theme->display( 'Version', 'classic-internet-services' ))); ?>
	</h1>
	<p class="theme-description">
	<?php esc_html_e( 'Do you want to configure this theme? Look no further, our easy-to-follow theme documentation will walk you through it.', 'classic-internet-services' ); ?>
	</p>
	<hr>
	<div class="important-links clearfix">
		<p><strong><?php esc_html_e( 'Theme Links', 'classic-internet-services' ); ?>:</strong>
			<a href="<?php echo esc_url( CLASSIC_INTERNET_SERVICES_THEME_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Theme Page', 'classic-internet-services' ); ?></a>
			<a href="<?php echo esc_url( CLASSIC_INTERNET_SERVICES_SUPPORT ); ?>" target="_blank"><?php esc_html_e( 'Contact Us', 'classic-internet-services' ); ?></a>
			<a href="<?php echo esc_url( CLASSIC_INTERNET_SERVICES_REVIEW ); ?>" target="_blank"><?php esc_html_e( 'Rate This Theme', 'classic-internet-services' ); ?></a>
			<a href="<?php echo esc_url( CLASSIC_INTERNET_SERVICES_PRO_DEMO ); ?>" target="_blank"><?php esc_html_e( 'Premium Demo', 'classic-internet-services' ); ?></a>
			<a href="<?php echo esc_url( CLASSIC_INTERNET_SERVICES_PREMIUM_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Go To Premium', 'classic-internet-services' ); ?></a>
		</p>
	</div>
	<hr>
	<div id="getting-started">
		<h3><?php printf( esc_html__( 'Getting started with %s', 'classic-internet-services' ),
		esc_html($classic_internet_services_theme->display( 'Name', 'classic-internet-services' ))); ?></h3>
		<div class="columns-wrapper clearfix">
			<div class="column column-half clearfix">
				<div class="section">
					<h4><?php esc_html_e( 'Theme Description', 'classic-internet-services' ); ?></h4>
					<div class="theme-description-1"><?php echo esc_html($classic_internet_services_theme->display( 'Description' )); ?></div>
				</div>
			</div>
			<div class="column column-half clearfix">
				<img src="<?php echo esc_url( $classic_internet_services_theme->get_screenshot() ); ?>" alt="" />
				<div class="section">
					<h4><?php esc_html_e( 'Theme Options', 'classic-internet-services' ); ?></h4>
					<p class="about">
					<?php printf( esc_html__( '%s makes use of the Customizer for all theme settings. Click on "Customize Theme" to open the Customizer now.', 'classic-internet-services' ),esc_html($classic_internet_services_theme->display( 'Name', 'classic-internet-services' ))); ?></p>
					<p>
					<a target="_blank" href="<?php echo esc_url( wp_customize_url() ); ?>" class="button button-primary"><?php esc_html_e( 'Customize Theme', 'classic-internet-services' ); ?></a>
					<a href="<?php echo esc_url( CLASSIC_INTERNET_SERVICES_PREMIUM_PAGE ); ?>" target="_blank" class="button button-secondary premium-btn"><?php esc_html_e( 'Checkout Premium', 'classic-internet-services' ); ?></a></p>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div id="theme-author">
	  <p><?php
		printf( esc_html__( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'classic-internet-services' ),
			esc_html($classic_internet_services_theme->display( 'Name', 'classic-internet-services' )),
			'<a target="_blank" href="' . esc_url( 'https://www.theclassictemplates.com/', 'classic-internet-services' ) . '">classictemplate</a>',
			'<a target="_blank" href="' . esc_url( CLASSIC_INTERNET_SERVICES_REVIEW ) . '" title="' . esc_attr__( 'Rate it', 'classic-internet-services' ) . '">' . esc_html_x( 'rate it', 'If you like this theme, rate it', 'classic-internet-services' ) . '</a>'
		)
		?></p>
	</div>
</div>
<?php
}
