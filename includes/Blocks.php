<?php
/**
 * Handles the block registration functionality of the plugin.
 *
 * This class is responsible for registering and handling Gutenberg blocks.
 *
 * @package random-quote
 */

namespace WPPRQ\RandomQuote;

/**
 * Class Blocks
 */
class Blocks {

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
    /**
     * Register custom block category.
     *
     * @param array $categories Array of block categories.
     * @return array Modified array of block categories.
     */
    public function register_block_category($categories) {
        return array_merge(
            [
                [
                    'slug'  => 'random-quote',
                    'title' => __('Random Quote', 'random-quote')
                ]
            ],
            $categories
        );
    }

    public function init() {
        add_action( 'init', array( $this, 'register_block' ) );
        add_filter( 'block_categories_all', array( $this, 'register_block_category' ), 10, 1 );
    }
}