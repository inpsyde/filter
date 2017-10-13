<?php

namespace Inpsyde\Filter\WordPress;

use Inpsyde\Filter\AbstractFilter;


/**
 * Class SanitizePostField
 *
 * @package Inpsyde\Filter\WordPress
 */
class SanitizePostField extends AbstractFilter {

	/**
	 * {@inheritdoc}
	 */
	protected $options = array(
		'context'   => 'db',
		'field'     => '',
	);

	/**
	 * {@inheritdoc}
	 */
	public function filter( $value ) {

		if ( ! is_scalar( $value ) || empty( $value ) ) {
			do_action( 'inpsyde.filter.error', 'The given value is not scalar or empty.', [ 'method' => __METHOD__, 'value' => $value ] );

			return $value;
		}

		if ( ! isset( $this->options[ 'field' ] ) ) {

			return $value;
		}

		$context = (string) $this->options[ 'context' ];
		$field   = (string) $this->options[ 'field' ];

		return sanitize_post_field( $field, $value, 0, $context );
	}

}