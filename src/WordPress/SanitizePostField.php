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

			_doing_it_wrong(
				__METHOD__,
				'The given value is not scalar or empty,',
				'0.1'
			);

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