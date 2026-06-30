<?php
/**
 * Plugin Name: SMA Theresiana 2018 Theme Switcher
 * Description: Activates ashe theme ONLY when ?2018 is present in
 *              the URL. No cookies — the live site is never affected.
 * Version: 4.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

// ── 1. Helper: 2018 is active ONLY when ?2018 is in the current URL ─────────
if ( ! function_exists( 'smathere_2018_active' ) ) {
	function smathere_2018_active() {
		return isset( $_GET['2018'] );
	}
}

// ── 2. Switch theme ONLY when ?2018 is present ──────────────────────────────
//      When ?2018 is NOT in the URL this code does nothing — the live site
//      remains completely unchanged.
add_filter( 'template',   function( $t ) { return smathere_2018_active() ? 'ashe' : $t; }, 1 );
add_filter( 'stylesheet', function( $s ) { return smathere_2018_active() ? 'ashe' : $s; }, 1 );

// ── 3. Floating exit-2018 button ──────────────────────────────────────────────
add_action( 'wp_footer', function() {
	if ( ! smathere_2018_active() ) return;
	// Links back to the same page WITHOUT ?2018
	$exit_url = esc_url( remove_query_arg( '2018' ) );
	echo '<a href="' . $exit_url . '" class="exit-beta-widget" style="position:fixed;bottom:20px;right:20px;background:#333;color:#fff;padding:10px 15px;border-radius:5px;z-index:999999;text-decoration:none;">'
		. '<i class="fa fa-eye-slash" aria-hidden="true"></i> Exit 2018 View'
		. '</a>';
} );
