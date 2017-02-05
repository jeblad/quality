<?php

namespace Quality\Test;

use Quality\Feature\OutputNumExternalLinksFeature;

/**
 * Test Quality\Feature\OutputNumExternalLinksFeature.
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
class OutputNumExternalLinksFeatureTest extends \MediaWikiTestCase {

	/**
	 * @dataProvider provideBuildRepresentation
	 */
	public function testBuildRepresentation( $params, $opts, $expect ) {
		$feature = new \Quality\Feature\OutputNumExternalLinksFeature( $opts );
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
				array( 'wikitext' => "foo\n[http://example.com example.com]\nbar\n" ),
				array( 'max' => 3, 'bins' => 4 ),
				array( false, true, false, false )
			),
			array(
				array( 'wikitext' => "foo\n[http://example.com example.com]\n[http://example.net example.net]\nbar\n" ),
				array( 'max' => 3, 'bins' => 4 ),
				array( false, false, true, false )
			)
		);
		foreach ( $data as $key => $val ) {
			$content = new \WikitextContent( $val[0]['wikitext'] );
			$wikipage = new \Wikipage( \Title::newFromText( 'WikitextFeatureTest' ) );
			$wikipage->doEditContent( $content, 'summary for test entry' );
			$output = $wikipage->getParserOutput( new \ParserOptions() );
			$data[$key][0]['output'] = $output;
		}
		return $data;
	}

}
