<?php
/**
 * Plugin Name: Random Quote
* Description: A lightweight plugin that displays a daily quote using the ZenQuotes API. Use the [wpprq_quote] shortcode to add it anywhere on your site.
 * Version: 1.0.1
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
define( 'WPPRQ_VERSION', '1.0.0' );
define( 'WPPRQ_PLUGIN_FILE', __FILE__ );
define( 'WPPRQ_PLUGIN_URL', plugin_dir_url( WPPRQ_PLUGIN_FILE ) );
define( 'WPPRQ_ASSETS_URL', WPPRQ_PLUGIN_URL . 'assets/' );

// Include the main class.
require_once plugin_dir_path( WPPRQ_PLUGIN_FILE ) . 'includes/class-wpprq-core.php';

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
