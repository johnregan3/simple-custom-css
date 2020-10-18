<?php
/**
 * Front-facing functionality.
 *
 * @package SCCSS
 * @since   2.0.0
 * @author  John Regan <john@johnregan3.com>
 */

// Prevent direct file access.
if ( ! defined( 'SCCSS_FILE' ) ) {
	die();
}

/**
 * Add frontend hooks.
 */
function sccss_add_frontend_hooks() {
	if ( sccss_is_amp_request() ) { // @todo Why not just do this all the time?
		add_action( 'wp_head', 'sccss_print_inline_css' );
	} else {
		add_action( 'wp_enqueue_scripts', 'sccss_register_style', 99 );
	}
}
add_action( 'wp', 'sccss_add_frontend_hooks' );

/**
 * Enqueue link to add CSS through PHP.
 *
 * This is a typical WP Enqueue statement, except that the URL of the stylesheet is simply a query var.
 * This query var is passed to the URL, and when it is detected by scss_maybe_print_css(),
 * it writes its PHP/CSS to the browser.
 *
 * @since  1.0.0
 *
 * @action wp_enqueue_scripts, 99
 */
function sccss_register_style() {
	$url = home_url();

	if ( is_ssl() ) {
		$url = home_url( '/', 'https' );
	}

	// @todo The ver should be set to the timestamp that the CSS was last edited.
	wp_register_style( // phpcs:ignore WordPress.WP.EnqueuedResourceParameters
		'sccss_style',
		add_query_arg(
			array(
				'sccss' => 1,
			),
			$url
		)
	);

	wp_enqueue_style( 'sccss_style' );
}

/**
 * If the query var is set, print the Simple Custom CSS rules.
 *
 * @since  1.0.0
 *
 * @action plugins_loaded
 */
function sccss_maybe_print_css() {

	// Only print CSS if this is a stylesheet request.
	if ( ! isset( $_GET['sccss'] ) || intval( $_GET['sccss'] ) !== 1 ) {  // phpcs:ignore WordPress.Security.NonceVerification
		return;
	}

	ob_start();
	// @todo Send Cache-Control header and ETag header.
	header( 'Content-type: text/css' );

	sccss_the_css();

	die();
}
add_action( 'plugins_loaded', 'sccss_maybe_print_css' );

/**
 * Print inline style element.
 *
 * @see wp_custom_css_cb()
 */
function sccss_print_inline_css() {
	echo '<style id="sccss">';
	sccss_the_css();
	echo '</style>';
}

/**
 * Echo the CSS.
 *
 * @since 4.0.0
 */
function sccss_the_css() {
	$options     = get_option( 'sccss_settings' );
	$raw_content = isset( $options['sccss-content'] ) ? $options['sccss-content'] : '';
	$content     = wp_kses( $raw_content, array( '\'', '\"' ) );
	$content     = str_replace( '&gt;', '>', $content );
	echo strip_tags( $content ); // phpcs:ignore WordPress.Security.EscapeOutput
}

/**
 * Determine whether an AMP page is being requested.
 *
 * @return bool
 */
function sccss_is_amp_request() {
	return (
		( function_exists( 'amp_is_request' ) && amp_is_request() )
		||
		( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() )
	);
}
