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
			do_action( 'inpsyde.filter.error', 'The given value is not scalar or empty.', [ 'method' => __METHOD__, 'value' => $value ] );

			return $value;
		}

		return esc_url_raw( (string) $value, $this->options[ 'protocols' ] );
	}

}
