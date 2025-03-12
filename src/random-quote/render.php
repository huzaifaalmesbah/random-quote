<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<?php
require_once plugin_dir_path( __DIR__ ) . '../includes/class-wpprq-api.php';

$quote = WPPRQ_API::fetch_quote();
?>
<div <?php echo get_block_wrapper_attributes(['class' => 'wpprq-quote-wrapper']); ?>>
	<?php echo wp_kses_post($quote); ?>
</div>
