<?php

namespace Inpsyde\Filter\WordPress;

use Inpsyde\Filter\AbstractFilter;


/**
 * Class StripTags
 *
 * @package Inpsyde\Filter\WordPRess
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

			_doing_it_wrong(
				__METHOD__,
				'The given value is not a string or empty,',
				'0.1'
			);

			return $value;
		}

		$strict = (bool) $this->options[ 'strict' ];

		return wp_strip_all_tags( $value, $strict );
	}

}