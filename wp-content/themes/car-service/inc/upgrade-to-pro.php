<?php
/**
 * Upgrade to pro options
 */
function car_service_upgrade_pro_options( $wp_customize ) {

	$wp_customize->add_section(
		'upgrade_premium',
		array(
			'title'    => esc_html( CAR_SERVICE_PRO_NAME ),
			'pro_text' => esc_html__( 'About Car Service','car-service'),
			'priority' => 1,
		)
	);

	class Car_Service_Pro_Button_Customize_Control extends WP_Customize_Control {
		public $type = 'upgrade_premium';

		function render_content() {
			?>
			<div class="pro_info">
				<ul>
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( CAR_SERVICE_THEME_PAGE ); ?>" target="_blank"><i class="dashicons dashicons-admin-appearance"></i><?php esc_html_e( 'Theme Page', 'car-service' ); ?> </a></li>

					<li><a class="support" href="<?php echo esc_url( CAR_SERVICE_SUPPORT ); ?>' ); ?>" target="_blank"><i class="dashicons dashicons-lightbulb"></i><?php esc_html_e( 'Support Forum', 'car-service' ); ?> </a></li>

					<li><a class="rate-us" href="<?php echo esc_url( CAR_SERVICE_REVIEW ); ?>' ); ?>" target="_blank"><i class="dashicons dashicons-star-filled"></i><?php esc_html_e( 'Rate Us', 'car-service' ); ?> </a></li>

					<li><a class="free-pro" href="<?php echo esc_url( CAR_SERVICE_PRO_DEMO ); ?>' ); ?>" target="_blank"><i class="dashicons dashicons-awards"></i><?php esc_html_e( 'Premium Demo', 'car-service' ); ?> </a></li>

					<li><a class="upgrade-to-pro" href="<?php echo esc_url( CAR_SERVICE_PREMIUM_PAGE ); ?>" target="_blank"><i class="dashicons dashicons-cart"></i><?php esc_html_e( 'Upgrade Pro', 'car-service' ); ?> </a></li>

					<li><a class="free-pro" href="<?php echo esc_url( CAR_SERVICE_THEME_DOCUMENTATION ); ?>' ); ?>" target="_blank"><i class="dashicons dashicons-visibility"></i><?php esc_html_e( 'Theme Documentation', 'car-service' ); ?> </a></li>
				</ul>
			</div>
			<?php
		}
	}

	$wp_customize->add_setting(
		'pro_info_buttons',
		array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'car_service_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Car_Service_Pro_Button_Customize_Control(
			$wp_customize,
			'pro_info_buttons',
			array(
				'section' => 'upgrade_premium',
			)
		)
	);
}
add_action( 'customize_register', 'car_service_upgrade_pro_options' );
