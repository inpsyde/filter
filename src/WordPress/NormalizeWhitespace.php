<?php

namespace Inpsyde\Filter\WordPress;

use Inpsyde\Filter\AbstractFilter;


/**
 * Class StringTrim
 *
 * @package Inpsyde\Filter\WordPress
 */
class NormalizeWhitespace extends AbstractFilter {

	/**
	 * {@inheritdoc}
	 */
	public function filter( $value ) {

		if ( ! is_string( $value ) || empty( $value ) ) {
			do_action( 'inpsyde.filter.error', 'The given value is not a string or empty.', [ 'method' => __METHOD__, 'value' => $value ] );

			return $value;
		}

		return normalize_whitespace( $value );
	}

}