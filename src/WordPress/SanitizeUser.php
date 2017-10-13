<?php

namespace Inpsyde\Filter\WordPress;

use Inpsyde\Filter\AbstractFilter;

/**
 * Class SanitizeUser
 *
 * @package Inpsyde\Filter\WordPress
 */
class SanitizeUser extends AbstractFilter {

	/**
	 * @var array
	 */
	protected $options = [
		'strict' => FALSE
	];

	/**
	 * {@inheritdoc}
	 */
	public function filter( $value ) {

		if ( ! is_string( $value ) || empty( $value ) ) {
			do_action( 'inpsyde.filter.error', 'The given value is not string or empty.', [ 'method' => __METHOD__, 'value' => $value ] );

			return $value;
		}

		$strict = (bool) $this->options[ 'strict' ];

		return sanitize_user( $value, $strict );
	}

}