<?php

namespace Inpsyde\Filter\Tests\Unit;

use Inpsyde\Filter\ArrayValue;
use Inpsyde\Filter\FilterFactory;

class FilterFactoryTest extends \PHPUnit_Framework_TestCase {

	public function test_basic() {

		$expected = '\Inpsyde\Filter\FilterInterface';
		$factory  = new FilterFactory();

		$this->assertInstanceOf( $expected, $factory->create( 'ArrayValue' ) );

	}

	/**
	 * Test if Factory creates external classes which are implementing the FilterInterface
	 */
	public function test_external_filter() {

		$factory = new FilterFactory();
		$factory->create( Fake\WithOptionsFilter::class );
	}

	/**
	 * Test if Factory throws an exception if validator is undefined.
	 *
	 * @expectedException \InvalidArgumentException
	 */
	public function test_unknown_filter() {

		$factory = new FilterFactory();
		$factory->create( 'some invalid class name' );
	}
}