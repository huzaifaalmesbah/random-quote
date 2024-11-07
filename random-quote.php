<?php
/**
 * Plugin Name: Random Quote
* Description: A lightweight plugin that displays a daily quote using the ZenQuotes API. Use the [wpprq_quote] shortcode to add it anywhere on your site.
 * Version: 1.0.6
 * Requires at least: 5.6
 * Requires PHP: 7.0
 * Author: Huzaifa Al Mesbah
 * Author URI: https://profiles.wordpress.org/huzaifaalmesbah
 * License: GPL2
 * Text Domain: random-quote
 * Domain Path: /languages
 *
 * @package random-quote
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Plugin constants.
define( 'WPPRQ_VERSION', '1.0.6' );
define( 'WPPRQ_PLUGIN_FILE', __FILE__ );
define( 'WPPRQ_PLUGIN_URL', plugin_dir_url( WPPRQ_PLUGIN_FILE ) );
define( 'WPPRQ_ASSETS_URL', WPPRQ_PLUGIN_URL . 'assets/' );

// Load the Composer autoload file.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}
// Include the main class.
require_once plugin_dir_path( WPPRQ_PLUGIN_FILE ) . 'includes/class-wpprq-core.php';


/**
 * Initialize the plugin tracker
 *
 * @return void
 */
function appsero_init_tracker_random_quote() {

    $client = new Appsero\Client( 'ede1e8b4-619f-442f-98b4-3787df3bbb39', 'Random Quote', __FILE__ );

    // Active insights
    $client->insights()->init();

}

appsero_init_tracker_random_quote();


/**
 * Initializes the plugin.
 *
 * This function creates a new instance of the WPPRQ_Core class and calls its run method.
 */
function wpprq_run_plugin() {
	$plugin = new WPPRQ_Core();
	$plugin->run();
}

add_action( 'plugins_loaded', 'wpprq_run_plugin' );
