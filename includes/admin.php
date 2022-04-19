<?php
/**
 * Admin-facing functionality.
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
 * Determine if WP's CodeMirror is available.
 *
 * As CodeMirror was added in ver 4.9, simply compare with the
 * current WP version.
 *
 * @since 4.0.2
 *
 * @return bool
 */
function sccss_wp_codemirror_available() {
	$wp_version = get_bloginfo( 'version' );
	return ( version_compare( $wp_version, 4.9 ) >= 0 );
}

/**
 * Print direct link to Custom CSS admin page
 *
 * Fetches array of links generated by WP Plugin admin page ( Deactivate | Edit )
 * and inserts a link to the Custom CSS admin page
 *
 * @since  1.0.0
 * @filter plugin_action_links_
 *
 * @param  array $links Array of links generated by WP in Plugin Admin page.
 *
 * @return array        Array of links to be output on Plugin Admin page.
 */
function sccss_settings_link( $links ) {
	return array_merge(
		array(
			'settings' => '<a href="' . admin_url( 'themes.php?page=simple-custom-css.php' ) . '">' . __( 'Add CSS', 'simple-custom-css' ) . '</a>',
		),
		$links
	);
}
add_filter( 'plugin_action_links_' . plugin_basename( SCCSS_FILE ), 'sccss_settings_link' );

/**
 * Register text domain.
 *
 * @action plugins_loaded
 *
 * @since  1.0.0
 */
