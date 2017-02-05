<?php

namespace Quality\Test;

use Quality\Transform\IdentityTransform;

/**
 * Test Quality\Transform\IdentityTransform.
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
class IdentityTransformTest extends \MediaWikiTestCase {

	/**
	 * @dataProvider provideCalc
	 */
	public function testCalc( $value, $expect ) {
		$transform = new IdentityTransform();
		$this->assertEquals( $expect, $transform->calc( $value ) );
	}

	public static function provideCalc() {
		return array(
			array( 0, 0 ),
			array( 0.5, 0.5 ),
			array( 1, 1 ),
			array( 1.5, 1.5 ),
			array( 2, 2 ),
		);
	}
}
