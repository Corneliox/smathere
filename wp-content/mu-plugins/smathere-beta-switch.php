<?php
/**
 * Plugin Name: SMA Theresiana Beta Theme Switcher
 * Description: Activates sma_theresiana theme for beta preview via cookie.
 *              Visit ?beta=1 to enable, ?beta=0 to disable.
 * Version: 2.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

// ── 1. Helper: detect beta mode ───────────────────────────────────────────────
if ( ! function_exists( 'smathere_beta_active' ) ) {
	function smathere_beta_active() {
		return isset( $_COOKIE['smathere_beta_preview'] )
			&& $_COOKIE['smathere_beta_preview'] === '1';
	}
}
if ( ! function_exists( 'smathere_is_beta_mode' ) ) {
	function smathere_is_beta_mode() { return smathere_beta_active(); }
}

// ── 2. Switch theme template/stylesheet when cookie is active ─────────────────
add_filter( 'template',   function( $t ) { return smathere_beta_active() ? 'sma_theresiana' : $t; }, 1 );
add_filter( 'stylesheet', function( $s ) { return smathere_beta_active() ? 'sma_theresiana' : $s; }, 1 );

// ── 3. Set / clear beta cookie when ?beta=1 or ?beta=0 is in the URL ─────────
//      Runs on `init` (early priority 1) and redirects to strip the query arg.
add_action( 'init', function() {
	if ( ! isset( $_GET['beta'] ) ) {
		return;
	}

	$val = sanitize_text_field( wp_unslash( $_GET['beta'] ) );

	if ( $val === '1' ) {
		// Set cookie for 7 days.
		setcookie(
			'smathere_beta_preview',
			'1',
			time() + 7 * DAY_IN_SECONDS,
			defined( 'COOKIEPATH' ) ? COOKIEPATH : '/',
			defined( 'COOKIE_DOMAIN' ) ? COOKIE_DOMAIN : ''
		);
		// Make the cookie available to the CURRENT request as well.
		$_COOKIE['smathere_beta_preview'] = '1';

	} elseif ( $val === '0' ) {
		// Clear cookie.
		setcookie(
			'smathere_beta_preview',
			'',
			time() - HOUR_IN_SECONDS,
			defined( 'COOKIEPATH' ) ? COOKIEPATH : '/',
			defined( 'COOKIE_DOMAIN' ) ? COOKIE_DOMAIN : ''
		);
		unset( $_COOKIE['smathere_beta_preview'] );
	}

	// Redirect to the same URL without the ?beta param.
	wp_safe_redirect( esc_url_raw( remove_query_arg( 'beta' ) ) );
	exit;
}, 1 );

// ── 4. Theme-mods bridge: expose live-theme Customizer data inside beta theme ─
//      Without this, get_theme_mod('onepress_*') returns empty because
//      those settings are stored under the live theme slug, not 'sma_theresiana'.
add_filter( 'option_theme_mods_sma_theresiana', function( $beta_mods ) {
	if ( ! smathere_beta_active() ) {
		return $beta_mods;
	}

	// get_option('template') returns the RAW stored value (the live theme slug),
	// unaffected by our 'template' filter above.
	$live_slug = get_option( 'template' );

	if ( ! $live_slug || $live_slug === 'sma_theresiana' ) {
		return $beta_mods;
	}

	$live_mods = get_option( 'theme_mods_' . $live_slug, array() );

	if ( ! is_array( $live_mods ) ) {
		return $beta_mods;
	}

	if ( ! is_array( $beta_mods ) ) {
		$beta_mods = array();
	}

	// Merge: live-theme values as base, beta-specific overrides on top.
	return array_merge( $live_mods, $beta_mods );
}, 10 );

// ── 5. Floating exit-beta widget ──────────────────────────────────────────────
add_action( 'wp_footer', function() {
	if ( ! smathere_beta_active() ) {
		return;
	}
	$exit_url = esc_url( add_query_arg( 'beta', '0', home_url( '/' ) ) );
	echo '<a href="' . $exit_url . '" class="exit-beta-widget" title="Kembali ke tampilan live">'
		. '<i class="fa fa-eye-slash" aria-hidden="true"></i> Exit Beta'
		. '</a>';
} );
