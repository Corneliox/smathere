<?php
/**
 * Plugin Name: SMA Theresiana Beta Theme Switcher
 * Description: Activates sma_theresiana theme ONLY when ?beta=1 is present in
 *              the URL. No cookies — the live site is never affected.
 * Version: 3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

// ── 1. Helper: beta is active ONLY when ?beta=1 is in the current URL ─────────
if ( ! function_exists( 'smathere_beta_active' ) ) {
	function smathere_beta_active() {
		return isset( $_GET['beta'] ) && $_GET['beta'] === '1';
	}
}
if ( ! function_exists( 'smathere_is_beta_mode' ) ) {
	function smathere_is_beta_mode() { return smathere_beta_active(); }
}

// ── 2. Switch theme ONLY when ?beta=1 is present ──────────────────────────────
//      When ?beta=1 is NOT in the URL this code does nothing — the live site
//      remains completely unchanged.
add_filter( 'template',   function( $t ) { return smathere_beta_active() ? 'sma_theresiana' : $t; }, 1 );
add_filter( 'stylesheet', function( $s ) { return smathere_beta_active() ? 'sma_theresiana' : $s; }, 1 );

// ── 3. Theme-mods bridge: expose live-theme Customizer data in beta ───────────
//      get_theme_mod('onepress_*') reads from theme_mods_{active_theme}.
//      When beta theme is active, we merge the live theme's mods so that
//      hero images, about text, etc. all appear correctly.
add_filter( 'option_theme_mods_sma_theresiana', function( $beta_mods ) {
	if ( ! smathere_beta_active() ) {
		return $beta_mods;
	}

	// get_option('template') returns the RAW stored live theme slug.
	$live_slug = get_option( 'template' );
	if ( ! $live_slug || $live_slug === 'sma_theresiana' ) {
		return $beta_mods;
	}

	$live_mods = get_option( 'theme_mods_' . $live_slug, array() );
	if ( ! is_array( $live_mods ) ) return $beta_mods;
	if ( ! is_array( $beta_mods ) ) $beta_mods = array();

	return array_merge( $live_mods, $beta_mods );
}, 10 );

// ── 4. Floating exit-beta button ──────────────────────────────────────────────
add_action( 'wp_footer', function() {
	if ( ! smathere_beta_active() ) return;
	// Links back to the same page WITHOUT ?beta=1
	$exit_url = esc_url( remove_query_arg( 'beta' ) );
	echo '<a href="' . $exit_url . '" class="exit-beta-widget">'
		. '<i class="fa fa-eye-slash" aria-hidden="true"></i> Exit Beta'
		. '</a>';
} );
