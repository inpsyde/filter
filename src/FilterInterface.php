<?php

namespace Inpsyde\Filter;

/**
 * Interface FilterInterface
 *
 * @package Inpsyde\Filter
 */
interface FilterInterface {

	/**
	 * Returns the result of filtering $value.
	 *
	 * @param  mixed $value
	 *
	 * @uses _doing_it_wrong if the given value is not the correct type.
	 *
	 * @return mixed
	 */
	public function filter( $value );

}