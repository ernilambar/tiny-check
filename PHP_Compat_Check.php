<?php
/**
 * Class PHP_Compat_Check
 *
 * @package TinyCheck
 */

use WordPress\Plugin_Check\Checker\Check_Result;
use WordPress\Plugin_Check\Checker\Checks\Abstract_PHP_CodeSniffer_Check;
use WordPress\Plugin_Check\Traits\Stable_Check;

class PHP_Compat_Check extends Abstract_PHP_CodeSniffer_Check {

	use Stable_Check;

	public function get_categories() {
		return [ 'general' ];
	}

	protected function get_args( Check_Result $result ) {
		return [
			'extensions'      => 'php',
			'standard'        => 'PHPCompatibility',
			'installed_paths' => [
				TINY_CHECK_DIR . '/vendor/phpcompatibility/php-compatibility',
				WP_PLUGIN_CHECK_PLUGIN_DIR_PATH . 'vendor/wp-coding-standards/wpcs',
			],
		];
	}

	public function get_description(): string {
		return '';
	}

	public function get_documentation_url(): string {
		return '';
	}
}
