<?php

namespace Inpsyde\Filter\Tests\Unit\Fake;

use Inpsyde\Filter\AbstractFilter;

/**
 * Class WithOptionsFilter
 *
 * This class is just a simple "Fake" which is only used in tests to check, if the $options can be overwritten.
 * 
 * @package Inpsyde\Filter\Tests\Unit\Fake
 */
class WithOptionsFilter extends AbstractFilter {

	protected $options = [
		'key' => 'value'
	];

	/**
	 * {@inheritdoc}
	 */
	public function filter( $value ) {

		return $value;
	}
}