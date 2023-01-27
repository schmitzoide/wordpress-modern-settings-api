<?php
/**
 * Plugin URI: https://github.com/schmitzoide/wordpress-modern-settings-api
 * Plugin Name: WordPress Modern Settings API
 * Description: Enable usable of react components on the WordPress admin side.
 * Version: 0.3.0
 * Author: Marcel Schmitz
 * Author URI: https://profiles.wordpress.org/schmitzoide/
 * Text Domain: wordpress-modern-settings-api
 * Requires PHP: 8.1
 *
 * @package WP_Modern_Settings\Plugin
 * @internal This file is only used when running as a feature plugin.
 */

namespace WP_Modern_Settings;

defined( 'ABSPATH' ) || exit;

/**
 * This is the main class for the plugin to fire up.
 */
class Plugin {

	/**
	 * Construct.
	 */
	public function __construct() {
		require_once __DIR__ . '/includes/class-settings.php';
	}
}

add_action(
	'plugins_loaded',
	function () {
		require_once __DIR__ . '/vendor/autoload.php';
		new Plugin();
	},
	5
);
