<?php
/**
 * Plugin Name: Tiny Check
 * Plugin URI: https://github.com/ernilambar/tiny-check
 * Description: Addon for Plugin Check.
 * Version: 1.0.0
 * Requires at least: 6.6
 * Requires PHP: 7.2.24
 * Author: Nilambar Sharma
 * Author URI: https://www.nilambar.net/
 * Text Domain: tiny-check
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Requires Plugins: plugin-check
 */

// Define.
define( 'TINY_CHECK_VERSION', '1.0.0' );
define( 'TINY_CHECK_BASE_NAME', basename( __DIR__ ) );
define( 'TINY_CHECK_BASE_FILEPATH', __FILE__ );
define( 'TINY_CHECK_BASE_FILENAME', plugin_basename( __FILE__ ) );
define( 'TINY_CHECK_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
define( 'TINY_CHECK_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );

if ( file_exists( TINY_CHECK_DIR . '/vendor/autoload.php' ) ) {
	require_once TINY_CHECK_DIR . '/vendor/autoload.php';
}

add_filter(
	'wp_plugin_check_checks',
	function ( array $checks ) {
		require_once TINY_CHECK_DIR . '/Todo_Check.php';
		require_once TINY_CHECK_DIR . '/PHP_Compat_Check.php';

		return array_merge(
			$checks,
			[
				'todo'       => new Todo_Check(),
				'php_compat' => new PHP_Compat_Check(),
			]
		);
	}
);
