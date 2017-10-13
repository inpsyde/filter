<?php

namespace Inpsyde\Filter\WordPress;

use Inpsyde\Filter\AbstractFilter;


/**
 * Class StripTags
 *
 * @package Inpsyde\Filter\WordPress
 */
class StripTags extends AbstractFilter {

	/**
	 * @var array
	 */
	protected $options = [
		'strict' => TRUE	
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

		return wp_strip_all_tags( $value, $strict );
	}

}