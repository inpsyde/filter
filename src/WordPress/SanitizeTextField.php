<?php

namespace Inpsyde\Filter\WordPress;

use Inpsyde\Filter\AbstractFilter;


/**
 * Class SanitizeTextField
 *
 * @package Inpsyde\Filter\WordPress
 */
class SanitizeTextField extends AbstractFilter {

	/**
	 * {@inheritdoc}
	 */
	public function filter( $value ) {

		if ( ! is_string( $value ) || empty( $value ) ) {
			do_action( 'inpsyde.filter.error', 'The given value is not string or empty.', [ 'method' => __METHOD__, 'value' => $value ] );

			return $value;
		}

		return sanitize_text_field( $value );
	}

}