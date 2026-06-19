<?php
/*
 * @package Car Service
 */

function car_service_admin_enqueue_scripts() {
	wp_enqueue_style( 'car-service-admin-style', esc_url( get_template_directory_uri() ).'/css/addon.css' );
}
add_action( 'admin_enqueue_scripts', 'car_service_admin_enqueue_scripts' );

add_action('after_switch_theme', 'car_service_options');

function car_service_options () {
	global $pagenow;
	if( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) && current_user_can( 'manage_options' ) ) {
		wp_redirect( admin_url( 'themes.php?page=car-service' ) );
		exit;
	}
}

function car_service_theme_info_menu_link() {

	$theme = wp_get_theme();
	add_theme_page(
		sprintf( esc_html__( 'Welcome to %1$s %2$s', 'car-service' ), $theme->display( 'Name' ), $theme->display( 'Version' ) ),
		esc_html__( 'Theme Info', 'car-service' ),'edit_theme_options','car-service','car_service_theme_info_page'
	);
}
add_action( 'admin_menu', 'car_service_theme_info_menu_link' );

function car_service_theme_info_page() {

	$theme = wp_get_theme();
	?>
<div class="wrap theme-info-wrap">
	<h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'car-service' ), esc_html($theme->display( 'Name', 'car-service'  )),esc_html($theme->display( 'Version', 'car-service' ))); ?>
	</h1>
	<p class="theme-description">
	<?php esc_html_e( 'Do you want to configure this theme? Look no further, our easy-to-follow theme documentation will walk you through it.', 'car-service' ); ?>
	</p>
	<hr>
	<div class="important-links clearfix">
		<p><strong><?php esc_html_e( 'Theme Links', 'car-service' ); ?>:</strong>
			<a href="<?php echo esc_url( CAR_SERVICE_THEME_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Theme Page', 'car-service' ); ?></a>
			<a href="<?php echo esc_url( CAR_SERVICE_SUPPORT ); ?>" target="_blank"><?php esc_html_e( 'Contact Us', 'car-service' ); ?></a>
			<a href="<?php echo esc_url( CAR_SERVICE_REVIEW ); ?>" target="_blank"><?php esc_html_e( 'Rate This Theme', 'car-service' ); ?></a>
			<a href="<?php echo esc_url( CAR_SERVICE_PRO_DEMO ); ?>" target="_blank"><?php esc_html_e( 'Premium Demo', 'car-service' ); ?></a>
			<a href="<?php echo esc_url( CAR_SERVICE_PREMIUM_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Go To Premium', 'car-service' ); ?></a>
		</p>
	</div>
	<hr>
	<div id="getting-started">
		<h3><?php printf( esc_html__( 'Getting started with %s', 'car-service' ), 
		esc_html($theme->display( 'Name', 'car-service' ))); ?></h3>
		<div class="columns-wrapper clearfix">
			<div class="column column-half clearfix">
				<div class="section">
					<h4><?php esc_html_e( 'Theme Description', 'car-service' ); ?></h4>
					<div class="theme-description-1"><?php echo esc_html($theme->display( 'Description' )); ?></div>
				</div>
			</div>
			<div class="column column-half clearfix">
				<img src="<?php echo esc_url( $theme->get_screenshot() ); ?>" alt="" />
				<div class="section">
					<h4><?php esc_html_e( 'Theme Options', 'car-service' ); ?></h4>
					<p class="about">
					<?php printf( esc_html__( '%s makes use of the Customizer for all theme settings. Click on "Customize Theme" to open the Customizer now.', 'car-service' ),esc_html($theme->display( 'Name', 'car-service' ))); ?></p>
					<p>
					<a href="<?php echo esc_attr(wp_customize_url()); ?>" class="button button-primary" target="_blank"><?php esc_html_e( 'Customize Theme', 'car-service' ); ?></a>
					<a href="<?php echo esc_url( CAR_SERVICE_PREMIUM_PAGE ); ?>" target="_blank" class="button button-secondary premium-btn"><?php esc_html_e( 'Checkout Premium', 'car-service' ); ?></a></p>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div id="theme-author">
	  <p><?php
		printf( esc_html__( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'car-service' ),
			esc_html($theme->display( 'Name', 'car-service' )),
			'<a target="_blank" href="' . esc_url( 'https://www.theclassictemplates.com/', 'car-service' ) . '">classictemplate</a>',
			'<a target="_blank" href="' . esc_url( CAR_SERVICE_REVIEW ) . '" title="' . esc_attr__( 'Rate it', 'car-service' ) . '">' . esc_html_x( 'rate it', 'If you like this theme, rate it', 'car-service' ) . '</a>'
		)
		?></p>
	</div>
</div>
<?php
}
