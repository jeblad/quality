<?php

namespace Quality\Test;

use Quality\Feature\OutputNumCategoriesFeature;

/**
 * Test Quality\Feature\OutputNumCategoriesFeature.
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
class OutputNumCategoriesFeatureTest extends \MediaWikiTestCase {

	/**
	 * @dataProvider provideBuildRepresentation
	 */
	public function testBuildRepresentation( $params, $opts, $expect ) {
		$feature = new \Quality\Feature\OutputNumCategoriesFeature( $opts );
		$this->assertEquals( $expect, $feature->buildRepresentation( $params ) );
	}

	public static function provideBuildRepresentation() {
		$data = array(
			array(
				array( 'wikitext' => '' ),
				array( 'max' => 3, 'bins' => 4 ),
				array( true, false, false, false )
			),
			array(
				array( 'wikitext' => 'foo bar' ),
				array( 'max' => 3, 'bins' => 4 ),
				array( true, false, false, false )
			),
			array(
				array( 'wikitext' => "foo\n[[Category:Foo]]\nbar\n" ),
				array( 'max' => 3, 'bins' => 4 ),
				array( false, true, false, false )
			),
			array(
				array( 'wikitext' => "foo\n[[Category:Foo]]\n[[Category:Bar]]\nbar\n" ),
				array( 'max' => 3, 'bins' => 4 ),
				array( false, false, true, false )
			),
			array(
				array( 'wikitext' => '' ),
				array( 'max' => 3, 'bins' => 4, 'subset' => 'broken' ),
				array( true, false, false, false )
			),
			array(
				array( 'wikitext' => 'foo bar' ),
				array( 'max' => 3, 'bins' => 4, 'subset' => 'broken' ),
				array( true, false, false, false )
			),
			array(
				array( 'wikitext' => "foo\n[[Category:Foo]]\nbar\n" ),
				array( 'max' => 3, 'bins' => 4, 'subset' => 'broken' ),
				array( false, true, false, false )
			),
			array(
				array( 'wikitext' => "foo\n[[Category:Foo]]\n[[Category:Bar]]\nbar\n" ),
				array( 'max' => 3, 'bins' => 4, 'subset' => 'broken' ),
				array( false, false, true, false )
			),
			array(
				array( 'wikitext' => '' ),
				array( 'max' => 3, 'bins' => 4, 'subset' => 'valid' ),
				array( true, false, false, false )
			),
			array(
				array( 'wikitext' => 'foo bar' ),
				array( 'max' => 3, 'bins' => 4, 'subset' => 'valid' ),
				array( true, false, false, false )
			),
			// not defined
			array(
				array( 'wikitext' => "foo\n[[Category:Foo]]\nbar\n" ),
				array( 'max' => 3, 'bins' => 4, 'subset' => 'valid' ),
				array( true, false, false, false )
			),
			// not defined
			array(
				array( 'wikitext' => "foo\n[[Category:Foo]]\n[[Category:Bar]]\nbar\n" ),
				array( 'max' => 3, 'bins' => 4, 'subset' => 'valid' ),
				array( true, false, false, false )
			)
		);
		foreach ( $data as $key => $val ) {
			$content = new \WikitextContent( $val[0]['wikitext'] );
			$wikipage = new \Wikipage( \Title::newFromText( 'WikitextFeatureTest' ) );
			$wikipage->doEditContent( $content, 'summary for test entry' );
			$data[$key][0]['output'] = $wikipage->getParserOutput( new \ParserOptions() );
		}
		return $data;
	}

}
