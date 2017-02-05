<?php

namespace Quality\Test;

use Quality\Transform\Log1pTransform;

/**
 * Test Quality\Transform\Log1pTransform.
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
class Log1pTransformTest extends \MediaWikiTestCase {

	/**
	 * @dataProvider provideCalc
	 */
	public function testCalc( $value, $expect ) {
		$transform = new Log1pTransform();
		$this->assertEquals( $expect, $transform->calc( $value ) );
	}

	public static function provideCalc() {
		return array(
			array( 0, 0 ),
			array( 0.5, 0.40546510810816 ),
			array( 1, 0.69314718055995 ),
			array( 1.5, 0.91629073187416 ),
			array( 2, 1.0986122886681 ),
		);
	}
}
