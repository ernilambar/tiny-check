Feature: Basic checks

  Scenario: Basic checks
    Given a WP install with the Plugin Check plugin

    When I run the WP-CLI command `plugin list --format=csv --fields=name,status`
    Then STDOUT should contain:
      """
      plugin-check,active
      """
    And STDOUT should contain:
      """
      tiny-check,active
      """

    When I run the WP-CLI command `help plugin check`
    Then STDOUT should not be empty
    And STDERR should be empty

    When I run the WP-CLI command `plugin check hello.php --format=csv --fields=code,type,severity`
    Then STDOUT should contain:
      """
      WordPress.WP.AlternativeFunctions.rand_mt_rand,ERROR,5
      """

  Scenario: Check todo error
    Given a WP install with the Plugin Check plugin
    And a wp-content/plugins/foo-sample/foo-sample.php file:
      """
      <?php
      /**
       * Plugin Name: Foo Sample
       * Plugin URI: https://foo-sample.com
       * Description: Custom plugin.
       * Version: 0.1.0
       * Author: WordPress Performance Team
       * Author URI: https://make.wordpress.org/performance/
       * License: GPL-2.0+
       * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
       */

			 // TODO: Needs some refinement.
			 $var = 1;

      """
    And a wp-content/plugins/foo-sample/README.md file:
      """
      # Foo Sample #

      **Contributors:** johndoe
      **Requires at least:** 6.0
      **Tested up to:** 6.6
      **Requires PHP:** 7.2
      **Stable tag:** 0.1.0
      **License:** GPL-2.0+
      **License URI:** http://www.gnu.org/licenses/gpl-2.0.txt

      This is a short description of the plugin.

      """

    When I run the WP-CLI command `plugin check foo-sample --format=csv --fields=code,type,severity`
    Then STDOUT should contain:
	    """
	    NilambarCodingStandard.Commenting.TodoComment.Found,WARNING,5
	    """
