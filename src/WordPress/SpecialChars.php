<?php

namespace Inpsyde\Filter\WordPress;

use Inpsyde\Filter\AbstractFilter;

/**
 * Class SpecialChars
 *
 * @package Inpsyde\Filter\WordPress
 */
class SpecialChars extends AbstractFilter {

	/**
	 * @var array
	 */
	protected $options = [
		'quote_style'   => ENT_NOQUOTES,
		'charset'       => 'UTF-8',
		'double_encode' => FALSE
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

		$quote_style   = $this->options[ 'quote_style' ];
		$charset       = (string) $this->options[ 'charset' ];
		$double_quotes = (bool) $this->options[ 'double_encode' ];

		return _wp_specialchars( $value, $quote_style, $charset, $double_quotes );
	}

}