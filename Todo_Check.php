<?php
/**
 * Class Todo_Check
 *
 * @package TinyCheck
 */

use WordPress\Plugin_Check\Checker\Check_Result;
use WordPress\Plugin_Check\Checker\Checks\Abstract_PHP_CodeSniffer_Check;
use WordPress\Plugin_Check\Traits\Stable_Check;

class Todo_Check extends Abstract_PHP_CodeSniffer_Check {

	use Stable_Check;

	public function get_categories() {
		return [ 'general' ];
	}

	protected function get_args( Check_Result $result ) {
		return [
			'extensions'      => 'php',
			'standard'        => 'NilambarCodingStandard',
			'sniffs'          => 'NilambarCodingStandard.Commenting.TodoComment',
			'installed_paths' => [
				TINY_CHECK_DIR . '/vendor/ernilambar/coding-standard',
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
