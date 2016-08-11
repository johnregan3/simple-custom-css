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
	 * Allowed HTML for wp_kses()
	 *
	 * @var array
	 */
	public $allowed_html = array( '\'', '\"', '>', '<', '+' );

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
	 *
	 * @since 3.5
	 */
	function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'register_style' ), 99 );
		add_action( 'wp_head', array( $this, 'preview_styles' ), 99 );
		add_action( 'plugins_loaded', array( $this, 'maybe_print_css' ) );
	}

	/**
	 * Enqueue link to add CSS through PHP
	 *
	 * This is a typical WP Enqueue statement, except that the URL of the stylesheet is simply a query var.
	 * This query var is passed to the URL, and when it is detected by sccss_maybe_print_css(),
	 * it writes its PHP/CSS to the browser.
	 *
	 * Note that this method is not used in the Customizer Preview Pane.
	 *
	 * @see self::preview_styles()
	 *
	 * @since 3.2
	 */
	public function register_style() {

		// Do not load in the customizer.
		if ( is_customize_preview() ) {
			return;
		}
		$url = home_url();

		if ( is_ssl() ) {
			$url = home_url( '/', 'https' );
		}

		wp_register_style( 'sccss_style', add_query_arg( array( 'sccss' => 1 ), $url ) );

		wp_enqueue_style( 'sccss_style' );
	}


	/**
	 * If the query var is set, print the Simple Custom CSS rules
	 *
	 * @since 3.2
	 */
	public function maybe_print_css() {

		// Only print CSS if this is a stylesheet request.
		if ( ! isset( $_GET['sccss'] ) || 1 !== intval( $_GET['sccss'] ) ) {
			return;
		}

		ob_start();
		header( 'Content-type: text/css' );
		echo wp_kses( $this->get_raw_content(), $this->allowed_html );
		die();
	}

	/**
	 * Write the styles in the customizer preview pane
	 *
	 * In the Customizer Preview Pane, don't load our
	 * specially-enqueued script.  Instead, just
	 * write the CSS in the <head> so we can modify
	 * it with JS.
	 *
	 * @since 3.5
	 */
	public function preview_styles() {

		// Only load in the customizer.
		if ( ! is_customize_preview() ) {
			return;
		}
		?>
			<style type="text/css" id="sccss-preview">
				<?php echo wp_kses( $this->get_raw_content(), $this->allowed_html ); ?>
			</style>
		<?php
	}

	/**
	 * Get the raw content from our setting
	 *
	 * @since 3.5
	 *
	 * @return string
	 */
	public function get_raw_content() {
		$options     = get_option( Admin::OPTION );
		$raw_content = isset( $options[ Admin::SETTING_CONTENT ] ) ? $options[ Admin::SETTING_CONTENT ] : '';
		return $raw_content;
	}
}
