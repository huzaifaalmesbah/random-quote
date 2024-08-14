<?php
/**
 * The core plugin class.
 *
 * This is the main class for the Random Quote plugin. It initializes the plugin by loading dependencies
 * and defining hooks for both the public-facing and admin-specific functionalities.
 *
 * @package random-quote
 */

/**
 * The core plugin class.
 */
class WPPRQ_Core {

	/**
	 * Constructor to initialize the plugin.
	 */
	public function __construct() {
		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for the plugin.
	 */
	private function load_dependencies() {
		require_once plugin_dir_path( __FILE__ ) . 'class-wpprq-api.php';
		require_once plugin_dir_path( __FILE__ ) . 'class-wpprq-frontend.php';
	}

	/**
	 * Register the hooks related to the admin area.
	 */
	private function define_admin_hooks() {
		// Add admin-specific hooks here.
	}

	/**
	 * Register the hooks related to the public-facing side.
	 */
	private function define_public_hooks() {
		$plugin_public = new WPPRQ_Frontend();
		add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_styles' ) );
		add_shortcode( 'wpprq_quote', array( $plugin_public, 'display_quote' ) );
	}

	/**
	 * Run the plugin.
	 */
	public function run() {
		// Add hooks that need to run regardless of the area (admin/public).
	}
}
