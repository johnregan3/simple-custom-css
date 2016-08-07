<?php
/**
 * Frontend functionality.
 *
 * @package SimpleCustomCSS
 */

namespace SimpleCustomCSS;

// Prevent direct file access.
if ( ! defined( 'SCCSS_FILE' ) ) {
	die();
}

/**
 * Class Front
 *
 * @package SimpleCustomCSS
 */
class Front {

	/**
	 * The class instance.
	 *
	 * @var object
	 */
	public static $instance;

	/**
	 * Get the instance.
	 *
	 * @return AMP|object
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Front constructor
	 */
	function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'register_style' ), 99 );
		add_action( 'plugins_loaded', array( $this, 'maybe_print_css' ) );
	}

	/**
	 * Enqueue link to add CSS through PHP.
	 *
	 * This is a typical WP Enqueue statement, except that the URL of the stylesheet is simply a query var.
	 * This query var is passed to the URL, and when it is detected by scss_maybe_print_css(),
	 * it writes its PHP/CSS to the browser.
	 */
	public function register_style() {
		$url = home_url();

		if ( is_ssl() ) {
			$url = home_url( '/', 'https' );
		}

		wp_register_style( 'sccss_style', add_query_arg( array( 'sccss' => 1 ), $url ) );

		wp_enqueue_style( 'sccss_style' );
	}


	/**
	 * If the query var is set, print the Simple Custom CSS rules.
	 */
	public function maybe_print_css() {

		// Only print CSS if this is a stylesheet request.
		if ( ! isset( $_GET['sccss'] ) || 1 !== intval( $_GET['sccss'] ) ) {
			return;
		}

		ob_start();
		header( 'Content-type: text/css' );
		$options     = get_option( Admin::OPTION );
		$raw_content = isset( $options[ Admin::SETTING_CONTENT ] ) ? $options[ Admin::SETTING_CONTENT ] : '';
		echo wp_kses( $raw_content, array( '\'', '\"', '>', '<', '+' ) );
		die();
	}
}

$sccss_public = Front::get_instance();
