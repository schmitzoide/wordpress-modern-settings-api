<?php
/**
 * Registers Settings Pages from 3rd party plugins.
 *
 * This class is responsible for collecting the information about the 3rd party plugin
 * and adding the information to the settings page.
 *
 * @package WP_Modern_Settings\Settings
 * @since 0.3.0
 */

namespace WP_Modern_Settings;

defined( 'ABSPATH' ) || exit;

/**
 * Registers Settings Pages from 3rd party plugins.
 */
class Settings {

	/**
	 * Holds information about the plugin that is registering their component,
	 * present on the settings.json file that is passed along.
	 *
	 * @var array
	 */
	protected $options = array();

	/**
	 * Construct.
	 */
	final public function __construct() {
		if ( is_admin() ) {
			add_action( 'admin_menu', array( $this, 'admin_menus' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		}
	}

	/**
	 * Enqueues the files needed for our settings wrapper components first,
	 * then the onees from the registered settings panel.
	 *
	 * @return void
	 */
	public function admin_enqueue_scripts() {

		// Automatically load dependencies and version.
		$asset_file = include plugin_dir_path( __FILE__ ) . '../build/index.asset.php';

		// Enqueue CSS dependencies.
		foreach ( $asset_file['dependencies'] as $style ) {
			wp_enqueue_style( $style );
		}

		// Load our app.js.
		wp_register_script(
			'settings',
			plugins_url( '../build/index.js', __FILE__ ),
			$asset_file['dependencies'],
			$asset_file['version'],
			true,
		);
		wp_enqueue_script( 'settings' );

		// Lets pass some info over to the react component.
		wp_localize_script(
			'settings',
			'wpReactBackendSettings',
			array(
				'slug'  => $this->options['slug'],
				'title' => $this->options['title'],
			)
		);

		// Load our style.css.
		wp_register_style(
			'settings',
			plugins_url( '../build/style-index.css', __FILE__ ),
			null,
			$asset_file['version'],
		);
		wp_enqueue_style( 'settings' );

		// Gets the info necessary to do the same for the 3rd party settings panel.
		$name   = $this->options['name'];
		$path   = $this->options['path'];
		$script = $this->options['script'];

		$this->admin_enqueue_scripts_from_json( $path, $name, $script );

	}

	/**
	 * Creates the admin menus for the 3rd party plugins.
	 *
	 * @return void
	 */
	public function admin_menus() {

		$name  = $this->options['name'];
		$title = $this->options['title'];
		$slug  = $this->options['slug'];

		add_menu_page(
			$name,
			$title,
			'manage_options',
			$slug,
			array( $this, 'settings_wrapper' ),
			'dashicons-admin-generic',
			99
		);
	}

	/**
	 * The content for our settings wrapper component.
	 *
	 * @return void
	 */
	public function settings_wrapper() {
		echo '<div class="wp-react-backend-settings-wrapper wrap"></div>';
	}

	/**
	 * Function dedicated to enqueue the 3rd party component that was registered.
	 *
	 * @param string $path The full path to the plugin's build directory.
	 * @param string $name The name of the plugin's setting panel.
	 * @param string $script The file that contains the export for the setting's panel.
	 * @return void
	 */
	protected function admin_enqueue_scripts_from_json( $path, $name, $script ) {
		// Automatically load dependencies and version.
		$asset_file = include $path . '/' . str_replace( '.js', '', $script ) . '.asset.php';

		// Enqueue CSS dependencies.
		foreach ( $asset_file['dependencies'] as $style ) {
			wp_enqueue_style( $style );
		}

		// Load our app.js.
		wp_register_script(
			$name,
			plugins_url( "build/$script", $path ),
			$asset_file['dependencies'],
			$asset_file['version'],
			true,
		);

		wp_enqueue_script( $name );

		// Load our style.css.
		wp_register_style(
			$name,
			plugins_url( 'build/style-index.css', $path ),
			null,
			$asset_file['version'],
		);
		wp_enqueue_style( $name );
	}

	/**
	 * Function used by plugins to register their settings panel.
	 *
	 * @param [type] $json Settings.json file with specific schema.
	 * @return void
	 */
	public function registerSettings( $json ) {
		$json_string   = file_get_contents( $json );
		$settings_json = json_decode( $json_string, true );
		$name          = sanitize_title( $settings_json['name'] );
		$path          = dirname( $json );
		$title         = $settings_json['title'];
		$script        = $settings_json['editorScript'];

		$this->options = array(
			'title'  => $title,
			'name'   => $name,
			'slug'   => $name,
			'path'   => $path,
			'script' => $script,
		);
	}
}
