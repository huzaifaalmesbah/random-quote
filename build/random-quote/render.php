<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

use WPPRQ\RandomQuote\Api;

$quote = Api::fetch_quote();
?>
<div <?php echo get_block_wrapper_attributes(['class' => 'wpprq-quote-wrapper']); ?>>
	<?php echo wp_kses_post($quote); ?>
</div>
