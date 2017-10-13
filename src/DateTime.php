<?php

namespace Inpsyde\Filter;

/**
 * Class DateTime
 *
 * @package Inpsyde\Filter
 */
class DateTime extends AbstractFilter {

	/**
	 * {@inheritdoc}
	 */
	protected $options = array(
		'format' => 'Y-m-d'
	);

	/**
	 * {@inheritdoc}
	 */
	public function filter( $value ) {

		try {
			$result = $this->normalize_date_time( $value );
		}
		catch ( \Exception $e ) {
			do_action(
				'inpsyde.filter.error',
				'The given value caused an exception.',
				[ 'method' => __METHOD__, 'exception' => $e, 'value' => $value ]
			);

			return '';
		}

		if ( $result === FALSE ) {
			return $value;
		}

		return $result;
	}

	/**
	 * Normalize the provided value to a formatted string.
	 *
	 * @param  string|int|DateTime $value
	 *
	 * @return string
	 */
	protected function normalize_date_time( $value ) {

		if ( $value === '' || $value === NULL ) {
			return $value;
		}
		if ( ! is_string( $value ) && ! is_int( $value ) && ! $value instanceof DateTime ) {
			return $value;
		}
		if ( is_int( $value ) ) {
			//timestamp
			$value = new \DateTime( '@' . $value );
		} elseif ( ! $value instanceof DateTime ) {
			$value = new \DateTime( $value );
		}

		return $value->format( $this->options[ 'format' ] );
	}
}