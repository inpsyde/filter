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
	 * @return mixed
	 */
	public function filter( $value );

}