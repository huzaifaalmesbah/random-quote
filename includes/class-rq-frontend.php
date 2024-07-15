<?php
/**
 * Handles the public-facing functionality of the plugin.
 *
 * This class is responsible for enqueueing stylesheets and displaying the daily inspirational quote
 * on the public-facing side of the website.
 *
 * @package random-quote
 */

/**
 * Class RQ_Frontend
 */
class RQ_Frontend {

	/**
	 * Enqueue stylesheets for the public-facing side.
	 */
	public function enqueue_styles() {
		global $post;

		// Check if the post content contains the [random_quote] shortcode.
		if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'random_quote' ) ) {
			wp_enqueue_style( 'rq-styles', RQ_ASSETS_URL . 'css/frontend.css', array(), RQ_VERSION );
		}
	}

	/**
	 * Displays a daily inspirational quote wrapped in a div with class 'rq-quote-wrapper'.
	 *
	 * @return string The HTML markup for the quote wrapper.
	 */
	public function display_quote() {
		$quote = RQ_API::fetch_quote();
		return "<div class='rq-quote-wrapper'>{$quote}</div>";
	}
}
