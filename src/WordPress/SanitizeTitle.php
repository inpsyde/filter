<?php

namespace Inpsyde\Filter\WordPress;

use Inpsyde\Filter\AbstractFilter;

/**
 * Class SanitizeKey
 *
 * @package Inpsyde\Filter\WordPress
 */
class SanitizeTitle extends AbstractFilter {

	/**
	 * @var array
	 */
	protected $options = [
		'fallback' => '',
		'context'  => 'save'
	];

	/**
	 * {@inheritdoc}
	 */
	public function filter( $value ) {

		if ( ! is_string( $value ) || empty( $value ) ) {
			do_action( 'inpsyde.filter.error', 'The given value is not string or empty.', [ 'method' => __METHOD__, 'value' => $value ] );

			return $value;
		}

		$fallback = (string) $this->options[ 'fallback' ];
		$context  = (string) $this->options[ 'context' ];

		return sanitize_title( $value, $fallback, $context );
	}

}