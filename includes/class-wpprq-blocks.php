<?php
/**
 * Handles the block registration functionality of the plugin.
 *
 * This class is responsible for registering and handling Gutenberg blocks.
 *
 * @package random-quote
 */

/**
 * Class WPPRQ_Blocks
 */
class WPPRQ_Blocks {

    /**
     * Register the block using the metadata loaded from the `block.json` file.
     *
     * @see https://developer.wordpress.org/reference/functions/register_block_type/
     */
    public function register_block() {
        register_block_type( plugin_dir_path( WPPRQ_PLUGIN_FILE ) . 'build/random-quote' );
    }

    /**
     * Initialize the blocks functionality.
     */
    public function init() {
        add_action( 'init', array( $this, 'register_block' ) );
    }
}