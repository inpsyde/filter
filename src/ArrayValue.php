<?php

namespace Inpsyde\Filter;

/**
 * Class ArrayValue
 *
 * @package Inpsyde\Validator
 */
class ArrayValue extends AbstractFilter {

	/**
	 * Contains a group of filters for all array values
	 *
	 * @var FilterInterface[]
	 */
	private $filters = [ ];

	/**
	 * Contains a group of filters mapped to an array key.
	 *
	 * @var array
	 */
	private $filters_by_key = [ ];

	/**
	 * Adding filters to an array key.
	 *
	 * @param   FilterInterface $filter
	 * @param   string          $array_key
	 *
	 * @return void
	 */
	public function add_filter( FilterInterface $filter, $array_key = '' ) {

		if ( $array_key === '' ) {
			$this->filters[] = $filter;
		} else {

			if ( ! array_key_exists( $array_key, $this->filters_by_key ) ) {
				$this->filters_by_key[ $array_key ] = [ ];
			}
			$this->filters_by_key[ $array_key ][] = $filter;
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function filter( $value ) {

		if ( empty( $value ) ) {
			return $value;
		}

		if ( ! is_array( $value ) ) {
			$value = array( $value );
		}

		foreach ( $value as $key => $the_value ) {
			if ( is_array( $the_value ) ) {
				$the_value = $this->filter( $the_value );
			}
			$value[ $key ] = $this->do_filter( $key, $the_value );
		}

		return $value;
	}

	/**
	 * @param   string $key
	 * @param   mixed  $value
	 *
	 * @return  mixed $value
	 */
	protected function do_filter( $key, $value ) {

		// filter by all filter without key.
		foreach ( $this->filters as $filter ) {
			$value = $filter->filter( $value );
		}

		// filter by key-filter
		if ( array_key_exists( $key, $this->filters_by_key ) ) {
			/** @var \Inpsyde\Filter\FilterInterface[] $filters */
			$filters = $this->filters_by_key[ $key ];
			foreach ( $filters as $filter ) {
				$value = $filter->filter( $value );
			}
		}

		return $value;
	}

}