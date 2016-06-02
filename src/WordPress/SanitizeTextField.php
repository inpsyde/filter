<?php

namespace Inpsyde\Filter\WordPress;

use Inpsyde\Filter\AbstractFilter;


/**
 * Class SanitizeTextField
 *
 * @package Inpsyde\Filter\WordPRess
 */
class SanitizeTextField extends AbstractFilter {

	/**
	 * {@inheritdoc}
	 */
	public function filter( $value ) {

		if ( ! is_string( $value ) || empty( $value ) ) {

			_doing_it_wrong(
				__METHOD__,
				'The given value is not a string or empty,',
				'0.1'
			);

			return $value;
		}

		return sanitize_text_field( $value );
	}

}