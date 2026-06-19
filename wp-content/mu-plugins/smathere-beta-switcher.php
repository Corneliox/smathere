<?php
/**
 * Plugin Name: SMA There Beta Theme Switcher
 * Description: Dynamically switches the active theme to "sma_there" when ?beta=1 is passed or the beta cookie is present.
 * Version: 1.0.0
 * Author: Antigravity
 */

function smathere_mu_is_beta_mode() {
	if ( isset( $_GET['beta'] ) ) {
		if ( $_GET['beta'] === '1' ) {
			return true;
		} elseif ( $_GET['beta'] === '0' ) {
			return false;
		}
	}
	return isset( $_COOKIE['smathere_beta_preview'] ) && $_COOKIE['smathere_beta_preview'] === '1';
}

if ( smathere_mu_is_beta_mode() ) {
	add_filter( 'template', 'smathere_mu_switch_theme' );
	add_filter( 'stylesheet', 'smathere_mu_switch_theme' );
}

function smathere_mu_switch_theme( $theme ) {
	return 'sma_there';
}
