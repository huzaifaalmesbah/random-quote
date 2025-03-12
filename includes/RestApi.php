<?php
/**
 * Handles the REST API functionality of the plugin.
 *
 * This class is responsible for registering and handling REST API endpoints.
 *
 * @package random-quote
 */

namespace WPPRQ\RandomQuote;

/**
 * Class RestApi
 */
class RestApi {

    /**
     * Register REST API endpoint for fetching quotes
     */
    public function register_rest_route() {
        register_rest_route('wpprq/v1', '/quote', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_quote'),
            'permission_callback' => '__return_true'
        ));
    }

    /**
     * Callback function for the quote endpoint
     */
    public function get_quote() {
        return rest_ensure_response(Api::fetch_quote());
    }
}