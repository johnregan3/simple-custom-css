<?php
/**
 * Customizer functionality.
 *
 * This is set to only load for WP Version 4.9+.
 *
 * @package SCCSS
 * @since   4.0
 * @author  John Regan <john@johnregan3.com>
 */

// Prevent direct file access.
if ( ! defined( 'SCCSS_FILE' ) ) {
	die();
}

/**
 * Register Customizer functionality.
 *
 * @since  4.0
 *
 * @action customize_register, 11
 *
 * @param \WP_Customize_Manager $wp_customize \WP_Customize_Manager object.
 */
function sccss_customize_register( $wp_customize ) {
	$section_id = 'sccss_section';

	$wp_customize->add_section( $section_id, array(
		'title'       => __( 'Simple Custom CSS', 'simple-custom-css' ),
		'capability'  => 'manage_options',
		'description' => __( 'Simple Custom CSS allows you to add your own styles that will remain even if you change your theme.', 'simple-custom-css' ),
	) );

	$wp_customize->add_setting( SCCSS_OPTION . '[sccss-content]', array(
		'type' => 'option',
	) );

	$control = $wp_customize->add_control( new WP_Customize_Code_Editor_Control( $wp_customize, 'sccss_editor', array(
		'label'       => '',
		'section'     => $section_id,
		'settings'    => array(
			'default' => SCCSS_OPTION . '[sccss-content]',
		),
		'code_type'   => 'text/css',
		'input_attrs' => array(
			'aria-describedby' => 'editor-keyboard-trap-help-1 editor-keyboard-trap-help-2 editor-keyboard-trap-help-3 editor-keyboard-trap-help-4',
		),
	) ) );

	if ( $control instanceof WP_Customize_Code_Editor_Control ) {
		$options = array();
		if ( isset( $control->editor_settings['codemirror'] ) ) {
			$options = isset( $control->editor_settings['codemirror'] );
		}
		$control->editor_settings['codemirror'] = array_merge(
			$options,
			array(
				'height' => 'auto',
			)
		);
	}

}

add_action( 'customize_register', 'sccss_customize_register', 11 );

/**
 * Render the Custom CSS in the Customizer.
 *
 * @since  4.0
 *
 * @action wp_head, 99
 */
function sccss_customizer_css() {
	if ( ! is_customize_preview() ) {
		return;
	}
	?>
	<style type="text/css" id="sccss-css">
		<?php sccss_the_css(); ?>
	</style>
	<?php
}

add_action( 'wp_head', 'sccss_customizer_css', 99 );

/**
 * Add custom styles to the Customizer Editor Control.
 *
 * @since 4.0
 *
 * @action customize_controls_print_styles
 */
function sccss_customizer_styles() {
	?>
	<style>
		.customize-section-description-container + #customize-control-sccss_editor:last-child .CodeMirror {
			height: calc(100vh - 331px);
		}
		.customize-section-description-container + #customize-control-sccss_editor:last-child {
			margin-left: -12px;
			width: 299px;
			width: calc(100% + 24px);
			margin-bottom: -12px;
		}
	</style>
	<?php
}
add_action( 'customize_controls_print_styles', 'sccss_customizer_styles', 999 );

