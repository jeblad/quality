<?php

namespace Quality\Test;

use Quality\Feature\WikitextKnownSectionsFeature;

/**
 * Test Quality\Feature\WikitextKnownSectionFeature.
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
class WikitextKnownSectionsFeatureTest extends \MediaWikiTestCase {

	/**
	 * @dataProvider provideBuildRepresentation
	 */
	public function testBuildRepresentation( $params, $opts, $expect ) {
		$feature = new \Quality\Feature\WikitextKnownSectionsFeature( $opts );
		$this->assertEquals( $expect, $feature->buildRepresentation( $params ) );
	}

	public static function provideBuildRepresentation() {
		return array(
			array(
				array( 'wikitext' => '' ),
				array( 'known' => array( 'source', 'foo', 'external', 'bar' ) ),
				array( false, false, false, false )
			),
			array(
				array( 'wikitext' => 'foo bar' ),
				array( 'known' => array( 'source', 'foo', 'external', 'bar' ) ),
				array( false, false, false, false )
			),
			array(
				array( 'wikitext' => "foo\n== test ==\nbar\n" ),
				array( 'known' => array( 'source', 'foo', 'external', 'bar' ) ),
				array( false, false, false, false )
			),
			array(
				array( 'wikitext' => "foo\n== test ==\n== external ==\nbar\n" ),
				array( 'known' => array( 'source', 'foo', 'external', 'bar' ) ),
				array( false, false, true, false )
			),
			array(
				array( 'wikitext' => "foo\n== external ==\n== test ==\n== source ==\nbar\n" ),
				array( 'known' => array( 'source', 'foo', 'external', 'bar' ) ),
				array( true, false, true, false )
			)
		);
	}

}
