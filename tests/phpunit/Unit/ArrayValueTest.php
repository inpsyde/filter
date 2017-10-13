<?php

namespace Inpsyde\Filter\Tests\Unit;

use Inpsyde\Filter\ArrayValue;

class ArrayValueTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Basic test with no filters.
	 */
	public function test_basic() {

		$expected = [ 'key' => 'value', ];
		$testee   = new ArrayValue();
		static::assertSame( $expected, $testee->filter( $expected ) );
	}

	/**
	 * Tests the different input types and expected result.
	 *
	 * @dataProvider provide__value_types
	 */
	public function test__invalid_value_type( $input, $expected ) {

		$testee = new ArrayValue();
		static::assertEquals( $expected, $testee->filter( $input ) );
	}

	/**
	 * Returns a dataSet of different input values with excepted result.
	 *
	 * @return array
	 */
	public function provide__value_types() {

		$t = $this->getMock( 'Traversable' );

		return [
			'valid_array'       => [ [ 'key' => 'value' ], [ 'key' => 'value' ] ],
			'valid_traversable' => [ $t, $t ],
			'string'            => [ '', '' ],
			'int'               => [ 1, 1 ],
			'boolean'           => [ TRUE, TRUE ]
		];

	}

	/**
	 * Basic test with one filter to filter all values.
	 */
	public function test_basic_add_filter() {

		$input          = [ 'key' => 'value', ];
		$expected_value = 'value1';
		$expected       = [ 'key' => $expected_value ];

		$testee = new ArrayValue();
		$testee->add_filter( $this->getMockFilter( $expected_value ) );

		static::assertSame( $expected, $testee->filter( $input ) );
	}

	/**
	 * Test multiple filters.
	 */
	public function test_multiple_add_filter() {

		$input          = [ 'key' => 'value', ];
		$expected_value = 'value1';
		$expected       = [ 'key' => $expected_value ];

		$testee = new ArrayValue();
		$testee->add_filter( $this->getMockFilter( 'value' ) );
		$testee->add_filter( $this->getMockFilter( $expected_value ) );

		static::assertEquals( $expected, $testee->filter( $input ) );
	}

	/**
	 * Basic test with 2 filters, where the second filter should not be called, because the array-key does not exists.
	 */
	public function test_basic_add_filter_by_key() {

		$input          = [ 'key' => 'value', ];
		$expected_value = 'value1';
		$expected       = [ 'key' => $expected_value ];

		$testee = new ArrayValue();
		$testee->add_filter_by_key( $this->getMockFilter( $expected_value ), 'key' );
		$testee->add_filter_by_key( $this->getMockFilter( '', 0 ), 'some non existing key.' );

		static::assertEquals( $expected, $testee->filter( $input ) );
	}

	/**
	 * @param string $return_value
	 * @param int    $called
	 *
	 * @return \PHPUnit_Framework_MockObject_Builder_InvocationMocker
	 */
	private function getMockFilter( $return_value = '', $called = 1 ) {

		$mock = $this->getMock( '\Inpsyde\Filter\FilterInterface' );
		$mock->expects( new \PHPUnit_Framework_MockObject_Matcher_InvokedCount( $called ) )
		     ->method( 'filter' )
		     ->will( $this->returnValue( $return_value ) );

		return $mock;
	}

}