<?php

namespace Quality\Test;

use Quality\Feature\WikitextLengthFeature;
use Quality\Transform\Log1pTransform;

/**
 * Test Quality\Feature\WikitextLengthFeature.
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
class WikitextLengthFeatureTest extends \MediaWikiTestCase {

	/**
	 * @dataProvider provideBuildRepresentation
	 */
	public function testBuildRepresentation( $params, $opts, $expect ) {
		$feature = new \Quality\Feature\WikitextLengthFeature( $opts );
		$this->assertEquals( $expect, $feature->buildRepresentation( $params ) );
	}

	public static function provideBuildRepresentation() {
		return array(
			array(
				array( 'wikitext' => '' ),
				array( 'max' => 25, 'bins' => 10, 'func' => new Log1pTransform() ),
				array( true, false, false, false, false, false, false, false, false, false )
			),
			array(
				array( 'wikitext' => 'foo bar' ),
				array( 'max' => 25, 'bins' => 10, 'func' => new Log1pTransform() ),
				array( false, false, false, false, false, false, true, false, false, false )
			),
			array(
				array( 'wikitext' => "foo\n[[test]]\nbar\n" ),
				array( 'max' => 25, 'bins' => 10, 'func' => new Log1pTransform() ),
				array( false, false, false, false, false, false, false, false, true, false )
			)
		);
	}

}
