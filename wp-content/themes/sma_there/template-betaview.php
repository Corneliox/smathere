<?php
/**
 * Template Name: Beta View Router
 *
 * Digunakan untuk mengaktifkan atau menonaktifkan mode preview beta kustom.
 */

if ( isset( $_GET['beta'] ) && $_GET['beta'] === '0' ) {
	// Hapus cookie
	setcookie( 'smathere_beta_preview', '', time() - 3600, '/' );
	// Alihkan ke homepage normal
	wp_safe_redirect( home_url( '/' ) );
	exit;
} else {
	// Setel cookie selama 7 hari
	setcookie( 'smathere_beta_preview', '1', time() + ( 86400 * 7 ), '/' );
	// Alihkan ke homepage mode beta
	wp_safe_redirect( home_url( '/' ) );
	exit;
}
