<?php

namespace Inpsyde\Filter\WordPress;

use Inpsyde\Filter\AbstractFilter;

/**
 * Class AutoP
 *
 * @package Inpsyde\Filter\WordPress
 */
class AutoP extends AbstractFilter {

	/**
	 * @var array
	 */
	protected $options = [
		'br' => TRUE
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

		$br = (bool) $this->options[ 'br' ];

		return wpautop( $value, $br );
	}

}