<?php
/**
 * Handles the API calls for the plugin.
 *
 * This class is responsible for fetching a daily inspirational quote from the ZenQuotes API.
 *
 * @package random-quote
 */

namespace WPPRQ\RandomQuote;

/**
 * Class Api
 */
class Api {

	/**
	 * Transient key for storing the daily quote.
	 *
	 * @var string
	 */
	private static $transient_key = 'wpprq_quote';

	/**
	 * Transient key for storing the last successful quote (fallback).
	 *
	 * @var string
	 */
	private static $fallback_transient_key = 'wpprq_quote_fallback';

	/**
	 * Transient key for storing API error information.
	 *
	 * @var string
	 */
	private static $error_transient_key = 'wpprq_quote_error';

	/**
	 * Fetches a daily inspirational quote from the ZenQuotes API or cache.
	 *
	 * @return string The formatted quote HTML, or an error message.
	 */
	public static function fetch_quote() {
		// Try to get cached quote first
		$cached_quote = get_transient(self::$transient_key);
		if (false !== $cached_quote) {
			return $cached_quote;
		}

		// If there's a cached fallback quote (within 7 days), use it
		$fallback_quote = get_transient(self::$fallback_transient_key);
		if (false !== $fallback_quote) {
			return $fallback_quote;
		}

		// Fetch new quote from API
		$quote_data = self::fetch_from_api();
		
		if (is_wp_error($quote_data)) {
			// API failed, try fallback
			$fallback_success = self::set_fallback_quote();
				
			if ($fallback_success) {
				$fallback_quote = get_transient(self::$fallback_transient_key);
				if (false !== $fallback_quote) {
					return $fallback_quote;
				}
			}
			
			return self::get_error_message();
		}

		// Cache the quote for 24 hours
		set_transient(self::$transient_key, $quote_data, DAY_IN_SECONDS);
		
		// Update fallback quote too
		set_transient(self::$fallback_transient_key, $quote_data, 7 * DAY_IN_SECONDS);
		
		// Clear any stored error
		delete_transient(self::$error_transient_key);
		
		return $quote_data;
	}

	/**
	 * Fetches quote from the ZenQuotes API with detailed error handling.
	 *
	 * @return string|WP_Error The formatted quote HTML or WP_Error on failure.
	 */
	private static function fetch_from_api() {
		// Check if WP_DEBUG is enabled for logging
		$debug_enabled = defined('WP_DEBUG') && WP_DEBUG;
		
		if ($debug_enabled) {
			// Log the API request
			if (function_exists('error_log')) {
				error_log('Random Quote: Attempting to fetch quote from ZenQuotes API');
			}
		}

		$response = wp_remote_get(
			'https://zenquotes.io/api/random',
			array(
				'timeout' => 15,
				'redirection' => 3,
			)
		);

		if (is_wp_error($response)) {
			$error_message = $response->get_error_message();
			$error_code = $response->get_error_code();
			$debug_info = array(
				'type' => 'wp_error',
				'code' => $error_code,
				'message' => $error_message,
			);
			
			self::log_error($debug_info);
			self::set_admin_notice('connection_error', $error_message);
			
			if ($debug_enabled && function_exists('error_log')) {
				error_log(sprintf(
					'Random Quote: WP_Error encountered - Code: %s, Message: %s',
					$error_code,
					$error_message
				));
			}
			
			return new WP_Error('api_error', $error_message);
		}

		$response_code = wp_remote_retrieve_response_code($response);
		$response_body = wp_remote_retrieve_body($response);

		if (200 !== $response_code) {
			$debug_info = array(
				'type' => 'http_error',
				'code' => $response_code,
				'message' => wp_remote_retrieve_response_message($response),
				'body' => $response_body,
			);
			
			self::log_error($debug_info);
			self::set_admin_notice('http_error', $response_code);
			
			if ($debug_enabled && function_exists('error_log')) {
				error_log(sprintf(
					'Random Quote: HTTP Error - Code: %s, Message: %s',
					$response_code,
					wp_remote_retrieve_response_message($response)
				));
			}
			
			return new WP_Error('http_error', sprintf(
				__('HTTP Error %d: %s', 'random-quote'),
				$response_code,
				wp_remote_retrieve_response_message($response)
			));
		}

		// Validate JSON response
		$data = json_decode($response_body);
		
		if (null === $data) {
			$json_error = json_last_error_msg();
			$debug_info = array(
				'type' => 'json_error',
				'message' => $json_error,
				'body' => $response_body,
			);
			
			self::log_error($debug_info);
			self::set_admin_notice('json_error', $json_error);
			
			if ($debug_enabled && function_exists('error_log')) {
				error_log(sprintf(
					'Random Quote: JSON Decode Error - %s',
					$json_error
				));
			}
			
			return new WP_Error('json_error', sprintf(
				__('Invalid JSON response: %s', 'random-quote'),
				$json_error
			));
		}

		if (!is_array($data) || empty($data) || !isset($data[0]->q, $data[0]->a)) {
			$debug_info = array(
				'type' => 'data_error',
				'data_structure' => (array) $data,
			);
			
			self::log_error($debug_info);
			self::set_admin_notice('data_error', 'Invalid data structure received from API');
			
			if ($debug_enabled && function_exists('error_log')) {
				error_log('Random Quote: Invalid data structure received from API');
			}
			
			return new WP_Error('data_error', __('Invalid data structure received from API', 'random-quote'));
		}

		// Format the quote
		$quote = esc_html($data[0]->q);
		$author = esc_html($data[0]->a);
		$formatted_quote = "<blockquote class='wpprq-quote'><p>{$quote}</p><cite>&mdash; {$author}</cite></blockquote>";
		
		if ($debug_enabled && function_exists('error_log')) {
			error_log(sprintf(
				'Random Quote: Successfully fetched quote by %s',
				$author
			));
		}
		
		return $formatted_quote;
	}

