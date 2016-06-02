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

	public function test_add_multiple_filter_by_key() {

		$key_1 = 'key1';
		$key_2 = 'key2';

		$input    = [
			$key_1 => 'input_value_1',
			$key_2 => 'input_value_2'
		];
		$expected = [
			$key_1 => 'expected_value_1',
			$key_2 => 'expected_value_2'
		];

		/** @var \Inpsyde\Filter\FilterInterface $mock */
		$mock_1 = $this->get_mock();
		$mock_1->method( 'filter' )
		       ->with( $input[ $key_1 ] )
		       ->will( $this->returnValue( $expected[ $key_1 ] ) );

		$mock_2 = $this->get_mock();
		$mock_2->method( 'filter' )
		       ->with( $input[ $key_2 ] )
		       ->will( $this->returnValue( $expected[ $key_2 ] ) );

		$testee = new ArrayValue();
		$testee->add_filter( $mock_1, $key_1 );
		$testee->add_filter( $mock_2, $key_2 );

		$this->assertEquals( $expected, $testee->filter( $input ) );
	}

	/**
	 * @return \PHPUnit_Framework_MockObject_MockObject
	 */
	private function get_mock() {

		return $this->getMock( '\Inpsyde\Filter\FilterInterface' );
	}
}