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

			_doing_it_wrong(
				__METHOD__,
				'The given value is not a string or empty,',
				'0.1'
			);

			return $value;
		}

		$strict = (bool) $this->options[ 'strict' ];

		return sanitize_user( $value, $strict );
	}

}