	/**
	 * Sets the fallback quote to the last successful one.
	 *
	 * @return bool True if fallback was set, false otherwise.
	 */
	private static function set_fallback_quote() {
		// Try to get the current quote (which is the last successful one)
		$cached_quote = get_transient(self::$transient_key);
		
		if (false !== $cached_quote) {
			// Set fallback quote with 7-day expiration
			set_transient(self::$fallback_transient_key, $cached_quote, 7 * DAY_IN_SECONDS);
			return true;
		}
		
		return false;
	}

	/**
	 * Gets appropriate error message based on stored error information.
	 *
	 * @return string Error message.
	 */
	private static function get_error_message() {
		$stored_error = get_transient(self::$error_transient_key);
		
		if (false !== $stored_error) {
			$error_type = $stored_error['type'] ?? 'unknown';
			$error_data = $stored_error['data'] ?? array();
			
			switch ($error_type) {
				case 'wp_error':
					return __('Could not connect to quote service. Please check your website configuration.', 'random-quote');
					
				case 'http_error':
					$code = $error_data['code'] ?? 0;
					if ($code === 429) {
						return __('Quote service is temporarily busy. Please try again later.', 'random-quote');
					}
					return __('Could not retrieve quote due to server error. Please try again later.', 'random-quote');
					
				case 'json_error':
					return __('Could not process quote data. Please try again later.', 'random-quote');
					
				case 'data_error':
					return __('Received invalid quote data. Please try again later.', 'random-quote');
					
				default:
					return __('Could not retrieve quote. Please try again later.', 'random-quote');
			}
		}
		
		return __('Could not retrieve quote. Please try again later.', 'random-quote');
	}

	/**
	 * Logs error information for debugging.
	 *
	 * @param array $error_info Error information array.
	 */
	private static function log_error($error_info) {
		// Store error information with 1-hour expiration
		set_transient(self::$error_transient_key, array(
			'time' => current_time('timestamp'),
			'data' => $error_info,
		), HOUR_IN_SECONDS);
	}

	/**
	 * Sets admin notice for API errors.
	 *
	 * @param string $notice_type Type of notice.
	 * @param string $additional_info Additional error information.
	 */
	private static function set_admin_notice($notice_type, $additional_info = '') {
		if (!is_admin()) {
			return;
		}
		
		$notice_message = '';
		
		switch ($notice_type) {
			case 'connection_error':
				$notice_message = sprintf(
					__('Random Quote: Connection error - %s', 'random-quote'),
					$additional_info
				);
				break;
				
			case 'http_error':
				$notice_message = sprintf(
					__('Random Quote: Service returned error code %s', 'random-quote'),
					$additional_info
				);
				break;
				
			case 'json_error':
				$notice_message = sprintf(
					__('Random Quote: Invalid data received from service - %s', 'random-quote'),
					$additional_info
				);
				break;
				
			case 'data_error':
				$notice_message = $additional_info;
				break;
		}
		
		if (!empty($notice_message)) {
			// Schedule admin notice for next admin load
			add_action('admin_notices', function() use ($notice_message) {
				echo '<div class="notice notice-error is-dismissible">
					<p>' . esc_html($notice_message) . '</p>
					<p>' . esc_html(__('You may need to check your website configuration or contact your hosting provider.', 'random-quote')) . '</p>
				</div>';
			});
		}
	}
}
}
