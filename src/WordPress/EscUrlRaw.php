<?php

namespace Inpsyde\Filter\WordPress;

use Inpsyde\Filter\AbstractFilter;

/**
 * Class EscUrlRaw
 *
 * @package Inpsyde\Filter\WordPress
 */
class EscUrlRaw extends AbstractFilter {

	/**
	 * @var array
	 */
	protected $options = [
		'protocols' => [ ]
	];

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

		return esc_url_raw( (string) $value, $this->options[ 'protocols' ] );
	}

}
