<?php
/**
 * Handles the API calls for the plugin.
 *
 * This class is responsible for fetching a daily inspirational quote from the ZenQuotes API.
 *
 * @package random-quote
 */

/**
 * Class WPPRQ_API
 */
class WPPRQ_API {

	/**
	 * Fetches a daily inspirational quote from the ZenQuotes API.
	 *
	 * @return string The formatted quote HTML, or an error message.
	 */
	public static function fetch_quote() {
		$response = wp_remote_get( 'https://zenquotes.io/api/random' );

		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
			return __( 'Could not retrieve quote. Please try again later.', 'random-quote' );
		}

		$data = json_decode( wp_remote_retrieve_body( $response ) );

		if ( ! empty( $data ) && is_array( $data ) ) {
			$quote  = esc_html( $data[0]->q );
			$author = esc_html( $data[0]->a );
			return "<blockquote class='wpprq-quote'><p>{$quote}</p><cite>&mdash; {$author}</cite></blockquote>";
		}

		return __( 'Could not retrieve quote. Please try again later.', 'random-quote' );
	}
}
