<?php
/**
 * SMA Theresiana Theme Customizer
 *
 * @package sma_theresiana
 */

function sma_theresiana_customize_register( $wp_customize ) {

	// =========================================================
	// 1. HERO SECTION
	// =========================================================
	$wp_customize->add_section( 'th_hero_section', [
		'title'       => __( 'Hero Banner', 'sma-theresiana' ),
		'priority'    => 120,
		'description' => __( 'Customize the hero section background image.', 'sma-theresiana' ),
	] );

	// -- Hero Background Image --
	$wp_customize->add_setting( 'Hero_Background_Image', [
		'default'           => home_url('/wp-content/uploads/2025/07/24132023_1229465257154162_6232500862772732835_o-960x540.jpg'),
		'sanitize_callback' => 'esc_url_raw',
	] );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'Hero_Background_Image', [
		'label'    => __( 'Hero Background Image', 'sma-theresiana' ),
		'section'  => 'th_hero_section',
		'settings' => 'Hero_Background_Image',
	] ) );

	// =========================================================
	// 2. FOOTER SECTION
	// =========================================================
	$wp_customize->add_section( 'th_footer_section', [
		'title'       => __( 'Footer Settings', 'sma-theresiana' ),
		'priority'    => 130,
		'description' => __( 'Customize the logos, QR codes, and contact info in the footer.', 'sma-theresiana' ),
	] );

	// -- Akreditasi Logo --
	$wp_customize->add_setting( 'th_footer_akreditasi_logo', [
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	] );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'th_footer_akreditasi_logo', [
		'label'    => __( 'Akreditasi Logo', 'sma-theresiana' ),
		'section'  => 'th_footer_section',
		'settings' => 'th_footer_akreditasi_logo',
	] ) );

	// -- Unika Logo --
	$wp_customize->add_setting( 'th_footer_unika_logo', [
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	] );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'th_footer_unika_logo', [
		'label'    => __( 'Unika Soegijapranata Logo', 'sma-theresiana' ),
		'section'  => 'th_footer_section',
		'settings' => 'th_footer_unika_logo',
	] ) );

	// -- QR Code Instagram --
	$wp_customize->add_setting( 'th_footer_qr_instagram', [
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	] );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'th_footer_qr_instagram', [
		'label'    => __( 'QR Code Instagram', 'sma-theresiana' ),
		'section'  => 'th_footer_section',
		'settings' => 'th_footer_qr_instagram',
	] ) );

	// -- QR Code PPDB --
	$wp_customize->add_setting( 'th_footer_qr_ppdb', [
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	] );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'th_footer_qr_ppdb', [
		'label'    => __( 'QR Code PPDB', 'sma-theresiana' ),
		'section'  => 'th_footer_section',
		'settings' => 'th_footer_qr_ppdb',
	] ) );

	// -- QR Code Pengaduan --
	$wp_customize->add_setting( 'th_footer_qr_pengaduan', [
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	] );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'th_footer_qr_pengaduan', [
		'label'    => __( 'QR Code Pengaduan', 'sma-theresiana' ),
		'section'  => 'th_footer_section',
		'settings' => 'th_footer_qr_pengaduan',
	] ) );

	// -- Contact Address --
	$wp_customize->add_setting( 'th_footer_address', [
		'default'           => 'Jl. Mayjend. Sutoyo No.69 Semarang, Jawa Tengah, Indonesia 50244',
		'sanitize_callback' => 'sanitize_textarea_field',
	] );
	$wp_customize->add_control( 'th_footer_address', [
		'label'    => __( 'Alamat Lengkap', 'sma-theresiana' ),
		'section'  => 'th_footer_section',
		'type'     => 'textarea',
	] );

	// -- Contact Phone --
	$wp_customize->add_setting( 'th_footer_phone', [
		'default'           => '(024) 8313374',
		'sanitize_callback' => 'sanitize_text_field',
	] );
	$wp_customize->add_control( 'th_footer_phone', [
		'label'    => __( 'Nomor Telepon', 'sma-theresiana' ),
		'section'  => 'th_footer_section',
		'type'     => 'text',
	] );

	// -- Contact Email --
	$wp_customize->add_setting( 'th_footer_email', [
		'default'           => 'admin@smatheresiana1.sch.id',
		'sanitize_callback' => 'sanitize_email',
	] );
	$wp_customize->add_control( 'th_footer_email', [
		'label'    => __( 'Email Sekolah', 'sma-theresiana' ),
		'section'  => 'th_footer_section',
		'type'     => 'email',
	] );

	// =========================================================
	// 3. COLOR PALETTE SECTION
	// =========================================================
	$wp_customize->add_section( 'th_colors_section', [
		'title'       => __( 'Theme Colors', 'sma-theresiana' ),
		'priority'    => 140,
		'description' => __( 'Choose the color palette for the theme.', 'sma-theresiana' ),
	] );

	// -- Theme Palette --
	$wp_customize->add_setting( 'th_color_palette', [
		'default'           => 'default',
		'sanitize_callback' => 'sanitize_text_field',
	] );
	
	$wp_customize->add_control( 'th_color_palette', [
		'label'    => __( 'Choose Theme Color Palette', 'sma-theresiana' ),
		'section'  => 'th_colors_section',
		'type'     => 'radio',
		'choices'  => [
			'default' => 'Default (Olive Green)',
			'teal'    => 'Teal (Blue-Green)',
			'emerald' => 'Emerald (Forest Green)',
		],
	] );

}
add_action( 'customize_register', 'sma_theresiana_customize_register' );
