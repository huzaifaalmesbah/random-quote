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

use Appsero\Client;

/**
 * The core plugin class.
 */
class Core {
    /**
     * Instance of this class.
     *
     * @var Core
     */
    private static $instance = null;

    /**
     * Get the singleton instance.
     *
     * @return Core
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor to initialize the plugin.
     */
    private function __construct() {
        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();
        $this->init_blocks();
        $this->init_rest_api();

        // Initialize Appsero after init hook
        add_action('init', array($this, 'init_appsero'));
    }

    /**
     * Load the required dependencies for the plugin.
     */
    private function load_dependencies() {
        // Dependencies are now handled by Composer autoloader
    }

    /**
     * Initialize Appsero Tracker
     */
    public function init_appsero() {
        $client = new Client('ede1e8b4-619f-442f-98b4-3787df3bbb39', 'Random Quote', WPPRQ_PLUGIN_FILE);
        $client->insights()->init();
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
        add_action('wp_enqueue_scripts', array($plugin_public, 'enqueue_styles'));
        add_shortcode('wpprq_quote', array($plugin_public, 'display_quote'));
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
