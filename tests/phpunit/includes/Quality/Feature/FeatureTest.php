<?php

namespace Quality\Test;

use Quality\Feature\Feature;

/**
 * Test Quality\Feature\Feature.
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
class FeatureTest extends \MediaWikiTestCase {

	/**
	 * @dataProvider provideAddOptions
	 */
	public function testAddOptions( $opts, $expect ) {
		$stub = $this->getMockForAbstractClass('\Quality\Feature\Feature');
		$this->assertEquals( $expect, $stub->addOptions( $opts ) );
	}

	public static function provideAddOptions() {
		return array(
			array(
				array(),
				array(),
			),
			array(
				array( 'cache' => true ),
				array( 'cache' => true ),
			)
		);
	}
}
