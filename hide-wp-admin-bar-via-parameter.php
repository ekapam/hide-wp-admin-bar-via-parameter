<?php
/**
Plugin Name: Hide WP Admin Bar via parameter
Plugin URI: https://github.com/ekapam/hide-wp-admin-bar-via-parameter
Description: A simple plugin to hide the WP admin bar with a URL parameter.
Version: 1.0
Author: Ricardo Ambriz
Author URI: https://ricardoambriz.com
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Text Domain: hide-wp-admin-bar-via-parameter
Requires PHP: 7.3
Requires at least: 6.0
Tested up to: 6.7

@package category: WordPress
 */

if ( ! defined( 'WPINC' ) || ! defined( 'ABSPATH' ) ) {
	die( 'Direct access not allowed' );
}

/**
 * Gets the value of the hide parameter from the URL.
 *
 * @param int $hide The default value to return if the parameter doesn't exist.
 *
 * @return int|null The value of the hide parameter or null if it doesn't exist.
 */
function get_hide_param( $hide = 1 ) {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	if ( isset( $_GET['hide'] ) ) {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$value = sanitize_text_field( wp_unslash( $_GET['hide'] ) );

		if ( '' === $value || null === $value ) {
			return $hide;
		}

		if ( is_numeric( $value ) ) {
			return (int) $value;
		}
	}

	return null;
}

/**
 * Sets a cookie to hide the WP Dashboard bar for the given number of minutes.
 *
 * @param int $value The number of minutes to hide the bar for.
 */
function set_hide_cookie( $value ) {
	$expiration = time() + ( (int) $value * 60 );

	$secure   = false;
	$httponly = true;
	$samesite = 'Strict';

	// PHP >= 7.3.
	setcookie(
		'hide',
		$value,
		array(
			'expires'  => $expiration,
			'path'     => '/',
			'secure'   => $secure,
			'httponly' => $httponly,
			'samesite' => $samesite,
		)
	);
}

/**
 * Determines whether the WP Dashboard bar should be hidden.
 *
 * @param mixed $param The parameter value indicating hide preference.
 * @param mixed $cookie The cookie value indicating hide preference.
 *
 * @return bool True if the bar should be hidden, false otherwise.
 */
function should_hide_bar( $param, $cookie ) {
	if ( is_numeric( $param ) ) {
		set_hide_cookie( $param );
		return true;
	}

	if ( is_numeric( $cookie ) ) {
		return true;
	}

	return false;
}

/**
 * Applies a filter to control the visibility of the WP Admin Bar.
 *
 * @param bool $should_hide Determines if the admin bar should be hidden.
 *                          True to hide the admin bar, false to show it.
 */
function apply_admin_bar_visibility( $should_hide ) {
	$filter = $should_hide ? '__return_false' : '__return_true';
	add_filter( 'show_admin_bar', $filter );
}

/**
 * Checks for the presence of a URL parameter indicating whether or not to display the Admin Bar.
 *
 * The function first retrieves the value of the URL parameter. If a value is present, it is used to set a cookie.
 * The cookie value is then used to determine whether or not to display the Admin Bar.
 *
 * @since 1.0
 */
function check_url_param() {
	$param      = get_hide_param();
	$cookie_raw = wp_unslash( isset( $_COOKIE['hide'] ) ) ?? null;
	$cookie     = $cookie_raw ? sanitize_text_field( wp_unslash( $cookie_raw ) ) : null;

	$should_hide = should_hide_bar( $param, $cookie );

	apply_admin_bar_visibility( $should_hide );
}

add_action( 'init', 'check_url_param' );
