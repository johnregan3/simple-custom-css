<?php
/**
 * Plugin Name: Simple Custom CSS
 * Plugin URI: http://johnregan3.github.io/simple-custom-css
 * Description: The simple, solid way to add custom CSS to your WordPress website. Simple Custom CSS allows you to add your own styles or override the default CSS of a plugin or theme.
 * Author: John Regan, Danny Van Kooten
 * Author URI: http://johnregan3.me
 * Version: 4.0.3
 * Text Domain: simple-custom-css
 *
 * Copyright 2014-2019  John Regan  (email : john@johnregan3.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @package SCCSS
 * @author John Regan
 * @version 4.0.3
 */

global $wp_version;

// Prevent direct file access.
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

define( 'SCCSS_FILE', __FILE__ );
define( 'SCCSS_OPTION', 'sccss_settings' );

if ( ! is_admin() ) {
	require_once dirname( SCCSS_FILE ) . '/includes/public.php';
} elseif ( ! defined( 'DOING_AJAX' ) ) {
	require_once dirname( SCCSS_FILE ) . '/includes/admin.php';
}

// Load the customizer control on later versions of WP.
if ( version_compare( $wp_version, 4.9 ) >= 0 ) {
	require_once dirname( SCCSS_FILE ) . '/includes/customizer.php';
}

