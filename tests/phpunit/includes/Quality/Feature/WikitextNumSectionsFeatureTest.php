<?php

namespace Quality\Test;

use Quality\Feature\WikitextNumSectionsFeature;

/**
 * Test Quality\Feature\WikitextNumSectionFeature.
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
class WikitextNumSectionsFeatureTest extends \MediaWikiTestCase {

	/**
	 * @dataProvider provideBuildRepresentation
	 */
	public function testBuildRepresentation( $params, $opts, $expect ) {
		$feature = new \Quality\Feature\WikitextNumSectionsFeature( $opts );
		$this->assertEquals( $expect, $feature->buildRepresentation( $params ) );
	}

	public static function provideBuildRepresentation() {
		return array(
			array(
				array( 'wikitext' => '' ),
				array( 'max' => 5, 'bins' => 10 ),
				array( true, false, false, false, false, false, false, false, false, false )
			),
			array(
				array( 'wikitext' => 'foo bar' ),
				array( 'max' => 5, 'bins' => 10 ),
				array( true, false, false, false, false, false, false, false, false, false )
			),
			array(
				array( 'wikitext' => "foo\n== test ==\nbar\n" ),
				array( 'max' => 5, 'bins' => 10 ),
				array( false, false, true, false, false, false, false, false, false, false )
			),
			array(
				array( 'wikitext' => "foo\n== test ==\n== external ==\nbar\n" ),
				array( 'max' => 5, 'bins' => 10 ),
				array( false, false, false, false, true, false, false, false, false, false )
			)
		);
	}

}