function sccss_textdomain() {
	load_plugin_textdomain( 'simple-custom-css', false, dirname( plugin_basename( SCCSS_FILE ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'sccss_textdomain' );

/**
 * Delete Options on Uninstall.
 *
 * @since 1.1.0
 */
function sccss_uninstall() {
	delete_option( SCCSS_OPTION );
}
register_uninstall_hook( SCCSS_FILE, 'sccss_uninstall' );

/**
 * Enqueues Scripts/Styles for Syntax Highlighter.
 *
 * @since  4.0.2 Add WP CodeMirror Support.
 * @since  4.0.0 Updated scripts, added linting.
 * @since  3.0.0
 *
 * @param  string $hook Hook of admin screen.
 *
 * @return void
 */
function sccss_register_codemirror( $hook ) {
	// Note that this only loads on the admin tools page (Appearance > Custom CSS).
	if ( 'appearance_page_simple-custom-css' !== $hook ) {
		return;
	}

	wp_enqueue_style( 'sccss-editor-css', plugins_url( 'simple-custom-css/includes/css/editor.css' ), array(), '20190306' );

	if ( sccss_wp_codemirror_available() ) {
		wp_enqueue_code_editor( array( 'type' => 'text/html' ) );
		wp_enqueue_script( 'sccss-editor-js', plugins_url( 'simple-custom-css/includes/js/editor.js' ), array( 'jquery' ), '20190306', true );
	} else {
		// Maintaining for backwards compatibility.
		wp_enqueue_script( 'sccss-css-lint-js', plugins_url( 'simple-custom-css/codemirror/csslint.js' ), array( 'sccss-codemirror-js' ), '1.0.3', true );
		wp_enqueue_script( 'sccss-codemirror-lint-js', plugins_url( 'simple-custom-css/codemirror/codemirror-lint.js' ), array( 'sccss-css-lint-js' ), '20180208', true );
		wp_enqueue_script( 'sccss-codemirror-css-lint-js', plugins_url( 'simple-custom-css/codemirror/codemirror-css-lint.js' ), array( 'sccss-codemirror-css-js' ), '20180208', true );
		wp_enqueue_script( 'sccss-codemirror-js', plugins_url( 'simple-custom-css/codemirror/codemirror.js' ), array(), '20180208', true );
		wp_enqueue_script( 'sccss-codemirror-css-js', plugins_url( 'simple-custom-css/codemirror/css.js' ), array( 'sccss-codemirror-lint-js' ), '20180208', true );

		wp_enqueue_style( 'sccss-codemirror-css', plugins_url( 'simple-custom-css/codemirror/codemirror.min.css' ), array(), '20190306' );

		wp_add_inline_script(
			'sccss-codemirror-js',
			'jQuery( document ).ready( function() {
				var editor = CodeMirror.fromTextArea( document.getElementById( "sccss_settings[sccss-content]" ), {
					lineNumbers: true,
					lineWrapping: true,
					mode:"text/css",
					indentUnit: 2,
					tabSize: 2,
					lint: true,
					gutters: [ "CodeMirror-lint-markers" ]
				} );
			} )( CodeMirror );'
		);
	}
}
add_action( 'admin_enqueue_scripts', 'sccss_register_codemirror' );

/**
 * Register "Custom CSS" submenu in "Appearance" Admin Menu.
 *
 * @since  1.0.0
 *
 * @action admin_menu
 */
function sccss_register_submenu_page() {
	add_theme_page( __( 'Simple Custom CSS', 'simple-custom-css' ), __( 'Custom CSS', 'simple-custom-css' ), 'edit_theme_options', basename( SCCSS_FILE ), 'sccss_render_submenu_page' );
}
add_action( 'admin_menu', 'sccss_register_submenu_page' );

/**
 * Register settings.
 *
 * @since  1.0.0
 *
 * @action admin_init
 */
function sccss_register_settings() {
	register_setting( 'sccss_settings_group', SCCSS_OPTION );
}
add_action( 'admin_init', 'sccss_register_settings' );

/**
 * Render Admin Menu page.
 *
 * @since 4.0.2 Remove hardcoded script in lieu of wp_add_inline_script.
 * @since 1.0.0
 */
function sccss_render_submenu_page() {

	$options = get_option( SCCSS_OPTION );
	$content = isset( $options['sccss-content'] ) && ! empty( $options['sccss-content'] ) ? $options['sccss-content'] : __( '/* Enter Your Custom CSS Here */', 'simple-custom-css' );

	if ( isset( $_GET['settings-updated'] ) ) : // phpcs:ignore WordPress.Security.NonceVerification ?>
		<div id="message" class="updated">
			<p><?php esc_html_e( 'Custom CSS updated successfully.', 'simple-custom-css' ); ?></p></div>
	<?php endif; ?>
	<div class="wrap">

		<h2 style="margin-bottom: 1em;"><?php esc_html_e( 'Simple Custom CSS', 'simple-custom-css' ); ?></h2>

		<form name="sccss-form" action="options.php" method="post" enctype="multipart/form-data">

			<?php settings_fields( 'sccss_settings_group' ); ?>

			<div id="templateside">
				<?php do_action( 'sccss_sidebar_top' ); ?>

				<p style="margin-top: 0"><?php esc_html_e( 'Simple Custom CSS allows you to add your own styles or override the default CSS of a plugin or theme.', 'simple-custom-css' ); ?></p>
				<p style="margin-top: 0"><?php esc_html_e( 'The styles you save here will remain even if you switch themes.', 'simple-custom-css' ); ?></p>

				<p><?php esc_html_e( 'To use, enter your custom CSS, then click "Update Custom CSS".  It\'s that simple!', 'simple-custom-css' ); ?></p>
				<?php submit_button( __( 'Update Custom CSS', 'simple-custom-css' ), 'primary', 'submit', true ); ?>

				<?php if ( sccss_wp_codemirror_available() ) : ?>
                    <?php if ( ! function_exists( 'gutenberg_is_fse_theme' ) || ! gutenberg_is_fse_theme() ) : ?>
                        <p class="description">
                            <?php
                            // translators: Placeholder represents the URL to the Customizer Section.
                            echo wp_kses_post( sprintf( __( 'Did you know that you can preview your CSS live in <a href="%s" title="Simple Custom CSS in the Customizer">the Customizer</a>?', 'simple-custom-css' ), esc_url( wp_customize_url() . '?autofocus[control]=sccss_editor' ) ) );
                            ?>
                        </p>
                    <?php endif; ?>
				<?php endif; ?>

				<?php do_action( 'sccss_sidebar_bottom' ); ?>
			</div>
			<div id="template">

				<?php do_action( 'sccss_form_top' ); ?>

				<div>
					<textarea cols="70" rows="30" name="sccss_settings[sccss-content]" class="sccss-content" id="sccss_settings[sccss-content]"><?php echo esc_html( $content ); ?></textarea>
				</div>

				<?php do_action( 'sccss_textarea_bottom' ); ?>

				<div>
					<?php submit_button( __( 'Update Custom CSS', 'simple-custom-css' ), 'primary', 'submit', true ); ?>
				</div>

				<?php do_action( 'sccss_form_bottom' ); ?>
			</div>
		</form>
	</div>
	<?php
}
