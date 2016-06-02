<?php

namespace Inpsyde\Filter\WordPress;

use Inpsyde\Filter\AbstractFilter;

/**
 * Class SanitizeKey
 *
 * @package Inpsyde\Filter\WordPRess
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

			_doing_it_wrong(
				__METHOD__,
				'The given value is not a string or empty,',
				'0.1'
			);

			return $value;
		}

		$fallback = (string) $this->options[ 'fallback' ];
		$context  = (string) $this->options[ 'context' ];

		return sanitize_title( $value, $fallback, $context );
	}

}