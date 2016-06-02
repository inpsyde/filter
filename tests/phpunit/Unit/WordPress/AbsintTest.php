<?php

namespace Inpsyde\Filter\Tests\Unit\WordPress;

use \Inpsyde\Filter\WordPress\Absint;
use Brain\Monkey;

class AbsintTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Sets up the environment.
	 *
	 * @return void
	 */
	protected function setUp() {

		parent::setUp();
		Monkey::setUp();
	}

	/**
	 * Tears down the environment.
	 *
	 * @return void
	 */
	protected function tearDown() {

		Monkey::tearDown();
		parent::tearDown();
	}

	public function test_basic() {

		$this->assertInstanceOf( '\Inpsyde\Filter\FilterInterface', new Absint() );
	}

	/**
	 *
	 * @dataProvider provide__filters
	 */
	public function test_filter( $input, $expected ) {

		$filter = new Absint();

		Monkey\Functions::when( '_doing_it_wrong' );

		Monkey\Functions::expect( 'absint' )
		                ->with( $input )
		                ->andReturn( $expected );

		$this->assertSame( $expected, $filter->filter( $input ) );
	}

	public function provide__filters() {

		return [
			// input, expected
			"valid"      => [ 1, 1 ],
			"not_scalar" => [ [ ], [ ] ]
		];
	}

}