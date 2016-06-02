<?php

namespace Inpsyde\Filter\Tests\Unit\Fake;

use Inpsyde\Filter\AbstractFilter;

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