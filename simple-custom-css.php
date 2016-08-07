<?php
/**
 * Plugin Name: Simple Custom CSS
 * Plugin URI: http://johnregan3.github.io/simple-custom-css
 * Description: The simple, solid way to add custom CSS to your WordPress website. Simple Custom CSS allows you to add your own styles or override the default CSS of a plugin or theme.
 * Author: John Regan, Danny Van Kooten
 * Author URI: http://johnregan3.me
 * Version: 3.5
 * Text Domain: simple-custom-css
 *
 * Copyright 2014-2016  John Regan  (email : john@johnregan3.com)
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
 * @package SimpleCustomCSS
 *
 * @author John Regan
 *
 * @version 3.5
 */

// Prevent direct file access
if( ! defined( 'ABSPATH' ) ) {
	die();
}

define( 'SCCSS_FILE', __FILE__ );

require_once dirname( SCCSS_FILE ) . '/includes/front.php';
require_once dirname( SCCSS_FILE ) . '/includes/admin.php';
require_once dirname( SCCSS_FILE ) . '/includes/customizer.php';

add_action( 'after_setup_theme', 'sccss_load' );

function sccss_load() {
	if ( ! is_admin() ) {
		$sccss_public = SimpleCustomCSS\Front::get_instance();
	}
	if ( ! defined( 'DOING_AJAX' ) ) {
		$sccss_admin = SimpleCustomCSS\Admin::get_instance();
	}
	$sccss_customizer = SimpleCustomCSS\Customizer::get_instance();
}

