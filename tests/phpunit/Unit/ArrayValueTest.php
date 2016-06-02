<?php

namespace Inpsyde\Filter\Tests\Unit;

use Inpsyde\Filter\ArrayValue;

class ArrayValueTest extends \PHPUnit_Framework_TestCase {

	public function test_basic() {

		$this->assertInstanceOf( '\Inpsyde\Filter\FilterInterface', new ArrayValue() );
	}

	/**
	 * Basic test for error messages if nothing is validated.
	 */
	public function test_add_filter() {

		$expected = 'test';

		/** @var \Inpsyde\Filter\FilterInterface $mock */
		$mock = $this->get_mock();
		$mock->method( 'filter' )
		     ->with( $expected )
		     ->will( $this->returnValue( $expected ) );

		$testee = new ArrayValue();
		$testee->add_filter( $mock );

		$this->assertEquals( [ $expected ], $testee->filter( [ $expected ] ) );
	}

	/**
	 * Basic test for error messages if nothing is validated.
	 */
	public function test_add_filter_by_key() {

		$expected_value = 'value';
		$expected_key   = 'key';
		$expected       = [ $expected_key => $expected_value ];

		/** @var \Inpsyde\Filter\FilterInterface $mock */
		$mock = $this->get_mock();
		$mock->method( 'filter' )
		     ->with( $expected_value )
		     ->will( $this->returnValue( $expected_value ) );

		$testee = new ArrayValue();
		$testee->add_filter( $mock, $expected_key );

		$this->assertEquals( $expected, $testee->filter( $expected ) );
	}

	/**
	 * Basic test for error messages if nothing is validated.
	 */
	public function test_add_multiple_filter() {

		$expected = 'test';

		/** @var \Inpsyde\Filter\FilterInterface $mock */
		$mock_1 = $this->get_mock();
		$mock_1->method( 'filter' )
		       ->with( $expected )
		       ->will( $this->returnValue( $expected ) );

		$mock_2 = $this->get_mock();
		$mock_2->method( 'filter' )
		       ->with( $expected )
		       ->will( $this->returnValue( $expected ) );

		$testee = new ArrayValue();
		$testee->add_filter( $mock_1 );
		$testee->add_filter( $mock_2 );

		$input = [ $expected, $expected ];
		$this->assertEquals( $input, $testee->filter( $input ) );
	}

	/**
	 * @return \PHPUnit_Framework_MockObject_MockObject
	 */
	private function get_mock() {

		return $this->getMock( '\Inpsyde\Filter\FilterInterface' );
	}
}