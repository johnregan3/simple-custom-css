<?php
/**
 * Customizer Handler.
 *
 * @author John Regan
 *
 * @package SimpleCustomCSS
 */

namespace SimpleCustomCSS;

// Prevent direct file access.
if ( ! defined( 'SCCSS_FILE' ) ) {
	die();
}

// Load our custom control at the appropriate time.
add_action( 'customize_register',  __NAMESPACE__ . '\\customizer_register_callback' );

/**
 * Class Customizer
 *
 * @package SimpleCustomCSS
 *
 * @since 3.5
 */
class Customizer {

	/**
	 * The Section name
	 */
	const SECTION_NAME = 'simple-custom-css-section';

	/**
	 * The Setting name
	 *
	 * @var string
	 */
	public $setting_name;

	/**
	 * The class instance.
	 *
	 * @var object
	 */
	public static $instance;

	/**
	 * Get the instance.
	 *
	 * @since 3.5
	 *
	 * @return Customizer|object
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Customizer constructor.
	 *
	 * @since 3.5
	 */
	function __construct() {
		$this->setting_name = Admin::OPTION . '[' . Admin::SETTING_CONTENT . ']';
		add_action( 'customize_register', array( $this, 'customize_register' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'customizer_scripts' ) );
	}

	/**
	 * Register SCCSS with the Customizer.
	 *
	 * @action customize_register
	 *
	 * @since 3.5
	 *
	 * @param \WP_Customize_Manager $wp_customize The Customizer.
	 */
	function customize_register( $wp_customize ) {

		ob_start();
		esc_html_e( 'Simple Custom CSS allows you to add your own styles or override the default CSS of a plugin or theme.', 'simple-custom-css' );
		?>
		<br />
		<br />
		<a href="<?php echo esc_url( admin_url( 'themes.php?page=simple-custom-css.php' ) ); ?>"><?php esc_html_e( 'View the full CSS editor', 'simple-custom-css' ); ?>&rarr;</a>
		<?php

		$description = ob_get_clean();

		$wp_customize->add_section( self::SECTION_NAME, array(
			'title'       => __( 'Simple Custom CSS', 'simple-custom-css' ),
			'description' => $description,
			'capability'  => apply_filters( 'sccss_capability', 'edit_theme_options' ),
			'priority'    => 101,
		) );

		$wp_customize->add_setting( $this->setting_name, array(
				'default'   => '',
				'type'      => 'option',
				'transport' => 'postMessage',
			)
		);

		// Add control using our custom controller class.
		$wp_customize->add_control( new Textarea( $wp_customize, 'sccss_textarea', array(
				'label'       => __( 'Custom CSS', 'simple-custom-css' ),
				'section'     => self::SECTION_NAME,
				'settings'    => $this->setting_name,
				'type'        => 'textarea',
			)
		) );

		if ( $wp_customize->is_preview() && ! is_admin() ) {
			add_action( 'wp_footer', array( $this, 'customize_preview' ), 99 );
		}
	}

	/**
	 * Output the CSS into the Preview pane.
	 *
	 * @action wp_footer
	 *
	 * @since 3.5
	 */
	function customize_preview() {
		?>
		<script type="text/javascript">
			( function( $ ) {
				wp.customize( <?php echo wp_json_encode( $this->setting_name ); ?>, function( value ) {
					var style = $( '#sccss-preview' );
					value.bind(function(to) {
						style.html( to ? to : '' );
					});
				});
			} )( jQuery )
		</script>
		<?php
	}

	/**
	 * Enqueue Scripts
	 *
	 * @since 3.5
	 */
	function customizer_scripts() {
		$codemirror_css = 'sccss-codemirror-css';
		$codemirror_js = 'sccss-codemirror-js';
		$customizer_js = 'sccss-customizer-js';
		$js_url = trailingslashit( plugins_url( 'simple-custom-css/js/' ) );

		wp_register_style( $codemirror_css, $js_url . 'codemirror/codemirror.css' );
		wp_enqueue_style( $codemirror_css );

		wp_register_script( $codemirror_js, $js_url . 'codemirror/codemirror-css.min.js', array(), '20160806', true );
		wp_enqueue_script( $codemirror_js );

		wp_register_script( $customizer_js, $js_url . 'customizer.js', array( 'jquery', $codemirror_js, 'customize-controls' ) );

		$exports = array(
			'section' => self::SECTION_NAME,
			'control' => 'sccss_textarea',
			'element' => $this->setting_name,
		);

		 wp_scripts()->add_data(
			 $customizer_js,
			 'data',
			 sprintf( 'var _simpleCustomCSSCustomizerExports = %s;', wp_json_encode( $exports ) )
		 );

		 wp_add_inline_script( $customizer_js, 'simpleCustomCSSCustomizer.init();', 'after' );
		 wp_enqueue_script( $customizer_js );
	}
}

/**
 * Load our custom control
 *
 * @since 3.5
 *
 * @action customize_register
 */
function customizer_register_callback() {
	/**
	 * Class Textarea
	 *
	 * @since 3.5
	 *
	 * @package SimpleCustomCSS
	 */
	class Textarea extends \WP_Customize_Control {
		/**
		 * The control type
		 *
		 * @var string
		 */
		public $type = 'textarea';

		/**
		 * Render our custom textarea
		 *
		 * @since 3.5
		 */
		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="20" id="<?php echo esc_attr( Admin::OPTION . '[' . Admin::SETTING_CONTENT . ']' ); ?>" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}
}
