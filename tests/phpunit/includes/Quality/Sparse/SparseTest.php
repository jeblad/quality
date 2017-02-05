<?php

namespace Quality\Test;

use Quality\Sparse\Sparse;

/**
 * Test Quality\Sparse\Sparse.
 *
 * @file
 * @since 0.1
 *
 * @ingroup QualityTest
 * @ingroup Test
 *
 * @group Database
 * @group Quality
 * @group QualityFeature
 *
 * @licence GNU GPL v2+
 * @author John Erling Blad < jeblad@gmail.com >
 *
 */
class SparseTest extends \MediaWikiTestCase {

	protected $className;

	public function setUp() {
		parent::setUp();
		$this->className = 'Quality\Sparse\Sparse';
	}

	public function testBasic() {
		$sparse = new $this->className();
		$this->assertEquals( array( false, false ), $sparse->values() );
		$sparse->allOn();
		$this->assertEquals( array( true, true ), $sparse->values() );
		$sparse->allOff();
		$this->assertEquals( array( false, false ), $sparse->values() );
	}

	/**
	 * @dataProvider provideData
	 */
	public function testToggle( $opts, $value, $expect ) {
		$sparse = new $this->className( $opts );

		$sparse->on( $value );
		$this->assertEquals( $expect, $sparse->values() );

		$sparse->allOn();
		$invert = array_map( function ( $state) { return !$state; }, $expect );

		$sparse->off( $value );
		$this->assertEquals( $invert, $sparse->values() );
	}

	public static function provideData() {
		return array(
			array(
				array(),
				0,
				array( true, false ),
			),
			array(
				array(),
				1,
				array( false, true ),
			),
			array(
				array(),
				2, // outside defined sparse vector
				array( false, false ),
			),
			array(
				array( 'bins' => 3 ),
				0,
				array( true, false, false ),
			),
			array(
				array( 'bins' => 3 ),
				1,
				array( false, true, false ),
			),
			array(
				array( 'bins' => 3 ),
				2,
				array( false, false, true ),
			),
			array(
				array( 'bins' => 3 ),
				3, // outside defined sparse vector
				array( false, false, false ),
			)
		);
	}
}
