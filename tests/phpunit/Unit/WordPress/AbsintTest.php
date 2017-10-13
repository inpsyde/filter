<?php

namespace Inpsyde\Filter\Tests\Unit\WordPress;

use Brain\Monkey;
use Inpsyde\Filter\WordPress\Absint;

class AbsintTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Sets up the environment.
	 *
	 * @return void
	 */
	protected function setUp() {

		parent::setUp();
		Monkey::setUpWP();
	}

	/**
	 * Tears down the environment.
	 *
	 * @return void
	 */
	protected function tearDown() {

		Monkey::tearDownWP();
		parent::tearDown();
	}

	public function test_basic() {

		static::assertInstanceOf( '\Inpsyde\Filter\FilterInterface', new Absint() );
	}

	public function test_filter() {

		$expected = 1;

		Monkey\Functions::expect( 'absint' )
			->once()
			->with( \Mockery::type( 'int' ) )
			->andReturn( $expected );

		static::assertSame( $expected, ( new Absint() )->filter( $expected ) );
	}

	public function test_filter__non_scalar() {

		$expected = new \stdClass();

		Monkey\WP\Actions::expectFired( 'inpsyde.filter.error' );

		Monkey\Functions::expect( 'absint' )
			->never();

		static::assertSame( $expected, ( new Absint() )->filter( $expected ) );
	}
}