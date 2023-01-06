<?php
/**
 * Plugin URI: https://marcelschmitz.com
 * Plugin Name: WordPress React Backend
 * Description: Enable usable of react components on the WordPress admin side.
 * Version: 0.0.1
 * Author: Marcel Schmitz
 * Author URI: https://marcelschmitz.com
 * Text Domain: wp-react-backend
 * Requires PHP: 8.0
 *
 * @package WP_React_Backend\Plugin
 * @internal This file is only used when running as a feature plugin.
 */

namespace WP_React_Backend;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'WP_React_Backend\Plugin' ) ) {

	class Plugin {

		public function __construct() {
		}
	}

}

add_action(
	'plugins_loaded',
	function () {
		require_once __DIR__ . '/vendor/autoload.php';
		require_once __DIR__ . '/includes/class-helper.php';
		require_once __DIR__ . '/includes/class-settings.php';

		new Plugin();
	}
);
