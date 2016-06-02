<?php

namespace Inpsyde\Filter;

/**
 * Class AbstractFilter
 *
 * @package Inpsyde\Filter
 */
abstract class AbstractFilter implements FilterInterface {

	/**
	 * Filter options.
	 *
	 * @var array
	 */
	protected $options = [ ];

	/**
	 * @param  array|\Traversable $options
	 */
	public function __construct( array $options = [ ] ) {

		$this->set_options( $options );
	}

	/**
	 * Setting the given options from constructor.
	 *
	 * @param array $options
	 *
	 * @throws \InvalidArgumentException if the given option is not available to overwrite.
	 */
	protected function set_options( array $options = [ ] ) {

		foreach ( $options as $key => $value ) {
			if ( ! array_key_exists( $key, $this->options ) ) {
				throw new \InvalidArgumentException(
					sprintf( 'The option "%1$s" does not have a matching option[%1$s] array key', $key ),
					1.0
				);
				continue;
			}

			$this->options[ $key ] = $value;
		}
	}

	/**
	 * Retrieve options representing object state.
	 *
	 * @return array
	 */
	public function get_options() {

		return $this->options;
	}

	/**
	 * {@inheritdoc}
	 */
	abstract public function filter( $value );

} 