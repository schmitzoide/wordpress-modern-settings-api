<?php

namespace WP_React_Backend;

defined( 'ABSPATH' ) || exit;

class Settings {

	protected $options = array();

	final public function __construct() {
		if ( is_admin() ) {
			add_action( 'admin_menu', array( $this, 'admin_menus' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 9 );
		}
	}

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
		error_log( 'enqueued settings' );

		// Load our style.css.
		wp_register_style(
			'settings',
			plugins_url( '../build/style-index.css', __FILE__ ),
			null,
			$asset_file['version'],
		);
		wp_enqueue_style( 'settings' );

	}

	public function admin_menus() {

		foreach ( $this->options as $option ) {

			$name = $option['name'];
			$slug = $option['slug'];

			add_menu_page(
				$name,
				$name,
				'manage_options',
				$slug,
				array( $this, 'settings_wrapper' ),
				'dashicons-admin-generic',
				99
			);
		}

	}

	public function settings_wrapper() {
		echo '<div class="wp-react-backend-settings-wrapper wrap"></div>';
	}

	public function register_menu( $name, $slug, $component ) {
		$this->options[] = array(
			'name'      => $name,
			'slug'      => $slug,
			'component' => $component,
		);
	}

}
