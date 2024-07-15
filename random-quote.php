<?php
/**
 * Plugin Name: Random Quote
 * Description: A simple plugin that displays a daily inspirational quote using a free API.
 * Version: 1.0.0
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
define( 'RQ_VERSION', '1.0.0' );
define( 'RQ_PLUGIN_FILE', __FILE__ );
define( 'RQ_PLUGIN_URL', plugin_dir_url( RQ_PLUGIN_FILE ) );
define( 'RQ_ASSETS_URL', RQ_PLUGIN_URL . 'assets/' );

// Include the main class.
require_once plugin_dir_path( RQ_PLUGIN_FILE ) . 'includes/class-random-quote.php';

/**
 * Initializes the plugin.
 *
 * This function creates a new instance of the Random_Quote class and calls its run method.
 */
function rq_run_plugin() {
	$plugin = new Random_Quote();
	$plugin->run();
}

add_action( 'plugins_loaded', 'rq_run_plugin' );
