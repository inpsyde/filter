<?php

namespace Inpsyde\Filter;

/**
 * Class ArrayValue
 *
 * @package Inpsyde\Filter
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
	 * Adding filters to filter all array-values.
	 *
	 * @param   FilterInterface $filter
	 *
	 * @return ArrayValue
	 */
	public function add_filter( FilterInterface $filter ) {

		$this->filters[] = $filter;

		return $this;
	}

	/**
	 * Adding a filter grouped by array key.
	 *
	 * @throws Exception\InvalidArgumentException if type of $key is not scalar.
	 *
	 * @param FilterInterface    $filter
	 * @param                    $key
	 *
	 * @return ArrayValue
	 */
	public function add_filter_by_key( FilterInterface $filter, $key ) {

		if ( ! is_scalar( $key ) ) {
			throw new Exception\InvalidArgumentException( 'key should be a scalar value.' );
		}

		$key = (string) $key;

		if ( ! isset ( $this->filters_by_key[ $key ] ) ) {
			$this->filters_by_key[ $key ] = [ ];
		}

		$this->filters_by_key[ $key ][] = $filter;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function filter( $values ) {

		if ( ! is_array( $values )&& ! $values instanceof \Traversable  ) {

			return $values;
		}

		$values = $this->all_filters( $values );
		$values = $this->filter_by_key( $values );

		return $values;
	}

	/**
	 * @param mixed $values
	 *
	 * @return mixed
	 */
	private function all_filters( $values ) {

		foreach ( $values as $key => $value ) {
			foreach ( $this->filters as $filter ) {
				$values[ $key ] = $filter->filter( $value );
			}
		}

		return $values;
	}

	/**
	 * Filters all values by array-key.
	 *
	 * @param   mixed $values
	 *
	 * @return  mixed $value
	 */
	protected function filter_by_key( $values ) {

		if ( count( $this->filters_by_key ) < 1 ) {

			return $values;
		}

		foreach ( $values as $key => $value ) {
			if ( ! is_scalar( $value ) || ! isset( $this->filters_by_key[ $key ] ) ) {
				continue;
			}
			/** @var FilterInterface[] */
			$filters = $this->filters_by_key[ $key ];
			foreach ( $filters as $filter ) {
				$values[ $key ] = $filter->filter( $value );
			}
		}

		return $values;
	}

}