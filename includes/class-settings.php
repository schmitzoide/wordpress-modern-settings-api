<?php

namespace WP_React_Backend;

defined( 'ABSPATH' ) || exit;

class Settings {

	protected $options = [];

	final public function __construct() {
		if ( is_admin() ) {
			add_action( 'admin_menu', array( $this, 'admin_menus' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		}
	}

    public function admin_enqueue_scripts() {

        $page = isset( $_GET["page"] ) ? $_GET["page"] : '';
        wp_enqueue_script(
            'wp-react-backend-settings_' . $page,
            plugins_url( '../build/settings.js', __FILE__ ),
            array(),
            filemtime( plugin_dir_path( __FILE__ ) . '../build/settings.js' ),
            true
        );

        wp_localize_script(
            'wp-react-backend-settings_' . $page,
            'wp_react_backend_settings_options',
            array( 'page' => $page ) 
        );

        wp_enqueue_style(
            'wp-react-backend-css',
            plugins_url( '../build/style.css', __FILE__ ),
            array(),
            filemtime( plugin_dir_path( __FILE__ ) . '../build/style.css' )
        );
    }

	public function admin_menus() {

        foreach( $this->options as $option ) {

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
        $page = isset( $_GET["page"] ) ? $_GET["page"] : '';
        echo '<div class="wp-react-backend-settings-wrapper_' . $page . ' wrap"></div>';
    }

    public function register_menu( $name, $slug ) {
        $this->options[] = [
            'name' => $name,
            'slug' => $slug
        ];
    }

}

$settings = new Settings();
$settings->register_menu( 'WP React Backend 1', 'wp-react-backend-1' );
$settings->register_menu( 'WP React Backend 2', 'wp-react-backend-2' );
