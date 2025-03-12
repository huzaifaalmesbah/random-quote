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
	 * Transient key for storing the daily quote.
	 *
	 * @var string
	 */
	private static $transient_key = 'wpprq_quote';

	/**
	 * Fetches a daily inspirational quote from the ZenQuotes API or cache.
	 *
	 * @return string The formatted quote HTML, or an error message.
	 */
	public static function fetch_quote() {
		// Try to get cached quote
		$cached_quote = get_transient(self::$transient_key);
		if (false !== $cached_quote) {
			return $cached_quote;
		}

		$response = wp_remote_get('https://zenquotes.io/api/random');

		if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {
			return __('Could not retrieve quote. Please try again later.', 'random-quote');
		}

		$data = json_decode(wp_remote_retrieve_body($response));

		if (!empty($data) && is_array($data)) {
			$quote = esc_html($data[0]->q);
			$author = esc_html($data[0]->a);
			$formatted_quote = "<blockquote class='wpprq-quote'><p>{$quote}</p><cite>&mdash; {$author}</cite></blockquote>";
			
			// Cache the quote for 24 hours
			set_transient(self::$transient_key, $formatted_quote, DAY_IN_SECONDS);
			
			return $formatted_quote;
		}

		return __('Could not retrieve quote. Please try again later.', 'random-quote');
	}
}
