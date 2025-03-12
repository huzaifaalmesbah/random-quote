/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import { useEffect, useState } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit() {
	const [quote, setQuote] = useState('');
	const [isLoading, setIsLoading] = useState(true);
	const [error, setError] = useState(null);

	useEffect(() => {
		fetchQuote();
	}, []);

	const fetchQuote = async () => {
		try {
			const response = await apiFetch({ path: '/wpprq/v1/quote' });
			if (response) {
				setQuote(response);
			}
			setIsLoading(false);
		} catch (err) {
			setError(__('Could not retrieve quote. Please try again later.', 'random-quote'));
			setIsLoading(false);
		}
	};

	return (
		<div { ...useBlockProps({ className: 'wpprq-quote-wrapper' }) }>
			{isLoading ? (
				<p>{ __('Loading...', 'random-quote') }</p>
			) : error ? (
				<p>{ error }</p>
			) : (
				<div dangerouslySetInnerHTML={{ __html: quote }} />
			)}
		</div>
	);
}
