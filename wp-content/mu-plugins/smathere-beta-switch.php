<?php
/**
 * Plugin Name: SMA Theresiana Beta Theme Switcher
 * Description: Switches to sma_theresiana theme when beta preview cookie is active.
 * Version: 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Returns true if the beta preview cookie is set and equals '1'.
 *
 * @return bool
 */
function smathere_beta_active() {
    return isset( $_COOKIE['smathere_beta_preview'] ) && $_COOKIE['smathere_beta_preview'] === '1';
}

/**
 * Alias kept for backward-compatible calls in other files.
 *
 * @return bool
 */
function smathere_is_beta_mode() {
    return smathere_beta_active();
}

add_filter( 'template',   function( $t ) { return smathere_beta_active() ? 'sma_theresiana' : $t; }, 1 );
add_filter( 'stylesheet', function( $s ) { return smathere_beta_active() ? 'sma_theresiana' : $s; }, 1 );
