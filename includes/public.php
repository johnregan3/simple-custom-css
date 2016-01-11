<?php

// Prevent direct file access
if( ! defined( 'SCCSS_FILE' ) ) {
	die();
}

/**
 * Enqueue link to add CSS through PHP.
 *
 * This is a typical WP Enqueue statement, except that the URL of the stylesheet is simply a query var.
 * This query var is passed to the URL, and when it is detected by scss_maybe_print_css(),
 * it writes its PHP/CSS to the browser.
 */
function sccss_register_style() {
	$url = home_url();

	if ( is_ssl() ) {
		$url = home_url( '/', 'https' );
	}

	wp_register_style( 'sccss_style', add_query_arg( array( 'sccss' => 1 ), $url ) );

	wp_enqueue_style( 'sccss_style' );
}
add_action( 'wp_enqueue_scripts', 'sccss_register_style', 99 );

/**
 * If the query var is set, print the Simple Custom CSS rules.
 */
function sccss_maybe_print_css() {

	// Only print CSS if this is a stylesheet request
	if( ! isset( $_GET['sccss'] ) || intval( $_GET['sccss'] ) !== 1 ) {
		return;
	}

	ob_start();
	header( 'Content-type: text/css' );
	$options     = get_option( 'sccss_settings' );
	$raw_content = isset( $options['sccss-content'] ) ? $options['sccss-content'] : '';
	$content     = wp_kses( $raw_content, array( '\'', '\"' ) );
	$content     = str_replace( '&gt;', '>', $content );
	echo $content; //xss okay
	die();
}

add_action( 'plugins_loaded', 'sccss_maybe_print_css' );
