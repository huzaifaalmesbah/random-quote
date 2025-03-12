<?php
/**
 * The core plugin class.
 *
 * This is the main class for the Random Quote plugin. It initializes the plugin by loading dependencies
 * and defining hooks for both the public-facing and admin-specific functionalities.
 *
 * @package random-quote
 */

namespace WPPRQ\RandomQuote;

/**
 * The core plugin class.
 */
class Core {

	/**
	 * Constructor to initialize the plugin.
	 */
	public function __construct() {
		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->init_blocks();
		$this->init_rest_api();
	}

	/**
	 * Load the required dependencies for the plugin.
	 */
	private function load_dependencies() {
		// Dependencies are now handled by Composer autoloader
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
		$plugin_public = new Frontend();
		add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_styles' ) );
		add_shortcode( 'wpprq_quote', array( $plugin_public, 'display_quote' ) );
	}

	/**
	 * Initialize the blocks functionality.
	 */
	private function init_blocks() {
		$blocks = new Blocks();
		$blocks->init();
	}

	/**
	 * Initialize the REST API functionality.
	 */
	private function init_rest_api() {
		$rest_api = new RestApi();
		add_action('rest_api_init', array($rest_api, 'register_rest_route'));
	}

	/**
	 * Run the plugin.
	 */
	public function run() {
		// Add hooks that need to run regardless of the area (admin/public).
	}
}
