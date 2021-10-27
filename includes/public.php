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
 * Print inline style element.
 *
 * @since 4.0.5
 */
function sccss_print_inline_css() {
	echo '<style id="sccss">';
	sccss_the_css();
	echo '</style>';
}
add_action( 'wp_head', 'sccss_print_inline_css', 101 );

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
