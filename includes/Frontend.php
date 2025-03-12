<?php
/**
 * Handles the public-facing functionality of the plugin.
 *
 * This class is responsible for enqueueing stylesheets and displaying the daily inspirational quote
 * on the public-facing side of the website.
 *
 * @package random-quote
 */

namespace WPPRQ\RandomQuote;

/**
 * Class Frontend
 */
class Frontend {

	/**
	 * Enqueue stylesheets for the public-facing side.
	 */
	public function enqueue_styles() {
		global $post;

		// Check if the post content contains the [wpprq_quote] shortcode.
		if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'wpprq_quote' ) ) {
			wp_enqueue_style( 'wpprq-styles', WPPRQ_ASSETS_URL . 'css/frontend.css', array(), WPPRQ_VERSION );
		}
	}

	/**
	 * Displays a daily inspirational quote wrapped in a div with class 'wpprq-quote-wrapper'.
	 *
	 * @return string The HTML markup for the quote wrapper.
	 */
	public function display_quote() {
		$quote = Api::fetch_quote();
		return "<div class='wpprq-quote-wrapper'>{$quote}</div>";
	}
}
