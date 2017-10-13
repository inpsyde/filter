<?php

namespace Inpsyde\Filter\Tests\Unit;

use Inpsyde\Filter\Tests\Unit\Fake\WithOptionsFilter;

class AbstractFilterTest extends \PHPUnit_Framework_TestCase {

	public function test_basic() {

		static::assertInstanceOf( '\Inpsyde\Filter\FilterInterface', $this->create_stub() );
	}

	/**
	 * Basic test for error messages if nothing is validated.
	 */
	public function test_get_options() {

		/** @var \Inpsyde\Filter\AbstractFilter $stub */
		$stub = $this->create_stub();
		static::assertEquals( [ ], $stub->get_options() );
	}

	/**
	 * Test pre-defined options can be overwritten by constructor.
	 */
	public function test_overwrite_options() {

		$expceted = [ 'key' => 'new value' ];
		$filter   = new WithOptionsFilter( $expceted );

		static::assertEquals( $expceted, $filter->get_options() );
	}

	/**
	 * Test if a undefined option key throws an Exception.
	 *
	 * @expectedException \InvalidArgumentException
	 */
	public function test_invalid_options_in_constructor() {

		new WithOptionsFilter( [ 'some_undefined_key' => '' ] );
	}

	/**
	 * Basic test for implementation of "is_valid()".
	 */
	public function test_is_valid() {

		$value = 'some value';

		/** @var \Inpsyde\Filter\AbstractFilter $stub */
		$stub = $this->create_stub();
		$stub->expects( $this->any() )
		     ->method( 'filter' )
		     ->with( $value )
		     ->will( $this->returnValue( $value ) );

		static::assertEquals( $value, $stub->filter( $value ) );
	}

	/**
	 * Returns a new Mock of the AbstractValidator.
	 *
	 * @param array $args
	 *
	 * @return \PHPUnit_Framework_MockObject_MockObject
	 */
	private function create_stub( $args = [ ] ) {

		return $this->getMockForAbstractClass( '\Inpsyde\Filter\AbstractFilter', $args );
	}

}