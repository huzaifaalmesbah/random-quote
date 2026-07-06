<?php
/**
 * Plugin Name: Random Quote
 * Description: A lightweight plugin that displays a daily quote using the ZenQuotes API. Add quotes using the Gutenberg block editor or [wpprq_quote] shortcode anywhere on your site.
 * Version: 1.1.1
 * Requires at least: 5.6
 * Requires PHP: 7.0
 * Author: Huzaifa Al Mesbah
 * Author URI: https://profiles.wordpress.org/huzaifaalmesbah
 * License: GPL2
 * Text Domain: random-quote
 *
 * @package random-quote
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// Plugin constants.
define('WPPRQ_VERSION', '1.1.1');
define('WPPRQ_PLUGIN_FILE', __FILE__);
define('WPPRQ_PLUGIN_URL', plugin_dir_url(WPPRQ_PLUGIN_FILE));
define('WPPRQ_ASSETS_URL', WPPRQ_PLUGIN_URL . 'assets/');

// Load the Composer autoload file.
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * Initializes the plugin.
 *
 * This function creates instances of the core classes and initializes their functionality.
 */
function wpprq_run_plugin() {
    // Initialize core functionality using singleton pattern
    $plugin = WPPRQ\RandomQuote\Core::get_instance();
    $plugin->run();
}

// Initialize plugin after WordPress loads
add_action('plugins_loaded', 'wpprq_run_plugin');
