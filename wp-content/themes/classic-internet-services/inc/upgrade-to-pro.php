<?php
/**
 * Upgrade to pro options
 */
function classic_internet_services_upgrade_pro_options( $wp_customize ) {

	$wp_customize->add_section(
		'upgrade_premium',
		array(
			'title'    => __( 'About Classic Internet Services', 'classic-internet-services' ),
			'priority' => 1,
		)
	);

	class Classic_Internet_Services_Pro_Button_Customize_Control extends WP_Customize_Control {
		public $type = 'upgrade_premium';

		function render_content() {
			?>
			<div class="pro_info">
				<ul>
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( 'https://theclassictemplates.com/wp-themes/internet-service-provider-wordpress-theme/' ); ?>" target="_blank"><i class="dashicons dashicons-cart"></i><?php esc_html_e( 'Upgrade Pro', 'classic-internet-services' ); ?> </a></li>

					<li><a class="free-pro" href="<?php echo esc_url( 'http://theclassictemplates.com/documentation/internet-provider/' ); ?>" target="_blank"><i class="dashicons dashicons-visibility"></i><?php esc_html_e( 'Theme Documentation', 'classic-internet-services' ); ?> </a></li>

					<li><a class="free-pro" href="<?php echo esc_url( 'https://www.theclassictemplates.com/trial/classic-internet-services-pro/' ); ?>" target="_blank"><i class="dashicons dashicons-awards"></i><?php esc_html_e( 'Premium Demo', 'classic-internet-services' ); ?> </a></li>

					<li><a class="support" href="<?php echo esc_url( 'https://wordpress.org/support/theme/classic-internet-services/' ); ?>" target="_blank"><i class="dashicons dashicons-lightbulb"></i><?php esc_html_e( 'Support Forum', 'classic-internet-services' ); ?> </a></li>

					<li><a class="rate-us" href="<?php echo esc_url( 'https://wordpress.org/support/theme/classic-internet-services/reviews/' ); ?>" target="_blank"><i class="dashicons dashicons-star-filled"></i><?php esc_html_e( 'Rate Us', 'classic-internet-services' ); ?> </a></li>
				</ul>
			</div>
			<?php
		}
	}

	$wp_customize->add_setting(
		'pro_info_buttons',
		array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'classic_internet_services_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Classic_Internet_Services_Pro_Button_Customize_Control(
			$wp_customize,
			'pro_info_buttons',
			array(
				'section' => 'upgrade_premium',
			)
		)
	);
}
add_action( 'customize_register', 'classic_internet_services_upgrade_pro_options' );
